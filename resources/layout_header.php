<?php
// inicio del HTML, el head y el header de la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball Store - Tienda Online MVC</title>
    
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>

    <header>
        <div class="logo">UABasket</div>
        <nav>
            <ul>
                <li><a href="index.php?accio=llistar-categories">Catálogo</a></li>
                <li><a href="index.php?accio=registro">Registrarse</a></li>
                
                <li style="margin-left: 20px; padding-left: 20px; border-left: 1px solid #555;">
                    <a href="index.php?accio=carrito" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                        <span style="font-size: 1.5em;">🛒</span>
                        <div style="font-size: 0.8em; line-height: 1.2; color: #fff;">
                            <span id="cart-count"><?= $_SESSION['total_qty'] ?? 0 ?></span> prod.<br>
                            <span id="cart-total"><?= number_format($_SESSION['total_price'] ?? 0, 2) ?> €</span>
                        </div>
                    </a>
                </li>
                <li id="user-menu-container" style="margin-left: 20px;">
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <a href="#" id="user-menu-link">Hola, <?= htmlspecialchars($_SESSION['user_name']) ?></a>
        
                        <div id="user-menu-dropdown">
                            <a href="index.php?accio=cuenta">Mi Cuenta</a>
                            <a href="index.php?accio=pedidos">Mis Compras</a>
                            <a href="index.php?accio=logout">Cerrar Sesión</a>
                        </div>

                    <?php else: ?>
                        <a href="index.php?accio=login">Iniciar Sesión</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <main>