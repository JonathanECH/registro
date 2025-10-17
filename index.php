<?php
include_once 'data.php';

$is_logged_in = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - PHP Auth</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Waos, puro php</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <?php if (!$is_logged_in): ?>
                <a href="register.php">✨ Registro</a>
                <a href="login.php"> Login</a>
            <?php else: ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php"> Cerrar Sesión</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section class="card flow-animation">
            <h2>Bienvenido al Sistema de Autenticación</h2>
            <p>Simulación de autenticación</p>

            <?php if ($is_logged_in): ?>
                <p class="success-message">¡Hola, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>! Ya estás autenticado. Visita tu <a href="dashboard.php">Dashboard</a>.</p>
            <?php else: ?>
                <p>Para comenzar, por favor. Regístrate o inicia sesión.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>