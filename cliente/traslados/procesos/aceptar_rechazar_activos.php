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
}

if (isset($_POST['rechazar'])) {
    // Actualizar el estado del activo a "Rechazado"
    $sql = "UPDATE activos_solicitud SET estado = 2 WHERE id_activo = $id_activo AND id_solicitud = $id_solicitud";
    $conexion->query($sql);

    // Verificar si al menos un activo ha sido rechazado
    $sql_verificar_rechazados = "SELECT COUNT(*) AS total_rechazados FROM activos_solicitud WHERE id_solicitud = $id_solicitud AND estado = 2";
    $result_verificar_rechazados = $conexion->query($sql_verificar_rechazados);
    $row_verificar_rechazados = $result_verificar_rechazados->fetch_assoc();
    $total_rechazados = $row_verificar_rechazados["total_rechazados"];

    if ($total_rechazados > 0) {
        // Si al menos un activo ha sido rechazado, actualizar el estado de la solicitud a "Rechazado"
        $sql_update_solicitud = "UPDATE solicitudes_transferencia SET estado = 2 WHERE id = $id_solicitud";
        $conexion->query($sql_update_solicitud);
    }
}

// Verificar si todos los activos de la solicitud han sido aceptados
$sql_verificar_aceptados = "SELECT COUNT(*) AS total_aceptados FROM activos_solicitud WHERE id_solicitud = $id_solicitud AND estado = 1";
$result_verificar_aceptados = $conexion->query($sql_verificar_aceptados);
$row_verificar_aceptados = $result_verificar_aceptados->fetch_assoc();
$total_aceptados = $row_verificar_aceptados["total_aceptados"];

$sql_activos = "SELECT COUNT(*) AS total_activos FROM activos_solicitud WHERE id_solicitud = $id_solicitud";
$result_activos = $conexion->query($sql_activos);
$row_activos = $result_activos->fetch_assoc();
$total_activos = $row_activos["total_activos"];

// Actualizar el estado de la solicitud según corresponda
if ($total_aceptados == $total_activos) {
    // Si todos los activos de la solicitud han sido aceptados, actualizar el estado de la solicitud a "Aceptado"
    $sql_update_solicitud = "UPDATE solicitudes_transferencia SET estado = 1 WHERE id = $id_solicitud";
    $conexion->query($sql_update_solicitud);
}

// Redirigir a la página anterior
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>