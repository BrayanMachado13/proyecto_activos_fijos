<?php 
                        
    include_once '../database/db.php';

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM activos_fijos";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE ac.num_placa_activo LIKE '%$search%'";
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
    $sql = "SELECT ac.id, ac.num_placa_activo AS activo_fijo , cc.nombre_centrocosto AS nombre_centrocosto, pr.nombre_producto AS nombre_producto,
    usu.nombre_usuario AS nombre_usuario, es.nombre AS nombre_estado 
    FROM activos_fijos ac
    LEFT JOIN centrocosto cc ON ac.fk_idcentrocosto = cc.idcentrocosto
    LEFT JOIN producto pr ON ac.nombre_producto = pr.id
    LEFT JOIN usuarios usu ON ac.fk_cedula = usu.identificacion
    LEFT JOIN estado es ON ac.estado = es.id
    
    UNION  
    
    SELECT inv.id, inv.num_placa_inventario AS activo_fijo , cc.nombre_centrocosto AS nombre_centrocosto, pr.nombre_producto AS nombre_producto,
    usu.nombre_usuario AS nombre_usuario, es.nombre AS nombre_estado 
    FROM inventarios inv
    LEFT JOIN centrocosto cc ON inv.fk_idcentrocosto = cc.idcentrocosto
    LEFT JOIN producto pr ON inv.nombre_producto = pr.id
    LEFT JOIN usuarios usu ON inv.fk_cedula = usu.identificacion
    LEFT JOIN estado es ON inv.estado = es.id";
                        
    if (!empty($search)) {
        if (!empty($search)) {
            $sql = "SELECT 'activo_fijo' AS tipo, ac.num_placa_activo AS activo_fijo, pr.nombre_producto AS nombre_producto, cc.nombre_centrocosto AS nombre_centrocosto, es.nombre AS nombre_estado, usu.nombre_usuario AS nombre_usuario
                FROM activos_fijos ac
                LEFT JOIN centrocosto cc ON ac.fk_idcentrocosto = cc.idcentrocosto
                LEFT JOIN producto pr ON ac.nombre_producto = pr.id
                LEFT JOIN usuarios usu ON ac.fk_cedula = usu.identificacion
                LEFT JOIN estado es ON ac.estado = es.id 
                WHERE num_placa_activo LIKE '%$search%'
                OR pr.nombre_producto LIKE '%$search%'
                    
                UNION 
                    
                SELECT 'inventario' AS tipo, inv.num_placa_inventario AS activo_fijo, pr.nombre_producto AS nombre_producto, cc.nombre_centrocosto AS nombre_centrocosto, es.nombre AS nombre_estado, usu.nombre_usuario AS nombre_usuario
                FROM inventarios inv
                LEFT JOIN centrocosto cc ON inv.fk_idcentrocosto = cc.idcentrocosto
                LEFT JOIN producto pr ON inv.nombre_producto = pr.id
                LEFT JOIN usuarios usu ON inv.fk_cedula = usu.identificacion
                LEFT JOIN estado es ON inv.estado = es.id
                WHERE num_placa_inventario LIKE '%$search%'
                OR pr.nombre_producto LIKE '%$search%'";
        }
        

    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= " LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsulta($conexion, $sql);
    ?>