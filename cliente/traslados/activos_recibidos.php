<?php
 include '../../database/db.php';
 include_once "../usuarios/nombre_usuarios.php";

 $sql = "SELECT pr.nombre_producto AS nombre_producto, ae.estado, et.nombre AS nombre_estado, ae.id_activo, st.id,
 usu.nombre_usuario AS usuario_destino, st.centro_costo, st.destino, ubi.nombre_ubicacion AS nombre_ubicacion_final, 
 st.fecha_solicitud, ds.nombre_destino AS nombre_destino_inicial, ub.nombre_ubicacion AS nombre_ubicacion_inicial, 
 af.serial_activo, jr.nombre_jerarquiactivo AS nombre_jerarquiactivo 
 FROM activos_solicitud ae 
 JOIN activos_fijos af ON ae.id_activo = af.num_placa_activo 
 JOIN solicitudes_transferencia st ON ae.id_solicitud = st.id
 LEFT JOIN usuarios usu ON st.usuario_origen = usu.identificacion
 LEFT JOIN destino ds ON af.fk_desti_id = ds.desti_id
 LEFT JOIN ubicacion ub ON af.fk_ubica_id = ub.ubica_id
 LEFT JOIN ubicacion ubi ON st.ubicacion = ubi.ubica_id
 LEFT JOIN estadotraslado et ON ae.estado = et.id
 LEFT JOIN producto pr ON af.nombre_producto = pr.id
 LEFT JOIN jerarquiactivo jr ON af.fk_idjerarquiactivo = jr.idjerarquiactivo
 WHERE ae.id_usuario_destino = $identificacion";
    $result = $conexion->query($sql);

 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body>

    <?php 
    include('header.php'); 
    ?>
    <br>

    <div class="container">
        <form class="d-flex" action="" accept-charset="UTF-8" method="get">

            <select id="selectElement">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
            </select>
            <script>
            new SlimSelect({
                select: '#selectElement'
            })
            </script>


            <select name="state_id" id="state_id">
                <option value="">Buscar por estado</option>
                <option value="1">FINALIZADO</option>
                <option value="2">EN PROCESO</option>
                <option value="3">RECHAZADO</option>
                <option value="4">CANCELADO</option>
                <option value="5">ANULADO</option>
            </select>

            <input type="text" name="plate" id="plate" placeholder="Buscar por placa..." class="form-control">
            <input type="submit" name="commit" value="Buscar" data-disable-with="Buscar">
        </form>
        <div class="container text-center d-flex"></div>
        <?php if ($result->num_rows > 0): ?>
        <table class="bigtable table table-striped table-hover">
            <thead>
                <tr id="encabezados">
                    <th>Nombre usuario</th>
                    <th>Fecha Solicitud</th>
                    <th>Destino Inicial</th>
                    <th>Ubicacion Inicial</th>
                    <th>Ubicacion final</th>
                    <th>Estado</th>
                    <th>Placa</th>
                    <th>Serial</th>
                    <th>Nombre</th>
                    <th>Jerarquía</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody id="tabla-aceptados">
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr data-estado="2">
                    <td><?= $row['usuario_destino'] ?></td>
                    <td><?= $row['fecha_solicitud'] ?></td>
                    <td><?= $row['nombre_destino_inicial'] ?></td>
                    <td><?= $row['nombre_ubicacion_inicial'] ?></td>
                    <td><?= $row['nombre_ubicacion_final'] ?></td>
                    <td><?= $row['nombre_estado'] ?></td>
                    <td><?= $row['id_activo'] ?></td>
                    <td><?= $row['serial_activo'] ?></td>
                    <td><?= $row['nombre_producto'] ?></td>
                    <td><?= $row['nombre_jerarquiactivo'] ?></td>
                    <td>
                        <?php if ($row['estado'] != 1 && $row['estado'] != 2): ?>
                        <form action="procesos/aceptar_rechazar_activos.php" method="post">
                            <input type="hidden" name="id_activo" value="<?= $row['id_activo'] ?>">
                            <input type="hidden" name="id_solicitud" value="<?= $row['id'] ?>">
                            <input type="submit" name="aceptar" value="Aceptar">
                            <input type="submit" name="rechazar" value="Rechazar">
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No hay activos enviados.</p>
        <?php endif; ?>
    </div>
</body>

</html>
<?php
$conexion->close();
?>