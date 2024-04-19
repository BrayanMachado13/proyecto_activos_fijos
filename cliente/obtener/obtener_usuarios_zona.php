<?php
include '../../database/db.php';

if (isset($_POST['idcentrocosto'])) {
    $idcentrocosto = $_POST['idcentrocosto'];

    // Obtener el id de la zona asociada al centro de costo
    $sql = "SELECT fk_idzona FROM centrocosto WHERE idcentrocosto = $idcentrocosto";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $idzona = $fila['fk_idzona'];

        // Obtener los usuarios de la zona
        $sql_usuarios = "SELECT identificacion, nombres FROM usuarios WHERE fk_idzona = $idzona";
        $resultado_usuarios = $conexion->query($sql_usuarios);

    
        // Generar opciones para el segundo select
        $options = '';
        
            while ($row = $resultado_usuarios->fetch_assoc()) {
                $options .= "<option value='{$row['identificacion']}'>{$row['nombres']}</option>";
            }
        

        echo $options;
    } else {
        echo "No se encontró la zona asociada al centro de costo";
    }
} else {
    echo "No se recibió el id del centro de costo";
}
?>