<?php
require_once __DIR__ . '/../model/comandes.php';

// Verificación: Usuario logueado
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigir a login
    header("Location: index.php?accio=login");
    exit;
}

// Verificación: Carrito no vacío
if (empty($_SESSION['carrito'])) {
    header("Location: index.php?accio=carrito");
    exit;
}

$userId = $_SESSION['user_id'];
$totalPrice = $_SESSION['total_price'];
$cartItems = $_SESSION['carrito'];

// 1. Desar la comanda a la BD
$orderId = crearComanda($userId, $totalPrice, $cartItems);

if ($orderId) {
    // 2. Buidar el cabàs internament
    unset($_SESSION['carrito']);
    $_SESSION['total_qty'] = 0;
    $_SESSION['total_price'] = 0.00;

    // 3. Redirigir a pàgina de confirmació
    header("Location: index.php?accio=compra-finalitzada&order_id=" . $orderId);
    exit;
} else {
    // Manejo de error básico
    echo "Error al tramitar el pedido.";
}
?>