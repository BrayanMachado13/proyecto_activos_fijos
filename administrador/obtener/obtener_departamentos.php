<?php
include '../../database/db.php';
 
// Obtener el id del país seleccionado
$idPais = $_POST['id_pais'];

// Consulta para obtener los departamentos relacionados con el país seleccionado
$sql = "SELECT id, nombre_departamento FROM departamento WHERE id_pais = $idPais";
$result = $conexion->query($sql);

// Generar opciones para el segundo select
$options = '';
if ($result->num_rows > 0) {
    $options .= "<option value=''>SELECCIONE UN DEPARTAMENTO</option>";
    while ($row = $result->fetch_assoc()) {
        
        $options .= "<option value='{$row['id']}'>{$row['nombre_departamento']}</option>";
    }
}

echo $options;

// Cerrar la conexión
$conexion->close();
?>