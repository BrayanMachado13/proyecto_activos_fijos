<?php 
                        
    include_once "../database/db.php";                   

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM destino";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE nombre_destino LIKE '%$search%'";
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
    $sql = "SELECT ds.desti_id, ds.nombre_destino, cc.nombre_centrocosto AS nombre_centrocosto,
    pa.nombre_pais AS nombre_pais,
    dp.nombre_departamento AS nombre_departamento,
    ci.nombre_ciudad AS nombre_ciudad 
    FROM destino ds
    LEFT JOIN centrocosto cc ON ds.fk_idcentrocosto = cc.idcentrocosto
    LEFT JOIN pais pa ON ds.fk_pais = pa.id
    LEFT JOIN departamento dp ON ds.fk_departamento = dp.id
    LEFT JOIN ciudad ci ON ds.fk_ciudad = ci.id";
                        
    if (!empty($search)) {
        $sql .= " WHERE nombre_destino LIKE '%$search%'";
    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= " LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsulta($conexion, $sql);
?>