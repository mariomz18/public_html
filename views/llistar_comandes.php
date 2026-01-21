<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <h1>Mis Compras</h1>
    
    <?php if (empty($orders)): ?>
        <p>Aún no has realizado ninguna compra.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div style="border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; padding: 15px; background: #fff;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                    <strong>Pedido #<?= $order['id'] ?></strong>
                    <span style="color: #666;"><?= date('d/m/Y H:i', strtotime($order['date'])) ?></span>
                </div>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <?php foreach ($order['lines'] as $line): ?>
                        <tr>
                            <td style="padding: 5px;"><?= htmlspecialchars($line['product_name']) ?></td>
                            <td style="padding: 5px;">x<?= $line['quantity'] ?></td>
                            <td style="padding: 5px; text-align: right;"><?= $line['price_at_purchase'] ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                
                <div style="text-align: right; margin-top: 10px; font-weight: bold; font-size: 1.2em; color: var(--color-primary);">
                    Total: <?= $order['total_price'] ?> €
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>