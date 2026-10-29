<?php
// ============================================================================
// FUNCIONES GENERALES DEL SISTEMA ReciclaCDMX
// ============================================================================

/**
 * Función 1: Da formato profesional a valores numéricos de masa/peso.
 * 
 * @param float|int $cantidad Kilogramos registrados.
 * @return string Texto con formato y unidad 'kg'.
 */
function formatearKilos($cantidad) {
    return number_format((float)$cantidad, 1, '.', ',') . ' kg';
}

/**
 * Función 2: Retorna un badge HTML estilizado con el estado operativo del centro.
 * Evita duplicar bloques if/else de diseño en las vistas de catálogo y detalle.
 * 
 * @param bool $activo Indica si el centro está en operación regular.
 * @param string $capacidad Estado de capacidad o motivo de suspensión.
 * @return string Elemento HTML con colores condicionales.
 */
function renderizarBadgeEstado($activo, $capacidad) {
    if ($activo) {
        return '<span style="color: #2e7d32; font-weight: bold;">● Operando</span> (' . htmlspecialchars($capacidad) . ')';
    } else {
        return '<span style="color: #c62828; font-weight: bold;">● Fuera de servicio</span> (' . htmlspecialchars($capacidad) . ')';
    }
}

/**
 * Función 3: Calcula la mitigación aproximada de CO2 en kg según la cantidad reciclada.
 * Factor promedio de mitigación urbana: 1.8 kg de CO2 por cada kg de material recuperado.
 * 
 * @param float|int $kilos Cantidad de residuos acopiados.
 * @return float Huella de carbono evitada en kg.
 */
function calcularEquivalenciaCO2($kilos) {
    $factorCO2 = 1.8;
    return round($kilos * $factorCO2, 2);
}
?>