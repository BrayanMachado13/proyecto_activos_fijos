<?php
include '../../database/db.php';
 
// Obtener el id del país seleccionado
$idcentrocosto = $_POST['fk_idcentrocosto'];

// Consulta para obtener los departamentos relacionados con el país seleccionado
$sql = "SELECT desti_id, nombre_destino FROM destino WHERE fk_idcentrocosto = $idcentrocosto";
$result = $conexion->query($sql);

// Generar opciones para el segundo select
$options = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['desti_id']}'>{$row['nombre_destino']}</option>";
    }
}

echo $options;

// Cerrar la conexión
$conexion->close();
?>