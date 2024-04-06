<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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
            $sql = "INSERT INTO producto (id, nombre, estado) VALUES ('$data[0]', '$data[1]', '$data[2]')";
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