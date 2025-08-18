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
