<?php
include '../../database/db.php';
include_once "../usuarios/nombre_usuarios.php";

$id_solicitud = $_GET['id_solicitud'];
$id_activo = $_GET['id_activo'];
$usuario_destino = $_GET['usuario_destino'];
$destino = $_GET['destino'];
$ubicacion = $_GET['ubicacion'];
$tipo_activos = $_GET['tipoactivo'];
$id_marca = $_GET['marca'];
$producto = $_GET['producto'];

// Consulta para obtener los detalles del activo en la tabla activos_solicitud
$sql_activo = "SELECT * FROM activos_solicitud WHERE id_solicitud = $id_solicitud AND id_activo = $id_activo";
$result_activo = $conexion->query($sql_activo);

// Consulta para obtener los detalles del activo en la tabla activos_fijos
$sql_activo_fijo = "SELECT * FROM activos_fijos WHERE num_placa_activo = $id_activo";
$result_activo_fijo = $conexion->query($sql_activo_fijo);

// Consulta para obtener los detalles del activo en la tabla activos_fijos
$sql_marca = "SELECT * FROM marca WHERE idmarcas = $id_marca";
$result_marca = $conexion->query($sql_marca);

//consulta para obtener el tipo del activo
$sql_tipoactivo = "SELECT * FROM jerarquiactivo WHERE idjerarquiactivo = $tipo_activos";
$result_tipoactivo = $conexion->query($sql_tipoactivo);

// Consulta para obtener el nombre del responsable
$sql_responsable = "SELECT nombres FROM usuarios WHERE identificacion = $usuario_destino";
$result_responsable = $conexion->query($sql_responsable);

// Consulta para obtener el nombre del destino
$sql_destino = "SELECT nombre_destino FROM destino WHERE desti_id = $destino";
$result_destino = $conexion->query($sql_destino);

// Consulta para obtener el nombre de la ubicación
$sql_ubicacion = "SELECT nombre_ubicacion FROM ubicacion WHERE ubica_id = $ubicacion";
$result_ubicacion = $conexion->query($sql_ubicacion);

// Consulta para obtener el nombre del producto
$sql_producto = "SELECT * FROM producto WHERE id = $producto";
$result_producto = $conexion->query($sql_producto);

// Verificar si se encontraron los activos
if ($result_activo->num_rows > 0 && $result_activo_fijo->num_rows > 0) {
    $row_activo = $result_activo->fetch_assoc();
    $row_activo_fijo = $result_activo_fijo->fetch_assoc();
    $row_destino = $result_destino->fetch_assoc();
    $row_ubicacion = $result_ubicacion->fetch_assoc();
    $row_usuario_destino = $result_responsable->fetch_assoc();
    $row_jerarquiactivo = $result_tipoactivo->fetch_assoc();
    $row_marca = $result_marca->fetch_assoc();
    $row_producto = $result_producto->fetch_assoc();
    $serial_activo = $row_activo_fijo['serial_activo'];
    $nombre_usuario_destino = $row_usuario_destino['nombres'];
    $nombre_destino = $row_destino['nombre_destino'];
    $nombre_ubicacion = $row_ubicacion['nombre_ubicacion'];
    $nombre_jerarquiactivo =  $row_jerarquiactivo['nombre_jerarquiactivo'];
    $nombre_marca = $row_marca['nombre_marca'];
    $nombre_producto = $row_producto['nombre_producto'];
   
    if ($row_activo['estado'] != 1 && $row_activo['estado'] != 2) {
        $mostrar_botones = true;
    } else {
        $mostrar_botones = false;
    }
} else {
    echo "No se encontraron detalles para el activo recibido.";
}

// Cerrar conexión
$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body>

    <?php 
    include('headerSolicitudes.php'); 
    ?>

    <br>
    <div class="container tam-card-personal">
        <div class="row">
            <div class="col md-8">
                <div class="bg-card-personal card  text-white">
                    <div class="card-body ">
                        <h2 class="card-title"></h2>
                        <div class="row">
                            <div class="col text-dark">
                                <h3 class="card-title "> Detalles de la aceptación</h3>
                                <div class="container">
                                    <table class="bigtables table  table-striped table-hover text-dark">
                                        <tbody>
                                            <tr class="">
                                                <th>Id de la aceptación</th>
                                                <td>
                                                    <?= $id_solicitud ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Activo</th>
                                                <td>
                                                    <div class="badge text-dark text-wrap font-monospace">
                                                        PLACA: <?= $id_activo ?> <br>
                                                        NOMBRE:<?= $nombre_producto ?> <br>
                                                        TIPO: <?= $nombre_jerarquiactivo ?><br>
                                                        SERIAL: <?= $serial_activo ?><br>
                                                        MARCA: <?= $nombre_marca ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>INVENTARIOS ASOCIADOS</th>
                                                <td class="text-dark">
                                                    No hay inventarios asociados.
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>NOMBRE DEL RESPONSABLE</th>
                                                <td>
                                                    <?= $usuario_destino ?> -
                                                    <?= $nombre_usuario_destino ?></td>
                                            </tr>
                                            <tr>
                                                <th>DESTINO</th>
                                                <td>
                                                    <?= $destino ?> -
                                                    <?= $nombre_destino ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>UBICACIÓN</th>
                                                <td> <?= $ubicacion ?> -
                                                    <?= $nombre_ubicacion ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <i>
                                    <ul class="separar d-flex">
                                        <li><button onclick="window.history.back()"
                                                class="bi bi-skip-backward-btn-fill text-dark btn"> Atrás</button></li>

                                        <form class="button_to" method="post"
                                            action="procesos/aceptar_rechazar_activos.php">
                                            <input type="hidden" name="id_activo" value="<?= $id_activo ?>">
                                            <input type="hidden" name="id_solicitud" value="<?= $id_solicitud ?>">
                                            <?php if ($mostrar_botones): ?>
                                            <input type="submit" name="aceptar"
                                                class="bi bi-check-circle-fill text-success btn" value="Aceptar activo">
                                            <input type="submit" name="rechazar"
                                                class="bi bi-x-circle-fill text-danger btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" value="Rechazar">
                                            <?php endif; ?>
                                        </form>
                                    </ul>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>