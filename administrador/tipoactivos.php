<?php
include_once "usuarios/nombre_usuarios.php";
include_once "../database/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body style="background-image: url(../complemento/imagen/fondoweb.jpg);">

    <?php 
    include('header.php'); 
    ?>

    <div class="container">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <nav class="navbar navsep navbar-expand-sm navbar-rednav bg-rednav rounded">
            <div class="container-fluid">
                <div class="navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <i>
                                <a class="nav-item nav-link bi bi-plus-square-dotted" href="pantallas/crear_tipoactivo.php" style="font-size: 18px;">Nuevo tipo de activo</a>
                            </i>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row" >
            <div class="col-md-8">
                    <div class="tzona">
                        <h3>TIPOS DE ACTIVOS</h3>
                    </div>
                <div id="zones">
                </div>
                <table class="bigtables table  table-striped table-hover">
                    <tbody>
                        <tr class="text-dark">
                            <th>CÓDIGO</th>
                            <th>DESCRIPCION</th>
                            <th>ACCIONES</th>
                        </tr>
                        <?php
                        $sql = "SELECT * from tipoactivos";
                        $result = mysqli_query($conexion, $sql);
                        while ($mostrar = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $mostrar['idtipoactivos'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['nombre_tipoactivos'] ?>
                                </td>
                                <td>
                                    <i class="separar">
                                        <form class="button_to" method="post" action=""><input type="hidden" name="_method"
                                                value="delete" autocomplete="off"><button class="bi bi-trash  text-dark btn"
                                                data-turbo-confirm="Estás seguro?" type="submit"></button><input type="hidden" name="authenticity_token"
                                                value="M4R3-guNhkMZXdAi4oYx16iTq3_MXZ-KTFxZ0ecU7CvtMNRFJ3Lc8gRze_Gy3zZTwWaRIRGgIv8eOflpIS_i6w"
                                                autocomplete="off"></form>
                                        <a title="Editar" class=" bi bi-pencil-fill  text-dark btn" href=""></a>
                                    </i>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>