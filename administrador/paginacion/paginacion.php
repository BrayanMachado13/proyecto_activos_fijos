<?php
    // Número máximo de botones de paginación a mostrar a la vez
    $maxButtonsToShow = 3;

    // Calcula el número total de páginas
    $totalPages = ceil($totalResults / $resultsPerPage);

    // Obtiene la página actual de la URL
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calcula el rango de botones de paginación a mostrar
    $startPage = max(1, $page - floor($maxButtonsToShow / 2));
    $endPage = min($totalPages, $startPage + $maxButtonsToShow - 1);

                // Ajusta el inicio si estás cerca del final
    $diff = $maxButtonsToShow - ($endPage - $startPage + 1);
    if ($diff > 0) {
        $startPage = max(1, $startPage - $diff);
    }

    // Imprime los botones de paginación
    echo '<ul class="pagination justify-content-center mt-2" >';
     if ($page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?search=' . $search . '&page=' . ($page - 1) . '">Anterior</a></li>';
    }
    for ($i = $startPage; $i <= $endPage; $i++) {
        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?search=' . $search . '&page=' . $i . '">' . $i . '</a></li>';
    }
    if ($page < $totalPages) {
        echo '<li class="page-item"><a class="page-link" href="?search=' . $search . '&page=' . ($page + 1) . '">Siguiente</a></li>';
    }
    echo '</ul>';
?>