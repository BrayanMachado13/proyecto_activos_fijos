<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_solicitud = $_POST["id_solicitud"];
    $id_activo = $_POST["activo"];
    $id_usuario_destino = $_POST["id_usuario_destino"];

    $conexion = new mysqli("localhost", "root", "", "activofijos");

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Obtener el destino y la ubicación del activo
    $sql_activo = "SELECT fk_desti_id, fk_ubica_id FROM activos_fijos WHERE num_placa_activo = $id_activo";
    $result_activo = $conexion->query($sql_activo);
    if ($result_activo->num_rows > 0) {
        $row_activo = $result_activo->fetch_assoc();
        $destino_inicial = $row_activo["fk_desti_id"];
        $ubicacion_inicial = $row_activo["fk_ubica_id"];

        // Insertar el activo en la solicitud con estado "Pendiente"
        $sql_insert = "INSERT INTO activos_solicitud (id_solicitud, id_activo, ubicacion_inicial, destino_inicial, estado, id_usuario_destino) 
                       VALUES ($id_solicitud, $id_activo,$ubicacion_inicial, $destino_inicial, 3, $id_usuario_destino )";
        if ($conexion->query($sql_insert) === TRUE) {
            echo "Activo enviado correctamente.";

            // Redirigir al usuario de vuelta a la misma página
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error al enviar el activo: " . $conexion->error;
        }
    } else {
        echo "No se encontró el activo con el ID proporcionado.";
    }

    $conexion->close();
} else {
    echo "Acceso denegado.";
}
?>