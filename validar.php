<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("localhost", "root", "", "activofijos");

    if ($mysqli->connect_error) {
        die("Error de conexión a la base de datos: " . $mysqli->connect_error);
    }

    $usuario = $_POST["correo"];
    $contrasena = $_POST["password"];
   

    $sql = "SELECT rol FROM usuarios WHERE usuario = '$usuario'";
    $resultado = mysqli_query($mysqli, $sql);


    $sql = "SELECT SUBSTRING_INDEX(nombres, ' ', 1) AS nombres, SUBSTRING_INDEX(apellidos, ' ', 1) AS apellidos,usuario,rol,identificacion,fk_idzona
    FROM usuarios WHERE usuario = '$usuario' AND password = '$contrasena'
    LIMIT 1";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        // Obtiene la fila de resultados
        $row = $result->fetch_assoc();

        // Inicia la sesión y almacena información relevante
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['rol'] = $row['rol'];
        $_SESSION['nombres'] = $row['nombres'];
        $_SESSION['apellidos'] = $row['apellidos'];
        $_SESSION['identificacion'] = $row['identificacion'];
        $_SESSION['fk_idzona'] = $row['fk_idzona'];

        header("Location: cliente/principal_regular.php"); // Redirige al usuario a la página de bienvenida
        exit();
    } else {
        $error_msg =  "CORREO O CONTRASEÑA SON INCORRECTOS";
        header("Location: login.php?error_msg=$error_msg");
    }

    $mysqli->close();
}
?>