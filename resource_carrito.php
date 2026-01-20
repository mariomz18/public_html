<?php
require_once __DIR__ . '/resources/layout_header.php';
?>

    <h1>Tu Carrito de Compra</h1>
    <section id="carrito-view" class="view active">
        <?php require_once __DIR__ . '/controller/carrito.php'; ?>
    </section>

<?php
require_once __DIR__ . '/resources/layout_footer.php';
?>