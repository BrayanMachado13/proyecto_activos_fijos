<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo_activo = $_POST["tipo_activo"];
    $archivo_tmp = $_FILES["file"]["tmp_name"];

    include '../../database/db.php';

    // Leer el archivo CSV línea por línea, empezando desde la segunda fila
    if (($handle = fopen($archivo_tmp, "r")) !== FALSE) {
        $first_row = true;
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            // Omitir la primera fila (títulos)
            if ($first_row) {
                $first_row = false;
                continue;
            }

            // Insertar los datos en la tabla MySQL
            $sql = "INSERT INTO activos_fijos (num_placa_activo, serial_activo, nombre_producto, fk_desti_id, fk_ubica_id, fk_cedula, fk_idtipoactivos, estado, fk_idprovedor, fecha_activo, num_factura_activo, precio_activo, fk_idmarcas, fk_idjerarquiactivo) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]', '$tipo_activo')";
            if ($conexion->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conexion->error;
            }
        }
        fclose($handle);
        echo "<div class='alert alert-success'>Datos importados correctamente.</div>";
    }
}

// Cerrar la conexión
$conexion->close();
?>





