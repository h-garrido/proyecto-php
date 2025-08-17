<?php
/**
 * Este script obtiene información sobre la próxima película del Universo Cinematográfico de Marvel (MCU)
 * utilizando una API externa que proporciona detalles como la fecha de estreno, título y poster.
 */

declare(strict_types=1);

// Configuración
const API_URL = 'https://whenisthenextmcufilm.com/api';
const CACHE_FILE = __DIR__ . '/cache/api_response.json';
const CACHE_DURATION = 3600; // 1 hora en segundos

/**
 * Obtiene los datos de la API con manejo de caché
 * @return array|null Los datos de la API o null si hay un error
 */
function fetchAPIData(): ?array {
    // Verificar si hay caché válido
    if (file_exists(CACHE_FILE) && (time() - filemtime(CACHE_FILE)) < CACHE_DURATION) {
        $cachedData = file_get_contents(CACHE_FILE);
        return json_decode($cachedData, true);
    }

    // Inicializar cURL
    $ch = curl_init(API_URL);
    if (!$ch) {
        error_log('Error inicializando cURL');
        return null;
    }

    // Configurar opciones de cURL
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_USERAGENT => 'Marvel Movies Info/1.0'
    ]);

    // Ejecutar la petición
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Verificar errores
    if ($result === false || $httpCode !== 200) {
        error_log('Error en la petición cURL: ' . curl_error($ch));
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    // Decodificar respuesta
    $data = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Error decodificando JSON: ' . json_last_error_msg());
        return null;
    }

    // Guardar en caché
    if (!is_dir(dirname(CACHE_FILE))) {
        mkdir(dirname(CACHE_FILE), 0755, true);
    }
    file_put_contents(CACHE_FILE, $result);

    return $data;
}

/**
 * Escapa texto para salida segura en HTML
 */
function e(string|int $text): string {
    return htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Obtener datos
$data = fetchAPIData();

// var_dump($data); // Mostrar el resultado de la petición

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Consulta la próxima película de Marvel y su fecha de estreno.">
    <meta name="theme-color" content="#0066cc">
    <title>Próxima película de Marvel</title>
    
    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <?php if ($data === null): ?>
            <div class="error-message" role="alert">
                <p>Lo sentimos, no pudimos cargar la información en este momento. Por favor, inténtalo más tarde.</p>
            </div>
        <?php else: ?>
            <section>
                <img src="<?= e($data['poster_url'] ?? ''); ?>" 
                     alt="Póster de <?= e($data['title'] ?? 'la película'); ?>"
                     width="200" 
                     height="300"
                     loading="lazy"
                     class="movie-poster">
            </section>

            <hgroup class="movie-info">
                <h1><?= e($data['title'] ?? 'Próxima película'); ?></h1>
                <p class="release-info">
                    Se estrena en <span class="days-until"><?= e((string)($data['days_until'] ?? '?')) ?></span> días
                </p>
                <p class="release-date">
                    Fecha de estreno: <?= e($data['release_date'] ?? 'Próximamente'); ?>
                </p>
                <?php if (!empty($data['following_production']['title'])): ?>
                    <p class="next-movie">
                        Siguiente película: <?= e($data['following_production']['title']); ?>
                    </p>
                <?php endif; ?>
            </hgroup>
        <?php endif; ?>
    </main>

    <footer>
        <p><small>Datos proporcionados por <a href="https://whenisthenextmcufilm.com" target="_blank" rel="noopener">WhenIsTheNextMCUFilm</a></small></p>
    </footer>
</body>
</html>