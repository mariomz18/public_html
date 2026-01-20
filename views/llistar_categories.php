<?php
// Definimos el mapa de imágenes fuera del bucle
$categoryImages = [
    1 => 'img/img/jordan.jpg',
    2 => 'img/img/pantalon-negro.jpg',
    3 => 'img/img/lakers-equipacion.jpg',
    4 => 'img/img/balón.jpg',
    5 => 'img/img/hyperdunk.jpg'
];
?>

<div id="category-list-container">
    <div class="category-grid">
        <?php if (empty($categories)): ?>
            <p>No se encontraron categorías.</p>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <?php
                    // Asignación directa de imagenes
                    $imgSrc = $categoryImages[$category['id']] ?? null;
                ?>
                <a href="index.php?accio=llistar-productes&category_id=<?= $category['id'] ?>" 
                   class="category-card" 
                   title="<?= htmlspecialchars($category['description']) ?>">
                    
                    <img src="<?= $imgSrc ?>" 
                         alt="<?= htmlspecialchars($category['name']) ?>"
                         style="object-fit: contain; background: #fff;">
                    
                    <div class="category-card-content">
                        <h3><?= htmlentities($category['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div id="dynamic-content" style="margin-top: 20px; display:none;"></div>