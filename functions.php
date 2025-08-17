<?php


function fetchAPIData(): ?array
{
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

/* Escapa texto para salida segura en HTML
 */
function e(string|int $text): string
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
