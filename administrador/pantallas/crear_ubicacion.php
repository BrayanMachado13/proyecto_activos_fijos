<?php
      include_once "../../database/db.php"; 
      include_once "../usuarios/nombre_usuarios.php";
    
     // Consulta para obtener croles desde la tabla "roles"
     $sql_destino = "SELECT desti_id, nombre_destino FROM destino";
     $resultado_destino = $conexion->query($sql_destino);

     // Consulta para obtener croles desde la tabla "roles"
     $sql_pais = "SELECT id, nombre_pais FROM pais";
     $resultado_pais = $conexion->query($sql_pais);

     $sql_estado = "SELECT id, nombre FROM estado";
     $resultado_estado = $conexion->query($sql_estado);
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>

    <?php 
   include('header_pantallas.php'); 
    ?>

    <br>
    <center>
        <div class="container tam-card-personal" style="height: 70%;width: 40%;">
            <div class="row">
                <div class="col md-8">
                    <div class="bg-card-personal card  text-white">
                        <div class="card-body ">
                            <h2 class="card-title"></h2>
                            <div class="row">
                                <div class="col text-dark">
                                    <h3 class="card-title " style="text-align: center;"> REGISTRAR NUEVA UBICACIÓN</h3>
                                    <p class="text-center">A continuación digita los datos de La ubicacion</p>
                                    <div class="centrarcard">
                                        <form action="../guardar/GUbicaciones.php" method="post">
                                            <div class="mb-3">
                                                <label for="id" class="form-label">CODIGO</label>
                                                <input type="text" class="form-control" id="id" name="id">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">NOMBRE</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="selectdestino" class="form-label">seleccione el
                                                    destino</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="selectdestino" id="selectdestino">
                                                    <?php
                                                    while ($fila = $resultado_destino->fetch_assoc()) {
                                                        echo '<option value="' . $fila['desti_id'] . '">' . $fila['nombre_destino'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="selectpais" class="form-label">PAIS</label>
                                                <select id="pais" name="pais" class="form-select"
                                                    aria-label="Default select example">
                                                    <?php
                                                    while ($fila = $resultado_pais->fetch_assoc()) {
                                                        echo '<option value="' . $fila['id'] . '">' . $fila['nombre_pais'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="selectdepartamento" class="form-label">DEPARTAMENTO</label>
                                                <select id="departamento" name="departamento" class="form-select"
                                                    aria-label="Default select example">
                                                    <!-- Aquí se cargarán los departamentos relacionados con el país seleccionado -->
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="selectciudad" class="form-label">CIUDAD</label>
                                                <select id="ciudades" name="ciudades" class="form-select"
                                                    aria-label="Default select example">
                                                    <!-- Aquí se cargarán las ciudades relacionadas con el departamento seleccionado -->
                                                </select>
                                            </div>
                                            <script>
                                            $(document).ready(function() {
                                                // Cuando se cambie la selección en el primer select
                                                $('#pais').change(function() {
                                                    var idPais = $(this).val();

                                                    // Realizar una solicitud al servidor para obtener los departamentos relacionados
                                                    $.ajax({
                                                        url: '../obtener/obtener_departamentos.php',
                                                        type: 'POST',
                                                        data: {
                                                            id_pais: idPais
                                                        },
                                                        success: function(response) {
                                                            // Limpiar el segundo select
                                                            $('#departamento').empty();

                                                            // Agregar las opciones al segundo select
                                                            $('#departamento').append(
                                                                response);
                                                        },
                                                        error: function(xhr, status, error) {
                                                            console.error(error);
                                                        }
                                                    });
                                                });

                                                // Cuando se cambie la selección en el segundo select
                                                $('#departamento').change(function() {
                                                    var idDepartamento = $(this).val();

                                                    // Realizar una solicitud al servidor para obtener las ciudades relacionadas
                                                    $.ajax({
                                                        url: '../obtener/obtener_ciudades.php',
                                                        type: 'POST',
                                                        data: {
                                                            id_departamento: idDepartamento
                                                        },
                                                        success: function(response) {
                                                            // Limpiar el tercer select
                                                            $('#ciudades').empty();

                                                            // Agregar las opciones al tercer select
                                                            $('#ciudades').append(response);
                                                        },
                                                        error: function(xhr, status, error) {
                                                            console.error(error);
                                                        }
                                                    });
                                                });
                                            });
                                            </script>

                                            <div class="mb-3">
                                                <label for="estado" class="form-label">ESTADO</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="estado" id="estado">
                                                    <?php
                                            while ($fila = $resultado_estado->fetch_assoc()) {
                                                echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
                                            }
                                            ?>
                                                </select>
                                            </div>


                                            <button type="submit"
                                                class="bi bi-database-fill-add text-dark btn"></button>
                                            <a class="bi bi-skip-backward-btn-fill text-dark btn"
                                                title="Retornar a los tipos de activo" href="../destinos.php"></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <center>
        <div class=" mt-3 container tam-card-personal">
            <div class="row">
                <div class="col md-8">
                    <div class="bg-card-personal card  text-white">
                        <div class="card-body ">
                            <h2 class="card-title"></h2>
                            <div class="row">
                                <div class="col text-dark">
                                    <h5 class="card-title ">REGISTRO MASIVO DE UBICACIONES</h5>
                                    <p class="text-center">Escoja un archivo en formato .CSV para la creación masiva de
                                        Ubicaciones</p>
                                </div>
                            </div>
                            <div class="text-center text-dark">
                                <form enctype="multipart/form-data" action="php/importUbicacion.php"
                                    accept-charset="UTF-8" method="post"><input type="hidden" name="authenticity_token"
                                        value="g_l8u3DSowJ9ycs-_VWo0YXWHIJVEuhuHhlIX2McUkRf4KD-LsKogBXZOY5S58i92FRNleYR-MvWxf8ot7vigg"
                                        autocomplete="off">
                                    <div class="input-group">
                                        <input class="form-control border border-info" accept=".csv" type="file"
                                            name="file" id="file">
                                        <button name="button" type="submit"
                                            class=" btn btn-outline-secondary border border-info fa-solid fa-file-import"
                                            title="Importar">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="message" style="color: black;"></div>
            <script src="js/importUbicacion.js"></script>
        </div>
    </center>
</body>

</html>