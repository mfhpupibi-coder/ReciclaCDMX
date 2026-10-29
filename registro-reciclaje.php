<?php
require_once __DIR__ . '/includes/funciones.php';

$tituloPagina = "ReciclaCDMX - Mi Portal de Registro";
$paginaActiva = "registro";


$alcaldia = "";
$tipoResiduo = "";
$kilos = "";
$comentarios = "";

$errores = [];
$registroExitoso = false;
$huellaCO2Evitada = 0;

// ============================================================================
// PROTECCIÓN DE ACCESO MEDIANTE SESIONES
// ============================================================================
// Si no existe una sesión activa, impedir el acceso y redirigir al login
if (!isset($_SESSION['usuario_activo'])) {
    header("Location: login.php");
    exit();
}

// Autocompletar el nombre del usuario desde la sesión[cite: 2]
$nombre = $_SESSION['nombre'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre      = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $alcaldia    = isset($_POST['alcaldia']) ? trim($_POST['alcaldia']) : '';
    $tipoResiduo = isset($_POST['tipo_residuo']) ? trim($_POST['tipo_residuo']) : '';
    $kilos       = isset($_POST['kilos']) ? trim($_POST['kilos']) : '';
    $comentarios = isset($_POST['comentarios']) ? trim($_POST['comentarios']) : '';

    if (empty($nombre)) {
        $errores[] = "El campo 'Nombre completo' es obligatorio.";
    } elseif (strlen($nombre) < 3) {
        $errores[] = "El nombre debe contener al menos 3 caracteres.";
    }

    if (empty($alcaldia)) {
        $errores[] = "Debes seleccionar una alcaldía de la Ciudad de México.";
    }

    if (empty($tipoResiduo)) {
        $errores[] = "Debes seleccionar la categoría del residuo.";
    }

    if (empty($kilos)) {
        $errores[] = "El campo 'Cantidad estimada (kg)' es obligatorio.";
    } elseif (!filter_var($kilos, FILTER_VALIDATE_FLOAT)) {
        $errores[] = "La cantidad en kilogramos debe ser un valor numérico.";
    } elseif ($kilos <= 0 || $kilos > 100) {
        $errores[] = "La cantidad debe situarse entre 0.5 kg y 100 kg por entrega ciudadana.";
    }

    if (empty($errores)) {
        $registroExitoso = true;
        // Aplicación de las funciones de formateo y cálculo de impacto ambiental
        $huellaCO2Evitada = calcularEquivalenciaCO2((float)$kilos);
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="seccion">
    <h2>Portal Ciudadano - Registro de Residuos Reciclables</h2>
    <p>Registra previamente el volumen de materiales a entregar para agilizar tu trámite y conocer el beneficio ambiental generado.</p>

    <?php if (!empty($errores)): ?>
        <div class="alerta alerta-error">
            <strong>Por favor corrige los siguientes aspectos:</strong>
            <ul style="margin-top: 0.5rem; margin-left: 1.2rem;">
                <?php foreach ($errores as $err): ?>
                    <li><?php echo htmlspecialchars($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($registroExitoso): ?>
        <div class="alerta alerta-exito">
            <h3>¡Registro confirmado exitosamente!</h3>
            <p>Se ha generado el comprobante de recepción con los siguientes datos:</p>
        </div>

        <div class="info-box">
            <p><strong>Ciudadano:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Alcaldía:</strong> <?php echo htmlspecialchars($alcaldia); ?></p>
            <p><strong>Material:</strong> <?php echo htmlspecialchars($tipoResiduo); ?></p>
            <!-- Uso de la función de formateo -->
            <p><strong>Volumen registrado:</strong> <?php echo formatearKilos($kilos); ?></p>[cite: 1]
            <!-- Uso del cálculo de CO2 -->
            <p><strong>Ahorro estimado de emisiones:</strong> <?php echo formatearKilos($huellaCO2Evitada); ?> de CO₂ equivalente mitigado.</p>[cite: 1]
            
            <?php if (!empty($comentarios)): ?>
                <p><strong>Notas:</strong> <?php echo htmlspecialchars($comentarios); ?></p>
            <?php endif; ?>
            <p style="margin-top: 1rem; color: #2e7d32; font-weight: bold;">
                Folio asignado: #REC-<?php echo rand(1000, 9999); ?>
            </p>
        </div>

        <a href="registro-reciclaje.php" class="btn">Registrar otra entrega</a>
        <a href="centros.php" class="btn btn-secundario">Ver centros de acopio</a>

    <?php else: ?>
        <form action="registro-reciclaje.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="nombre">Nombre completo del ciudadano:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" 
                       placeholder="Ej. Edith Ramírez"
                       value="<?php echo htmlspecialchars($nombre); ?>">
            </div>

            <div class="form-group">
                <label for="alcaldia">Alcaldía donde resides o entregarás:</label>
                <select id="alcaldia" name="alcaldia" class="form-control">
                    <option value="">-- Selecciona una alcaldía --</option>
                    <option value="Benito Juárez" <?php echo ($alcaldia === 'Benito Juárez') ? 'selected' : ''; ?>>Benito Juárez</option>
                    <option value="Coyoacán" <?php echo ($alcaldia === 'Coyoacán') ? 'selected' : ''; ?>>Coyoacán</option>
                    <option value="Cuauhtémoc" <?php echo ($alcaldia === 'Cuauhtémoc') ? 'selected' : ''; ?>>Cuauhtémoc</option>
                    <option value="Miguel Hidalgo" <?php echo ($alcaldia === 'Miguel Hidalgo') ? 'selected' : ''; ?>>Miguel Hidalgo</option>
                    <option value="Iztapalapa" <?php echo ($alcaldia === 'Iztapalapa') ? 'selected' : ''; ?>>Iztapalapa</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_residuo">Categoría del residuo a reciclar:</label>
                <select id="tipo_residuo" name="tipo_residuo" class="form-control">
                    <option value="">-- Selecciona el tipo de material --</option>
                    <option value="Plástico PET" <?php echo ($tipoResiduo === 'Plástico PET') ? 'selected' : ''; ?>>Plástico PET</option>
                    <option value="Papel y Cartón" <?php echo ($tipoResiduo === 'Papel y Cartón') ? 'selected' : ''; ?>>Papel y Cartón</option>
                    <option value="Aluminio y Metales" <?php echo ($tipoResiduo === 'Aluminio y Metales') ? 'selected' : ''; ?>>Aluminio y Metales</option>
                    <option value="Vidrio" <?php echo ($tipoResiduo === 'Vidrio') ? 'selected' : ''; ?>>Vidrio</option>
                    <option value="Electrónicos / Pilas" <?php echo ($tipoResiduo === 'Electrónicos / Pilas') ? 'selected' : ''; ?>>Electrónicos / Pilas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kilos">Cantidad estimada en kilogramos (kg):</label>
                <input type="number" id="kilos" name="kilos" step="0.1" min="0.5" max="100" class="form-control" 
                       placeholder="Ej. 4.5"
                       value="<?php echo htmlspecialchars($kilos); ?>">
            </div>

            <div class="form-group">
                <label for="comentarios">Comentarios o estado del empaque (opcional):</label>
                <textarea id="comentarios" name="comentarios" rows="3" class="form-control" 
                          placeholder="Ej. Entregaré 2 cajas con botellas limpias y aplastadas."><?php echo htmlspecialchars($comentarios); ?></textarea>
            </div>

            <button type="submit" class="btn">Enviar Registro</button>
        </form>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>