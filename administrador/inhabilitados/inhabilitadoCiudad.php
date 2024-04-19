<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">


    <title>Document</title>
</head>

<body>

    <br><br>
    <div class="container">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <nav class="navbar navsep navbar-expand-sm navbar-rednav bg-rednav rounded">
            <div class="container-fluid">
                <div class="navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <i>
                                <a class="nav-item nav-link bi bi-plus-square-dotted" href="">
                                </a>
                            </i>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input placeholder="Busca la ciudad acá" onchange="this.form.requestSubmit()" type="text"
                            name="search" id="qsearch">
                        <button class="btn btn-secondary" type="button">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-8">
                <center>
                    <div class="tzona">
                        <h3>CIUDADES</h3>
                    </div>
                </center>
                <div id="pais">
                </div>
                <table class="bigtables table  table-striped table-hover ">
                    <tbody>
                        <tr class="text-dark">
                            <th>CÓDIGO</th>
                            <th>NOMBRE</th>
                            <th>DEPARTAMENTO</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>

                        <?php 
                        include_once 'busquedas/buscarInhabilitadoCiudad.php';
                        ?>

                        <?php 
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $mostrar['id']?></td>
                            <td><?php echo $mostrar['nombre_ciudad']?></td>
                            <td><?php echo $mostrar['nombre_departamento']?></td>
                            <td><?php echo $mostrar['nombre_estado']?></td>
                            <td>
                                <i class="separar">
                                    <a title="Editar" class=" bi bi-pencil-fill  text-dark btn" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </a>
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
    <nav aria-label="...">
        <ul class="pagination justify-content-center mt-2">
            <?php 
            include_once 'paginacion/paginacion.php';
        ?>
        </ul>
    </nav>
</body>

</html>