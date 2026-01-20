<?php
// controller/API_carrito.php
//session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../model/productes.php';

// Inicializamos el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
if (!isset($_SESSION['total_qty'])) { $_SESSION['total_qty'] = 0; }
if (!isset($_SESSION['total_price'])) { $_SESSION['total_price'] = 0.00; }

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'add') {
    // Leemos el JSON enviado por JS
    $data = json_decode(file_get_contents('php://input'), true);
    
    $productId = isset($data['id']) ? (int)$data['id'] : 0;
    $quantity = isset($data['quantity']) ? (int)$data['quantity'] : 1;

    if ($productId > 0 && $quantity > 0) {
        // Obtenemos precio real de la BD para cálculos seguros
        $product = getDetallProducte($productId);
        
        if ($product) {
            // Actualizar carrito (ID => Cantidad)
            if (isset($_SESSION['carrito'][$productId])) {
                $_SESSION['carrito'][$productId] += $quantity;
            } else {
                $_SESSION['carrito'][$productId] = $quantity;
            }

            // Actualizar totales globales de sesión (para el header)
            $_SESSION['total_qty'] += $quantity;
            $_SESSION['total_price'] += ($product['price'] * $quantity);

            echo json_encode([
                'success' => true, 
                'message' => 'Producto añadido correctamente.',
                'total_qty' => $_SESSION['total_qty'],
                'total_price' => number_format($_SESSION['total_price'], 2)
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no permitida.']);
}
?>