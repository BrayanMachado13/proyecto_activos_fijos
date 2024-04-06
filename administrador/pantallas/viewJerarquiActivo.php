<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<style>
    div{
        display:block;
    }

    .container, .container-fluid, .container-xxl, .container-xl, .container-lg, .container-md, .container-sm {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    width: 100%;
    padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);
    margin-right: auto;
    margin-left: auto;
    }

    .text-dark {
        --bs-text-opacity: 1;
        color: rgba(var(--bs-dark-rgb), var(--bs-text-opacity)) !important;
    }

    .table > tbody {
    vertical-align: inherit;
    }

    thead, tbody, tfoot, tr, td, th {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }
   
    tbody {
        display: table-row-group;
        vertical-align: middle;
        border-color: inherit;
    }

        .container-sm, .container {
        max-width: 1080px;
    }
    .container, .container-fluid, .container-xxl, .container-xl, .container-lg, .container-md, .container-sm {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        width: 100%;
        padding-right: calc(var(--bs-gutter-x) * 0.5);
        padding-left: calc(var(--bs-gutter-x) * 0.5);
        margin-right: auto;
        margin-left: auto;
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

    .separar {
    display: flex;
    justify-content: center;
    list-style: none;
    }
</style>

<body style="height: 100%;
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
    background-image: url(../recursos/fondoweb.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}">


    

    <div class="container tam-card-personal">
  <div class="row" style="--bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--bs-gutter-y));
    margin-right: calc(-0.5 * var(--bs-gutter-x));
    margin-left: calc(-0.5 * var(--bs-gutter-x));">
    <div class="col md-8" style="flex: 1 0 0%;">
    <div class="bg-card-personal card  text-white" style="background: linear-gradient(0deg, rgba(34,193,195,0.3) 0%, rgba(45,115,253,0.1) 100%);">
    <div class="card-body " style="flex: 1 1 auto;
    padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
    color: var(--bs-card-color);">
      <h2 class="card-title" style="margin-bottom: var(--bs-card-title-spacer-y);
        text-align: center;"></h2>
      <div class="row" style="--bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-0.5 * var(--bs-gutter-x));
        margin-left: calc(-0.5 * var(--bs-gutter-x));">
          <div class="col text-dark" style="--bs-text-opacity: 1;
            color: rgba(var(--bs-dark-rgb), var(--bs-text-opacity)) !important;">
            <h3 class="card-title " style="margin-bottom: var(--bs-card-title-spacer-y);
            text-align: center;"> DATOS DE LA JERARQUIA</h3>
            <p class="text-center" style="text-align: center !important;"></p>
            <div class="container">
                    <table class="bigtables table  table-striped table-hover text-dark" style="--bs-table-color: var(--bs-body-color);
                --bs-table-bg: transparent;
                --bs-table-border-color: var(--bs-border-color);
                --bs-table-accent-bg: transparent;
                --bs-table-striped-color: var(--bs-body-color);
                --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
                --bs-table-active-color: var(--bs-body-color);
                --bs-table-active-bg: rgba(0, 0, 0, 0.1);
                --bs-table-hover-color: var(--bs-body-color);
                --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
                width: 100%;
                margin-bottom: 1rem;
                color: var(--bs-table-color);
                vertical-align: top;
                border-color: var(--bs-table-border-color);
                text-align: center;">
                
                  <tbody><tr class="">
                    <th>ID</th>
                    <td>2173902003778</td>
                  </tr>
                  <tr>
                    <th>JERARQUIA</th>
                    <td>22496</td>
                  </tr>                 
                </tbody>
                </table>
                </div>
                <p></p>
                <ul class="separar d-flex">
                  <li><form class="button_to" method="post" action="/actives/28116"><input type="hidden" name="_method" value="delete" autocomplete="off"><button title="Eliminar" class="bi bi-trash btn" type="submit"></button><input type="hidden" name="authenticity_token" value="cg4xduwMLAhC6mHzMklNskSto8UqwrxgyniDcOYqnfZ7aJrg38pSMtBrhAe-YeIyRAdUTE9sMyvFS8yPEgBBkA" autocomplete="off"></form></li>
                  <li><a title="Editar" class=" bi bi-pencil-fill btn" href="/actives/28116/edit"></a></li>
                  <li>
                    </li><li><a title="atras" class=" bi bi-skip-backward-btn-fill btn" href="/actives">ir a kardex</a></li>
                    <li><button onclick="window.history.back()" class="bi bi-skip-backward-btn-fill text-dark btn">Regresar</button></li>
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