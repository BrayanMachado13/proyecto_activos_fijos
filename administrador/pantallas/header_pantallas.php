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


    <nav class=" sep navbar navbar-expand-sm bg-rednav navbar" style="">
        <div class="container-fluid">
            <a class="navbar-brand" href="../principal_admin.php">
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
                            style="font-size: 20px; color: aliceblue;">Administrador</a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item text-dark " href="../pais.php">Ir a Paises</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../departamentos.php">Ir a Departamentos</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../ciudad.php">Ir a Ciudades</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../zonas.php">Ir a Zonas</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../centroCosto.php">Ir a Centros de Costo</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../destinos.php">Ir a Destinos</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../ubicacion.php">Ir a Ubicaciones</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark" href="">Ir a De baja</a>
                            </li>
                            <a class="dropdown-item text-dark" href="../activosfijos.php">Ir a Activos</a>
                            <li>
                                <a class="dropdown-item text-dark " href="../tipoactivos.php">Ir a Tipos de Activo</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../jerarquiaActivo.php">Ir a jerarquias
                                    Activo</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../usuarios.php">Ir a Usuarios</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../solicitudes_traslados.php">Ir a
                                    Solicitudes</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../asignaciones_de_activos.php">Ir a
                                    Asignacion de Activos</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../roles.php">Ir a Roles</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="">Ir a Estados de traslado</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../provedor.php">Ir a proveedores</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark " href="../marcas.php">Ir a Marcas</a>
                            </li>
                        </ul>

                    </li>
                </ul>
                <div class="navbar-collapse collapse show" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                style="font-size: 20px; color: aliceblue;">Opciones</a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item text-dark " href="../viewPerfil.php">Mi perfil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-dark" href="../traslados/mis_activos.php">Mis
                                        activos</a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-dark" href="../traslados/solicitudes.php">Hacer
                                        solicitudes</a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-dark" href="../traslados/activos_recibidos.php">Recibir
                                        activos</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                        style="font-size: 20px; color: aliceblue;">
                        <?php echo $n_usuario; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item text-dark " href="viewPerfil.php">Perfil</a>
                        <a class="dropdown-item text-dark " href="../../cerrar_sesion.php">cerrar sesion</a>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</body>

</html>