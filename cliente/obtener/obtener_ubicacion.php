<?php
include '../../database/db.php';
 
// Obtener el id del país seleccionado
$idDestino = $_POST['fk_desti_id'];

// Consulta para obtener los departamentos relacionados con el país seleccionado
$sql = "SELECT ubica_id, nombre_ubicacion FROM ubicacion WHERE fk_desti_id = $idDestino";
$result = $conexion->query($sql);

// Generar opciones para el segundo select
$options = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['ubica_id']}'>{$row['nombre_ubicacion']}</option>";
    }
}

echo $options;

// Cerrar la conexión
$conexion->close();
?>