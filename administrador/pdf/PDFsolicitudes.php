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
$sql = 'SELECT st.id, usu.nombres AS nombre_usuario_solicitante, usua.nombres AS nombre_usuario_destino, 
cc.nombre_centrocosto AS nombre_centrocosto, ds.nombre_destino AS nombre_destino, ub.nombre_ubicacion AS nombre_ubicacion
FROM solicitudes_transferencia st
LEFT JOIN usuarios usu ON st.usuario_origen = usu.identificacion
LEFT JOIN usuarios usua ON st.usuario_destino = usua.identificacion
LEFT JOIN centrocosto cc ON st.centro_costo = cc.idcentrocosto
LEFT JOIN destino ds ON st.destino = ds.desti_id
LEFT JOIN ubicacion ub ON st.ubicacion = ub.ubica_id';
$result = $conn->query($sql);

// Crear un archivo PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Título del PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'INFORMES DE TRASLADOS', 0, 1, 'C');

// Fecha de generación
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Fecha de generacion: ' . date('Y-m-d H:i:s'), 0, 1, 'C');

// Agregar imagen
$pdf->Image('../../complemento/imagen/logorecord.png', 14, 12, 30);

$pdf->Ln(10); // Salto de línea

// Ancho de la página
$pageWidth = $pdf->GetPageWidth();

// Altura de línea
$lineHeight = 10;

// Ancho de cada columna
$idWidth = $pageWidth * 0.05;
$solicitanteWidth = $pageWidth * 0.15;
$destinatarioWidth = $pageWidth * 0.15;
$centroCostoWidth = $pageWidth * 0.15;
$nuevoDestinoWidth = $pageWidth * 0.2;
$nuevaUbicacionWidth = $pageWidth * 0.2;

// Encabezados
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell($idWidth, $lineHeight, 'ID', 'LTRB', 0, 'C');
$pdf->Cell($solicitanteWidth, $lineHeight, 'SOLICITANTE', 'LTRB', 0, 'C');
$pdf->Cell($destinatarioWidth, $lineHeight, 'DESTINATARIO', 'LTRB', 0, 'C');
$pdf->Cell($centroCostoWidth, $lineHeight, 'C. COSTO', 'LTRB', 0, 'C');
$pdf->Cell($nuevoDestinoWidth, $lineHeight, 'NUEVO DESTINO', 'LTRB', 0, 'C');
$pdf->Cell($nuevaUbicacionWidth, $lineHeight, 'NUEVA UBICACION', 'LTRB', 1, 'C');

// Procesar los datos obtenidos y agregarlos al PDF
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 7);

        // ID
        $pdf->Cell($idWidth, $lineHeight, $row['id'], 'LTRB', 0, 'C');

        // Solicitante
        $pdf->Cell($solicitanteWidth, $lineHeight, $row['nombre_usuario_solicitante'], 'LTRB', 0, 'C');

        // Destinatario
        $pdf->Cell($destinatarioWidth, $lineHeight, $row['nombre_usuario_destino'], 'LTRB', 0, 'C');

        // Centro de Costo
        $pdf->SetFont('Arial', '', 5);
        $pdf->Cell($centroCostoWidth, $lineHeight, $row['nombre_centrocosto'], 'LTRB', 0, 'C');

        // Nuevo Destino
        $pdf->SetFont('Arial', '', 5);
        if(strlen($row['nombre_destino']) > 35) {
            $pdf->MultiCell($nuevoDestinoWidth, $lineHeight, $row['nombre_destino'], 'LTRB', 'C');
        } else {
            $pdf->Cell($nuevoDestinoWidth, $lineHeight, $row['nombre_destino'], 'LTRB', 0, 'C');
        }

        // Nueva Ubicación
        if(strlen($row['nombre_ubicacion']) > 35) {
            $pdf->MultiCell($nuevaUbicacionWidth, $lineHeight, $row['nombre_ubicacion'], 'LTRB', 'C');
        } else {
            $pdf->Cell($nuevaUbicacionWidth, $lineHeight, $row['nombre_ubicacion'], 'LTRB', 1, 'C');
        }
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 0, 1, 'C');
}

// Cerrar conexión a MySQL
$conn->close();

// Salida del archivo PDF
$pdf->Output();