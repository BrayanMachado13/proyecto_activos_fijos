<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "activofijos";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>
