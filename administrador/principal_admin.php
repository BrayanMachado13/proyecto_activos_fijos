<?php
include_once "usuarios/nombre_usuarios.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Document</title>
</head>

<body style="height: 100%;
    margin: 0;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    background-color: var(--bs-body-bg);
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    background-image: url(../complemento/imagen/fondoweb.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;">

    <?php 
    include('header.php'); 
    ?>

    <style>
    .container-1 {
        display: flex;
        justify-content: space-evenly;
        width: 80%;
        margin: 20px auto;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .bg-rednav {
        --bs-bg-opacity: 1;
        background: linear-gradient(to right top, rgb(49 97 125), rgb(0, 161, 245));
    }

    .box {
        margin: 10px;
        padding: 40px;
        border: 1px solid;
        border-radius: 5px;
        background:
    }


    .container-2 {
        display: flex;
        justify-content: space-evenly;
        width: 80%;
        margin: auto;

        border-radius: 5px;
    }

    .box {
        display: column;
        margin: 10px;
        padding: 40px;
        border: 1px solid;
        border-radius: 5px;
    }

    .leyenda {
        text-align: center;
    }
    </style>
    <div class="container-1">
        <div class="row">
            <div class="col-md-6">
                <a class="text-dark fw-bold" href="viewPerfil.php">
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
</htm>