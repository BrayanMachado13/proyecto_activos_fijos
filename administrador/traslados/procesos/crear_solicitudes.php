<?php
include '../../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_origen = $_POST["solicitud_usuario_id"]; // Puedes obtener el usuario origen de la sesión o de alguna otra forma
    $usuario_destino = $_POST["destinatario"];
    $zona = $_POST["zona"];
    $centro_costo = $_POST["centrocosto"];
    $destino = $_POST["destinos"];
    $ubicacion = $_POST["ubicaciones"];
    $estado = $_POST["estado"];

    // Insertar la solicitud de transferencia
    $sql = "INSERT INTO solicitudes_transferencia (usuario_origen, usuario_destino, zona, centro_costo, destino, ubicacion, estado) VALUES ('$usuario_origen', '$usuario_destino', '$zona', '$centro_costo', '$destino', '$ubicacion', '$estado')";
    if ($conexion->query($sql) === TRUE) {
        $id_solicitud = $conexion->insert_id;

        // Redirigir al usuario a la página de selección de activos
        header("Location: ../asignacion_activos.php?id_solicitud=$id_solicitud&nombre_solicitante=$usuario_origen");
        exit();
    } else {
        echo "Error al crear la solicitud: " . $conexion->error;
    }
}
?>