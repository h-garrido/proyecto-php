<?php

/**
 * Renderiza un template con los datos proporcionados
 * 
 * @param string $template Nombre del template a renderizar
 * @param array $data Datos para el template
 */
function render_template(string $template, array $data = []): void {
    extract($data);
    require "templates/$template.php";
}

/**
 * Obtiene los datos de la API de Marvel con manejo de caché
 * 
 * @return array|null Datos de la API o null si hay error
 */
function fetchAPIData(): ?array {
    try {
        // Verificar si hay caché válido
        if (file_exists(CACHE_FILE) && (time() - filemtime(CACHE_FILE)) < CACHE_DURATION) {
            $cachedData = file_get_contents(CACHE_FILE);
            if ($cachedData === false) {
                throw new Exception('Error leyendo el archivo de caché');
            }
            $decoded = json_decode($cachedData, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        // Inicializar cURL
        $ch = curl_init(API_URL);
        if (!$ch) {
            throw new Exception('Error inicializando cURL');
        }

        // Configurar opciones de cURL
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Marvel Movies Info/1.0',
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => '',
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
        ]);

        // Ejecutar la petición
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Verificar errores
        if ($result === false) {
            throw new Exception('Error en la petición cURL: ' . curl_error($ch));
        }

        if ($httpCode !== 200) {
            throw new Exception('Error HTTP: ' . $httpCode);
        }

        curl_close($ch);

        // Decodificar respuesta
        $data = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error decodificando JSON: ' . json_last_error_msg());
        }

        // Guardar en caché
        if (!is_dir(dirname(CACHE_FILE))) {
            if (!mkdir(dirname(CACHE_FILE), 0755, true)) {
                throw new Exception('Error creando directorio de caché');
            }
        }
        
        if (file_put_contents(CACHE_FILE, $result) === false) {
            throw new Exception('Error guardando caché');
        }

        return $data;
    } catch (Exception $e) {
        error_log('Error en fetchAPIData: ' . $e->getMessage());
        return null;
    }
}

/**
 * Escapa texto para salida segura en HTML
 * 
 * @param string|int $text Texto a escapar
 * @return string Texto escapado
 */
function e(string|int $text): string {
    return htmlspecialchars((string)$text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Procesa los datos de películas para mostrar en el calendario y próximos estrenos
 * 
 * @param array|null $data Datos de la API
 * @return array Array de películas procesadas
 */
function processUpcomingMovies(?array $data): array {
    if (!$data) {
        return [];
    }

    $movies = [];
    
    // Añadir la próxima película
    if (isset($data['release_date'])) {
        $movies[] = [
            'title' => $data['title'],
            'release_date' => new DateTime($data['release_date']),
            'poster_url' => $data['poster_url'] ?? '',
            'days_until' => $data['days_until'],
            'overview' => getMovieDescription($data['title']),
            'is_next' => true
        ];
    }

    // Añadir la película siguiente
    if (isset($data['following_production']['release_date'])) {
        $movies[] = [
            'title' => $data['following_production']['title'],
            'release_date' => new DateTime($data['following_production']['release_date']),
            'poster_url' => $data['following_production']['poster_url'] ?? '',
            'days_until' => $data['following_production']['days_until'] ?? null,
            'overview' => getMovieDescription($data['following_production']['title']),
            'is_next' => false
        ];
    }

    return $movies;
}

/**
 * Genera una descripción para una película
 * 
 * @param string $title Título de la película
 * @return string Descripción generada
 */
function getMovieDescription(string $title): string {
    return "Prepárate para una nueva aventura épica en el Universo Cinematográfico de Marvel " .
           "con " . $title . ". Esta nueva entrega promete llevar la saga a nuevos horizontes " .
           "con emocionantes secuencias de acción y una historia cautivadora que expandirá " .
           "los límites del MCU.";
}

/**
 * Procesa los datos para el calendario de películas
 * 
 * @param array|null $data Datos de la API
 * @return array Array de películas procesadas para el calendario
 */
function processMoviesForCalendar(?array $data): array {
    if (!$data) {
        return [];
    }

    $movies = [];
    
    // Añadir la próxima película
    if (isset($data['release_date'])) {
        $date = new DateTime($data['release_date']);
        $movies[] = [
            'title' => $data['title'],
            'date' => $date,
            'poster_url' => $data['poster_url'] ?? '',
            'days_until' => $data['days_until']
        ];
    }

    // Añadir la película siguiente
    if (isset($data['following_production']['release_date'])) {
        $date = new DateTime($data['following_production']['release_date']);
        $movies[] = [
            'title' => $data['following_production']['title'],
            'date' => $date,
            'poster_url' => $data['following_production']['poster_url'] ?? '',
            'days_until' => $data['following_production']['days_until'] ?? null
        ];
    }

    return $movies;
}
