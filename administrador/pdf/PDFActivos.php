<?php
require('../../fpdf186/fpdf.php');

// Conexión a la base de datos (debes incluir tus propios datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "activofijos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

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


// Definir posición y tamaño del cuadro principal
$pdf->Rect(10, 42, 190, 250, 'D');

// Definir posición inicial de los cuadros internos
$x = 12;
$y = 46;

$pdf->SetFont('Arial','B',7);
$pdf->Rect($x, $y, 14, $titleHeight, 'LTRB');
$pdf->SetXY($x + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'Placa deL Activo', 0, 'L');
            
$x += $titleWidth + $margin; // Ajustar la posición para el siguiente cuadrito pequeño

$pdf->SetFont('Arial','B',7);
$pdf->Rect(27, $y, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(27 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'Nombre del Activo', 0, 'L');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(46, $y, 9, $titleHeight, 'LTRB');
$pdf->SetXY(45 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell(10 - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'Tipo', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',6);
$pdf->Rect(56, $y, 9, $titleHeight, 'LTRB');
$pdf->SetXY(53 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell(15 - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'MARCA', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(66, $y, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(66 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'SERIAL', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(85, $y, 12, $titleHeight, 'LTRB');
$pdf->SetXY(82 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'CCOSTO', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(98, $y, 14, $titleHeight, 'LTRB');
$pdf->SetXY(96 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'DESTINO', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',7);
$pdf->Rect(113, $y, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(113 +$paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'UBICACION', 0, 'C');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',5);
$pdf->Rect(132, $y, 13, $titleHeight, 'LTRB');
$pdf->SetXY(131 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'ACTIVO ASOCIADO', 0, 'L');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',5);
$pdf->Rect(146, $y, 13, $titleHeight, 'LTRB');
$pdf->SetXY(145 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell(20 - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'INVENTARIO ASOCIADO', 0, 'L');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',5);
$pdf->Rect(160, $y, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(160 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'RESPONSABLE', 0, 'L');

$x += $titleWidth + $margin;

$pdf->SetFont('Arial','B',5);
$pdf->Rect(179, $y, $titleWidth, $titleHeight, 'LTRB');
$pdf->SetXY(179 + $paddingtitle, $y + $paddingtitle);
$pdf->MultiCell($titleWidth - ($paddingtitle * 2), $titleHeight - ($paddingtitle * 7), 'NOMBRE', 0, 'L');
// Ajustar la posición Y para el contenido de los cuadros
$y += $cuadroHeight + $margin;


// Agregar los datos de la tabla al PDF
foreach ($data as $row) {
    // Consultar datos adicionales de la base de datos
    $sql = 'SELECT pr.nombre_producto AS nombre_producto, jr.nombre_jerarquiactivo AS nombre_jerarquia, mr.nombre_marca AS nombre_marca, ac.serial_activo AS serial_activo, 
    cc.nombre_centrocosto AS nombre_centrocosto, ds.nombre_destino AS nombre_destino, ub.nombre_ubicacion AS nombre_ubicacion, ac.activofijo_repuesto, 
    ac.fk_cedula AS cedula, usu.nombres AS nombre_usuario
    FROM activos_fijos ac
    LEFT JOIN producto pr ON ac.nombre_producto = pr.id
    LEFT JOIN jerarquiactivo jr ON ac.fk_idjerarquiactivo = jr.idjerarquiactivo
    LEFT JOIN marca mr ON ac.fk_idmarcas = mr.idmarcas
    LEFT JOIN centrocosto cc ON ac.fk_idcentrocosto = cc.idcentrocosto
    LEFT JOIN destino ds ON ac.fk_desti_id = ds.desti_id
    LEFT JOIN ubicacion ub ON ac.fk_ubica_id = ub.ubica_id
    LEFT JOIN usuarios usu ON ac.fk_cedula = usu.identificacion
    WHERE num_placa_activo = '.$row[0].'
    UNION 
    SELECT 
    pr.nombre_producto AS nombre_producto, 
    jr.nombre_jerarquiactivo AS nombre_jerarquia, 
    mr.nombre_marca AS nombre_marca, 
    inv.serial_inventario AS serial_activo, 
    cc.nombre_centrocosto AS nombre_centrocosto, 
    ds.nombre_destino AS nombre_destino, 
    ub.nombre_ubicacion AS nombre_ubicacion, 
    inv.activofijo_asociado, 
    inv.fk_cedula AS cedula, 
    usu.nombres AS nombre_usuario
    FROM inventarios inv
    LEFT JOIN producto pr ON inv.nombre_producto = pr.id
    LEFT JOIN jerarquiactivo jr ON inv.fk_idjerarquiactivo = jr.idjerarquiactivo
    LEFT JOIN marca mr ON inv.fk_idmarcas = mr.idmarcas
    LEFT JOIN centrocosto cc ON inv.fk_idcentrocosto = cc.idcentrocosto
    LEFT JOIN destino ds ON inv.fk_desti_id = ds.desti_id
    LEFT JOIN ubicacion ub ON inv.fk_ubica_id = ub.ubica_id
    LEFT JOIN usuarios usu ON inv.fk_cedula = usu.identificacion
    WHERE num_placa_inventario = '.$row[0]; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row_db = $result->fetch_assoc()) {
            $pdf->SetFont('Arial','B',7);
            // Cuadrito 1
            $pdf->Rect(12, $y, 14, $cuadroHeight, 'D');
            $pdf->SetXY(12 + $padding, $y + $padding);
            $pdf->MultiCell($cuadroWidth - ($padding * 1), $cuadroHeight - ($padding * 4), $row[0], 0, 'L');
            
            // Cuadrito 2
            $pdf->SetFont('Arial','B',6);
            $pdf->Rect(11 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(9 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['nombre_producto'], 0, 'L');

            // Cuadrito 3
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(30 + 14 + $margin, $y, 9, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(28 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['nombre_jerarquia'], 0, 'L');

            // Cuadrito 4
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(40 + 14 + $margin, $y, 9, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(40 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['nombre_marca'], 0, 'L');

            // Cuadrito 5
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(50 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(50 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['serial_activo'], 0, 'L');

            // Cuadrito 6
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(69 + 14 + $margin, $y, 12, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(67 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(16 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['nombre_centrocosto'], 0, 'L');

            // Cuadrito 7
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(82 + 14 + $margin, $y, 14, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(80 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(17 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['nombre_destino'], 0, 'L');

            // Cuadrito 8
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(97 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(95 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['nombre_ubicacion'], 0, 'L');

            // Cuadrito 9
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(116 + 14 + $margin, $y, 13, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(116 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), '', 0, 'L');

            // Cuadrito 10
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(130 + 14 + $margin, $y, 13, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(128 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['activofijo_repuesto'], 0, 'L');

            // Cuadrito 11
            $pdf->SetFont('Arial','B',6);
            $pdf->Rect(144 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(144 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(24 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['cedula'], 0, 'L');

            // Cuadrito 12
            $pdf->SetFont('Arial','B',5);
            $pdf->Rect(163 + 14 + $margin, $y, 18, $cuadroHeight, 'D'); // La coordenada x del segundo cuadrito se ajusta sumando el ancho del primer cuadrito, el margen y la posición inicial
            $pdf->SetXY(162 + 14 + $margin + $padding, $y + $padding); // Ajustar la posición del texto dentro del cuadrito
            $pdf->MultiCell(20 - ($padding * 2), $cuadroHeight - ($padding * 4), $row_db['nombre_usuario'], 0, 'L');
            
            $y += $cuadroHeight + $margin;

             // Verificar si es necesario cambiar de página
             if ($y > 270) { // Ajustar este valor según el espacio disponible en la segunda página
                $pdf->AddPage();
                $y = 10; // Reiniciar la posición y en la nueva página
            }
        }
    }
}

$pdf->Output();
$conn->close();
?>