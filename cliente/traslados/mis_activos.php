<?php
 include '../../database/db.php';
 include_once "../usuarios/nombre_usuarios.php";

 // Consulta SQL para obtener los activos fijos del usuario
$sql = "SELECT af.num_placa_activo , pr.nombre_producto AS nombre_producto, jr.nombre_jerarquiactivo AS nombre_jerarquiactivo,
ub.nombre_ubicacion AS nombre_ubicacion
FROM activos_fijos af 
LEFT JOIN producto pr ON af.nombre_producto = pr.id
LEFT JOIN jerarquiactivo jr ON af.fk_idjerarquiactivo = jr.idjerarquiactivo
LEFT JOIN ubicacion ub ON af.fk_ubica_id = ub.ubica_id
WHERE fk_cedula = $identificacion";

$resultado = $conexion->query($sql);

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
    </link>
    <title>Document</title>
</head>

<body>

    <?php 
    include('header.php'); 
    ?>
    <br>
    <div class="row">
        <div class="col-md-8">
            <div class="tzona">
                <h3>ACTIVOS</h3>
            </div>
            <div class="container">
                <div class="form-group">
                    <form class="d-flex justify-content-center" action="" accept-charset="UTF-8" method="get">

                        <div class="content-select m-2 mt-1">
                            <span>Activo o inventario</span>
                            <select id="jerarquia">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                            <script>
                            new SlimSelect({
                                select: '#jerarquia'
                            })
                            </script>
                        </div>
                        <div class="content-select m-2 mt-1">
                            <span>Filtro Destino</span>
                            <select id="destinos">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                            <script>
                            new SlimSelect({
                                select: '#destinos'
                            })
                            </script>
                        </div>
                        <div class="content-select m-2 mt-1">
                            <span>Filtro ubicación</span>
                            <select id="ubicaciones">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                            <script>
                            new SlimSelect({
                                select: '#ubicaciones'
                            })
                            </script>
                        </div>
                        <div class="content-select mt-1 m-2">
                            <span>Escribe número de la placa</span>
                            <input type="text" name="barcode" id="barcode" placeholder="Buscar por placa..."
                                class="form-control">
                        </div>
                        <div class="content-select m-2 mt-4 ">
                            <input type="submit" name="commit" value="Buscar" class="btn btn-primary"
                                data-disable-with="Buscar">
                            <a class="btn btn-primary" href="">Limpiar filtros</a>
                        </div>
                    </form>
                </div>

                <div class="activos" id="mis_activos">
                    <a style="text-decoration: none;" href="">
                        <div class="active clearfix" id="clearf" data-toggle="tooltip"
                            title="Clic para mas información de este punto de venta">
                            <div class="active-details">
                                <?php if ($resultado->num_rows > 0): ?>
                                <table class="table  table-striped table-hover text-dark">
                                    <tbody>
                                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <span class="active-nombre text-dark">
                                                    <b>PLACA:</b> <?php echo $fila["num_placa_activo"]; ?>,
                                                    <b>NOMBRE:</b> </b> <?php echo $fila["nombre_producto"]; ?>,
                                                    <b>TIPO DE ACTIVO:</b> <?php echo $fila["nombre_jerarquiactivo"]; ?>
                                                    ,
                                                    <b>UBICACION:</b>
                                                    <?php echo $fila["nombre_ubicacion"]; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <?php else: ?>
                                <p>No se encontraron activos fijos asociados al usuario.</p>
                                <?php endif; ?>

                                <?php $conexion->close(); ?>
                            </div>
                        </div>
                </div>


                <!-- Agregar botón para exportar -->
                <div>
                    <a class="btn btn-primary" href="/export_csv">Exportar a CSV</a>
                    <a class="btn btn-primary" href="/export_pdf.pdf">Exportar a PDF</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>