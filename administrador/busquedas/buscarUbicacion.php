<?php 
                       
    include_once "../database/db.php";

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM ubicacion";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE nombre_ubicacion LIKE '%$search%'";
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
    $sql = "SELECT ub.ubica_id, ub.nombre_ubicacion, dn.nombre_destino AS nombre_destino,
    pa.nombre_pais AS nombre_pais,
    dp.nombre_departamento AS nombre_departamento,
    ci.nombre_ciudad AS nombre_ciudad 
    FROM ubicacion ub
    LEFT JOIN destino dn ON ub.fk_desti_id = dn.desti_id
    LEFT JOIN pais pa ON ub.fk_pais = pa.id
    LEFT JOIN departamento dp ON ub.fk_departamento = dp.id
    LEFT JOIN ciudad ci ON ub.fk_ciudad = ci.id";
                        
    if (!empty($search)) {
        $sql .= " WHERE nombre_ubicacion LIKE '%$search%'";
    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= " LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsulta($conexion, $sql);
?>