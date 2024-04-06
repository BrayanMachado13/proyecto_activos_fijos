<?php
include '../../../database/db.php';
include_once "../../usuarios/nombre_usuarios.php";

// Obtener el ID del activo y la solicitud
$id_activo = $_POST['id_activo'];
$id_solicitud = $_POST['id_solicitud'];

// Obtener el ID del usuario destino que aceptó el activo
$id_usuario_destino = $identificacion;

$sql_solicitud = "SELECT zona, centro_costo, destino, ubicacion FROM solicitudes_transferencia WHERE id = $id_solicitud";
$result_solicitud = $conexion->query($sql_solicitud);
$row_solicitud = $result_solicitud->fetch_assoc();
$zona = $row_solicitud['zona'];
$centrocosto = $row_solicitud['centro_costo'];
$destino = $row_solicitud['destino'];
$ubicacion = $row_solicitud['ubicacion'];

// Verificar si se ha enviado la acción de aceptar o rechazar
if (isset($_POST['aceptar'])) {
    // Actualizar el estado del activo a "Aceptado"
    $sql = "UPDATE activos_solicitud SET estado = 1 WHERE id_activo = $id_activo AND id_solicitud = $id_solicitud";
    $conexion->query($sql);

    // Actualizar el ID del usuario en el activo en la tabla activos_fijos
    $sql = "UPDATE activos_fijos SET fk_cedula = $id_usuario_destino, fk_idzona = '$zona', fk_idcentrocosto = '$centrocosto', fk_desti_id = '$destino', fk_ubica_id = '$ubicacion' WHERE num_placa_activo = $id_activo";
    $conexion->query($sql);
} elseif (isset($_POST['rechazar'])) {
    // Actualizar el estado del activo a "Rechazado"
    $sql = "UPDATE activos_solicitud SET estado = 2 WHERE id_activo = $id_activo AND id_solicitud = $id_solicitud";
    $conexion->query($sql);
}

// Redirigir a la página anterior
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>
