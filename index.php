<?php
session_start();

$accio = $_GET['accio'] ?? null;
// switch per enrutar les peticions
switch ($accio) {
    case 'llistar-categories':
        require __DIR__ . '/resource_llistar_categories.php';
        break;
        
    case 'registro':
        require __DIR__ . '/resource_registro.php';
        break;

    case 'login':
        require __DIR__ . '/controller/login.php'; 
        break;

    case 'logout':
        session_destroy(); // borrar sesión
        header("Location: index.php");
        exit;
        break; 

    case 'api_llistar_productes':
        // el controller s'encarrega d'obtenir les dades i retornar JSON
        require __DIR__ . '/controller/API_llistar_productes.php';
        break;

    case 'api_detall_producte':
        // El controller s'encarrega d'obtenir les dades i retornar JSON
        require __DIR__ . '/controller/detall_producte.php';
        break;

    case 'api_llistar_productes':
        require __DIR__ . '/controller/API_llistar_productes.php';
        break;

    case 'api_detall_producte':
        require __DIR__ . '/controller/detall_producte.php';
        break;

    case 'api_carrito':
        // Procesa añadir productos (AJAX)
        require __DIR__ . '/controller/API_carrito.php';
        break;

    case 'carrito':
        // Muestra la vista del carrito
        require __DIR__ . '/resource_carrito.php';
        break;

    default:
        // carga el recurso de la página principal/portada si no se especifica ninguna acción
        require __DIR__ . '/resource_portada.php';
        break;
}
?>