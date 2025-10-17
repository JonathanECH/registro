<?php
include_once 'data.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

// Lógica de autenticación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $message = "🔴 ¡ALERTA! Ingresa tu Correo y Clave de Acceso.";
    } else {
        $user = get_user_by_email(strtolower($email));

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => 'Jugador Élite' // ¡Nuevo rol gamer!
            ];
            $_SESSION['message'] = "🎉 ¡AUTENTICACIÓN EXITOSA, " . htmlspecialchars($user['name']) . "! Cargando Lobby...";
            redirect('dashboard.php');
        } else {
            $message = "🔴 Acceso Denegado. Credenciales no válidas.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Acceso al Servidor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🔑 Inicio de sesión</h1>
    </header>

    <main>
        <section class="card flow-animation">
            <h2>Ingresa tus credenciales de jugador</h2>
            <?php if ($message): ?>
                <p class="message <?php echo strpos($message, 'ÉXITO') !== false || strpos($message, '🎉') !== false ? 'success-message' : 'error-message'; ?>"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <form action="login.php" method="POST" class="form-container">
                <label for="email">Correo (ID de Usuario):</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>

                <label for="password">Clave de Acceso:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="button-submit">Acceder al juego</button>
            </form>
            
            <p class="link-text">
                ¿Aún no tienes cuenta? <a href="register.php" style="font-weight: bold;">Crea una cuenta ahora :)</a> 
            </p>
        </section>
    </main>
</body>
</html>