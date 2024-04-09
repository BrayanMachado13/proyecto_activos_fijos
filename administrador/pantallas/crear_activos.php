<?php
 include '../../database/db.php';

 $sql_centrocosto = "SELECT idcentrocosto, nombre_centrocosto FROM centrocosto";
 $resultado_centrocosto = $conexion->query($sql_centrocosto);

 $sql_usuarios = "SELECT identificacion, nombre_usuario FROM usuarios";
 $resultado_usuarios = $conexion->query($sql_usuarios);

 $sql_tipoactivos = "SELECT idtipoactivos, nombre_tipoactivos FROM tipoactivos";
 $resultado_tipoactivos = $conexion->query($sql_tipoactivos);

 $sql_producto = "SELECT id, nombre_producto FROM producto";
 $resultado_producto = $conexion->query($sql_producto);

 $sql_estado = "SELECT id, nombre FROM estado";
 $resultado_estado = $conexion->query($sql_estado);

 $sql_jerarquiactivo = "SELECT idjerarquiactivo, nombre_jerarquiactivo FROM jerarquiactivo";
 $resultado_jerarquiactivo = $conexion->query($sql_jerarquiactivo);

 $sql_provedor = "SELECT idprovedor, nombre_provedor FROM provedor";
 $resultado_provedor = $conexion->query($sql_provedor);

 $sql_marca = "SELECT idmarcas, nombre_marca FROM marca";
 $resultado_marca = $conexion->query($sql_marca);

 include_once "../usuarios/nombre_usuarios.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <title>Document</title>
</head>

<body style="background-image: url(../../complemento/imagen/fondoweb.jpg);">

    <?php 
    include('header_pantallas.php'); 
    ?>

    <br>
    <div class="container tam-card-personal">
        <div class="row">
            <div class="col md-8">
                <div class="bg-card-personal card  text-white"
                    style="background: linear-gradient(0deg, rgb(28 28 28 / 30%) 0%, rgb(0 0 0 / 10%) 100%);">
                    <div class="card-body "
                        style="background: linear-gradient(0deg, rgb(28 28 28 / 30%) 0%, rgb(0 0 0 / 10%) 100%);">
                        <h2 class="card-title"></h2>
                        <div class="row">
                            <div class="col text-dark">
                                <center>
                                    <h3 class="card-title ">REGISTRAR NUEVO ACTIVO</h3>
                                </center>
                                <p class="text-center">A continuación digita los datos del ACTIVO que deseas crear.</p>
                                <div class="centrarcard">
                                    <form action="../guardar/GActivosFijos.php" accept-charset="UTF-8" method="post">
                                        <input type="hidden" name="authenticity_token"
                                            value="gvYJq4mfrvtClbKSwiKjC1U1WmYAH2WRGq32urc1UHQclQipypTtscEJfoz9uXkUv-ZYmFkRKL4KqE66AuK9WQ"
                                            autocomplete="off">
                                        <div class="container">
                                            <!--Se agrega campo para asignarle manualmente el ID a cada registro-->
                                            <div class="form-control bg-card-personal"
                                                style="background: linear-gradient(0deg, rgb(28 28 28 / 30%) 0%, rgb(0 0 0 / 10%) 100%);">
                                                <div class="row row-cols-4">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label " style="display: block"
                                                                    for="codigo_activo">Código del
                                                                    activo</label>
                                                                <input
                                                                    class="form-control border border-info rounded-2 open-modal-button"
                                                                    type="text" name="codigo_activo" id="codigo_activo">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="form-label  " style="display: block"
                                                                        for="nombre_activo">Nombre del
                                                                        activo</label>
                                                                    <select
                                                                        class="form-select border border-info rounded-2" 
                                                                        name="nombre_activo" id="nombre_activo">
                                                                        <?php
                                                                        while ($fila = $resultado_producto->fetch_assoc()) {
                                                                            echo '<option value="' . $fila['id'] . '">' . $fila['nombre_producto'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <div class="form-group">
                                                                    <label class="form-label  " style="display: block"
                                                                        for="serial_activo">Serial del
                                                                        activo</label>
                                                                    <input
                                                                        class="form-control border border-info rounded-2"
                                                                        type="text" name="serial_activo"
                                                                        id="serial_activo">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">Tipo de activo </label>
                                                                    <select
                                                                        class="form-select border border-info rounded-2"
                                                                        name="tipo_activo" id="tipo_activo">
                                                                        <?php
                                                                        while ($fila = $resultado_tipoactivos->fetch_assoc()) {
                                                                            echo '<option value="' . $fila['idtipoactivos'] . '">' . $fila['nombre_tipoactivos'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label class="form-label">Estado?</label>
                                                                <select
                                                                    class="form-select border border-info rounded-2"
                                                                    name="estado" id="estado">
                                                                    <?php
                                                                        while ($fila = $resultado_estado->fetch_assoc()) {
                                                                            echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
                                                                        }
                                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Es Activo fijo o
                                                                    inventario?</label>
                                                                <select
                                                                    class="form-select border border-info rounded-2"
                                                                    name="jerarquia_activo" id="jerarquia_activo">
                                                                    <?php
                                                                        while ($fila = $resultado_jerarquiactivo->fetch_assoc()) {
                                                                            echo '<option value="' . $fila['idjerarquiactivo'] . '">' . $fila['nombre_jerarquiactivo'] . '</option>';
                                                                        }
                                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label " style="display: block"
                                                                    for="repuesto_activo">Activo
                                                                    Fijo</label>
                                                                <input
                                                                    class="form-control border border-info rounded-2 open-modal-button"
                                                                    type="text" name="repuesto_activo"
                                                                    id="repuesto_activo">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">Responsable </label>
                                                                    <select
                                                                        class="form-select border border-info rounded-2"
                                                                        name="usuario_activo" id="usuario_activo">
                                                                        <?php
                                                                        while ($fila = $resultado_usuarios->fetch_assoc()) {
                                                                            echo '<option value="' . $fila['identificacion'] . '">' . $fila['nombre_usuario'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label class="form-label " style="display: block"
                                                                    for="provedor_activo">Selecciona el
                                                                    proveedor</label>
                                                                <select
                                                                    class="form-select border border-info rounded-2"
                                                                    name="provedor_activo" id="provedor_activo">
                                                                    <?php
                                                                        while ($fila = $resultado_provedor->fetch_assoc()) {
                                                                            echo '<option value="' . $fila['idprovedor'] . '">' . $fila['nombre_provedor'] . '</option>';
                                                                        }
                                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div id="centers">
                                                                <label class="form-label  " style="display: block"
                                                                    for="centrocosto">Centros de
                                                                    costo:</label>
                                                                <select
                                                                    class="form-select border border-info rounded-2"
                                                                    name="centrocosto" id="centrocosto">
                                                                    <?php
                                                                    while ($fila = $resultado_centrocosto->fetch_assoc()) {
                                                                        echo '<option value="' . $fila['idcentrocosto'] . '">' . $fila['nombre_centrocosto'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div id="centers">
                                                                <label class="form-label  " style="display: block"
                                                                    for="destinos">Definir
                                                                    Destino:</label>
                                                                <select
                                                                    class="form-select border border-info rounded-2"
                                                                    name="destinos" id="destinos">

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div id="centers">
                                                                <label class="form-label  " style="display: block"
                                                                    for="ubicaciones">Definir
                                                                    ubicacion:</label>
                                                                <select
                                                                    class="form-select border border-info rounded-2"
                                                                    name="ubicaciones" id="ubicaciones">

                                                                </select>
                                                            </div>
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
                                                                error: function(xhr, status,
                                                                    error) {
                                                                    console.error(error);
                                                                }
                                                            });
                                                        });

                                                        // Cuando se cambie la selección en el segundo select
                                                        $('#destinos').change(function() {
                                                            var iddestino = $(this).val();

                                                            // Realizar una solicitud al servidor para obtener las ciudades relacionadas
                                                            $.ajax({
                                                                url: '../obtener/obtener_ubicacion.php',
                                                                type: 'POST',
                                                                data: {
                                                                    fk_desti_id: iddestino
                                                                },
                                                                success: function(response) {
                                                                    // Limpiar el tercer select
                                                                    $('#ubicaciones')
                                                                        .empty();

                                                                    // Agregar las opciones al tercer select
                                                                    $('#ubicaciones')
                                                                        .append(response);
                                                                },
                                                                error: function(xhr, status,
                                                                    error) {
                                                                    console.error(error);
                                                                }
                                                            });
                                                        });
                                                    });
                                                    </script>
                                                    <div class="col">
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label class="form-label  " style="display: block"
                                                                    for="fecha_compra">Digita fecha de
                                                                    compra</label>
                                                                <input class="form-control border border-info rounded-2"
                                                                    type="date" name="fecha_compra" id="fecha_compra">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label  " style="display: block"
                                                                    for="numero_factura">Numero de
                                                                    factura</label>
                                                                <input class="form-control border border-info rounded-2"
                                                                    type="text" name="numero_factura"
                                                                    id="numero_factura">
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label class="form-label  " style="display: block"
                                                                    for="precio_activo">Precio</label>
                                                                <input class="form-control border border-info rounded-2"
                                                                    type="text" name="precio_activo" id="precio_activo">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="form-label " style="display: block"
                                                                        for="marca_activo">Marca</label>
                                                                    <select
                                                                        class="form-select border border-info rounded-2"
                                                                        name="marca_activo" id="marca_activo">
                                                                        <?php
                                                                        while ($fila = $resultado_marca->fetch_assoc()) {
                                                                            echo '<option value="' . $fila['idmarcas'] . '">' . $fila['nombre_marca'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <center>
                                                    <i class="separar d-flex bi">
                                                        <span class="">

                                                            <button name="button" type="submit"
                                                                title="Guardar Activo O Inventario"
                                                                class="bi bi-arrow-counterclockwise text-dark btn"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-folder2-open" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z" />
                                                                </svg>
                                                            </button>
                                                        </span>
                                                    </i>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" mt-3 container tam-card-personal">
        <div class="row">
            <div class="col md-8">
                <div class="bg-card-personal card  text-white">
                    <div class="card-body ">
                        <h2 class="card-title"></h2>
                        <div class="row">
                            <div class="col text-dark">
                                <center>
                                    <h5 class="card-title ">REGISTRO MASIVO DE ACTIVOS FIJOS</h5>
                                </center>
                                <p class="text-center">Escoja un archivo en formato .CSV para la creación masiva de
                                    ACTIVOS FIJOS</p>
                            </div>
                        </div>
                        <div class="text-center text-dark">
                            <form enctype="multipart/form-data" action="../import/importActivos.php"
                                accept-charset="UTF-8" method="post" id="csvform"><input type="hidden"
                                    name="authenticity_token"
                                    value="fbU2oBPAh8Y8cd38Vt1xeKOmKV3WcI5O2Wd70Hu-i2T6ZPEvV-IxXF1d1Cj9IDW9bkiKm0GFOND-_MQCbGR47Q"
                                    autocomplete="off">
                                <div class="input-group">
                                    <input type="hidden" name="tipo_activo" id="tipo_activo" value="7">
                                    <input class="form-control border border-info" accept=".csv" type="file" name="file"
                                        id="filepadres">
                                    <button name="button" type="submit"
                                        class=" btn btn-outline-secondary border border-info fa-solid fa-file-import"
                                        title="Importar">Guardar</button>
                                </div>
                            </form>


                            <div class="col text-dark mt-3">
                                <h5 class="card-title ">REGISTRO MASIVO DE INVENTARIOS</h5>
                                <p class="text-center">Escoja un archivo en formato .CSV para la creación masiva de
                                    Inventarios</p>
                            </div>
                        </div>
                        <div class="text-center text-dark">
                            <form enctype="multipart/form-data" action="/actives/import2" accept-charset="UTF-8"
                                method="post"><input type="hidden" name="authenticity_token"
                                    value="37EZaru_YMrI983w1GhQACuyCiq0_EHxS0oyVZZrLAz3_YYhY0jGcf56SM_ZybdjweXn1gJqCvkkmHTlecikdw"
                                    autocomplete="off">
                                <div class="input-group">
                                    <input class="form-control border border-info" accept=".csv" type="file" name="file"
                                        id="file">
                                    <button name="button" type="submit"
                                        class=" btn btn-outline-secondary border border-info fa-solid fa-file-import"
                                        title="Importar"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>