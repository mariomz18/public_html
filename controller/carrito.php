<?php
require_once __DIR__ . '/../model/productes.php';

$cartItems = [];
$totalGeneral = 0;

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $productId => $qty) {
        // Obtenemos los detalles completos del producto de la BD
        $product = getDetallProducte((int)$productId);
        
        if ($product) {
            $subtotal = $product['price'] * $qty;
            $totalGeneral += $subtotal;
            
            // Añadimos datos calculados al array para la vista
            $product['qty'] = $qty;
            $product['subtotal'] = $subtotal;
            $cartItems[] = $product;
        }
    }
}

// Si quieres asegurar consistencia, actualizamos la sesión con el total recalculado
$_SESSION['total_qty'] = array_sum($_SESSION['carrito'] ?? []);
$_SESSION['total_price'] = $totalGeneral;

// Cargamos la vista
require_once __DIR__ . '/../views/carrito.php';
?>