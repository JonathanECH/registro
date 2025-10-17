<?php
include_once 'data.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']); 

$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($name) || empty($email) || empty($password) || empty($password_confirm)) {
        $message = "🔴 Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "🔴 El formato del email es inválido.";
    } elseif ($password !== $password_confirm) {
        $message = "🔴 La contraseña y la confirmación no coinciden.";
    } else {
        if (register_user($name, strtolower($email), $password)) {
            $_SESSION['message'] = "✅ ¡Registro exitoso! Por favor, inicia sesión.";
            redirect('login.php');
        } else {
            $message = "🔴 El email '{$email}' ya está registrado.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>✨ Registro de Usuario</h1>
        <nav>
            <a href="index.php"> Inicio</a>
            <a href="login.php">🔑 Login</a>
        </nav>
    </header>

    <main>
        <section class="card flow-animation">
            <h2>Crear Cuenta</h2>
            <?php if ($message): ?>
                <p class="message <?php echo strpos($message, '✅') !== false ? 'success-message' : 'error-message'; ?>"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <form action="register.php" method="POST" class="form-container">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <label for="password_confirm">Confirmar Contraseña:</label>
                <input type="password" id="password_confirm" name="password_confirm" required>

                <button type="submit" class="button-submit">Registrarme</button>
            </form>
            <p class="link-text">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
        </section>
    </main>
</body>
</html>