<?php 
                        
    include_once "../database/db.php";

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM ciudad";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE nombre_ciudad LIKE '%$search%'";
    }

    $totalResultQuery = ejecutarConsulta($conexion, $totalResultsSql);
    $totalResultRow = mysqli_fetch_assoc($totalResultQuery);
    $totalResults = $totalResultRow['total'];
                        
    // Función para ejecutar una consulta SQL y obtener los resultados
  
                        
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
    $sql = "SELECT ci.id, ci.nombre_ciudad AS nombre_ciudad, dp.nombre_departamento AS nombre_departamento, es.nombre AS nombre_estado 
    FROM ciudad ci
    LEFT JOIN departamento dp ON ci.id_departamento = dp.id
    LEFT JOIN estado es ON ci.estado = es.id
    WHERE ci.estado = 2 ";
                        
    if (!empty($search)) {
        $sql .= " AND nombre_ciudad LIKE '%$search%'";
    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= " LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsulta($conexion, $sql);
?>