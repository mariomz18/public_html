<?php
require_once __DIR__ . '/../model/comandes.php';
require_once __DIR__ . '/../resources/layout_header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?accio=login");
    exit;
}

$orders = getComandesByUsuari($_SESSION['user_id']);

require __DIR__ . '/../views/llistar_comandes.php';
require __DIR__ . '/../resources/layout_footer.php';
?>