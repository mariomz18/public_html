<div style="text-align: center; padding: 50px;">
    <h1 style="color: green;">¡La compra ha finalizado correctamente!</h1>
    <p>Tu número de pedido es: <strong>#<?= htmlspecialchars($_GET['order_id'] ?? '-') ?></strong></p>
    <p>Comprueba tu correo electrónico para ver los detalles del pedido.</p>
    
    <a href="index.php?accio=llistar-categories" class="btn-primary">Volver a la tienda</a>
</div>