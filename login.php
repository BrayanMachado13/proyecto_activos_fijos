<?php
    include_once 'validarParaqueElUsuarioNoVuelvaAlLogin/validarParaqueElUsuarioNoVuelvaAlLogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<style>
.container {
    max-width: 1080px;
}

.row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--bs-gutter-y));
    margin-right: calc(-0.5 * var(--bs-gutter-x));
    margin-left: calc(-0.5 * var(--bs-gutter-x));
}

.col {
    flex: 1 0 0%;
}

.bg-card-personal {
    background: rgb(34, 193, 195);
    background: linear-gradient(0deg, rgba(34, 193, 195, 0.3) 0%, rgba(45, 115, 253, 0.1) 100%);
}

.card-body {
    flex: 1 1 auto;
    padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
    color: var(--bs-card-color);
}

.card-title {
    margin-bottom: var(--bs-card-title-spacer-y);
    text-align: center;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.centrarcard {
    text-align: center;
    justify-content: space-around;
}

*,
*::before,
*::after {
    box-sizing: border-box;
}

div {
    display: block;
}

.third {
    border-color: #3498db;
    color: #fff;
    box-shadow: 0 0 40px 40px #3498db inset, 0 0 0 0 #3498db;
    -webkit-transition: all 150ms ease-in-out;
    transition: all 150ms ease-in-out;
}

.boton {
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    border: 2px solid #3498db;
    border-radius: 0.6em;
    color: #fff;
    cursor: pointer;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-self: center;
    -ms-flex-item-align: center;
    align-self: center;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1;
    margin: 20px;
    padding: 1.2em 2.8em;
    text-decoration: none;
    text-align: center;
    text-transform: uppercase;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
}

.py-3 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.my-4 {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important;
}

footer {
    width: 100%;
    bottom: 0;
    text-align: center;
}

.pb-3 {
    padding-bottom: 1rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.justify-content-center {
    justify-content: center !important;
}

.border-bottom {
    border-bottom: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
}

.fzona {
    border-radius: 0 0 5px 5px;
    text-align: center;
    font-size: 30px;
    font-family: 'Dancing Script', cursive;
}

img, svg {
    vertical-align: middle;
}
</style>

<body style=" height: 100%;
    margin: 0;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    background-color: var(--bs-body-bg);
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    background-image: url(complemento/imagen/fondoweb.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;">
    
    <?php 
        if (isset($_GET['error_msg'])) {
            $error_msg = $_GET['error_msg'];
            echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
        }
      ?>
      <br><br><br>
    <div class="container w-60">
        <div class="row container fluid">
            <div class="col container">
                <div class="bg-card-personal card  text-white container">
                    <div class="card-body container">
                        <h2 class="card-title container"></h2>
                        <div class="row">
                            <div class="col text-dark container">

                                <h3 class="card-title "> INICIAR SESIÓN</h3>
                                <p class="text-center">A continuación digita los datos para iniciar sesión.</p>

                                <div class=" bg-card-personal container">
                                    <div class="col container">

                                        <form action="validar.php" method="POST">
                                            <label class="form-label fw-bolder text-start" for="correo">Correo
                                                electrónico</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-card-personal">
                                                    <i class="bi bi-person-fill bg-card-personal fa-solid fa-envelope"></i>
                                                </span>
                                                <input autofocus="autofocus" autocomplete="email"
                                                    placeholder="Correo electrónico"
                                                    class="form-control border border-info rounded-2" type="email"
                                                    value="" name="correo" id="correo">
                                            </div>
                                            <label class="form-label fw-bolder mt-2" for="password">Contraseña</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-card-personal">
                                                    <i class="bi bi-key-fill bg-card-personal fa-solid fa-key"></i>
                                                </span>
                                                <input autocomplete="current-password" placeholder="Contraseña"
                                                    class="form-control border border-info rounded-2" type="text"
                                                    name="password" id="password">
                                            </div>

                                            <div class="centrarcard mt-2">
                                                <input name="user[remember_me]" type="hidden" value="0"
                                                    autocomplete="off"><input
                                                    class=" bg-card-personal border border-info rounded-2"
                                                    type="checkbox" value="1" name="user[remember_me]"
                                                    id="user_remember_me">
                                                <label class="form-label fw-bolder mt-2"
                                                    for="user_¿quieres que te recuerde">¿quieres que te
                                                    recuerde?</label>
                                            </div>

                                            <div class="d-flex" style="justify-content: center">
                                                <input type="submit" name="commit" value="Iniciar Sesión"
                                                    class=" boton third " data-turbo-false="true"
                                                    data-disable-with="Iniciar Sesión">
                                            </div>
                                        </form>
                                        <a class="d-flex justify-content-center" href="/users/password/new">Olvidaste la
                                            contraseña?</a><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
              <li class="nav-item fzona"></li>
            </ul>
            <p class="text-center text-muted">    
                    Todos los derechos reservados <br>
                    </p><p class="text-dark" style="font-size: 50%"></p>
                    <img class="" width="150px" src="complemento/imagen/logorecord.png">
            <p></p>
        </footer>
</body>

</html>