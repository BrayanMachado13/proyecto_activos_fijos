<?php
 include '../../database/db.php';
 include_once "../usuarios/nombre_usuarios.php";

    // Consulta para obtener croles desde la tabla "roles"
    $sql_jerarquia = "SELECT idjerarquiactivo, nombre_jerarquiactivo FROM jerarquiactivo";
    $resultado_jerarquia = $conexion->query($sql_jerarquia);

    // Consulta para obtener croles desde la tabla "roles"
    $sql_ccosto = "SELECT idcentrocosto, nombre_centrocosto FROM centrocosto";
    $resultado_ccosto = $conexion->query($sql_ccosto);

    $sql = "SELECT st.id, st.estado, ett.nombre AS nombre_estado, st.fecha_solicitud, st.usuario_origen, usu.nombre_usuario AS nombre_usuario_origen,
    usua.nombre_usuario AS nombre_usuario_destino, cc.nombre_centrocosto AS centro_costo, ds.nombre_destino AS destino,
    ub.nombre_ubicacion AS ubicacion,
    CONCAT('(', GROUP_CONCAT(acs.id_activo SEPARATOR '), ('), ')') AS activos_enviados 
    FROM solicitudes_transferencia st
    LEFT JOIN activos_solicitud acs ON st.id = acs.id_solicitud
    LEFT JOIN usuarios usu ON st.usuario_origen = usu.identificacion
    LEFT JOIN usuarios usua ON st.usuario_destino = usua.identificacion
    LEFT JOIN centrocosto cc ON st.centro_costo = cc.idcentrocosto
    LEFT JOIN destino ds ON st.destino = ds.desti_id
    LEFT JOIN ubicacion ub ON st.ubicacion = ub.ubica_id
    LEFT JOIN estadotraslado ett ON st.estado = ett.id
    WHERE usuario_origen = '$identificacion'
    GROUP BY st.id, st.fecha_solicitud";
    $result = $conexion->query($sql);

    $solicitudes = array();
    if ($result->num_rows > 0) {
        // Guardar las solicitudes en un array
        while($row = $result->fetch_assoc()) {
            $solicitudes[] = $row;
        }
    } else {
        echo "No se encontraron solicitudes para este usuario";
    }
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
    </link>
    <title>Document</title>
</head>

<body>

    <?php 
    include('../pantallas/header_pantallas.php'); 
    ?>
    <br>

    <div class="container">
        <h5>Crear nueva solicitud de traslado</h5>
        <div class="tzona">
            <div class="row">
                <div class="col-md-8">
                    <form action="procesos/crear_solicitudes.php" accept-charset="UTF-8" method="post"><input
                            type="hidden" name="authenticity_token"
                            value="nPo4q9CYYmLjKDMW6u_Hum1EOI6stWTQcKqeWswB4t2D3txQft7RWKC0nab0UbdQSdEMTIbFdPeS5ivEQo7dpw"
                            autocomplete="off">
                        <div class="form-control bg-card-personal">
                            <div class="row row-cols-2">
                                <h5>Tipo de traslado </h5>
                                <select class="form-control border border-info rounded-2" name="jerarquia_activo"
                                    id="jerarquia_activo">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    while ($fila = $resultado_jerarquia->fetch_assoc()) {
                                        echo '<option value="' . $fila['idjerarquiactivo'] . '">' . $fila['nombre_jerarquiactivo'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="col-6">
                                    <br>
                                    <h5>Origen</h5>
                                    <div class="mb-3">
                                        <label class="form-label fw-bolder ">Cédula de ciudadania:</label>
                                        <input value="<?php echo $identificacion; ?>"
                                            class="form-control border border-info rounded-2" readonly="readonly"
                                            type="text" name="solicitud_usuario_id" id="solicitud_usuario_id">
                                    </div>

                                    <div class="">
                                        <label class="form-label  ">Nombre de usuario:</label>
                                        <input value="<?php echo $n_usuario; ?>"
                                            class="form-control border border-info rounded-2" readonly="readonly"
                                            type="text" name="solicitud_usuario_nombre" id="solicitud_usuario_nombre">
                                    </div>

                                    <br>
                                </div>
                                <div class="col-6">
                                    <br>
                                    <h5>Destino</h5>

                                    <div class="">
                                        <div id="centers">
                                            <label class="form-label  " style="display: block" for="centrocosto">Centros
                                                de costo:</label>
                                            <select id="centrocosto" name="centrocosto" class="form-select"
                                                aria-label="Default select example">
                                                <option>Seleccione el centro de costo :</option>
                                                <?php
                                                while ($fila = $resultado_ccosto->fetch_assoc()) {
                                                    echo '<option value="' . $fila['idcentrocosto'] . '">' . $fila['nombre_centrocosto'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label class="form-label" style="display: block" for="destinos">Destinos</label>
                                        <div id="destinosdiv">
                                            <select id="destinos" name="destinos" class="form-select"
                                                aria-label="Default select example">


                                            </select>
                                        </div>

                                    </div>

                                    <div class="">
                                        <label class="form-label " style="display: block">Definir ubicacion:</label>
                                        <div id="ubicacionesdiv">
                                            <select id="ubicaciones" name="ubicaciones" class="form-select"
                                                aria-label="Default select example">

                                            </select>
                                        </div>
                                    </div>

                                    <script>
                                    $(document).ready(function() {
                                        // Cuando se cambie la selección en el primer select
                                        $('#centrocosto').change(function() {
                                            var idcentrocosto = $(this).val();

                                            // Realizar una solicitud al servidor para obtener los departamentos relacionados
                                            $.ajax({
                                                url: '../obtener/obtener_destinos.php',
                                                type: 'POST',
                                                data: {
                                                    fk_idcentrocosto: idcentrocosto
                                                },
                                                success: function(response) {
                                                    // Limpiar el segundo select
                                                    $('#destinos').empty();

                                                    // Agregar las opciones al segundo select
                                                    $('#destinos').append(
                                                        response);
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                }
                                            });
                                        });

                                        // Cuando se cambie la selección en el segundo select
                                        $('#destinos').change(function() {
                                            var idDestino = $(this).val();

                                            // Realizar una solicitud al servidor para obtener las ciudades relacionadas
                                            $.ajax({
                                                url: '../obtener/obtener_ubicacion.php',
                                                type: 'POST',
                                                data: {
                                                    fk_desti_id: idDestino
                                                },
                                                success: function(response) {
                                                    // Limpiar el tercer select
                                                    $('#ubicaciones').empty();

                                                    // Agregar las opciones al tercer select
                                                    $('#ubicaciones').append(response);
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                }
                                            });
                                        });
                                    });
                                    </script>

                                    <div class="mb-3">
                                        <label class="form-label ">Definir usuario destino:</label>

                                        <div id="usuariosdiv">
                                            <select id="destinatario" name="destinatario" class="form-select"
                                                aria-label="Default select example">

                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="estado" value="3">
                                    <script>
                                    $(document).ready(function() {
                                        // Cuando se cambie la selección en el primer select
                                        $('#centrocosto').change(function() {
                                            var idcentrocosto = $(this).val();

                                            // Realizar una solicitud al servidor para obtener los departamentos relacionados
                                            $.ajax({
                                                url: '../obtener/obtener_usuarios_zona.php',
                                                type: 'POST',
                                                data: {
                                                    idcentrocosto: idcentrocosto
                                                },
                                                success: function(response) {
                                                    // Limpiar el segundo select
                                                    $('#destinatario').empty();

                                                    // Agregar las opciones al segundo select
                                                    $('#destinatario').append(
                                                        response);
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                }
                                            });
                                        });
                                    });
                                    </script>

                                    <input type="hidden" id="zona" name="zona" value="">

                                    <script>
                                    $(document).ready(function() {
                                        // Cuando se cambie la selección en el primer select
                                        $('#centrocosto').change(function() {
                                            var idcentrocosto = $(this).val();

                                            // Realizar una solicitud al servidor para obtener los departamentos relacionados
                                            $.ajax({
                                                url: '../obtener/obtener_zona.php',
                                                type: 'POST',
                                                data: {
                                                    idcentrocosto: idcentrocosto
                                                },
                                                success: function(response) {
                                                    // Asignar el valor obtenido al campo de zona
                                                    $('#zona').val(response);
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                }
                                            });
                                        });
                                    });
                                    </script>
                                </div>
                            </div>

                        </div>
                        <div class="">
                            <div>
                                <i class="separar d-flex bi">
                                    <span class="">
                                        <button name="button" type="submit" title="Actualiza los datos"
                                            class="btn third">
                                            Guardar
                                        </button>
                                    </span>
                                </i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-8">
            <div class="tzona">
                <h5>SOLICITUDES DE TRASLADO</h5>
            </div>
            <?php if (!empty($solicitudes)): ?>
            <table id="solicited-table" class="bigtable table table-striped table-hover">
                <thead class="text-dark">
                    <tr>
                        <th>ESTADO?</th>
                        <th>FECHA</th>
                        <th>SOLICITANTE</th>
                        <th>DESTINATARIO</th>
                        <th>C. COSTO</th>
                        <th>NUEVO DESTINO</th>
                        <th>NUEVA UBICACIÓN</th>
                        <th>ACTIVOS ASOCIADOS</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody id="soliciteds">
                    <?php foreach ($solicitudes as $solicitud): ?>
                    <tr>
                        <td>
                            <?php if ($solicitud['estado'] == 1): ?>
                            <i class="bi bi-hand-thumbs-up-fill" style="color:#109d34;" aria-hidden="true"></i>
                            <?php elseif ($solicitud['estado'] == 2): ?>
                            <i class="bi bi-hand-thumbs-down-fill" style="color:#d63410;" aria-hidden="true"></i>
                            <?php elseif ($solicitud['estado'] == 3): ?>
                            <i class="bi bi-clock" style="color:#0051FF;" aria-hidden="true"></i>
                            <?php endif; ?>
                        </td>
                        <td><?= $solicitud['fecha_solicitud']; ?></td>
                        <td>
                            <?= $solicitud['nombre_usuario_origen']; ?>
                        </td>
                        <td>
                            <?= $solicitud['nombre_usuario_destino']; ?>
                        </td>
                        <td>
                            <?= $solicitud['centro_costo']; ?>
                        </td>
                        <td><?= $solicitud['destino']; ?></td>
                        <td>
                            <?= $solicitud['ubicacion']; ?>
                        </td>
                        <td class="active-barcode">
                            <?= $solicitud['activos_enviados']; ?>
                        </td>
                        <td>
                            <i class="separar">
                                <a class="bi bi-eye-fill text-dark btn"
                                    href="asignacion_activos.php?id_solicitud=<?= $solicitud['id']; ?>&nombre_solicitante=<?= $solicitud['usuario_origen']; ?>"></a>
                            </i>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>