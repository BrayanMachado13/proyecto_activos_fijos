<?php
include_once '../../database/db.php';

// Mensaje de error y éxito
$error_msg = "";
$success_msg = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];

    // Verificar si hay un registro con el mismo ID
    $sql = "SELECT * FROM rol WHERE idroles = $id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $error_msg = "Ya existe un registro con el mismo ID. No se puede guardar.";
    } else {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO rol (idroles, nom_rol, estado) VALUES ($id, '$nombre', '$estado')";
        if ($conexion->query($sql) === TRUE) {
            $success_msg = "ROL guardado correctamente.";
        } else {
            $error_msg = "Error: " . $sql . "<br>" . $conexion->error;
        }
    }
}

// Cerrar la conexión
$conexion->close();

// Redireccionar al formulario con los mensajes
if (!empty($error_msg)) {
    header("Location: ../roles.php?error_msg=$error_msg");
} else {
    header("Location: ../roles.php?success_msg=$success_msg");
}
?>
