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
    <link rel="stylesheet" href="../css/activos.css">

    <title>Document</title>
</head>

<body style="background-image: url(../complemento/imagen/fondoweb.jpg);">

    <?php 
    include('header.php'); 
    ?>

    <?php 
        if (isset($_GET['error_msg'])) {
            $error_msg = $_GET['error_msg'];
            echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
        }

        // Mostrar el mensaje de éxito
        if (isset($_GET['success_msg'])) {
            $success_msg = $_GET['success_msg'];
            echo '<div class="alert alert-success" role="alert">' . $success_msg . '</div>';
        }
    ?>

    <br>    
    <div class="container">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <nav class="navbar navsep navbar-expand-sm navbar-rednav bg-rednav rounded">
            <div class="container-fluid">
                <div class="navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <i>
                                <a class="nav-item nav-link bi bi-plus-square-dotted" href="pantallas/crear_usuarios.php"> Nueva Usuario</a>
                            </i>
                        </li>
                    </ul>
                    <form class="d-flex">


                        <input placeholder="Busca el usuario acá" onchange="this.form.requestSubmit()" type="text"
                            name="query_text" id="query_text">
                        <button class="btn btn-secondary" type="button">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-8">
                <center>
                    <div class="tzona">
                        <h3>USUARIOS</h3>
                    </div>
                </center>
                <div id="zones">
                </div>
                <table class="bigtables table  table-striped table-hover ">
                    <tbody>
                        <tr class="text-dark">
                            <th>IDENTIFICACION</th>
                            <th>NOMBRE</th>
                            <th>CORREO</th>
                            <th>ROL</th>
                            <th>ZONA</th>
                            <th>ACCIONES</th>
                        </tr>
                        <?php 
                            $sql="SELECT us.identificacion, us.nombre_usuario, us.usuario, r.nom_rol AS nombre_rol,
                            zn.nombre_zona AS nombre_zona
                            from usuarios us
                            LEFT JOIN rol r ON us.rol = r.idroles
                            LEFT JOIN zona zn ON us.fk_idzona = zn.idzona";
                            $result=mysqli_query($conexion,$sql);
                            while($mostrar=mysqli_fetch_array($result)){
                            ?>
                        <tr>
                            <td><?php echo $mostrar['identificacion']?></td>
                            <td><?php echo $mostrar['nombre_usuario']?></td>
                            <td><?php echo $mostrar['usuario']?></td>
                            <td><?php echo $mostrar['nombre_rol']?></td>
                            <td><?php echo $mostrar['nombre_zona']?></td>
                            <td>
                                <i class="separar">
                                    <form class="button_to" method="post" action=""><input type="hidden" name="_method"
                                            value="delete" autocomplete="off"><button class="bi bi-trash  text-dark btn"
                                            data-turbo-confirm="Estás seguro?" type="submit"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg></button><input type="hidden" name="authenticity_token"
                                            value="M4R3-guNhkMZXdAi4oYx16iTq3_MXZ-KTFxZ0ecU7CvtMNRFJ3Lc8gRze_Gy3zZTwWaRIRGgIv8eOflpIS_i6w"
                                            autocomplete="off"></form>
                                    <a title="Editar" class=" bi bi-pencil-fill  text-dark btn" href=""><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg></a>
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