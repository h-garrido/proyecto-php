 <?php
if (!function_exists('e')) {
    /**
     * Función de respaldo para escape HTML si no está disponible
     * @param string|int $text
     * @return string
     */
    function e($text): string {
        return htmlspecialchars((string)$text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
?>

<main class="container">
    <?php if ($data === null): ?>
        <div class="error-message" role="alert">
            <p>Lo sentimos, no pudimos cargar la información en este momento. Por favor, inténtalo más tarde.</p>
            <p>Intenta refrescar la página o vuelve más tarde.</p>
        </div>
    <?php else: ?>
        <section class="movie-card">
            <div class="poster-container">
                <img src="<?= e($data['poster_url'] ?? ''); ?>"
                    alt="Póster de <?= e($data['title'] ?? 'la película'); ?>"
                    width="200"
                    height="300"
                    loading="lazy"
                    class="movie-poster">
            </div>

            <hgroup class="movie-info">
                <h2 class="movie-title"><?= e($data['title'] ?? 'Próxima película'); ?></h2>
                <p class="release-info">
                    Se estrena en <span class="days-until"><?= e((string)($data['days_until'] ?? '?')) ?></span> días
                </p>
                <p class="release-date">
                    Fecha de estreno: <time datetime="<?= e($data['release_date'] ?? '') ?>"><?= e($data['release_date'] ?? 'Próximamente'); ?></time>
                </p>
                <?php if (!empty($data['following_production']['title'])): ?>
                    <p class="next-movie">
                        Siguiente película: <span class="next-title"><?= e($data['following_production']['title']); ?></span>
                    </p>
                <?php endif; ?>
            </hgroup>
        </section>
    <?php endif; ?>
 </main>