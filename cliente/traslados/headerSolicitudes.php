<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>
    <nav class=" sep navbar navbar-expand-sm bg-rednav navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="principal_regular.php">
                <img class="" width="50px" src="../../complemento/imagen/logorecord.png">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
                aria-expanded="true">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse show" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            style="font-size: 20px; color: aliceblue;">Opciones</a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item text-dark " href="../viewPerfilRegular.php">Mi perfil</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark" href="mis_activos.php">Mis activos</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark" href="solicitudes.php">Hacer
                                    solicitudes</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark" href="activos_recibidos.php">Recibir
                                    activos</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                        style="font-size: 20px; color: aliceblue;">
                        <?php echo $n_usuario; ?> <?php echo $apellidos; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item text-dark " href="viewPerfilRegular.php">Perfil</a>
                        <a class="dropdown-item text-dark " href="../../cerrar_sesion.php">cerrar sesion</a>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</body>

</html>