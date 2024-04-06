<?php

// Conectar a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "activofijos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Ejecutar una consulta SQL para obtener los datos
$sql = "SELECT idcentrocosto, nombre_centrocosto FROM centrocosto";
$result = $conn->query($sql);

// Generar el archivo CSV y escribir los datos
$filename = "CentroCostos.csv";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

// Escribir encabezados
fputcsv($output, array('CODIGO', 'NOMBRE'));

// Escribir datos
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);

// Cerrar la conexión a la base de datos
$conn->close();
