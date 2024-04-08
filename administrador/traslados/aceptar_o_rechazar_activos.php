<?php
include '../../database/db.php';
include_once "../usuarios/nombre_usuarios.php";

$id_solicitud = $_GET['id_solicitud'];
$id_activo = $_GET['id_activo'];

// Consulta para obtener los detalles del activo en la tabla activos_solicitud
$sql_activo = "SELECT * FROM activos_solicitud WHERE id_solicitud = $id_solicitud AND id_activo = $id_activo";
$result_activo = $conexion->query($sql_activo);

// Consulta para obtener los detalles del activo en la tabla activos_fijos
$sql_activo_fijo = "SELECT * FROM activos_fijos WHERE num_placa_activo = $id_activo";
$result_activo_fijo = $conexion->query($sql_activo_fijo);

// Consulta para obtener el nombre del responsable
$sql_responsable = "SELECT nombre_usuario FROM usuarios WHERE identificacion = $usuario_destino";
$result_responsable = $conexion->query($sql_responsable);

// Consulta para obtener el nombre del destino
$sql_destino = "SELECT nombre_destino FROM destino WHERE desti_id = $destino";
$result_destino = $conexion->query($sql_destino);

// Consulta para obtener el nombre de la ubicación
$sql_ubicacion = "SELECT nombre_ubicacion FROM ubicacion WHERE ubica_id = $ubicacion";
$result_ubicacion = $conexion->query($sql_ubicacion);

// Verificar si se encontraron los activos
if ($result_activo->num_rows > 0 && $result_activo_fijo->num_rows > 0) {
    $row_activo = $result_activo->fetch_assoc();
    $row_activo_fijo = $result_activo_fijo->fetch_assoc();
    $nombre_producto = $row_activo_fijo['nombre_producto'];
    $usuario_destino = $row_activo['id_usuario_destino'];
    $destino = $row_activo['destino'];
    $ubicacion = $row_activo['ubicacion'];
    // Continuar con los demás campos que quieras mostrar

    // Obtener el nombre del responsable
    $nombre_responsable = "";
    if ($result_responsable->num_rows > 0) {
        $row_responsable = $result_responsable->fetch_assoc();
        $nombre_responsable = $row_responsable['nombre_usuario'];
    }

    // Obtener el nombre del destino
    $nombre_destino = "";
    if ($result_destino->num_rows > 0) {
        $row_destino = $result_destino->fetch_assoc();
        $nombre_destino = $row_destino['nombre_destino'];
    }

    // Obtener el nombre de la ubicación
    $nombre_ubicacion = "";
    if ($result_ubicacion->num_rows > 0) {
        $row_ubicacion = $result_ubicacion->fetch_assoc();
        $nombre_ubicacion = $row_ubicacion['nombre_ubicacion'];
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
                                                        NOMBRE:
                                                        <?= $nombre_producto ?> <br>
                                                        TIPO: ACTIVO FIJO<br>
                                                        SERIAL: 26C'24RG'1A00517<br>
                                                        MARCA: SMART POST
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
                                                    MARTA MARIA MACIAS</td>
                                            </tr>
                                            <tr>
                                                <th>DESTINO</th>
                                                <td>
                                                    3576 -
                                                    EDIFICIO RECORD MONTERIA
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>UBICACIÓN</th>
                                                <td>56 -
                                                    TALLER DE SISTEMAS
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>SUBRESPONSABLE ASIGNADO</th>
                                                <td><?= $usuario_destino ?> -
                                                    BRAYAN MACHADO
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <i>
                                    <ul class="separar d-flex">
                                        <li><button onclick="window.history.back()"
                                                class="bi bi-skip-backward-btn-fill text-dark btn"> Atrás</button></li>
                                        <?php if ($row['estado'] != 1 && $row['estado'] != 2): ?>
                                            <form class="button_to" method="post"
                                                action="procesos/aceptar_rechazar_activos.php">
                                                <input type="hidden" name="id_activo" value="<?= $id_activo ?>">
                                                <input type="hidden" name="id_solicitud" value="<?= $id_solicitud ?>">
                                                <input type="button" name="aceptar"
                                                    class="bi bi-check-circle-fill text-success btn" value="Aceptar activo">
                                                <input type="button" name="rechazar"
                                                    class="bi bi-x-circle-fill text-danger btn" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" value="Rechazar">
                                            </form>
                                        <?php endif; ?>

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