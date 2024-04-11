<?php
include '../../database/db.php';
include_once "../usuarios/nombre_usuarios.php";

// Obtener el ID de la solicitud de la URL
$id_solicitud = $_GET['id_solicitud'];
$nombre_solicitante = $_GET['nombre_solicitante'];

// Obtener los activos disponibles
$sql = "SELECT ac.num_placa_activo, pr.nombre_producto AS nombre_producto, ac.serial_activo, jr.nombre_jerarquiactivo
    FROM activos_fijos ac 
    LEFT JOIN producto pr ON ac.nombre_producto = pr.id
    LEFT JOIN jerarquiactivo jr ON ac.fk_idjerarquiactivo = jr.idjerarquiactivo
    WHERE fk_cedula = $nombre_solicitante ";
$resultado = $conexion->query($sql);
$activos = $resultado->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT st.id AS id_solicitud, aso.estado, st.fecha_solicitud, st.usuario_origen, st.usuario_destino, st.centro_costo, 
    CASE WHEN EXISTS (
        SELECT 1
        FROM activos_solicitud aso
        WHERE aso.id_solicitud = st.id
    ) THEN dns.nombre_destino ELSE NULL END AS destino_final,
    CASE WHEN EXISTS (
        SELECT 1
        FROM activos_solicitud aso
        WHERE aso.id_solicitud = st.id
    ) THEN ubi.nombre_ubicacion ELSE NULL END AS ubicacion_final,
    af.num_placa_activo AS placa_activo, pr.nombre_producto AS nombre_activo, dn.nombre_destino AS destino_inicial, 
    ub.nombre_ubicacion AS ubicacion_inicial,
    est.nombre AS nombre_estado_traslado, aso.fecha_creacion AS fecha_creacion
    FROM solicitudes_transferencia st
    LEFT JOIN activos_solicitud aso ON st.id = aso.id_solicitud
    LEFT JOIN activos_fijos af ON aso.id_activo = af.num_placa_activo
    LEFT JOIN producto pr ON af.nombre_producto = pr.id
    LEFT JOIN destino dn ON aso.destino_inicial = dn.desti_id
    LEFT JOIN ubicacion ub ON aso.ubicacion_inicial = ub.ubica_id
    LEFT JOIN ubicacion ubi ON st.ubicacion = ubi.ubica_id
    LEFT JOIN destino dns ON st.destino = dns.desti_id
    LEFT JOIN estadotraslado est ON aso.estado = est.id
    WHERE st.id = $id_solicitud";
$result = $conexion->query($sql);

$sqli = "SELECT st.fecha_solicitud, st.usuario_destino AS usuario_envio_destino, usu.nombres AS usuario_origen, usua.nombres AS usuario_destino
    FROM solicitudes_transferencia st
    LEFT JOIN usuarios usu ON st.usuario_origen = usu.identificacion
    LEFT JOIN usuarios usua ON st.usuario_destino = usua.identificacion
    WHERE st.id =  $id_solicitud";
$resultados = $conexion->query($sqli);
$solicitudess = $resultados->fetch_assoc();

// Consultar la cantidad de activos pendientes en la solicitud
$sql_pendientes = "SELECT COUNT(*) AS total_pendientes FROM activos_solicitud WHERE id_solicitud = $id_solicitud AND estado = 3";
$result_pendientes = $conexion->query($sql_pendientes);
$row_pendientes = $result_pendientes->fetch_assoc();
$total_pendientes = $row_pendientes["total_pendientes"];

// Consultar si existen registros de activos para esa solicitud
$sql_activos = "SELECT COUNT(*) AS total_activos FROM activos_solicitud WHERE id_solicitud = $id_solicitud";
$result_activos = $conexion->query($sql_activos);
$row_activos = $result_activos->fetch_assoc();
$total_activos = $row_activos["total_activos"];

// Mostrar el select si hay activos pendientes o no hay registros de activos
$mostrar_select = ($total_pendientes > 0 || $total_activos == 0);

// Cerrar la conexión
$conexion->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
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
                                <h3 class="card-title "> DATOS DE LA SOLICITUD</h3>
                                <p class="text-center"></p>
                                <div class="container">
                                    <table class="bigtables table  table-striped table-hover text-dark">
                                        <tbody>
                                            <tr class="">
                                                <th>ID SOLICITUD</th>
                                                <td><?php echo $id_solicitud; ?></td>
                                            </tr>
                                            <tr>
                                                <th>SOLICITANTE</th>
                                                <td>
                                                    <?php echo $solicitudess["usuario_origen"]; ?>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th>NOMBRE DEL USUARIO DESTINO</th>
                                                <td><?php echo $solicitudess["usuario_destino"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>FECHA DE SOLICITUD</th>
                                                <td><?php echo $solicitudess["fecha_solicitud"]; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p></p>
                                <i>
                                    <ul class="separar d-flex">
                                        <li><a title="Editar" class=" bi bi-pencil-fill btn text-dark" href=""></a></li>
                                        <li><a title="Atras" class="bi bi-skip-backward-btn-fill text-dark btn"
                                                href="solicitudes.php">Atras</a></li>
                                    </ul>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container tam-card-personal">

        <div class="container form-control bg-card-personal">
            <?php if ($mostrar_select) : ?>
            <form action="procesos/enviar_activos.php" accept-charset="UTF-8" method="post">
                <input type='hidden' name='id_solicitud'
                    value='<?php echo isset($id_solicitud) ? $id_solicitud : ""; ?>'>
                <input type='hidden' name='id_usuario_destino'
                    value='<?php echo $solicitudess["usuario_envio_destino"]; ?>'>


                <div class="container">
                    <div class="col">
                        <label class="form-label">Activo fijo a trasladar</label>


                        <select name='activo' class="form-select" aria-label="Default select example">
                            <option value="" label=" "></option>


                            <?php foreach ($activos as $activo): ?>
                            <option value="<?php echo $activo['num_placa_activo']; ?>">
                                PLACA: <?php echo $activo['num_placa_activo']; ?> - NOMBRE:
                                <?php echo $activo['nombre_producto']; ?> - SERIAL:
                                <?php echo $activo['serial_activo']; ?> - JERARQUIA:
                                <?php echo $activo['nombre_jerarquiactivo']; ?></option>
                            <?php endforeach; ?>

                        </select>

                        <div class="separar d-flex">
                            <button name="button" type="submit" title="Inicia el traslado del activo"
                                class=" boton fourth mt-5">
                                <i class="fa-solid fa-truck-moving" aria-hidden="true"></i>
                                <span style="margin-left:10px;"> Iniciar traslado del activo </span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-8">
                    <div id="accepteds">
                    </div>
                    <div class="container">
                    </div>
                    <?php if ($result->num_rows > 0): ?>
                    <table class="bigtables table  table-striped table-hover">
                        <tbody>
                            <tr class="text-dark bigtable">
                                <th>Fecha</th>
                                <th>Placa</th>
                                <th>Nombre de activo</th>
                                <th>Destino inicial</th>
                                <th>Ubicación inicial</th>
                                <th>Destino final</th>
                                <th>Ubicación final</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </tbody>
                        <tbody class="bigtable">
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row["fecha_creacion"]; ?></td>
                                <td><?php echo $row["placa_activo"]; ?></td>
                                <td><?php echo $row["nombre_activo"]; ?></td>
                                <td><?php echo $row["destino_inicial"]; ?></td>
                                <td><?php echo $row["ubicacion_inicial"]; ?></td>
                                <td><?php echo $row["destino_final"]; ?></td>
                                <td><?php echo $row["ubicacion_final"]; ?></td>
                                <td><?php echo $row["nombre_estado_traslado"]; ?></td>

                                <td>
                                    <?php if ($row["destino_final"] != null && $row["ubicacion_final"] != null): ?>
                                    <div class="d-flex">
                                        <a class="bi bi-eye-fill btn text-dark" href=""></a>
                                        <?php if ($row["estado"] != 1 && $row["estado"] != 2): ?>
                                        <form class="button_to" method="post" action=""><input type="hidden"
                                                name="_method" value="delete" autocomplete="off"><button
                                                title="cancelar" class="bi bi-cart-x-fill btn text-dark"
                                                type="submit"></button><input type="hidden" name="authenticity_token"
                                                value="SLF6i9DLi9SaWg-5W7aavnxn08XuctIlYTYpHwiMW4SaUyZKDrLnXN-T52SmE2iQDhvxSlyw06glM46__WokyQ"
                                                autocomplete="off"></form>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p>No se encontraron activos enviados para esta solicitud.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>