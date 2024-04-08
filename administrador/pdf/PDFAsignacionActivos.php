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
$sql = 'SELECT aso.id, 
st.usuario_destino AS usuario_destino, 
usu.nombre_usuario AS nombre_usuario, 
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
LEFT JOIN estadotraslado est ON aso.estado = est.id';
$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

// Tamaños de los cuadros
$cuadroWidthtituloprincipal = 190;
$cuadroHeighttituloprincipal = 30;
$paddingtituloprincipal = 1; // Espacio entre cuadros

// Definir posición y tamaño del cuadro principal
$pdf->Rect(10, 10, $cuadroWidthtituloprincipal, $cuadroHeighttituloprincipal, 'D');

// Título
$pdf->SetXY(15, 19);
$pdf->Cell(0, 10, 'RELACION DE ACTIVOS E INVENTARIOS', 0, 1, 'C');

// Imagen
$pdf->Image('../../complemento/imagen/logorecord.png', 15, 20, 30);

// Fecha de creación
$pdf->SetFont('Arial','B',7);
$pdf->SetXY(5, 3);
$pdf->Cell(0, 10, 'Fecha de creacion: ' . date('Y-m-d H:i:s'), 0, 1, 'R');

// Tamaños de los cuadros
$titleWidth = 18;
$titleHeight = 10;
$paddingtitle = 1; // Espacio entre cuadros
$margintitle = 1;

$cuadroWidth = 15;
$cuadroHeight = 10;
$padding = 2; // Espacio entre cuadros
$margin = 2; // Margen entre cuadritos pequeños

$x = 12;
$y = 56;
$yy = 44;


// Encabezados
$pdf->SetFont('Arial', 'B', 7);
$pdf->Rect($x, $yy, 14, $titleHeight, 'LTRB');
$pdf->SetXY($x + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'ID', 0, 'L');

$x += $titleWidth + $margin; // Ajustar la posición para el siguiente cuadrito pequeño

$pdf->SetFont('Arial','B',7);
$pdf->Rect(27, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(27 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'USUARIO DESTINO', 0, 'L');

$pdf->SetFont('Arial','B',7);
$pdf->Rect(46, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(45 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'NOMBRE USUARIO', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(65, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(65 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'FECHA SOLICITUD', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(84, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(84 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'DESTINO INICIAL', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(103, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(103 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'UBICACION INICIAL', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(122, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(122 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'DESTINO FINAL', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(141, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(141 +$paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'UBICACION FINAL', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(160, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(160 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'ESTADO', 0, 'L');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(179, $yy, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(179 + $paddingtitle, $yy + $paddingtitle);
$pdf->MultiCell(20 - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'N. ACTIVO', 0, 'L');

$x += $titleWidth + $margin;

// Procesar los datos obtenidos y agregarlos al PDF
$pdf->SetFont('Arial', '', 5);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $x = 12;

            // Cuadrito 1
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Rect(12, $y, 14, $cuadroHeight, 'D');
            $pdf->SetXY(12 + $padding, $y + $padding);
            $pdf->MultiCell($cuadroWidth - ($padding * 2), $cuadroHeight - ($padding * 4), $row['id'], 0, 'L');
            
            // Cuadrito 2
            $pdf->SetFont('Arial','B',6);
            $pdf->Rect(11 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(9 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row['usuario_destino'], 0, 'L');

            // Cuadrito 3
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(30 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(28 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 3), $cuadroHeight - ($padding * 4), $row['nombre_usuario'], 0, 'L');

            // Cuadrito 4
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(49 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(48 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 3), $cuadroHeight - ($padding * 4), $row['fecha_solicitud'], 0, 'L');

            // Cuadrito 5
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(68 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(66 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 3), $cuadroHeight - ($padding * 4), $row['destino_inicial'], 0, 'L');

            // Cuadrito 6
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(87 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(86 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(16 - ($padding * 2), $cuadroHeight - ($padding * 4), $row['ubicacion_inicial'], 0, 'L');

            // Cuadrito 7
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(106 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(104 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(17 - ($padding * 2), $cuadroHeight - ($padding * 4), $row['destino_final'], 0, 'L');

            // Cuadrito 8
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(125 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(123 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 3), $cuadroHeight - ($padding * 4), $row['ubicacion_final'], 0, 'L');

            // Cuadrito 9
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(144 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(144 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4),$row['nombre_estado_traslado'], 0, 'L');

            // Cuadrito 10
            $pdf->SetFont('Arial','B',7);
            $pdf->Rect(163 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(163 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(17 - ($padding * 2), $cuadroHeight - ($padding * 4), $row['id_activo'], 0, 'L');
       
            $y += $cuadroHeight + $margin;

             // Verificar si es necesario cambiar de página
            if ($y > 270) { // Ajustar este valor según el espacio disponible en la segunda página
                $pdf->AddPage();
                $y = 10; // Reiniciar la posición y en la nueva página
            }
    }
} else {
    $pdf->Cell(array_sum($columnWidths), 10, 'No se encontraron resultados.', 1, 1, 'C');
}

// Cerrar conexión a MySQL
$conn->close();

// Salida del archivo PDF
$pdf->Output();