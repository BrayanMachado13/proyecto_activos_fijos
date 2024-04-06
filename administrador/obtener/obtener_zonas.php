<?php
include '../../database/db.php';

$centroCostoId = $_GET['centro_costo_id'];

$sql = "SELECT fk_idzona FROM centrocosto WHERE idcentrocosto = $centroCostoId";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['fk_idzona'];
} else {
    echo 'No se encontró la zona';
}

$conexion->close();
?>
