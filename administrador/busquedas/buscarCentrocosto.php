<?php 
                        
    include_once '../database/db.php';

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM centrocosto";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE nombre_centrocosto LIKE '%$search%'";
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
    $sql = "SELECT cc.idcentrocosto, cc.nombre_centrocosto, cc.fk_idzona, pa.nombre_pais AS nombre_pais, dp.nombre_departamento AS nombre_departamento, ci.nombre_ciudad AS nombre_ciudad
        FROM centrocosto cc
        LEFT JOIN pais pa ON cc.fk_pais = pa.id
        LEFT JOIN departamento dp ON cc.fk_departamento = dp.id
        LEFT JOIN ciudad ci ON cc.fk_ciudad = ci.id";
                        
    if (!empty($search)) {
        $sql .= " WHERE cc.nombre_centrocosto LIKE '%$search%'";
    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= " LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsulta($conexion, $sql);
    ?>