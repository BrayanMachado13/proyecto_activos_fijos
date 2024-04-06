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

<body>

    <?php 
    include('header.php'); 
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
                                <a class="nav-item nav-link bi bi-plus-square-dotted" href="/soliciteds/new"> Nueva
                                    Solicitud</a>
                            </i>
                        </li>
                    </ul>
                    <form class="d-flex">


                        <input placeholder="Busca la solicitud acá" onchange="this.form.requestSubmit()" type="text"
                            name="query_text" id="query_text">
                        <button class="btn btn-secondary" type="button">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>


        <div class="row">
            <div class="col-md-8">
                <div class="tzona">
                    <h3>SOLICITUDES DE TRASLADOS</h3>
                </div>
                <div id="soliciteds">
                </div>
                <table class="bigtables table  table-striped table-hover ">
                    <tbody>
                        <tr class="text-dark">
                            <th scope="col">ID</th>
                            <th scope="col">SOLICITANTE</th>
                            <th scope="col">DESTINATARIO</th>
                            <th scope="col">C. COSTO</th>
                            <th scope="col">NUEVO DESTINO</th>
                            <th scope="col">NUEVA UBICACIÓN</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                        <tr>
                            <td>
                                110
                            </td>
                            <td>
                                YADY LUZ GARCIA
                            </td>
                            <td>
                                EMIRO DAVID RODRIGUEZ PERZ
                            </td>
                            <td>
                                DORADO
                            </td>
                            <td>
                                S77 PILOTO DORADO
                            </td>
                            <td>
                                S77 PILOTO DORADO
                            </td>

                            <td>
                                <i class="separar">
                                    <a class="bi bi-eye-fill text-dark btn" href="/soliciteds/110"></a>
                                    <form class="button_to" method="post" action="/soliciteds/110"><input type="hidden"
                                            name="_method" value="delete" autocomplete="off"><button
                                            class="bi bi-trash  text-dark btn" data-turbo-confirm="Estás seguro?"
                                            type="submit"></button><input type="hidden" name="authenticity_token"
                                            value="6FxIRY4lovc1Px_4lHKuC63pYK2kWeUyKfyqsbDSCD_u90XaSjZaYZx4H890rgsFcYwmzasWeYij4jisZsQqgA"
                                            autocomplete="off"></form>
                                    <a title="Editar" class=" bi bi-pencil-fill  text-dark btn"
                                        href="/soliciteds/110/edit"></a>
                                </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav aria-label="...">
                    <ul class="pagination justify-content-center mt-2">
                        <li class="page-item disabled">
                            <span class="page-link text-dark">Anterior</span>
                        </li>

                        <li class="page-item text-dark bg-rednav text-white">
                            <span class="page-link text-dark bg-rednav text-white">1</span>
                        </li>
                        <li class="page-item text-dark">
                            <a class="page-link text-dark" href="/soliciteds?page=2">2</a>
                        </li>
                        <li class="page-item text-dark">
                            <a class="page-link text-dark" href="/soliciteds?page=3">3</a>
                        </li>
                        <li class="page-item text-dark">
                            <a class="page-link text-dark" href="/soliciteds?page=4">4</a>
                        </li>
                        <li class="page-item text-dark">
                            <a class="page-link text-dark" href="/soliciteds?page=5">5</a>
                        </li>
                        <li class="page-item text-dark bg-rednav text-white">
                            <span class="page-link text-dark bg-rednav text-white">gap</span>
                        </li>
                        <li class="page-item text-dark">
                            <a class="page-link text-dark" href="/soliciteds?page=1568">1568</a>
                        </li>

                        <li class="page-item text-dark">
                            <a class="page-link text-dark" href="/soliciteds?page=2">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>