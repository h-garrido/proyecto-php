 <?php
/**
 * Template para mostrar la información de la próxima película de Marvel
 * 
 * @var array|null $data Datos de la película con las siguientes claves:
 *      - title: string          Título de la película
 *      - poster_url: string     URL del póster
 *      - days_until: int        Días hasta el estreno
 *      - release_date: string   Fecha de estreno
 *      - following_production: array {
 *          - title: string      Título de la siguiente película
 *      }
 */

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