<?php
include_once "usuarios/nombre_usuarios.php";
include_once "../database/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
    </link>
    <link rel="stylesheet" href="../css/activos.css">
    <title>Document</title>
    <script>
    function exportarPDF() {
        // Obtener los datos de la tabla
        let table = document.getElementById('tabla-datos');
        let data = [];
        for (let i = 1; i < table.rows.length; i++) {
            let rowData = [];
            for (let j = 0; j < table.rows[i].cells.length; j++) {
                rowData.push(table.rows[i].cells[j].innerText);
            }
            data.push(rowData);
        }

        // Enviar los datos al servidor
        fetch('pdf/PDFActivos.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.blob())
            .then(blob => {
                // Crear una nueva ventana o pestaña con el PDF visualizado
                let pdfUrl = URL.createObjectURL(blob);
                window.open(pdfUrl, '_blank');
            });
    }
    </script>
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
    <!--Se agrega personalizacion con boostrap para visualizacion de las vistas de zonas -->
    <div class="container">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <nav class="navbar navsep navbar-expand-sm navbar-rednav bg-rednav rounded">
            <div class="container-fluid">
                <div class="navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <i>
                                <a class="nav-item nav-link bi bi-plus-square-dotted"
                                    href="pantallas/crear_activos.php"> Nueva activo</a>
                            </i>
                        </li>
                    </ul>
                    <form class="d-flex">

                        <input placeholder="Busca el activo" onchange="this.form.requestSubmit()" type="text"
                            name="search" id="search">
                        <button class="btn btn-secondary" type="button">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="row ">
            <div class="col-md-8">
                <div class="tzona">
                    <h3>ACTIVOS</h3>
                </div>
                <div>
                    <a class="btn third" href="#" onclick="exportarPDF()">Exportar PDF</a>
                    <a class="btn third" href="" onclick="generarPDF()">exportar Excel</a>
                    <a class="btn third" href="activosfijos.php">RESET FILTRO</a>
                </div>
                <div class="form-group">
                    <form class="d-flex" action="" accept-charset="UTF-8" method="get">
                        <div id="actives">
                            <div class="container">
                            </div>
                        </div>
                        <table class="bigtables table  table-striped table-hover" id="tabla-datos">
                            <tbody>
                                <tr class="text-dark">
                                    <th scope="col">PLACA DE ACTIVO</th>
                                    <th scope="col">C. DE COSTO</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">RESPONSABLE</th>
                                    <th scope="col">ESTADO</th>
                                    <th scope="col">ACCIONES</th>
                                </tr>
                                <?php 
                                include_once 'busquedas/buscarActivos.php';
                                ?>

                                <?php 
                                while ($mostrar = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo isset($mostrar['activo_fijo']) ? $mostrar['activo_fijo'] : ''; ?>
                                    </td>
                                    <td>
                                        <?php echo isset($mostrar['nombre_centrocosto']) ? $mostrar['nombre_centrocosto'] : ''; ?>
                                    </td>
                                    <td>
                                        <?php echo isset($mostrar['nombre_producto']) ? $mostrar['nombre_producto'] : ''; ?>
                                    </td>
                                    <td>
                                        <?php echo isset($mostrar['nombre_usuario']) ? $mostrar['nombre_usuario'] : ''; ?>
                                    </td>
                                    <td>
                                        <?php echo isset($mostrar['nombre_estado']) ? $mostrar['nombre_estado'] : ''; ?>
                                    </td>
                                    <td>
                                        <i class="separar">

                                            <a class="bi bi-eye-fill text-dark btn" href="visualizacion/visualizarActivo.php?id=<?php echo $mostrar['activo_fijo']?>"></a>
                                            <form class="button_to" method="post" action=""><input type="hidden"
                                                    name="_method" value="patch" autocomplete="off"><button
                                                    title="Dar de baja" class="text-dark bi bi-arrow-down btn"
                                                    type="submit"></button><input type="hidden"
                                                    name="authenticity_token"
                                                    value="wDGal4aJPjOixBl8j04X6cjmh2U8l03LfHztt-LWDYbxFTL-H1N63WJyppESOy0ycypOMrAygBngrypRzXZnpA"
                                                    autocomplete="off"></form>
                                            <a title="Editar" class=" bi bi-pencil-fill text-dark btn"
                                                href="modificar/modificarActivos.php?id=<?php echo isset($mostrar['activo_fijo'])?>"></a>
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

            <nav aria-label="...">
                <ul class="pagination justify-content-center mt-2">
                    <li class="page-item disabled">
                        <span class="page-link text-dark">Anterior</span>
                    </li>

                    <li class="page-item text-dark bg-rednav text-white">
                        <span class="page-link text-dark bg-rednav text-white">1</span>
                    </li>

                    <li class="page-item disabled text-dark">
                        <span class="page-link text-dark">Siguiente</span>
                    </li>
                </ul>
            </nav>
        </div>
</body>

</html>