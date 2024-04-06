<?php
include_once '../../database/db.php';

// Mensaje de error y éxito
$error_msg = "";
$success_msg = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['codigo_activo'];
    $nombre = $_POST['nombre_activo'];
    $serial = $_POST['serial_activo'];
    $tipo = $_POST['tipo_activo'];
    $estado = $_POST['estado'];
    $jerarquia_activo = $_POST['jerarquia_activo'];
    $repuesto_activo = $_POST['repuesto_activo'];
    $usuario_activo = $_POST['usuario_activo'];
    $provedor_activo = $_POST['provedor_activo'];
    $centrocosto = $_POST['centrocosto'];
    $destinos = $_POST['destinos'];
    $fecha_compra = $_POST['fecha_compra'];
    $numero_factura = $_POST['numero_factura'];
    $precio_activo = $_POST['precio_activo'];
    $marca_activo = $_POST['marca_activo'];
    $ubicaciones = $_POST['ubicaciones'];

    // Verificar si el ID de activo o inventario ya existe
    $sql = "SELECT id FROM ";
    if ($jerarquia_activo == 7) {
        $sql .= "activos_fijos WHERE num_placa_activo = '$id'";
    } elseif ($jerarquia_activo == 8) {
        $sql .= "inventarios WHERE num_placa_inventario = '$id'";
    }

    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $error_msg = "El ID de activo o inventario ya existe.";
    } else {
        // Insertar en la tabla correspondiente
        if ($jerarquia_activo == 7) {
            $sql_insert = "INSERT INTO activos_fijos (num_placa_activo, serial_activo, nombre_producto, fk_desti_id, fk_ubica_id, fk_cedula, fk_idtipoactivos, 
            estado, fk_idprovedor, fecha_activo, num_factura_activo, precio_activo, fk_idmarcas, activofijo_repuesto, fk_idcentrocosto, fk_idjerarquiactivo) 
            VALUES ('$id', '$serial', '$nombre', '$destinos','$ubicaciones','$usuario_activo','$tipo','$estado','$provedor_activo','$fecha_compra',
            '$numero_factura','$precio_activo','$marca_activo'," . ($repuesto_activo != "" ? "'$repuesto_activo'" : "NULL") . ",'$centrocosto','$jerarquia_activo')";
        } elseif ($jerarquia_activo == 8) {
            $sql_insert = "INSERT INTO inventarios (num_placa_inventario, serial_inventario, nombre_producto, fk_desti_id, fk_ubica_id, fk_cedula, fk_idtipoactivos, 
            estado, fk_idprovedor, fecha_inventario, num_factura_inventario, precio_activo, fk_idmarcas, fk_idcentrocosto, fk_idjerarquiactivo) 
            VALUES ('$id', '$serial', '$nombre', '$destinos','$ubicaciones','$usuario_activo','$tipo','$estado','$provedor_activo','$fecha_compra',
            '$numero_factura','$precio_activo','$marca_activo','$centrocosto','$jerarquia_activo')";
        }

        if ($conexion->query($sql_insert) === TRUE) {
            $success_msg = "Activo o Inventario guardado correctamente.";
        } else {
            $error_msg =  "Error al guardar datos: " . $conexion->error;
        }
    }

    $conexion->close();
}

// Redireccionar al formulario con los mensajes
if (!empty($error_msg)) {
header("Location: ../activosfijos.php?error_msg=$error_msg");
} else {
header("Location: ../activosfijos.php?success_msg=$success_msg");
}
?>