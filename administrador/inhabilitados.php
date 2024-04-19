<?php
include_once "usuarios/nombre_usuarios.php";
include_once "../database/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pestañas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/activos.css">
</head>

<body>

    <?php 
    include('header.php'); 
    ?>

    <br><br>

    <div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">PAISES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">DEPARTAMENTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">CIUDADES</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Contenido de la pestaña "PAISES" -->
                <?php include('inhabilitados/inhabilitadoPais.php'); ?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Contenido de la pestaña "DEPARTAMENTOS" -->
                <?php include('inhabilitados/inhabilitadoDepartamento.php'); ?>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <!-- Contenido de la pestaña "CIUDADES" -->
                <?php include('inhabilitados/inhabilitadoCiudad.php'); ?>
            </div>
        </div>
    </div>

    <script>
    // Restaurar la pestaña activa desde el almacenamiento local
    $(document).ready(function() {
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }

        // Almacenar la pestaña activa al cambiar de pestaña
        $('#myTab a').on('click', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
    });
    </script>
</body>

</html>