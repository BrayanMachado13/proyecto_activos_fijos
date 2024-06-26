<?php
session_start();

// Establecer la conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "activofijos");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"]) && !empty($_SESSION["nombres"]) && !empty($_SESSION["apellidos"]) && !empty($_SESSION["identificacion"])
&& !empty($_SESSION["fk_idzona"])) {
    $usuario = $_SESSION["usuario"];
    $n_usuario = $_SESSION["nombres"];
    $apellidos = $_SESSION["apellidos"];
    $identificacion = $_SESSION["identificacion"];
    $zona = $_SESSION["fk_idzona"];
    $rol = obtenerRolUsuario($mysqli);
    // Redirigir según el rol
    if ($rol == 1) {
        // No es necesario redirigir a una página específica para usuarios
        // Puedes dejar que continúen en esta página o redirigirlos a otra si es necesario
    }elseif ($rol == 2) {
        header("Location: ../cliente/principal_regular.php");
        exit();
    } else {
        // Rol desconocido, manejar según tus necesidades
    }
} else {
    header("Location: ../login.php");
    exit();
}

// Función para obtener el rol del usuario
function obtenerRolUsuario($mysqli) {
    // Obtener el nombre de usuario de la sesión
    $usuario = $_SESSION["usuario"];
    

    // Consultar el rol del usuario desde la base de datos
    $sql = "SELECT rol FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $mysqli->query($sql);

    // Verificar si se obtuvo un resultado
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return $fila['rol'];
    } else {
        return 'desconocido';
    }
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>