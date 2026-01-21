<div class="form-container">
    <h2>Mi Cuenta</h2>
    
    <?php if ($message): ?>
        <p style="color: blue; text-align: center;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="index.php?accio=cuenta" method="POST" enctype="multipart/form-data">
        
        <?php if (!empty($user['image'])): ?>
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="<?= $filesPublicPath . $user['image'] ?>" alt="Foto Perfil" 
                     style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc;">
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?= htmlspecialchars($user['address'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Población:</label>
            <input type="text" name="poblacion" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Código Postal:</label>
            <input type="text" name="cp" value="<?= htmlspecialchars($user['zip_code'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Imagen de Perfil:</label>
            <input type="file" name="profile_image" accept="image/*">
        </div>

        <button type="submit" class="btn-primary">Guardar Cambios</button>
    </form>
</div>