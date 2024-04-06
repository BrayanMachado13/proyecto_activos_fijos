<?php

require_once "../../fpdf186/fpdf.php";

// Configuración de la conexión a MySQL
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'activofijos';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Consulta a la base de datos
$sql = 'SELECT zn.idzona, zn.nombre_zona, es.nombre AS nombre_estado, pa.nombre_pais AS nombre_pais, dp.nombre_departamento AS nombre_departamento, 
ci.nombre_ciudad AS nombre_ciudad
FROM zona zn
LEFT JOIN pais pa ON zn.fk_pais = pa.id
LEFT JOIN departamento dp ON zn.fk_departamento = dp.id
LEFT JOIN ciudad ci ON zn.fk_ciudad = ci.id
LEFT JOIN estado es ON zn.estado = es.id';
$result = $conn->query($sql);

// Crear un archivo PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Título del PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'INFORMES DE ZONAS', 0, 1, 'C');

// Fecha de generación
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Fecha de generacion: ' . date('Y-m-d H:i:s'), 0, 1, 'C');

// Agregar imagen
$pdf->Image('../../complemento/imagen/logorecord.png', 14, 12, 30);

$pdf->Ln(25); // Salto de línea

// Ancho de la página
$pageWidth = $pdf->GetPageWidth();

// Altura de línea
$lineHeight = 10;

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell($pageWidth / 6, $lineHeight, 'CODIGO', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 7, $lineHeight, 'NOMBRE', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 8, $lineHeight, 'PAIS', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 7, $lineHeight, 'DEPARTAMENTO', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 6, $lineHeight, 'CIUDAD', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 6, $lineHeight, 'ESTADO', 'LTRB', 1, 'C');

// Procesar los datos obtenidos y agregarlos al PDF
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Establecer el tamaño de fuente para cada campo
        $pdf->SetFont('Arial', '', 8); // Tamaño 10 para el código
        $pdf->Cell($pageWidth / 6, $lineHeight, $row['idzona'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 8); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 7, $lineHeight, $row['nombre_zona'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 8); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 8, $lineHeight, $row['nombre_pais'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 8); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 7, $lineHeight, $row['nombre_departamento'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 8); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 6, $lineHeight, $row['nombre_ciudad'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 8); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 6, $lineHeight, $row['nombre_estado'], 'LTRB', 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 0, 1, 'C');
}

// Cerrar conexión a MySQL
$conn->close();

// Salida del archivo PDF
$pdf->Output();
