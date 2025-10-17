<?php
include_once 'data.php';

// Protección de la ruta 
protect_route();

$user = $_SESSION['user'];
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1> Dashboard</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="logout.php">👋 Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <section class="card flow-animation">
            <?php if ($message): ?>
                <p class="message success-message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <h2>¡Hola, <?php echo htmlspecialchars($user['name']); ?>!</h2>
            <p>Este es tu panel de control, solo accesible si has iniciado sesión correctamente. Tu ID de sesión es: <?php echo session_id(); ?></p>

            <aside class="user-info-box">
                <h3>Detalles de tu Perfil</h3>
                <p><strong>📧 Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>⭐ Rol:</strong> <span class="role-tag"><?php echo htmlspecialchars($user['role'] ?? 'N/A'); ?></span></p>
                <p><strong># ID de Usuario:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            </aside>

        </section>
    </main>
</body>
</html>