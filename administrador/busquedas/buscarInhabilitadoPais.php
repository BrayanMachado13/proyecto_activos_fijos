<?php 
                        
    include_once "../database/db.php";

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM pais";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE nombre_pais LIKE '%$search%'";
    }

    $totalResultQuery = ejecutarConsultas($conexion, $totalResultsSql);
    $totalResultRow = mysqli_fetch_assoc($totalResultQuery);
    $totalResults = $totalResultRow['total'];
                        
    // Función para ejecutar una consulta SQL y obtener los resultados
    function ejecutarConsultas($conexion, $sql) {
        $result = $conexion->query($sql);
        return $result;
    }
                        
    // Inicializa variables
    $search = "";
    $page = 1;
    $resultsPerPage = 10;
                        
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    }
                        
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
                        
    // Construye la consulta SQL para la búsqueda
    $sql = "SELECT pa.id, pa.nombre_pais, es.nombre AS estado
    FROM pais pa
    LEFT JOIN estado es ON pa.estado = es.id 
    where estado = 2";
                        
    if (!empty($search)) {
    $sql .= " AND nombre_pais LIKE '%$search%'";
    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= " LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsultas($conexion, $sql);
?>