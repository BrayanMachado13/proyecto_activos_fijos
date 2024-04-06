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

<body style="background-image: url(../../complemento/imagen/fondoweb.jpg);">


    <?php 
    include('header_pantallas.php'); 
    ?>



    <div class="container tam-card-personal">
        <div class="row">
            <div class="col md-8" style="flex: 1 0 0%;">
                <div class="bg-card-personal card  text-white">
                    <div class="card-body ">
                        <h2 class="card-title"></h2>
                        <div class="row">
                            <div class="col text-dark">
                                <h3 class="card-title "> DATOS DEL ACTIVO</h3>
                                <p class="text-center"></p>
                                <div class="container">

                                    N° #28116
                                    <table class="bigtables table  table-striped table-hover text-dark">
                                        <tbody>
                                            <tr class="">
                                                <th>SERIAL</th>
                                                <td>2173902003778</td>
                                            </tr>
                                            <tr>
                                                <th>PLACA</th>
                                                <td>22496</td>
                                            </tr>
                                            <tr>

                                                <th> ACTIVO FIJO ASOCIADO </th>
                                                <td>No aplica</td>
                                            </tr>
                                            <tr>
                                                <th>Inventarios Asociados</th>

                                            </tr>
                                            <tr>
                                                <th>TIPO DE ACTIVO</th>
                                                <td>
                                                    EQUIPO DE COMPUTACIÓN Y COMUNICACIÓN</td>
                                            </tr>
                                            <tr>
                                                <th>NOMBRE DEL ACTIVO</th>
                                                <td>SWITCH</td>
                                            </tr>
                                            <tr>
                                                <th>CÉDULA DEL RESPONSABLE</th>
                                                <td>1064999641</td>
                                            </tr>
                                            <tr>
                                                <th>NOMBRE DEL RESPONSABLE</th>
                                                <td>
                                                    JORGE NUÑEZ</td>
                                            </tr>
                                            <tr>
                                                <th>ESTADO</th>
                                                <td>true</td>
                                            </tr>
                                            <tr>
                                                <th>JERARQUIA</th>
                                                <td>
                                                    ACTIVO FIJO</td>
                                            </tr>
                                            <tr>
                                                <th>DESTINOS</th>
                                                <td>
                                                    EDIFICIO RECORD LORICA</td>
                                            </tr>
                                            <tr>
                                                <th>UBICACIÓN</th>
                                                <td>
                                                    BODEGA LORICA</td>
                                            </tr>
                                            <tr>
                                                <th>NIT PROVEEDOR</th>
                                                <td>
                                                    812005807</td>
                                            </tr>
                                            <tr>
                                                <th>NOMBRE PROVEEDOR</th>
                                                <td>
                                                    GL COMPUTADORES</td>
                                            </tr>
                                            <tr>
                                                <th>PRECIO</th>
                                                <td> 45.000,00 COP
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Fecha Compra</th>
                                                <td> 03/08/2017</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p></p>
                                <ul class="separar d-flex">
                                    <li>
                                        <form class="button_to" method="post" action="/actives/28116"><input
                                                type="hidden" name="_method" value="delete" autocomplete="off"><button
                                                title="Eliminar" class="bi bi-trash btn" type="submit"></button><input
                                                type="hidden" name="authenticity_token"
                                                value="cg4xduwMLAhC6mHzMklNskSto8UqwrxgyniDcOYqnfZ7aJrg38pSMtBrhAe-YeIyRAdUTE9sMyvFS8yPEgBBkA"
                                                autocomplete="off"></form>
                                    </li>
                                    <li><a title="Editar" class=" bi bi-pencil-fill btn" href="/actives/28116/edit"></a>
                                    </li>
                                    <li>
                                    </li>
                                    <li><a title="atras" class=" bi bi-skip-backward-btn-fill btn" href="/actives">ir a
                                            kardex</a></li>
                                    <li><button onclick="window.history.back()"
                                            class="bi bi-skip-backward-btn-fill text-dark btn">Regresar</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>