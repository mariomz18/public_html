<?php
require_once __DIR__ . '/connectaBD.php';

function crearComanda($userId, $totalPrice, $cartItems) {
    $conn = connectaBD();
    
    // 1. Insertar el pedido
    $sqlOrder = 'INSERT INTO "order" (user_id, total_price) VALUES ($1, $2) RETURNING id';
    $result = pg_query_params($conn, $sqlOrder, [$userId, $totalPrice]);
    
    if (!$result) {
        error_log("Error creando pedido: " . pg_last_error($conn));
        pg_close($conn);
        return false;
    }
    
    $row = pg_fetch_assoc($result);
    $orderId = $row['id'];
    
    // 2. Insertar las líneas de pedido
    foreach ($cartItems as $productId => $qty) {
        // Obtenemos datos actuales del producto para congelar el precio
        $sqlProd = 'SELECT name, price FROM product WHERE id = $1';
        $resProd = pg_query_params($conn, $sqlProd, [$productId]);
        $prodData = pg_fetch_assoc($resProd);
        
        if ($prodData) {
            $sqlLine = 'INSERT INTO order_line (order_id, product_id, quantity, price_at_purchase, product_name) 
                        VALUES ($1, $2, $3, $4, $5)';
            pg_query_params($conn, $sqlLine, [
                $orderId, 
                $productId, 
                $qty, 
                $prodData['price'],
                $prodData['name']
            ]);
        }
    }
    
    pg_close($conn);
    return $orderId;
}

function getComandesByUsuari($userId) {
    $conn = connectaBD();
    
    // Obtenemos los pedidos ordenados por fecha
    $sql = 'SELECT * FROM "order" WHERE user_id = $1 ORDER BY date DESC';
    $result = pg_query_params($conn, $sql, [$userId]);
    $orders = pg_fetch_all($result) ?: [];
    
    // Para cada pedido, obtenemos sus líneas
    foreach ($orders as &$order) {
        $sqlLines = 'SELECT * FROM order_line WHERE order_id = $1';
        $resLines = pg_query_params($conn, $sqlLines, [$order['id']]);
        $order['lines'] = pg_fetch_all($resLines) ?: [];
    }
    
    pg_close($conn);
    return $orders;
}
?>