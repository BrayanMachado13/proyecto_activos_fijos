<?php
include_once "usuarios/nombre_usuarios.php";
include_once "../database/db.php";

$sql = "SELECT aso.id, 
    st.usuario_destino AS usuario_destino, 
    usu.nombres AS nombre_usuario, 
    st.fecha_solicitud AS fecha_solicitud, 
    dn.nombre_destino AS destino_inicial, 
    ub.nombre_ubicacion AS ubicacion_inicial, 
    dns.nombre_destino AS destino_final, 
    ubi.nombre_ubicacion AS ubicacion_final, 
    est.nombre AS nombre_estado_traslado,
    aso.id_activo
    FROM activos_solicitud aso
    LEFT JOIN solicitudes_transferencia st ON aso.id_solicitud = st.id
    LEFT JOIN usuarios usu ON st.usuario_origen = usu.identificacion
    LEFT JOIN destino dn ON aso.destino_inicial = dn.desti_id
    LEFT JOIN ubicacion ub ON aso.ubicacion_inicial = ub.ubica_id
    LEFT JOIN ubicacion ubi ON st.ubicacion = ubi.ubica_id
    LEFT JOIN destino dns ON st.destino = dns.desti_id
    LEFT JOIN estadotraslado est ON aso.estado = est.id";

$result = $conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/activos.css">
    <title>Document</title>

    <script>
    function generarPDF() {
        // Llamar a generar_pdf.php para generar el PDF
        window.open('pdf/PDFAsignacionActivos.php', '_blank');
    }
    </script>
</head>

<body>

    <?php 
    include('header.php'); 
    ?>
    <br>
    <div class="container">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <nav class="navbar navsep navbar-expand-sm navbar-rednav bg-rednav rounded">
            <div class="container-fluid">
                <div class="navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <div>
                            <a class="btn third" data-method="get" href="">Reporte Asignaciones De Activos en
                                csv</a>
                            <button onclick="generarPDF()" class="btn third">Reporte Asignaciones De Activos en
                                PDF</button>
                        </div>
                    </ul>
                    <form class="d-flex">

                        <div class="form-group">
                            <label class="text-white" for="plate_filter"># placa</label>
                            <input class="form-control" onchange="this.form.requestSubmit()"
                                placeholder="Ingrese la placa" type="text" name="search" id="search">
                        </div>

                        <div class="form-group">
                            <label class="text-white" for="state_id">Estado</label>
                            <select class="form-control" onchange="this.form.requestSubmit()" name="state_id"
                                id="state_id">
                                <option value="">Seleccione un estado</option>
                                <option value="1">FINALIZADO</option>
                            </select>
                        </div>

                        <div class="form-group mt-4">
                            <input type="submit" name="commit" value="Buscar" class="btn btn-secondary"
                                onclick="this.form.submit()" data-disable-with="Buscar">
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <?php if ($result->num_rows > 0): ?>
        <table class="bigtables table  table-striped table-hover">
            <thead>
                <tr class="text-dark">
                    <th>ID</th>
                    <th>Usuario destino</th>
                    <th>Nombre de usuario</th>
                    <th>Fecha Solicitud</th>
                    <th>Destino Inicial</th>
                    <th>Ubicacion Inicial</th>
                    <th>Destino final</th>
                    <th>Ubicacion final</th>
                    <th>States ID</th>
                    <th>Active</th>
                    <th>options</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include_once 'busquedas/buscarAsignacionActivos.php';
                ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['usuario_destino'] ?></td>
                    <td><?= $row['nombre_usuario'] ?></td>
                    <td><?= $row['fecha_solicitud'] ?></td>
                    <td><?= $row['destino_inicial'] ?></td>
                    <td><?= $row['ubicacion_inicial'] ?></td>
                    <td><?= $row['destino_final'] ?></td>
                    <td><?= $row['ubicacion_final'] ?></td>
                    <td><?= $row['nombre_estado_traslado'] ?></td>
                    <td><?= $row['id_activo'] ?></td>
                    <td>
                        <div class="d-flex">

                        </div>
                        <a class="bi bi-eye-fill btn text-dark" href=""></a>

                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No se encontraron activos enviados para esta solicitud.</p>
        <?php endif; ?>
    </div>
    <nav aria-label="...">
        <ul class="pagination justify-content-center mt-2">
            <?php 
            include_once 'paginacion/paginacion.php';
        ?>
        </ul>
    </nav>
</body>

</html>