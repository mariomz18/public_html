<div id="login-background">
    
    <div class="form-container">
        <h2 style="text-align: center;">Iniciar Sesión</h2>
        
        <?php if (!empty($error_login)): ?>
            <div class="message error" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                <?= htmlspecialchars($error_login) ?>
            </div>
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
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Entrar</button>
        </form>
    </div>

</div>