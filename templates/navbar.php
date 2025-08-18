<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar">
    <ul class="nav-list">
        <li><a href="index.php" class="nav-link">Inicio</a></li>
        <li><a href="proximos.php" class="nav-link">Próximos Estrenos</a></li>
        <li><a href="calendario.php" class="nav-link">Calendario</a></li>
    </ul>
</nav>
<button class="menu-toggle" aria-label="Menú de navegación">
    <span class="hamburger"></span>
</button>
<div class="modal-overlay">
    <!-- El contenido del navbar se moverá aquí en móviles -->
</div>