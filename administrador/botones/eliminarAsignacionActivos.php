<?php
if (isset($_POST['eliminar'])) {
    // Aquí deberías realizar la conexión a la base de datos y eliminar el registro
    $id = $_POST['id'];
    // Por ejemplo, puedes usar MySQLi
    
    include_once '../../database/db.php';

    $sql = "DELETE FROM activos_solicitud WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "activo eliminardo del traslado.";
    } else {
        echo "Error al eliminar el activo eliminardo del traslado: " . $conexion->error;
    }
    $conexion->close();

    // Redirigir a index.php después de eliminar el registro
    header("Location: " . $_SERVER['HTTP_REFERER']);;
    exit();
}
?>