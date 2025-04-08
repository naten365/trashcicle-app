<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Suspendida</title>
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>
    <style>
        a {
            color: white;
        }
    </style>
    <div class="container">
        <div class="form-section">
            <div class="form-container">
                <h1>Cuenta Suspendida</h1>
                <p>Tu cuenta ha sido suspendida.</p>
                <?php if (isset($_GET['reason'])): ?>
                    <p><strong>Razón: <?php echo htmlspecialchars($_GET['reason']); ?></strong></p>
                <?php endif; ?>
                <p>Por favor, contacta al administrador para más información.</p>
                <a href="login-form.php" class="button">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
</body>

</html>