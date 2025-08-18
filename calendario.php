<?php

/**
 * Calendario de Películas Marvel
 * 
 * Muestra un calendario interactivo con las próximas películas de Marvel
 * organizadas por mes y año.
 */

declare(strict_types=1);

require_once 'config/consts.php';
require_once 'config/functions.php';

// Obtener datos de la API
$data = fetchAPIData();

// Procesar los datos para el calendario
function processMoviesForCalendar(?array $data): array
{
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

$movies = processMoviesForCalendar($data);

// Ordenar películas por fecha
usort($movies, function ($a, $b) {
    return $a['date'] <=> $b['date'];
});

?>
<!DOCTYPE html>
<html lang="es">
<?php render_template('head', ['title' => 'Calendario de Películas Marvel']); ?>

<body>
    <?php render_template('header', $data); ?>


    <main class="container">
        <?php if (empty($movies)): ?>
            <div class="error-message" role="alert">
                <p>Lo sentimos, no pudimos cargar la información del calendario en este momento.</p>
                <p>Por favor, inténtalo más tarde.</p>
            </div>
        <?php else: ?>
            <section class="calendar-section">
                <h2>Calendario de Estrenos Marvel</h2>

                <div class="timeline">
                    <?php foreach ($movies as $movie): ?>
                        <article class="timeline-item">
                            <div class="timeline-content">
                                <div class="movie-poster-small">
                                    <?php if (!empty($movie['poster_url'])): ?>
                                        <img src="<?= e($movie['poster_url']); ?>"
                                            alt="Póster de <?= e($movie['title']); ?>"
                                            width="100"
                                            height="150"
                                            loading="lazy">
                                    <?php endif; ?>
                                </div>
                                <div class="movie-info-calendar">
                                    <h3><?= e($movie['title']); ?></h3>
                                    <time datetime="<?= $movie['date']->format('Y-m-d'); ?>">
                                        <?= $movie['date']->format('d \d\e F \d\e Y'); ?>
                                    </time>
                                    <?php if (isset($movie['days_until'])): ?>
                                        <p class="days-until">
                                            Faltan <span class="highlight"><?= e($movie['days_until']); ?></span> días
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php render_template('footer', $data); ?>
</body>

</html>