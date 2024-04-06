<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_solicitud = $_POST["id_solicitud"];
    $id_activo = $_POST["activo"];
    $id_usuario_destino = $_POST["id_usuario_destino"];
    // Aquí deberías validar que el activo seleccionado existe y está disponible

    $conexion = new mysqli("localhost", "root", "", "activofijos");

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Insertar el activo en la solicitud con estado "Pendiente"
    $sql = "INSERT INTO activos_solicitud (id_solicitud, id_activo, estado, id_usuario_destino) VALUES ($id_solicitud, $id_activo, 3, $id_usuario_destino)";
    if ($conexion->query($sql) === TRUE) {
        echo "Activo enviado correctamente.";

        // Redirigir al usuario de vuelta a la misma página
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error al enviar el activo: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Acceso denegado.";
}
?>
