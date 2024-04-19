<?php
     include '../../database/db.php';


     include_once "../usuarios/nombre_usuarios.php";

    
     // Consulta para obtener croles desde la tabla "roles"
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

<body style="background-image: url(../../complemento/imagen/fondoweb.jpg);">

    <?php 
    include('header_pantallas.php'); 
    ?>

    <br>
    <center>
        <div class="container tam-card-personal">
            <div class="row">
                <div class="col md-8">
                    <div class="bg-card-personal card  text-white">
                        <div class="card-body ">
                            <h2 class="card-title"></h2>
                            <div class="row">
                                <div class="col text-dark">
                                    <h3 class="card-title " style="text-align: center;"> REGISTRAR NUEVO PRODUCTO</h3>
                                    <p class="text-center">A continuación digita los datos del producto</p>
                                    <div class="centrarcard">
                                        <form action="../guardar/Gproducto.php" method="post">
                                            <div class="mb-3">
                                                <label for="id" class="form-label">ID</label>
                                                <input type="number" class="form-control" id="id" name="id" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">NOMBRE</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre"
                                                    required>
                                            </div>
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
                                                title="Retornar a los tipos de activo" href="../usuarios.php"></a>
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
                                    <h5 class="card-title ">REGISTRO MASIVO DE PRODUCTOS</h5>
                                    <p class="text-center">Escoja un archivo en formato .CSV para la creación masiva de
                                        productos</p>
                                </div>
                            </div>
                            <div class="text-center text-dark">
                                <form enctype="multipart/form-data" action="../import/importProducto.php"
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
            <script src="js/importZonas.js"></script>
        </div>

    </center>
</body>

</html>