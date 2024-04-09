<?php
include_once "../usuarios/nombre_usuarios.php";
include_once "../../database/db.php";

$id = $_GET["id"];

// Consulta para obtener los detalles del dato
$sql = "SELECT ac.id, ac.serial_activo, ac.num_placa_activo AS activo_fijo, ac.activofijo_repuesto, tp.nombre_tipoactivos AS nombre_tipo_activos, ac.fk_cedula, jr.nombre_jerarquiactivo AS nombre_jerarquia, pr.nombre_producto AS nombre_producto,
usu.nombre_usuario AS nombre_usuario, es.nombre AS nombre_estado, ds.nombre_destino AS nombre_destino, ub.nombre_ubicacion AS nombre_ubicacion, ac.fk_idprovedor, prov.nombre_provedor AS nombre_provedor, ac.precio_activo, ac.fecha_activo
FROM activos_fijos ac
LEFT JOIN producto pr ON ac.nombre_producto = pr.id
LEFT JOIN usuarios usu ON ac.fk_cedula = usu.identificacion
LEFT JOIN estado es ON ac.estado = es.id
LEFT JOIN tipoactivos tp ON ac.fk_idtipoactivos = tp.idtipoactivos
LEFT JOIN jerarquiactivo jr ON ac.fk_idjerarquiactivo = jr.idjerarquiactivo
LEFT JOIN destino ds ON ac.fk_desti_id = ds.desti_id
LEFT JOIN ubicacion ub ON ac.fk_ubica_id = ub.ubica_id
LEFT JOIN provedor prov ON ac.fk_idprovedor = prov.idprovedor
WHERE num_placa_activo = $id

UNION  

SELECT inv.id, inv.serial_inventario, inv.num_placa_inventario AS activo_fijo , inv.activofijo_asociado, tp.nombre_tipoactivos AS nombre_tipo_activos, inv.fk_cedula, jr.nombre_jerarquiactivo AS nombre_jerarquia, pr.nombre_producto AS nombre_producto,
usu.nombre_usuario AS nombre_usuario, es.nombre AS nombre_estado, ds.nombre_destino AS nombre_destino, ub.nombre_ubicacion AS nombre_ubicacion, inv.fk_idprovedor, prov.nombre_provedor AS nombre_provedor, inv.precio_activo, inv.fecha_inventario
FROM inventarios inv
LEFT JOIN producto pr ON inv.nombre_producto = pr.id
LEFT JOIN usuarios usu ON inv.fk_cedula = usu.identificacion
LEFT JOIN estado es ON inv.estado = es.id
LEFT JOIN tipoactivos tp ON inv.fk_idtipoactivos = tp.idtipoactivos
LEFT JOIN jerarquiactivo jr ON inv.fk_idjerarquiactivo = jr.idjerarquiactivo
LEFT JOIN destino ds ON inv.fk_desti_id = ds.desti_id
LEFT JOIN ubicacion ub ON inv.fk_ubica_id = ub.ubica_id
LEFT JOIN provedor prov ON inv.fk_idprovedor = prov.idprovedor
WHERE num_placa_inventario = $id";

$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <title>Document</title>
</head>

<body>

    <?php 
    include('../pantallas/header_pantallas.php'); 
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
                                <h3 class="card-title "> DATOS DEL ACTIVO</h3>
                                <p class="text-center"></p>
                                <?php if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <div class="container">
                                    N° # <?php echo $row["id"]; ?>
                                    <table class="bigtables table  table-striped table-hover text-dark">
                                        <tbody>
                                            <tr class="">
                                                <th>SERIAL</th>
                                                <td><?php echo $row["serial_activo"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>PLACA</th>
                                                <td><?php echo $row["activo_fijo"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th> ACTIVO FIJO ASOCIADO </th>
                                                <td>No aplica</td>
                                            </tr>
                                            <tr>
                                                <th>Inventarios Asociados</th>
                                                <th><?php echo $row["activofijo_repuesto"]; ?></th>
                                            </tr>
                                            <tr>
                                                <th>TIPO DE ACTIVO</th>
                                                <td><?php echo $row["nombre_tipo_activos"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>NOMBRE DEL ACTIVO</th>
                                                <td><?php echo $row["nombre_producto"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>CÉDULA DEL RESPONSABLE</th>
                                                <td><?php echo $row["fk_cedula"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>NOMBRE DEL RESPONSABLE</th>
                                                <td><?php echo $row["nombre_usuario"]; ?></td>
                                            </tr>
                                            <tr>
                                            </tr>
                                            <tr>
                                                <th>ESTADO</th>
                                                <td><?php echo $row["nombre_estado"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>JERARQUIA</th>
                                                <td><?php echo $row["nombre_jerarquia"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>DESTINOS</th>
                                                <td><?php echo $row["nombre_destino"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>UBICACIÓN</th>
                                                <td><?php echo $row["nombre_ubicacion"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>NIT PROVEEDOR</th>
                                                <td><?php echo $row["fk_idprovedor"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>NOMBRE PROVEEDOR</th>
                                                <td><?php echo $row["nombre_provedor"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>PRECIO</th>
                                                <td> <?php echo $row["precio_activo"]; ?> COP</td>
                                            </tr>
                                            <tr>
                                                <th>Fecha Compra</th>
                                                <td> <?php echo $row["fecha_activo"]; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <?php } else {
                                echo "No se encontraron detalles para el ID proporcionado.";
                                 } ?>
                                <p></p>
                                <i>
                                    <ul class="separar d-flex">
                                        <li>
                                            <form class="button_to" method="post" action=""><input type="hidden"
                                                    name="_method" value="delete" autocomplete="off"><button
                                                    title="Eliminar" class="bi bi-trash btn"
                                                    type="submit"></button><input type="hidden"
                                                    name="authenticity_token"
                                                    value="7ylXddZvS6hTD6PE4T7cXUn-qvA3D5OJ1mmEdGI0R-Pyve4gpmk5DMFe2nXYkWx65i4aPJnXE4iodV65oDWOWw"
                                                    autocomplete="off"></form>
                                        </li>
                                        <li><a title="Editar" class=" bi bi-pencil-fill btn" href=""></a></li>
                                        <li>
                                        </li>
                                        <li><button onclick="window.history.back()"
                                                class="bi bi-skip-backward-btn-fill text-dark btn">Regresar</button>
                                        </li>
                                    </ul>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</body>

</html>