<?php

/**
 * Aplicación Web - Próxima Película de Marvel
 * 
 * Este script crea una página web que muestra información sobre la próxima película
 * del Universo Cinematográfico de Marvel (MCU). Utiliza una API externa para obtener
 * datos actualizados y emplea un sistema de caché para optimizar el rendimiento.
 * 
 * Características principales:
 * - Consulta de API externa
 * - Sistema de caché para reducir peticiones
 * - Manejo de errores robusto
 * - Escape de datos para seguridad
 * - Diseño responsive con efectos visuales
 * 
 */

// Activar el modo estricto de tipos en PHP 7+
declare(strict_types=1);

// Configuración de la aplicación
require_once 'config/consts.php';

/**
 * Obtiene los datos de la próxima película de Marvel desde la API
 * 
 * Esta función implementa un sistema de caché para optimizar el rendimiento:
 * 1. Primero verifica si existe un caché válido
 * 2. Si el caché es válido, retorna los datos almacenados
 * 3. Si no hay caché o está expirado, realiza una nueva petición a la API
 * 4. Almacena la nueva respuesta en caché para futuras consultas
 * 
 * Características de seguridad:
 * - Verificación SSL habilitada
 * - Timeout de 5 segundos para evitar bloqueos
 * - User-Agent personalizado para identificación
 * - Manejo de errores HTTP
 * 
 * @return array|null Retorna los datos de la API como array asociativo, o null si hay error
 */
require_once 'config/functions.php';


// Obtener datos
$data = fetchAPIData();

// var_dump($data); // Mostrar el resultado de la petición

?>
<!DOCTYPE html>
<html lang="es">
<?php render_template('head', $data) ?>

<body>
    <?php render_template('header', $data) ?>
    <?php render_template('main', $data) ?>
    <?php render_template('footer', $data) ?>
</body>

</html>