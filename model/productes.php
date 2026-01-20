<?php

require_once __DIR__ . '/connectaBD.php';

function getProductesByCategoria(int $category_id): array
{
    $conn = connectaBD();
    
    $sql = 'SELECT id, name, price, image, description FROM product 
            WHERE category_id = $1 AND is_active = TRUE 
            ORDER BY id ASC';

    $params = [$category_id];
    
    $result = pg_query_params($conn, $sql, $params);
    
    if ($result) {
        $products = pg_fetch_all($result);
        pg_free_result($result);
    } else {
        error_log("Error en consulta de productes: " . pg_last_error($conn));
        $products = [];
    }
    
    pg_close($conn);
    return $products ?: [];
}


function getDetallProducte(int $product_id): array
{
    $conn = connectaBD();
    
    $sql = 'SELECT id, name, description, price, image, category_id FROM product 
            WHERE id = $1 AND is_active = TRUE';

    $params = [$product_id];
    
    $result = pg_query_params($conn, $sql, $params);
    
    if ($result) {
        $product = pg_fetch_assoc($result); 
        pg_free_result($result);
    } else {
        error_log("Error en consulta de detall de producte: " . pg_last_error($conn));
        $product = [];
    }
    
    pg_close($conn);
    return $product ?: [];
}
?>