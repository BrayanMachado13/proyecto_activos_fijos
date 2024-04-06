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
$sql = 'SELECT cc.idcentrocosto, cc.nombre_centrocosto, zn.nombre_zona AS nombre_zona, pa.nombre_pais AS nombre_pais, dp.nombre_departamento AS nombre_departamento, ci.nombre_ciudad AS nombre_ciudad
FROM centrocosto cc
LEFT JOIN zona zn ON cc.fk_idzona = zn.idzona
LEFT JOIN pais pa ON cc.fk_pais = pa.id
LEFT JOIN departamento dp ON cc.fk_departamento = dp.id
LEFT JOIN ciudad ci ON cc.fk_ciudad = ci.id';
$result = $conn->query($sql);

// Crear un archivo PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Título del PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'INFORMES DE CENTROS DE COSTO', 0, 1, 'C');

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
$pdf->Cell($pageWidth / 5, $lineHeight, 'NOMBRE', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 8, $lineHeight, 'ZONA', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 8, $lineHeight, 'PAIS', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 8, $lineHeight, 'DEPARTAMENTO', 'LTRB', 0, 'C');
$pdf->Cell($pageWidth / 6, $lineHeight, 'CIUDAD', 'LTRB', 1, 'C');

// Procesar los datos obtenidos y agregarlos al PDF
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Establecer el tamaño de fuente para cada campo
        $pdf->SetFont('Arial', '', 7); // Tamaño 10 para el código
        $pdf->Cell($pageWidth / 6, $lineHeight, $row['idcentrocosto'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 7); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 5, $lineHeight, $row['nombre_centrocosto'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 7); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 8, $lineHeight, $row['nombre_zona'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 7); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 8, $lineHeight, $row['nombre_pais'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 7); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 8, $lineHeight, $row['nombre_departamento'], 'LTRB', 0, 'C');

        $pdf->SetFont('Arial', '', 7); // Tamaño 8 para el nombre
        $pdf->Cell($pageWidth / 6, $lineHeight, $row['nombre_ciudad'], 'LTRB', 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 0, 1, 'C');
}

// Cerrar conexión a MySQL
$conn->close();

// Salida del archivo PDF
$pdf->Output();
