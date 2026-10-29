<?php
// Iniciar la sesión en la cabecera para que esté disponible en todas las páginas
session_start();

if (!isset($tituloPagina)) {
    $tituloPagina = "ReciclaCDMX - Plataforma Ambiental";
}
if (!isset($paginaActiva)) {
    $paginaActiva = "";
}

// Determinar el estado de la sesión actual
$sesionActiva = isset($_SESSION['usuario_activo']);
$rolUsuario = $sesionActiva ? $_SESSION['rol'] : 'visitante';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tituloPagina); ?></title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>ReciclaCDMX</h1>
            <nav>
                <ul>
                    <li><a href="index.php" class="<?php echo ($paginaActiva === 'inicio') ? 'activo' : ''; ?>">Inicio</a></li>
                    <li><a href="centros.php" class="<?php echo ($paginaActiva === 'centros') ? 'activo' : ''; ?>">Centros de Acopio</a></li>
                    <li><a href="guia.php" class="<?php echo ($paginaActiva === 'guia') ? 'activo' : ''; ?>">Guía de Separación</a></li>
                    
                    <?php if ($sesionActiva): ?>
                        <!-- Enlaces para usuarios con sesión iniciada -->
                        <li><a href="registro-reciclaje.php" class="<?php echo ($paginaActiva === 'registro') ? 'activo' : ''; ?>">Mi Portal</a></li>
                        
                        <?php if ($rolUsuario === 'administrador'): ?>
                            <li><a href="#" style="color: #ffeb3b;">Panel Admin</a></li>
                        <?php endif; ?>
                        
                        <li><a href="logout.php" style="background-color: #c62828;">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <!-- Enlaces para visitantes -->
                        <li><a href="contacto.php" class="<?php echo ($paginaActiva === 'contacto') ? 'activo' : ''; ?>">Contacto</a></li>
                        <li><a href="login.php" class="<?php echo ($paginaActiva === 'login') ? 'activo' : ''; ?>" style="border: 1px solid white;">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>