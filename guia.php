<?php
require_once __DIR__ . '/includes/funciones.php';

$tituloPagina = "ReciclaCDMX - Guía de Separación";
$paginaActiva = "guia";

$normaOficial = "NADF-024-AMBT-2013";
$diaActual = date("l");

$categorias = [
    [
        "numero"    => "1",
        "tipo"      => "Orgánicos",
        "color"     => "#4caf50",
        "ejemplos"  => "Restos de verdura, fruta, cáscaras, café, té y hojarasca de jardín.",
        "diaCamion" => "Martes, Jueves y Sábado"
    ],
    [
        "numero"    => "2",
        "tipo"      => "Inorgánicos Reciclables",
        "color"     => "#1976d2",
        "ejemplos"  => "PET, cartón, periódicos, vidrio, aluminio y envases multicapa.",
        "diaCamion" => "Lunes, Miércoles, Viernes y Domingo"
    ],
    [
        "numero"    => "3",
        "tipo"      => "Inorgánicos No Reciclables",
        "color"     => "#ff9800",
        "ejemplos"  => "Colillas, toallas sanitarias, bolsas metalizadas y papel higiénico.",
        "diaCamion" => "Lunes, Miércoles, Viernes y Domingo"
    ],
    [
        "numero"    => "4",
        "tipo"      => "Manejo Especial y Voluminoso",
        "color"     => "#795548",
        "ejemplos"  => "Colchones, muebles, neumáticos, electrodomésticos y baterías de auto.",
        "diaCamion" => "Domingo exclusivo (o jornadas especiales)"
    ]
];

require_once __DIR__ . '/includes/header.php';
?>

<section class="seccion">
    <h2>Norma Ambiental de Clasificación (<?php echo htmlspecialchars($normaOficial); ?>)</h2>
    <p>La correcta separación en origen disminuye la saturación de los rellenos sanitarios y dignifica la labor de los recolectores urbanos.</p>
    
    <?php if ($diaActual === "Tuesday" || $diaActual === "Thursday" || $diaActual === "Saturday"): ?>
        <div class="info-box" style="border-left-color: #4caf50;">
            <strong>Recomendación de hoy:</strong> Corresponde la entrega prioritaria de residuos <strong>Orgánicos</strong> al camión recolector.
        </div>
    <?php else: ?>
        <div class="info-box" style="border-left-color: #1976d2;">
            <strong>Recomendación de hoy:</strong> Corresponde la entrega de residuos <strong>Inorgánicos (reciclables y no reciclables)</strong>.
        </div>
    <?php endif; ?>
</section>

<section class="seccion">
    <h2>Clasificación Oficial de Residuos</h2>
    <div class="grid">
        <?php foreach ($categorias as $cat): ?>
            <div class="card" style="border-top: 5px solid <?php echo $cat['color']; ?>;">
                <h3><?php echo htmlspecialchars($cat['numero'] . ". " . $cat['tipo']); ?></h3>
                <p><strong>Residuos comunes:</strong> <?php echo htmlspecialchars($cat['ejemplos']); ?></p>
                <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #555;">
                    <strong>Días de recolección:</strong> <?php echo htmlspecialchars($cat['diaCamion']); ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>