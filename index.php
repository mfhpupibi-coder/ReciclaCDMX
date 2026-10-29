<?php
// Inclusión obligatoria de módulos comunes y funciones
require_once __DIR__ . '/includes/funciones.php';

$tituloPagina = "ReciclaCDMX - Inicio y Métricas";
$paginaActiva = "inicio";

$subtitulo = "Por una Ciudad de México más limpia y sustentable";
$jornadaActiva = true;

// Arreglo con métricas de impacto
$estadisticas = [
    [
        "cifra" => "16",
        "etiqueta" => "Alcaldías con cobertura",
        "descripcion" => "Puntos de recolección en toda la CDMX."
    ],
    [
        "cifra" => "+45",
        "etiqueta" => "Centros registrados",
        "descripcion" => "Módulos autorizados por la SEDEMA."
    ],
    [
        "cifra" => "1,250",
        "etiqueta" => "Toneladas acopiadas",
        "descripcion" => "Residuos procesados en el último ciclo anual."
    ],
    [
        "cifra" => "98%",
        "etiqueta" => "Tasa de aprovechamiento",
        "descripcion" => "Materiales reincorporados a cadenas productivas."
    ]
];

// Carga del encabezado modular
require_once __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <h2><?php echo htmlspecialchars($subtitulo); ?></h2>
    <p>Conecta con puntos de recolección, consulta normas de separación y cuida el entorno urbano.</p>

    <?php if ($jornadaActiva): ?>
        <div class="info-box" style="margin-top: 1rem; border-left-color: #2e7d32;">
            <strong>¡Aviso importante!</strong> Hoy se encuentra activo el <em>Reciclatrón Comunitario</em>. Consulta horarios extendidos.
        </div>
    <?php else: ?>
        <div class="info-box" style="margin-top: 1rem;">
            <strong>Información:</strong> Operación regular en todos los centros de acopio fijos.
        </div>
    <?php endif; ?>
    <br>
    <a href="centros.php" class="btn">Explorar Centros de Reciclaje</a>
</section>

<section class="seccion">
    <h2>Impacto Ambiental en la Ciudad</h2>
    <p>Datos consolidados de la iniciativa ciudadana de reciclaje:</p>
    <div class="grid">
        <?php foreach ($estadisticas as $stat): ?>
            <div class="card">
                <h3 style="font-size: 1.8rem; color: #2e7d32;"><?php echo htmlspecialchars($stat['cifra']); ?></h3>
                <p><strong><?php echo htmlspecialchars($stat['etiqueta']); ?></strong></p>
                <p><?php echo htmlspecialchars($stat['descripcion']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="seccion">
    <h2>Módulos del Sistema</h2>
    <div class="grid">
        <div class="card">
            <h3>Directorio de Centros</h3>
            <p>Ubica centros de recepción, materiales admitidos y horarios de atención.</p>
            <a href="centros.php" class="btn">Ver Directorio</a>
        </div>
        <div class="card">
            <h3>Guía de Separación</h3>
            <p>Clasificación conforme a la norma ambiental vigente de la CDMX.</p>
            <a href="guia.php" class="btn">Consultar Guía</a>
        </div>
        <div class="card">
            <h3>Mi Portal de Registro</h3>
            <p>Agenda entregas voluntarias y calcula tu aporte contra la huella de carbono.</p>
            <a href="registro-reciclaje.php" class="btn">Ir a Registro</a>
        </div>
    </div>
</section>

<?php 
// Carga del pie de página modular
require_once __DIR__ . '/includes/footer.php';
?>