<?php
session_start();

// Establecer la conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "activofijos");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])&& !empty($_SESSION["nombre_usuario"])) {
    $usuario = $_SESSION["usuario"];
    $n_usuario = $_SESSION["nombre_usuario"];
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
    $n_usuario = $_SESSION["nombre_usuario"];

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>

    <?php 
    include('header_pantallas.php'); 
    ?>
    <center>
        <div class="container tam-card-personal">
            <div class="row">
                <div class="col md-8">
                    <div class="bg-card-personal card  text-white">
                        <div class="card-body ">
                            <h2 class="card-title"></h2>
                            <div class="row">
                                <div class="col text-dark">
                                    <h3 class="card-title "> REGISTRAR NUEVO TIPO DE ACTIVO</h3>
                                    <p class="text-center">A continuación digita los datos del tipo activo</p>
                                    <div class="centrarcard">
                                        <form action="../php/keepTipoActivo.php" method="post">
                                            <div class="mb-3">
                                                <label for="tipoactivo" class="form-label">ID TIPO ACTIVO</label>
                                                <input type="text" class="form-control" id="tipoactivo"
                                                    name="tipoactivo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="decripcionactivo" class="form-label">DESCRIPCION</label>
                                                <input type="text" class="form-control" id="decripcionactivo"
                                                    name="decripcionactivo">
                                            </div>
                                            <button type="submit"
                                                class="bi bi-database-fill-add text-dark btn"></button>
                                            <a class="bi bi-skip-backward-btn-fill text-dark btn"
                                                title="Retornar a los tipos de activo" href="../tipoactivos.php"></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
</body>

</html>