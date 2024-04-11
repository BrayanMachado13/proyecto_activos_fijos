<?php
// Conexión a la base de datos
include '../../database/db.php';

// Obtener el id del departamento seleccionado
$idDepartamento = $_POST['id_departamento'];

// Consulta para obtener las ciudades relacionadas con el departamento seleccionado
$sql = "SELECT id, nombre_ciudad FROM ciudad WHERE id_departamento = $idDepartamento";
$result = $conexion->query($sql);

// Generar opciones para el tercer select
$options = '';
if ($result->num_rows > 0) {
    $options .= "<option value=''>SELECCIONE UNA CIUDAD</option>";
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['id']}'>{$row['nombre_ciudad']}</option>";
    }
}

echo $options;

// Cerrar la conexión
$conexion->close();
?>