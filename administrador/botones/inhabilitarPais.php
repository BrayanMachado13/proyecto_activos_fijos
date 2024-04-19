<?php

$error_msg = "";
$success_msg = "";

if (isset($_POST['eliminar'])) {
    // Aquí deberías realizar la conexión a la base de datos y eliminar el registro
    $id = $_POST['id'];
    // Por ejemplo, puedes usar MySQLi

    include_once '../../database/db.php';
    
    $sql = "UPDATE pais SET estado = 2 WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        $success_msg = "Pais eliminado correctamente.";
    } else {
        $error_msg = "Error al eliminar el pais: " . $conexion->error;
    }



    $conexion->close();
    // Redireccionar al formulario con los mensajes
    if (!empty($error_msg)) {
    header("Location: ../pais.php?error_msg=$error_msg");
    } else {
    header("Location: ../pais.php?success_msg=$success_msg");
    }
}
?>