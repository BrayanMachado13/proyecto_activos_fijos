<?php
 include '../../database/db.php';
    
 // Consulta para obtener croles desde la tabla "roles"
 $sql_pais = "SELECT id, nombre_pais FROM pais";
 $resultado_pais = $conexion->query($sql_pais);

 $sql_estado = "SELECT id, nombre FROM estado";
 $resultado_estado = $conexion->query($sql_estado);

 include_once "../usuarios/nombre_usuarios.php";
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

<body style="background-image: url(../../complemento/imagen/fondoweb.jpg);">

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
                                    <h3 class="card-title " style="text-align: center;"> REGISTRAR NUEVA ZONA</h3>
                                    <p class="text-center">A continuación digita los datos de la ZONA</p>
                                    <div class="centrarcard">
                                        <form action="../guardar/Gzonas.php" method="post">
                                            <div class="mb-3">
                                                <label for="id" class="form-label">ID</label>
                                                <input type="text" class="form-control" id="id" name="id" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">NOMBRE</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="selectpais" class="form-label">PAIS</label>
                                                <select id="pais" name="pais" class="form-select"
                                                    aria-label="Default select example" required>
                                                    <option value="">SELECCIONE UN PAIS:</option>
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
                                                    aria-label="Default select example" required>
                                                    <!-- Aquí se cargarán los departamentos relacionados con el país seleccionado -->
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="selectciudad" class="form-label">CIUDAD</label>
                                                <select id="ciudades" name="ciudades" class="form-select"
                                                    aria-label="Default select example" required>
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
                                                    name="estado" id="estado" required>
                                                    <option value="">SELECCIONE UN ESTADO:</option>
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
                                                title="Retornar a las zonas" href="../zonas.php"></a>
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
                                    <h5 class="card-title ">REGISTRO MASIVO DE MARCAS</h5>
                                    <p class="text-center">Escoja un archivo en formato .CSV para la creación masiva de
                                        Marcas</p>
                                </div>
                            </div>
                            <div class="text-center text-dark">
                                <form enctype="multipart/form-data" action="../import/importZonas.php"
                                    accept-charset="UTF-8" method="post">
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
            <script src="js/importZonas.js"></script>
        </div>

    </center>
</body>

</html>