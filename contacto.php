<?php
// Inclusión de dependencias comunes
require_once __DIR__ . '/includes/funciones.php';

$tituloPagina = "ReciclaCDMX - Contacto y Preguntas Frecuentes";
$paginaActiva = "contacto";

// Arreglo con preguntas frecuentes sobre el programa
$faqs = [
    [
        "pregunta"  => "¿Tienen algún costo los módulos de reciclaje?",
        "respuesta" => "No, la entrega ciudadana en todos los puntos de la SEDEMA y alcaldías es completamente gratuita."
    ],
    [
        "pregunta"  => "¿Cómo debo entregar las botellas y envases?",
        "respuesta" => "Completamente vacíos, enjuagados, sin residuos de líquidos y aplastados para optimizar espacio."
    ],
    [
        "pregunta"  => "¿Aceptan aparatos electrodomésticos descompuestos?",
        "respuesta" => "Sí, en las jornadas de Reciclatrón y en centros de recolección electrónica como el de la alcaldía Cuauhtémoc."
    ],
    [
        "pregunta"  => "¿Puedo llevar residuos biológicos o medicamentos?",
        "respuesta" => "No se aceptan desechos biológico-infecciosos. Los medicamentos caducos deben llevarse a contenedores SINGREM ubicados en farmacias."
    ]
];

$mensajeEnviado = false;
$contactoNombre = "";
$contactoEmail = "";
$contactoMensaje = "";
$erroresContacto = [];

// Procesamiento de contacto ciudadano
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $contactoNombre  = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $contactoEmail   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $contactoMensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

    if (empty($contactoNombre)) {
        $erroresContacto[] = "Indica tu nombre completo.";
    }
    if (empty($contactoEmail) || !filter_var($contactoEmail, FILTER_VALIDATE_EMAIL)) {
        $erroresContacto[] = "Proporciona un correo electrónico válido.";
    }
    if (empty($contactoMensaje) || strlen($contactoMensaje) < 10) {
        $erroresContacto[] = "El mensaje debe contener al menos 10 caracteres.";
    }

    if (empty($erroresContacto)) {
        $mensajeEnviado = true;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="seccion">
    <h2>Atención Ciudadana y Sedes</h2>
    <p>Comunícate con la coordinación de gestión integral de residuos de la Ciudad de México.</p>
    
    <div class="grid">
        <div class="card">
            <h3>Oficina Central SEDEMA</h3>
            <p><strong>Dirección:</strong> Plaza de la Constitución #1, Centro Histórico, CDMX.</p>
            <p><strong>Horario:</strong> Lunes a Viernes de 09:00 a 18:00 hrs.</p>
            <p><strong>Teléfono:</strong> (55) 5345-8000</p>
        </div>
        <div class="card">
            <h3>Mesa de Soporte Tecnológico</h3>
            <p><strong>Área:</strong> Licenciatura en Sistemas Computacionales</p>
            <p><strong>Materia:</strong> Programación Web</p>
            <p><strong>Soporte digital:</strong> soporte@reciclacdmx.cdmx.gob.mx</p>
        </div>
    </div>
</section>

<section class="seccion">
    <h2>Preguntas Frecuentes (FAQ)</h2>
    <div class="grid">
        <?php foreach ($faqs as $item): ?>
            <div class="card">
                <h3 style="font-size: 1.1rem; color: #2e7d32;"><?php echo htmlspecialchars($item['pregunta']); ?></h3>
                <p><?php echo htmlspecialchars($item['respuesta']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="seccion">
    <h2>Buzón de Dudas y Sugerencias</h2>
    
    <?php if (!empty($erroresContacto)): ?>
        <div class="alerta alerta-error">
            <strong>Revisa los siguientes campos:</strong>
            <ul style="margin-top: 0.5rem; margin-left: 1.2rem;">
                <?php foreach ($erroresContacto as $e): ?>
                    <li><?php echo htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($mensajeEnviado): ?>
        <div class="alerta alerta-exito">
            <h3>¡Mensaje recibido!</h3>
            <p>Gracias <strong><?php echo htmlspecialchars($contactoNombre); ?></strong>. Nos pondremos en contacto contigo a través de <em><?php echo htmlspecialchars($contactoEmail); ?></em>.</p>
        </div>
        <a href="contacto.php" class="btn">Enviar otra consulta</a>
    <?php else: ?>
        <form action="contacto.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" 
                       value="<?php echo htmlspecialchars($contactoNombre); ?>" placeholder="Tu nombre">
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?php echo htmlspecialchars($contactoEmail); ?>" placeholder="correo@ejemplo.com">
            </div>

            <div class="form-group">
                <label for="mensaje">Consulta o propuesta de mejora:</label>
                <textarea id="mensaje" name="mensaje" rows="4" class="form-control" 
                          placeholder="Escribe tu mensaje..."><?php echo htmlspecialchars($contactoMensaje); ?></textarea>
            </div>

            <button type="submit" class="btn">Enviar Mensaje</button>
        </form>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>