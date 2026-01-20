<div class="form-container">
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($error_login)): ?>
        <div class="message error"><?= htmlspecialchars($error_login) ?></div>
    <?php endif; ?>
    
    <form action="index.php?accio=login" method="POST">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn-primary">Entrar</button>
    </form>
</div>