<?php
// ============================================================================
// LOGICA PHP: Cierre de sesión y redirección
// ============================================================================
session_start(); // Iniciar para poder destruirla

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al visitante a la página de inicio o login
header("Location: index.php");
exit();
?>