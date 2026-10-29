<?php
require_once __DIR__ . '/includes/funciones.php';

$tituloPagina = "ReciclaCDMX - Centros de Acopio";
$paginaActiva = "centros";

// Catálogo de centros de acopio
$centros = [
    [
        "id"         => 1,
        "nombre"     => "Punto Verde Benito Juárez",
        "alcaldia"   => "Benito Juárez",
        "materiales" => "Papel, cartón, PET y pilas alcalinas.",
        "activo"     => true,
        "capacidad"  => "Normal"
    ],
    [
        "id"         => 2,
        "nombre"     => "Módulo Ecológico Coyoacán",
        "alcaldia"   => "Coyoacán",
        "materiales" => "Vidrio, latas de aluminio y envases Tetra Pak.",
        "activo"     => true,
        "capacidad"  => "Saturado"
    ],
    [
        "id"         => 3,
        "nombre"     => "Centro de Reciclaje Cuauhtémoc",
        "alcaldia"   => "Cuauhtémoc",
        "materiales" => "Residuos electrónicos, pantallas y electrodomésticos.",
        "activo"     => false,
        "capacidad"  => "Mantenimiento"
    ],
    [
        "id"         => 4,
        "nombre"     => "Punto Limpio Miguel Hidalgo",
        "alcaldia"   => "Miguel Hidalgo",
        "materiales" => "Plásticos rígidos (HDPE), metales y cartón corrugado.",
        "activo"     => true,
        "capacidad"  => "Normal"
    ]
];

$terminoBusqueda = "";
$centrosFiltrados = $centros;
$busquedaRealizada = false;

// Manejo seguro del parámetro GET
if (isset($_GET['buscar'])) {
    $terminoBusqueda = trim($_GET['buscar']);
    $busquedaRealizada = true;

    if (!empty($terminoBusqueda)) {
        $centrosFiltrados = [];
        foreach ($centros as $c) {
            if (stripos($c['nombre'], $terminoBusqueda) !== false ||
                stripos($c['alcaldia'], $terminoBusqueda) !== false ||
                stripos($c['materiales'], $terminoBusqueda) !== false) {
                $centrosFiltrados[] = $c;
            }
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="seccion">
    <h2>Directorio y Búsqueda de Centros de Acopio</h2>
    <p>Encuentra los centros de acopio en CDMX por nombre de módulo, alcaldía o residuo aceptado.</p>

    <form action="centros.php" method="GET" class="form-container" style="margin-top: 1.5rem;">
        <label for="buscar" style="font-weight: bold; color: #2e7d32; display: block; margin-bottom: 0.5rem;">
            Buscar centro por alcaldía o material:
        </label>
        <div class="form-inline">
            <input type="text" id="buscar" name="buscar" class="form-control" 
                   placeholder="Ej. Coyoacán, PET, Benito Juárez, Pilas..." 
                   value="<?php echo htmlspecialchars($terminoBusqueda); ?>">
            <button type="submit" class="btn" style="margin-top: 0;">Buscar</button>
            <?php if ($busquedaRealizada && !empty($terminoBusqueda)): ?>
                <a href="centros.php" class="btn btn-secundario" style="margin-top: 0;">Limpiar filtro</a>
            <?php endif; ?>
        </div>
    </form>
</section>

<section class="seccion">
    <?php if ($busquedaRealizada && !empty($terminoBusqueda)): ?>
        <h3>Resultados para: <em>"<?php echo htmlspecialchars($terminoBusqueda); ?>"</em></h3>
    <?php else: ?>
        <h3>Puntos de Acopio Disponibles</h3>
    <?php endif; ?>

    <?php if (empty($centrosFiltrados)): ?>
        <div class="alerta alerta-info" style="margin-top: 1rem;">
            <strong>Sin coincidencias:</strong> No se encontraron centros asociados a tu búsqueda. Intenta con otra palabra clave.
        </div>
    <?php else: ?>
        <div class="grid" style="margin-top: 1rem;">
            <?php foreach ($centrosFiltrados as $c): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($c['nombre']); ?></h3>
                    <p><strong>Alcaldía:</strong> <?php echo htmlspecialchars($c['alcaldia']); ?></p>
                    <p><strong>Materiales:</strong> <?php echo htmlspecialchars($c['materiales']); ?></p>
                    
                    <!-- Uso de la función reutilizable de estado -->
                    <p><strong>Estado:</strong> <?php echo renderizarBadgeEstado($c['activo'], $c['capacidad']); ?></p>[cite: 1]

                    <?php if ($c['activo']): ?>
                        <a href="detalle-centro.php?id=<?php echo $c['id']; ?>" class="btn">Ver Detalles</a>
                    <?php else: ?>
                        <a href="#" class="btn btn-secundario" style="pointer-events: none; opacity: 0.6;">No disponible</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>