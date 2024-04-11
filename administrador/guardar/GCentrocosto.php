<?php
include_once '../../database/db.php';

// Mensaje de error
$error_msg = "";
$success_msg = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombreccosto'];
    $selectzona = $_POST['selectzona'];
    $pais = $_POST['pais'];
    $departamento = $_POST['departamento'];
    $ciudades = $_POST['ciudades'];
    $estado = $_POST['estado'];

    // Verificar si hay un registro con el mismo ID
    $sql = "SELECT * FROM centrocosto WHERE idcentrocosto = $id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $error_msg = "Ya existe un registro con el mismo ID. No se puede guardar.";
    } else {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO centrocosto (idcentrocosto, nombre_centrocosto, fk_idzona, fk_pais, fk_departamento, fk_ciudad, estado) VALUES ($id, '$nombre', '$selectzona', '$pais', '$departamento', '$ciudades', '$estado')";
        if ($conexion->query($sql) === TRUE) {
            $success_msg = "Datos guardados correctamente.";
        } else {
            $error_msg = "Error: " . $sql . "<br>" . $conexion->error;
        }
    }
}

// Cerrar la conexión
$conexion->close();

// Redireccionar al formulario con los mensajes
if (!empty($error_msg)) {
    header("Location: ../centroCosto.php?error_msg=$error_msg");
} else {
    header("Location: ../centroCosto.php?success_msg=$success_msg");
}
?>