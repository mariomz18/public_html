<?php
require_once __DIR__ . '/../model/usuari.php';

$error_login = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = validateUser($email, $password);

    if ($user) {
        // Inicio de sesión correcto, guardamos datos en $_SESSION
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        
        // Redirigir a la portada o catálogo
        header("Location: index.php");
        exit();
    } else {
        $error_login = "Email o contraseña incorrectos.";
    }
}

// Si falla o no es POST, cargamos la vista de Login
require_once __DIR__ . '/../views/login.php'; 
?>