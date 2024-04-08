<?php
include_once "usuarios/nombre_usuarios.php";
include_once "../database/db.php";


$sql = "SELECT st.id, usu.nombre_usuario AS nombre_usuario_solicitante, usua.nombre_usuario AS nombre_usuario_destino, 
    cc.nombre_centrocosto AS nombre_centrocosto, ds.nombre_destino AS nombre_destino, ub.nombre_ubicacion AS nombre_ubicacion
    FROM solicitudes_transferencia st
    LEFT JOIN usuarios usu ON st.usuario_origen = usu.identificacion
    LEFT JOIN usuarios usua ON st.usuario_destino = usua.identificacion
    LEFT JOIN centrocosto cc ON st.centro_costo = cc.idcentrocosto
    LEFT JOIN destino ds ON st.destino = ds.desti_id
    LEFT JOIN ubicacion ub ON st.ubicacion = ub.ubica_id";
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
        window.open('pdf/PDFsolicitudes.php', '_blank');
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
                        <li class="nav-item">
                            <i>
                                <a class="nav-item nav-link bi bi-plus-square-dotted" href="traslados/solicitudes.php">
                                    Nueva
                                    Solicitud</a>
                            </i>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input placeholder="Busca la solicitud acá" onchange="this.form.requestSubmit()" type="text"
                            name="search" id="search">
                        <button class="btn btn-secondary" type="button">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>
        <button onclick="generarPDF()" class="btn third">Generar Reporte</button>

        <div class="row">
            <div class="col-md-8">
                <div class="tzona">
                    <h3>SOLICITUDES DE TRASLADOS</h3>
                </div>
                <div id="soliciteds">
                </div>
                <table class="bigtables table  table-striped table-hover ">
                    <tbody>
                        <tr class="text-dark">
                            <th scope="col">ID</th>
                            <th scope="col">SOLICITANTE</th>
                            <th scope="col">DESTINATARIO</th>
                            <th scope="col">C. COSTO</th>
                            <th scope="col">NUEVO DESTINO</th>
                            <th scope="col">NUEVA UBICACIÓN</th>
                            <th scope="col">ACCIONES</th>
                        </tr>

                        <?php 
                            while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $mostrar['id']?>
                            </td>
                            <td>
                                <?php echo $mostrar['nombre_usuario_solicitante']?>
                            </td>
                            <td>
                                <?php echo $mostrar['nombre_usuario_destino']?>
                            </td>
                            <td>
                                <?php echo $mostrar['nombre_centrocosto']?>
                            </td>
                            <td>
                                <?php echo $mostrar['nombre_destino']?>
                            </td>
                            <td>
                                <?php echo $mostrar['nombre_ubicacion']?>
                            </td>

                            <td>
                                <i class="separar">
                                    <a class="bi bi-eye-fill text-dark btn" href=""></a>
                                    <form class="button_to" method="post" action=""><input type="hidden" name="_method"
                                            value="delete" autocomplete="off"><button class="bi bi-trash  text-dark btn"
                                            data-turbo-confirm="Estás seguro?" type="submit"></button><input
                                            type="hidden" name="authenticity_token"
                                            value="6FxIRY4lovc1Px_4lHKuC63pYK2kWeUyKfyqsbDSCD_u90XaSjZaYZx4H890rgsFcYwmzasWeYij4jisZsQqgA"
                                            autocomplete="off"></form>
                                    <a title="Editar" class=" bi bi-pencil-fill  text-dark btn" href=""></a>
                                </i>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>