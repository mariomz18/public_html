<?php
require_once __DIR__ . '/../model/usuari.php';
require_once __DIR__ . '/../resources/layout_header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?accio=login");
    exit;
}

$userId = $_SESSION['user_id'];
$message = '';

// Procesar Formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nombre'] ?? '';
    $address = $_POST['direccion'] ?? '';
    $city = $_POST['poblacion'] ?? '';
    $zip = $_POST['cp'] ?? '';
    
    $imageName = null;
    
    // Procesar subida de imagen (Requisito A.2 y A.3)
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['profile_image']['tmp_name'];
        $fileName = basename($_FILES['profile_image']['name']);
        
        // Limpiar nombre de archivo (recomendado en PDF)
        $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
        $finalName = $userId . '_' . time() . '_' . $fileName; // Evitar colisiones
        
        $destination = $filesAbsolutePath . $finalName;
        
        if (move_uploaded_file($tmpName, $destination)) {
            $imageName = $finalName;
        } else {
            $message = "Error al subir la imagen. Verifica permisos en uploadedFiles.";
        }
    }

    if (updateUser($userId, $name, $address, $city, $zip, $imageName)) {
        $message = "Perfil actualizado correctamente.";
        $_SESSION['user_name'] = $name; // Actualizar sesión
    } else {
        $message = "Error al actualizar la base de datos.";
    }
}

// Obtener datos actuales para rellenar el formulario
$user = getUserById($userId);

require __DIR__ . '/../views/compte.php';
require __DIR__ . '/../resources/layout_footer.php';
?>