<?php
include_once 'data.php';

//No se debe usar session_destroy()      

if (isset($_SESSION['user'])) {
    // Elimina solo la variable que indica que el usuario está logeado
    unset($_SESSION['user']); 
}

// Limpia el mensaje de sesión si existe
if (isset($_SESSION['message'])) {
    unset($_SESSION['message']); 
}

$_SESSION['message'] = "👋 Sesión cerrada exitosamente. Vuelve pronto.";
redirect('index.php'); // Redirige a la página de inicio
?>