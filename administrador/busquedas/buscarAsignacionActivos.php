<?php 
                        
    include_once '../database/db.php';

    // Calcula el número total de resultados sin límite de paginación
    $totalResultsSql = "SELECT COUNT(*) as total FROM activos_solicitud";
    if (!empty($search)) {
        $totalResultsSql .= " WHERE aso.id_activo LIKE '%$search%'";
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
    $sql = "SELECT aso.id, 
    st.usuario_destino AS usuario_destino, 
    usu.nombres AS nombre_usuario, 
    st.fecha_solicitud AS fecha_solicitud, 
    dn.nombre_destino AS destino_inicial, 
    ub.nombre_ubicacion AS ubicacion_inicial, 
    dns.nombre_destino AS destino_final, 
    ubi.nombre_ubicacion AS ubicacion_final, 
    est.nombre AS nombre_estado_traslado,
    aso.id_activo
    FROM activos_solicitud aso
    LEFT JOIN solicitudes_transferencia st ON aso.id_solicitud = st.id
    LEFT JOIN usuarios usu ON st.usuario_origen = usu.identificacion
    LEFT JOIN destino dn ON aso.destino_inicial = dn.desti_id
    LEFT JOIN ubicacion ub ON aso.ubicacion_inicial = ub.ubica_id
    LEFT JOIN ubicacion ubi ON st.ubicacion = ubi.ubica_id
    LEFT JOIN destino dns ON st.destino = dns.desti_id
    LEFT JOIN estadotraslado est ON aso.estado = est.id";
                        
    if (!empty($search)) {
        if (!empty($search)) {
            $sql .= " WHERE aso.id_activo LIKE '%$search%'";
        }
    
    }
                        
    $offset = ($page - 1) * $resultsPerPage;
    $sql .= " LIMIT $offset, $resultsPerPage";
                        
    $result = ejecutarConsulta($conexion, $sql);
    ?>