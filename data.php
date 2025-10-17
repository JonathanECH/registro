<?php
// Inicializa la sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializa el arreglo de usuarios si no existe
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        'admin@test.com' => [
            'id' => 1,
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => '$2y$10$C/z1YlM9F6Vl7pW8xY5nIe/dM0HjD7V9tL4X.aI2G3E5B7R8O.jA' // 'password123'
        ]
    ];
}

/**
 * Busca un usuario por email
 * @param string $email
 * @return array|null Usuario si se encuentra o null
 */
function get_user_by_email($email) {
    $users = $_SESSION['users'];
    return $users[$email] ?? null;
}

/**
 * Registra un nuevo usuario y hashea la contraseña
 * @param string $name
 * @param string $email
 * @param string $password
 * @return bool True si OK, False si el email ya existe
 */
function register_user($name, $email, $password) {
    if (get_user_by_email($email)) {
        return false;
    }
    $users = $_SESSION['users'];
    $new_id = count($users) + 1;

    $new_user = [
        'id' => $new_id,
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT), // Hashing de contraseña
    ];

    $_SESSION['users'][$email] = $new_user;
    return true;
}

// Redirecciona a una URL
function redirect($url) {
    header("Location: $url");
    exit();
}

// Protege una ruta, redireccionando si no hay sesión
function protect_route() {
    if (!isset($_SESSION['user'])) {
        $_SESSION['message'] = "⚠️ Debes iniciar sesión para acceder al Dashboard.";
        redirect('login.php');
    }
}