<?php

/**
 * Próximos Estrenos Marvel
 * 
 * Muestra una lista detallada de las próximas películas de Marvel
 * con información adicional y descripciones.
 */

declare(strict_types=1);

require_once 'config/consts.php';
require_once 'config/functions.php';

// Obtener datos de la API
$data = fetchAPIData();

// Procesar los datos para los próximos estrenos
function processUpcomingMovies(?array $data): array
{
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

// Función para obtener una descripción de la película
function getMovieDescription(string $title): string
{
    // Aquí podrías integrar con otra API para obtener sinopsis
    // Por ahora retornamos un texto genérico
    return "Prepárate para una nueva aventura épica en el Universo Cinematográfico de Marvel " .
        "con " . $title . ". Esta nueva entrega promete llevar la saga a nuevos horizontes " .
        "con emocionantes secuencias de acción y una historia cautivadora que expandirá " .
        "los límites del MCU.";
}

$movies = processUpcomingMovies($data);

?>
<!DOCTYPE html>
<html lang="es">
<?php render_template('head', ['title' => 'Próximos Estrenos Marvel']); ?>

<body>
    <?php render_template('header', $data); ?>

    <main class="container">
        <?php if (empty($movies)): ?>
            <div class="error-message" role="alert">
                <p>Lo sentimos, no pudimos cargar la información de próximos estrenos en este momento.</p>
                <p>Por favor, inténtalo más tarde.</p>
            </div>
        <?php else: ?>
            <section class="upcoming-movies">
                <h2>Próximos Estrenos Marvel</h2>

                <div class="movies-grid">
                    <?php foreach ($movies as $movie): ?>
                        <article class="movie-card-large <?= $movie['is_next'] ? 'next-release' : ''; ?>">
                            <?php if ($movie['is_next']): ?>
                                <div class="next-badge">Próximo Estreno</div>
                            <?php endif; ?>

                            <div class="movie-poster-container">
                                <?php if (!empty($movie['poster_url'])): ?>
                                    <img src="<?= e($movie['poster_url']); ?>"
                                        alt="Póster de <?= e($movie['title']); ?>"
                                        width="300"
                                        height="450"
                                        loading="lazy"
                                        class="movie-poster-large">
                                <?php endif; ?>
                            </div>

                            <div class="movie-details">
                                <h3><?= e($movie['title']); ?></h3>

                                <div class="release-info">
                                    <time datetime="<?= $movie['release_date']->format('Y-m-d'); ?>">
                                        Estreno: <?= $movie['release_date']->format('d \d\e F \d\e Y'); ?>
                                    </time>

                                    <?php if (isset($movie['days_until'])): ?>
                                        <p class="countdown">
                                            <span class="days"><?= e($movie['days_until']); ?></span>
                                            <span class="days-label">días restantes</span>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="movie-overview">
                                    <p><?= e($movie['overview']); ?></p>
                                </div>

                                <div class="movie-meta">
                                    <div class="meta-item">
                                        <span class="meta-label">Estreno en:</span>
                                        <span class="meta-value">Cines</span>
                                    </div>
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