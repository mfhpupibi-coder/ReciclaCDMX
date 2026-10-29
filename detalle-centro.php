<?php
require_once __DIR__ . '/includes/funciones.php';

$tituloPagina = "ReciclaCDMX - Detalle del Centro";
$paginaActiva = "centros";

$centroNombre = "Punto Verde Benito Juárez";
$alcaldia = "Benito Juárez";
$direccion = "Parque de los Venados, Av. División del Norte s/n, Sta Cruz Atoyac, CDMX";
$horarioAtencion = "Lunes a Sábado de 09:00 a 17:00 hrs";
$telefono = "(55) 5604-0123";
$aforoDisponible = 85;

$requisitos = [
    "Entregar botellas de plástico PET vacías, limpias y aplastadas.",
    "Papel y cartón desarmado, amarrado y completamente seco.",
    "Pilas alcalinas colocadas dentro de botellas o bolsas cerradas.",
    "No mezclar residuos reciclables con desechos orgánicos ni sanitarios.",
    "Presentar identificación oficial con residencia en la Ciudad de México."
];

$servicios = [
    "Talleres breves de compostaje casero",
    "Canje de material por plantas de ornato",
    "Asesoría para manejo de residuos de oficina",
    "Recepción de tapitas plásticas para fundaciones"
];

require_once __DIR__ . '/includes/header.php';
?>

<section class="seccion">
    <h2>Ficha Técnica: <?php echo htmlspecialchars($centroNombre); ?></h2>
    <p>Alcaldía sede: <strong><?php echo htmlspecialchars($alcaldia); ?></strong></p>

    <div class="info-box">
        <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($direccion); ?></p>
        <p><strong>Horario:</strong> <?php echo htmlspecialchars($horarioAtencion); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?></p>
    </div>

    <?php if ($aforoDisponible > 50): ?>
        <p style="color: #2e7d32;"><strong>Disponibilidad actual:</strong> Alta (Recepción ágil sin filas prolongadas).</p>
    <?php elseif ($aforoDisponible > 15): ?>
        <p style="color: #f57c00;"><strong>Disponibilidad actual:</strong> Media (Tiempo de espera estimado: 15 minutos).</p>
    <?php else: ?>
        <p style="color: #c62828;"><strong>Disponibilidad actual:</strong> Saturado por el día de hoy.</p>
    <?php endif; ?>
</section>

<section class="seccion">
    <h2>Reglas y Requisitos para Entrega</h2>
    <p>Para asegurar que los materiales sean procesados, verifica cumplir los siguientes puntos:</p>
    <ul>
        <?php foreach ($requisitos as $req): ?>
            <li style="margin-bottom: 0.5rem;"><?php echo htmlspecialchars($req); ?></li>
        <?php endforeach; ?>
    </ul>

    <h3 style="margin-top: 1.5rem; color: #2e7d32;">Actividades complementarias en esta sede</h3>
    <ul>
        <?php foreach ($servicios as $s): ?>
            <li style="margin-bottom: 0.5rem;"><?php echo htmlspecialchars($s); ?></li>
        <?php endforeach; ?>
    </ul>

    <br>
    <a href="centros.php" class="btn btn-secundario">&larr; Volver al directorio de centros</a>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>