<?php
$tituloPagina = "ReciclaCDMX - Iniciar Sesión";
$paginaActiva = "login";

require_once __DIR__ . '/includes/header.php';

// Redirigir si ya hay una sesión activa
if (isset($_SESSION['usuario_activo'])) {
    header("Location: registro-reciclaje.php");
    exit();
}

// 1. Usuarios ficticios definidos temporalmente en PHP (sin base de datos real)
$usuarios_prueba = [
    "ciudadano@recicla.com" => [
        "password" => "12345",
        "nombre" => "Usuario Ciudadano",
        "rol" => "ciudadano"
    ],
    "admin@recicla.com" => [
        "password" => "admin2026",
        "nombre" => "Administrador SEDEMA",
        "rol" => "administrador"
    ]
];

$error_login = "";
// 2. Recuperar correo de la cookie si el usuario decidió recordarlo previamente
$correo_guardado = isset($_COOKIE['recordar_correo']) ? $_COOKIE['recordar_correo'] : "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];
    $recordar = isset($_POST['recordar']); // Checkbox "Recordar mi correo"[cite: 1]

    // 3. Comprobar datos ingresados contra el arreglo temporal[cite: 2]
    if (array_key_exists($correo, $usuarios_prueba) && $usuarios_prueba[$correo]['password'] === $password) {
        
        // Guardar información del usuario en la sesión[cite: 2]
        $_SESSION['usuario_activo'] = true;
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $usuarios_prueba[$correo]['nombre'];
        $_SESSION['rol'] = $usuarios_prueba[$correo]['rol'];

        // 4. Manejo de Cookies[cite: 1]
        if ($recordar) {
            // Crear cookie válida por 7 días[cite: 1]
            setcookie('recordar_correo', $correo, time() + (86400 * 7), "/");
        } else {
            // Eliminar cookie si el usuario desmarcó la opción[cite: 1]
            setcookie('recordar_correo', "", time() - 3600, "/");
        }

        // Redirección exitosa
        header("Location: registro-reciclaje.php");
        exit();
    } else {
        $error_login = "Correo o contraseña incorrectos.";
    }
}
?>

<section class="seccion" style="max-width: 500px; margin: 0 auto;">
    <h2>Acceso al Portal</h2>
    <p>Ingresa tus credenciales para acceder a los servicios personalizados.</p>

    <?php if (!empty($error_login)): ?>
        <div class="alerta alerta-error">
            <strong>Error:</strong> <?php echo htmlspecialchars($error_login); ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="form-container">
        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <!-- El input imprime el valor de la cookie si existe[cite: 1] -->
            <input type="email" id="correo" name="correo" class="form-control" 
                   value="<?php echo htmlspecialchars($correo_guardado); ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
            <!-- Mostrar el checkbox marcado si ya existía la cookie[cite: 1] -->
            <input type="checkbox" id="recordar" name="recordar" <?php echo !empty($correo_guardado) ? 'checked' : ''; ?>>
            <label for="recordar" style="margin: 0; color: #555; font-weight: normal;">Recordar mi correo en este equipo</label>
        </div>

        <button type="submit" class="btn" style="width: 100%;">Iniciar Sesión</button>
    </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>