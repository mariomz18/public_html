<?php
// controller que maneja la lógica de registro de usuario
require_once __DIR__ . '/../model/usuari.php';

$message = null; // mensaje de exito/error

// si la petición es POST, procesamos el formulario 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'name' => $_POST['nombre'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'address' => $_POST['direccion'] ?? '',
        'city' => $_POST['poblacion'] ?? '',
        'zip_code' => $_POST['cp'] ?? ''
    ];

    // validación de campos obligatorios
    if (empty($name)) {
        $message = ['type' => 'error', 'text' => 'El nombre es obligatorio.'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = ['type' => 'error', 'text' => 'El formato del email no es válido.'];
    } elseif (strlen($password) < 6) {
        $message = ['type' => 'error', 'text' => 'La contraseña debe tener al menos 6 caracteres.'];
    } elseif (!empty($zip_code) && !preg_match('/^\d{5}$/', $zip_code)) {
        $message = ['type' => 'error', 'text' => 'El código postal debe tener 5 dígitos.'];
    } else {
        // si todo es correcto, preparamos el array
        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'city' => $city,
            'zip_code' => $zip_code
        ];
        // llamar a model para registrar con cifrado y por parametros
        if (registerUser($userData)) {
            $message = ['type' => 'success', 'text' => 'Registro completado con éxito. Ya puedes iniciar sesión.'];
        } else {
            // Error email ya en uso
            $message = ['type' => 'error', 'text' => 'Error al registrar el usuario. El email podría ya estar en uso.'];
        }
    }
}

// cargar la vista del formulario de registro
require_once __DIR__ . '/../views/formulari_registre.php';
?>