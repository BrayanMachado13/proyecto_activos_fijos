<?php

$error_msg = "";
$success_msg = "";

if (isset($_POST['eliminar'])) {
    // Aquí deberías realizar la conexión a la base de datos y eliminar el registro
    $id = $_POST['id'];
    // Por ejemplo, puedes usar MySQLi

    include_once '../../database/db.php';
    
    $sql = "UPDATE centrocosto SET estado = 2 WHERE idcentrocosto = $id";
    if ($conexion->query($sql) === TRUE) {
        $success_msg = "centrocosto eliminado correctamente.";
    } else {
        $error_msg = "Error al eliminar el centrocosto: " . $conexion->error;
    }



    $conexion->close();
    // Redireccionar al formulario con los mensajes
    if (!empty($error_msg)) {
    header("Location: ../centroCosto.php?error_msg=$error_msg");
    } else {
    header("Location: ../centroCosto.php?success_msg=$success_msg");
    }
}
?>