<?php
     include '../../database/db.php';


    include_once "../usuarios/nombre_usuarios.php";

    
     // Consulta para obtener croles desde la tabla "roles"
     $sql_roles = "SELECT idroles, nom_rol FROM rol";
     $resultado_roles = $conexion->query($sql_roles);
 
     // Consulta para obtener zonas desde la tabla "zona"
     $sql_zona = "SELECT idzona, nombre_zona FROM zona";
     $resultado_zona = $conexion->query($sql_zona);

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
                                    <h3 class="card-title " style="text-align: center;"> REGISTRAR NUEVO USUARIO</h3>
                                    <p class="text-center">A continuación digita los datos del usurio</p>
                                    <div class="centrarcard">
                                        <form action="../guardar/GUsuarios.php" method="post">
                                            <div class="mb-3">
                                                <label for="id" class="form-label">CEDULA</label>
                                                <input type="number" class="form-control" id="id" name="id">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">NOMBRES Y APELLIDOS</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="correo" class="form-label">CORREO ELECTRONICO</label>
                                                <input type="email" class="form-control" id="correo" name="correo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">CONTRASEÑA</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password">
                                            </div>

                                            <div class="mb-3">
                                                <label for="rol" class="form-label">ROL</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="rol" id="rol">
                                                    <?php
                                                    while ($fila = $resultado_roles->fetch_assoc()) {
                                                        echo '<option value="' . $fila['idroles'] . '">' . $fila['nom_rol'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="zona" class="form-label">ZONA</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="zona" id="zona">
                                                    <?php
                                                    while ($fila = $resultado_zona->fetch_assoc()) {
                                                        echo '<option value="' . $fila['idzona'] . '">' . $fila['nombre_zona'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

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
    <br>
    <br>
</body>

</html>