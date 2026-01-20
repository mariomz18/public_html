<?php
// controller que maneja la lógica de registro de usuario
require_once __DIR__ . '/../model/usuari.php';

$message = null; // mensaje de exito/error

// si la petición es POST, procesamos el formulario 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // extraemos las variables del POST y las limpiamos
    $name     = trim($_POST['nombre'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $address  = trim($_POST['direccion'] ?? '');
    $city     = trim($_POST['poblacion'] ?? '');
    $zip_code = trim($_POST['cp'] ?? '');

    // validamos usando esas variables que acabamos de crear
    if (empty($name)) {
        $message = ['type' => 'error', 'text' => 'El nombre es obligatorio.'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = ['type' => 'error', 'text' => 'El formato del email no es válido.'];
    } elseif (strlen($password) < 6) {
        $message = ['type' => 'error', 'text' => 'La contraseña debe tener al menos 6 caracteres.'];
    } elseif (!empty($zip_code) && !preg_match('/^\d{5}$/', $zip_code)) {
        $message = ['type' => 'error', 'text' => 'El código postal debe tener 5 dígitos.'];
    } else {
        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'city' => $city,
            'zip_code' => $zip_code
        ];

        // llamar a model para registrar
        if (registerUser($userData)) {
            header("Location: index.php?accio=login");
            exit();
        } else {
            $message = ['type' => 'error', 'text' => 'Error al registrar el usuario. El email podría ya estar en uso.'];
        }
    }
}

// cargar la vista del formulario de registro
require_once __DIR__ . '/../views/formulari_registre.php';
?>