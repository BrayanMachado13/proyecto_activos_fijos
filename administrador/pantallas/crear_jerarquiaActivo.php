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

<body style="background-image: url(../recursos/fondoweb.jpg);">

    <?php 
    include('../header2.php'); 
    ?>
    <center>
        <div class="container tam-card-personal" style="height: 70%;width: 70%;">
            <div class="row">
                <div class="col md-8">
                    <div class="bg-card-personal card  text-white"
                        style="background: linear-gradient(0deg, rgb(7 22 22 / 30%) 0%, rgba(45,115,253,0.1) 100%); width: 50%;">
                        <div class="card-body ">
                            <h2 class="card-title"></h2>
                            <div class="row">
                                <div class="col text-dark">
                                    <h3 class="card-title " style="text-align: center;"> REGISTRAR NUEVA JERARQUIA</h3>
                                    <p class="text-center">A continuación digita los datos la jerarquia</p>
                                    <div class="centrarcard">
                                        <form action="../php/keepJerarquiaActivo.php" method="post">
                                            <div class="mb-3">
                                                <label for="jerarquiaactivo" class="form-label">ID JERARQUIA
                                                    ACTIVO</label>
                                                <input type="text" class="form-control" id="jerarquiaactivo"
                                                    name="jerarquiaactivo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="decripcionjerarquia" class="form-label">DESCRIPCION</label>
                                                <input type="text" class="form-control" id="decripcionjerarquia"
                                                    name="decripcionjerarquia">
                                            </div>
                                            <button type="submit"
                                                class="bi bi-database-fill-add text-dark btn"></button>
                                            <a class="bi bi-skip-backward-btn-fill text-dark btn"
                                                title="Retornar a los tipos de activo"
                                                href="../jerarquiaActivo.php"></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
</body>

</html>