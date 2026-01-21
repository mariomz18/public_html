<div class="cart-container" style="background:#fff; padding:20px; border-radius:8px;">
    <?php if (empty($cartItems)): ?>
        <p style="text-align:center;">Tu carrito está vacío.</p>
        <div style="text-align:center; margin-top:20px;">
            <a href="index.php?accio=llistar-categories" class="btn-primary">Seguir comprando</a>
        </div>
    <?php else: ?>
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th style="text-align:left; padding:10px;">Producto</th>
                    <th style="padding:10px;">Precio</th>
                    <th style="padding:10px;">Cantidad</th>
                    <th style="padding:10px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding:10px; display:flex; align-items:center; gap:10px;">
                            <img src="<?= htmlspecialchars($item['image']) ?>" style="width:50px; height:50px; object-fit:contain;">
                            <?= htmlspecialchars($item['name']) ?>
                        </td>
                        <td style="padding:10px; text-align:center;"><?= $item['price'] ?> €</td>
                        <td style="padding:10px; text-align:center;"><?= $item['qty'] ?></td>
                        <td style="padding:10px; text-align:center; font-weight:bold;">
                            <?= number_format($item['subtotal'], 2) ?> €
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div style="text-align: right; margin-bottom: 10px;">
            <button onclick="emptyCart()" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                🗑️ Vaciar Carrito
            </button>
        </div>

        <div style="text-align:right; margin-top:20px; font-size:1.5em;">
            Total: <strong><?= number_format($totalGeneral, 2) ?> €</strong>
        </div>

        <div style="text-align:right; margin-top:20px;">
            <a href="index.php?accio=tramitar-pedido" class="btn-primary" style="background-color: green; text-decoration:none;">
                Tramitar Pedido
            </a>
        </div>
    <?php endif; ?>
</div>