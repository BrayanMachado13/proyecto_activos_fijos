<?php
session_start();

include 'database/db.php';

if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"]) && !empty($_SESSION["nombre_usuario"]) && !empty($_SESSION["identificacion"]) && !empty($_SESSION["fk_idzona"])) {
    $rol = obtenerRolUsuario($conexion);

    if ($rol == 1) {
        header("Location: administrador/principal_admin.php");
        exit();
    } elseif ($rol == 2) {
        header("Location: cliente/principal_Regular.php");
        exit();
    } else {
        // Manejar otro rol si es necesario
    }
} else {
    // El resto del código para manejar el inicio de sesión
}

// Función para obtener el rol del usuario
function obtenerRolUsuario($conexion) {
    // Obtener el nombre de usuario de la sesión
    $usuario = $_SESSION["usuario"];
    

    // Consultar el rol del usuario desde la base de datos
    $sql = "SELECT rol FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);

    // Verificar si se obtuvo un resultado
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return $fila['rol'];
    } else {
        return 'desconocido';
    }
}
?>