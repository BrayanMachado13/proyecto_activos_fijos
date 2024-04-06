<?php
    include_once "usuarios/nombre_usuarios.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/regulares.css">
    <title>Document</title>
</head>

<body style="background-image: url(../complemento/imagen/fondoweb.jpg);">

    <?php 
    include('headerRegular.php'); 
    ?>

    <br>
    <div class="container-1">
        <div class="row">
            <div class="col-md-6">
                <a class="text-dark fw-bold" href="viewPerfilRegular.php">
                    <div class="box fourth text-center">
                        <img style="width: 150px" src="../complemento/imagen/perfil.png">
                        <div class="leyenda">
                            <label>Mi perfil</label>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a class="text-dark fw-bold" href="traslados/mis_activos.php">
                    <div class="box fourth text-center">
                        <img style="width: 150px" src="../complemento/imagen/misactivos.png">
                        <div class="leyenda">
                            <label>Mis activos</label>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-2">
        <div class="row">
            <div class="col-md-6">
                <a class="text-dark fw-bold" href="traslados/solicitudes.php">
                    <div class="box fourth text-center">
                        <img style="width: 150px" src="../complemento/imagen/hacertraslado.png">
                        <div class="leyenda">
                            <label>Hacer una solicitud</label>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a class="text-dark fw-bold" href="traslados/activos_recibidos.php">
                    <div class="box fourth text-center">
                        <img style="width: 150px" src="../complemento/imagen/mispendientes.png">
                        <div class="leyenda">
                            <label>Mis pendientes</label>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>