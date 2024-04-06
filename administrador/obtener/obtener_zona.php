<?php
include '../../database/db.php';

// Obtener el id del centro de costo
$idcentrocosto = $_POST['idcentrocosto'];

// Consulta para obtener el id de la zona asociada al centro de costo
$sql_zona = "SELECT fk_idzona FROM centrocosto WHERE idcentrocosto = '$idcentrocosto'";
$resultado_zona = $conexion->query($sql_zona);

if ($resultado_zona->num_rows > 0) {
    $fila = $resultado_zona->fetch_assoc();
    $idzona = $fila['fk_idzona'];
    echo $idzona;
} else {
    echo '0'; // Devolver algún valor que indique que no se encontró la zona
}
?>