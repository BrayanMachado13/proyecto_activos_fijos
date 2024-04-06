<?php
    include_once "usuarios/nombre_usuarios.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/activos.css">
    <title>Document</title>
</head>

<body>

    <?php 
    include('headerRegular.php'); 
    ?>
    <br>
    <div class="container tam-card-personal">
        <div class="row">
            <div class="col md-8">
                <div class="bg-card-personal card  text-white">
                    <div class="card-body ">
                        <h2 class="card-title"></h2>
                        <div class="row">
                            <div class="col text-dark">
                                <h3 class="card-title"> Datos de <?php echo $n_usuario; ?></h3>
                                <p class="text-center">A continuación encontraras los datos de tu perfil</p>
                                <div class="">
                                    <div id="">
                                        <table class="bigtables table  table-striped table-hover text-dark">
                                            <tbody>
                                                <tr>
                                                    <th scope="col">Correo:</th>
                                                    <td scope="col"><?php echo $usuario; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cédula</th>
                                                    <td scope="col"><?php echo $identificacion; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nombre:</th>
                                                    <td><?php echo $n_usuario; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Rol</th>
                                                    <td><?php echo $rol; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Id de la zona</th>
                                                    <td><?php echo $zona; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Registrado desde:</th>
                                                    <td>29 May 15:38</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>