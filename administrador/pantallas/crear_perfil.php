<?php
     include '../../database/db.php';

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

<body>

    <?php 
    include('header_pantallas.php'); 
    ?>

    <br><br>
    <center>
        <div class="container tam-card-personal" style="height: 70%;width: 70%;">
            <div class="row">
                <div class="col md-8">
                    <div class="bg-card-personal card  text-white">
                        <div class="card-body ">
                            <h2 class="card-title"></h2>
                            <div class="row">
                                <div class="col text-dark">
                                    <h3 class="card-title " style="text-align: center;"> REGISTRAR NUEVO PERFIL</h3>
                                    <p class="text-center">A continuación digita los datos del Perfil</p>
                                    <div class="centrarcard">
                                        <form action="../guardar/GRoles.php" method="post">
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
                                                <label for="estado" class="form-label">ESTADO</label>
                                                <select id="estado" name="estado" class="form-select"
                                                    aria-label="Default select example" required>
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
                                                title="Retornar a los roles" href="../roles.php"></a>
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
</body>

</html>