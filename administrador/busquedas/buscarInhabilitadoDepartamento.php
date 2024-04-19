<?php 
                        
    include_once "../database/db.php";

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM departamento";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE nombre_departamento LIKE '%$search%'";
    }

    $totalResultQuery = ejecutarConsulta($conexion, $totalResultsSql);
    $totalResultRow = mysqli_fetch_assoc($totalResultQuery);
    $totalResults = $totalResultRow['total'];
                        
    // Función para ejecutar una consulta SQL y obtener los resultados
    function ejecutarConsulta($conexion, $sql) {
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
    $sql = "SELECT dp.id, dp.nombre_departamento, es.nombre AS estado, pa.nombre_pais AS nombre_pais
    FROM departamento dp
    LEFT JOIN estado es ON dp.estado = es.id
    LEFT JOIN pais pa ON dp.id_pais = pa.id 
    WHERE dp.estado = 2 ";
                        
    if (!empty($search)) {
        $sql .= " AND nombre_departamento LIKE '%$search%'";
    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= "LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsulta($conexion, $sql);
?>