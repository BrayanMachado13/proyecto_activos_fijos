-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-04-2024 a las 00:27:27
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `activofijos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos_fijos`
--

CREATE TABLE `activos_fijos` (
  `id` int NOT NULL,
  `num_placa_activo` int NOT NULL,
  `serial_activo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre_producto` int NOT NULL,
  `fk_desti_id` int NOT NULL,
  `fk_ubica_id` int NOT NULL,
  `fk_cedula` int NOT NULL,
  `fk_idtipoactivos` int NOT NULL,
  `estado` int NOT NULL,
  `fk_idprovedor` int NOT NULL,
  `fecha_activo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `num_factura_activo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio_activo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fk_idmarcas` int NOT NULL,
  `activofijo_repuesto` int DEFAULT NULL,
  `fk_idcentrocosto` int NOT NULL,
  `fk_idjerarquiactivo` int NOT NULL,
  `fk_idzona` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `activos_fijos`
--

INSERT INTO `activos_fijos` (`id`, `num_placa_activo`, `serial_activo`, `nombre_producto`, `fk_desti_id`, `fk_ubica_id`, `fk_cedula`, `fk_idtipoactivos`, `estado`, `fk_idprovedor`, `fecha_activo`, `num_factura_activo`, `precio_activo`, `fk_idmarcas`, `activofijo_repuesto`, `fk_idcentrocosto`, `fk_idjerarquiactivo`, `fk_idzona`) VALUES
(13, 35853, 'NA', 4, 1140, 1140, 1003397093, 3, 1, 800040390, '15/03/2024', 'FE 3395', '340000', 500, NULL, 1078, 7, 1077),
(14, 35854, 'NA', 4, 1140, 1140, 1003397093, 3, 1, 800040390, '15/03/2024', 'FE 3395', '340000', 500, NULL, 1078, 7, 1077),
(15, 35855, '25487858', 2, 1139, 1139, 6473874, 2, 1, 800040390, '2024-04-10', 'FE-2545', '25000', 1, NULL, 1078, 7, 1077),
(16, 40000, '25487858', 2, 1139, 1139, 6473874, 2, 1, 800040390, '2024-04-16', 'FE-2545', '25000', 1, NULL, 1078, 7, 1077);

--
-- Disparadores `activos_fijos`
--
DELIMITER $$
CREATE TRIGGER `insert_destino_trigger` BEFORE INSERT ON `activos_fijos` FOR EACH ROW BEGIN
    DECLARE centro_costo_id INT;
    DECLARE zona_id INT;

    -- Obtener el ID del centro de costo relacionado con el destino
    SELECT fk_idcentrocosto INTO centro_costo_id FROM destino WHERE desti_id = NEW.fk_desti_id;

    -- Obtener el ID de la zona relacionada con el centro de costo
    SELECT fk_idzona INTO zona_id FROM centrocosto WHERE idcentrocosto = centro_costo_id;

    -- Actualizar las columnas fk_idzona y fk_idcentrocosto antes de la inserción
    SET NEW.fk_idzona = zona_id;
    SET NEW.fk_idcentrocosto = centro_costo_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos_solicitud`
--

CREATE TABLE `activos_solicitud` (
  `id` int NOT NULL,
  `id_solicitud` int DEFAULT NULL,
  `id_activo` int NOT NULL,
  `ubicacion_inicial` int DEFAULT NULL,
  `destino_inicial` int DEFAULT NULL,
  `estado` int DEFAULT '3',
  `id_usuario_destino` int NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `activos_solicitud`
--

INSERT INTO `activos_solicitud` (`id`, `id_solicitud`, `id_activo`, `ubicacion_inicial`, `destino_inicial`, `estado`, `id_usuario_destino`, `fecha_creacion`) VALUES
(1, 43, 35853, 1145, 1145, 1, 6473874, '2024-04-10 01:37:28'),
(2, 43, 35854, 1145, 1145, 2, 6473874, '2024-04-10 01:37:45'),
(3, 44, 35853, 1145, 1145, 1, 6473874, '2024-04-16 02:21:12'),
(4, 44, 35854, 1145, 1145, 1, 6473874, '2024-04-16 02:21:14'),
(6, 47, 40000, 1145, 1145, 1, 6473874, '2024-04-17 01:58:05'),
(7, 47, 35855, 1143, 1143, 1, 6473874, '2024-04-17 01:58:26'),
(8, 48, 35853, 1139, 1139, 1, 1003397093, '2024-04-17 02:00:41'),
(9, 48, 35854, 1139, 1139, 1, 1003397093, '2024-04-17 02:00:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrocosto`
--

CREATE TABLE `centrocosto` (
  `idcentrocosto` int NOT NULL,
  `nombre_centrocosto` varchar(45) DEFAULT NULL,
  `fk_idzona` int DEFAULT NULL,
  `fk_pais` int DEFAULT NULL,
  `fk_departamento` int DEFAULT NULL,
  `fk_ciudad` int DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `centrocosto`
--

INSERT INTO `centrocosto` (`idcentrocosto`, `nombre_centrocosto`, `fk_idzona`, `fk_pais`, `fk_departamento`, `fk_ciudad`, `estado`) VALUES
(1078, 'OFICINA PRINCIPAL', 1077, 1, 1, 1, 1),
(1079, 'TORRES DE TELECOMUNICACION', 1077, 1, 1, 1, 1),
(1391, 'PLANETA RICA', 1390, 1, 1, 4, 1),
(1408, 'AYAPEL', 1409, 1, 1, 3, 1),
(1432, 'CERETE', 1431, 1, 1, 5, 1),
(1527, 'CANO VIEJO', 1077, 1, 1, 1, 1),
(1529, 'CARRISAL', 1077, 1, 1, 1, 1),
(1531, 'SAN ANTERITO', 1077, 1, 1, 1, 1),
(1533, 'BUENOS AIRES LA MANTA', 1077, 1, 1, 1, 1),
(1535, 'EBANO', 1077, 1, 1, 1, 2),
(1538, 'CANALETE', 1077, 1, 1, 1, 1),
(1545, 'SANTA LUCIA', 1077, 1, 1, 1, 1),
(1548, 'LOS CORDOBAS', 1077, 1, 1, 1, 1),
(1549, 'PUERTO ESCONDIDO', 1077, 1, 1, 1, 1),
(1552, 'SAN ANTERO', 1696, 1, 1, 6, 1),
(1564, 'LA GRANJA', 1077, 1, 1, 1, 1),
(1565, 'MOCARI', 1077, 1, 1, 1, 1),
(1566, 'PRADERA', 1077, 1, 1, 1, 1),
(1567, 'MOGAMBO', 1077, 1, 1, 1, 1),
(1568, 'DORADO', 1077, 1, 1, 1, 1),
(1685, 'SAN CARLOS', 1431, 1, 1, 5, 1),
(1686, 'CIENAGA DE ORO', 1431, 1, 1, 5, 1),
(1687, 'RABOLARGO', 1431, 1, 1, 5, 1),
(1688, 'SAN PELAYO', 1431, 1, 1, 5, 1),
(1689, 'COTORRA', 1431, 1, 1, 5, 1),
(1690, 'PUEBLO NUEVO', 1390, 1, 1, 4, 1),
(1691, 'BUENAVISTA', 1390, 1, 1, 4, 1),
(1693, 'MONTELIBANO', 1692, 1, 1, 2, 1),
(1694, 'PUERTO LIBERTADOR', 1692, 1, 1, 2, 1),
(1695, 'APARTADA', 1692, 1, 1, 2, 1),
(1697, 'LORICA', 1696, 1, 1, 6, 1),
(1699, 'SAN BERNARDO', 1696, 1, 1, 6, 1),
(1700, 'PURISIMA', 1696, 1, 1, 6, 1),
(1701, 'LA UNION', 1696, 1, 1, 6, 1),
(1702, 'MOMIL', 1696, 1, 1, 6, 1),
(1704, 'SAHAGUN', 1703, 1, 1, 7, 1),
(1705, 'CHINU', 1703, 1, 1, 7, 1),
(1706, 'TUCHIN', 1703, 1, 1, 7, 1),
(1707, 'SAN ANDRES', 1703, 1, 1, 7, 1),
(1709, 'TIERRALTA', 1708, 1, 1, 8, 1),
(1841, 'CHIMA', 1703, 1, 1, 7, 1),
(2044, 'ABROJAL', 1696, 1, 1, 6, 1),
(2258, 'MONITOS', 1696, 1, 1, 6, 1),
(2259, 'BUENOS AIRES - SP', 1077, 1, 1, 1, 1),
(2260, 'EL LEY', 1696, 1, 1, 6, 1),
(2307, 'VALENCIA', 1708, 1, 1, 8, 1),
(2318, 'MONTERIA MOVIL', 1077, 1, 1, 1, 1),
(2447, 'EL PANTANO', 1077, 1, 1, 1, 1),
(2516, 'MORINDO', 1077, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int NOT NULL,
  `nombre_ciudad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_departamento` int NOT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre_ciudad`, `id_departamento`, `estado`) VALUES
(1, 'MONTERIA', 1, 1),
(2, 'MONTELIBANO', 1, 1),
(3, 'AYAPEL', 1, 1),
(4, 'PLANETA RICA', 1, 1),
(5, 'CERETE', 1, 1),
(6, 'LORICA', 1, 1),
(7, 'SAHAGUN', 1, 1),
(8, 'TIERRALTA', 1, 2),
(9, 'ARBOLETES', 7, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int NOT NULL,
  `nombre_departamento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pais` int DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre_departamento`, `id_pais`, `estado`) VALUES
(1, 'CORDOBA', 1, 1),
(2, 'BOGOTA', 1, 2),
(7, 'ANTIOQUIA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE `destino` (
  `desti_id` int NOT NULL,
  `nombre_destino` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fk_idcentrocosto` int DEFAULT NULL,
  `fk_pais` int DEFAULT NULL,
  `fk_departamento` int DEFAULT NULL,
  `fk_ciudad` int DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`desti_id`, `nombre_destino`, `fk_idcentrocosto`, `fk_pais`, `fk_departamento`, `fk_ciudad`, `estado`) VALUES
(1, 'S', 1078, 1, 1, 1, 1),
(2, 's', 1564, 1, 1, 1, 1),
(1139, 'MONTERIA SUPERENVIOS', 1078, 1, 1, 1, 1),
(1140, 'MONTERIA BASE 1 - S03', 1078, 1, 1, 1, 1),
(1143, 'MONTERIA BASE 2 - S06', 1078, 1, 1, 1, 1),
(1144, 'MONTERIA BASE 3 - S07', 1078, 1, 1, 1, 1),
(1145, 'MONTERIA CALLE 33 CON 4 - S09', 1078, 1, 1, 1, 1),
(1146, 'MONTERIA CALLE 32 CON 3 - S11', 1078, 1, 1, 1, 1),
(1147, 'MONTERIA CALLE 29 CON 4TA - S12', 1078, 1, 1, 1, 1),
(1149, 'MONTERIA CALLE 34 CON 4TA - S14', 1078, 1, 1, 1, 1),
(1150, 'MONTERIA CALLE 41 CON 4TA - S15', 1078, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int NOT NULL,
  `nombre` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(1, 'true'),
(2, 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadotraslado`
--

CREATE TABLE `estadotraslado` (
  `id` int NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estadotraslado`
--

INSERT INTO `estadotraslado` (`id`, `nombre`) VALUES
(1, 'ACEPTADO'),
(2, 'RECHAZADO'),
(3, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int NOT NULL,
  `num_placa_inventario` int NOT NULL,
  `serial_inventario` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre_producto` int NOT NULL,
  `fk_desti_id` int NOT NULL,
  `fk_ubica_id` int NOT NULL,
  `fk_cedula` int NOT NULL,
  `fk_idtipoactivos` int NOT NULL,
  `estado` int NOT NULL,
  `fk_idprovedor` int NOT NULL,
  `fecha_inventario` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_factura_inventario` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `precio_activo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fk_idmarcas` int NOT NULL,
  `fk_idcentrocosto` int DEFAULT NULL,
  `fk_idjerarquiactivo` int DEFAULT NULL,
  `fk_idzona` int DEFAULT NULL,
  `activofijo_asociado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `inventarios`
--
DELIMITER $$
CREATE TRIGGER `insert_destinos_trigger` BEFORE INSERT ON `inventarios` FOR EACH ROW BEGIN
    DECLARE centro_costo_id INT;
    DECLARE zona_id INT;

    -- Obtener el ID del centro de costo relacionado con el destino
    SELECT fk_idcentrocosto INTO centro_costo_id FROM destino WHERE desti_id = NEW.fk_desti_id;

    -- Obtener el ID de la zona relacionada con el centro de costo
    SELECT fk_idzona INTO zona_id FROM centrocosto WHERE idcentrocosto = centro_costo_id;

    -- Actualizar las columnas fk_idzona y fk_idcentrocosto antes de la inserción
    SET NEW.fk_idzona = zona_id;
    SET NEW.fk_idcentrocosto = centro_costo_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jerarquiactivo`
--

CREATE TABLE `jerarquiactivo` (
  `idjerarquiactivo` int NOT NULL,
  `nombre_jerarquiactivo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `jerarquiactivo`
--

INSERT INTO `jerarquiactivo` (`idjerarquiactivo`, `nombre_jerarquiactivo`) VALUES
(7, 'ACTIVO FIJO'),
(8, 'INVENTARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idmarcas` int NOT NULL,
  `nombre_marca` varchar(45) DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarcas`, `nombre_marca`, `estado`) VALUES
(1, 'HP', 1),
(2, 'Brayan ', 1),
(500, 'NA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int NOT NULL,
  `nombre_pais` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre_pais`, `estado`) VALUES
(1, 'COLOMBIA', 1),
(2, 'PERU', 2),
(3, 'ARGENTINA', 2),
(4, 'BRAZIL', 2),
(7, 'PANAMA', 1),
(3455, 'Brayan ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre_producto`, `estado`) VALUES
(1, 'MOUSE', 1),
(2, 'COMPUTADOR TODO EN UNO', 2),
(3, 'AIRFIBER', 1),
(4, 'BUTACO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `idprovedor` int NOT NULL,
  `nombre_provedor` varchar(45) DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `provedor`
--

INSERT INTO `provedor` (`idprovedor`, `nombre_provedor`, `estado`) VALUES
(800040390, 'RED DE SERVICIOS DE CORDOBA', 1),
(1003397084, 'BRAYAN MACHADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idroles` int NOT NULL,
  `nom_rol` varchar(45) DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idroles`, `nom_rol`, `estado`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'USUARIO NORMAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_transferencia`
--

CREATE TABLE `solicitudes_transferencia` (
  `id` int NOT NULL,
  `usuario_origen` int NOT NULL,
  `usuario_destino` int NOT NULL,
  `zona` int DEFAULT NULL,
  `centro_costo` int NOT NULL,
  `destino` int NOT NULL,
  `ubicacion` int NOT NULL,
  `fecha_solicitud` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitudes_transferencia`
--

INSERT INTO `solicitudes_transferencia` (`id`, `usuario_origen`, `usuario_destino`, `zona`, `centro_costo`, `destino`, `ubicacion`, `fecha_solicitud`, `estado`) VALUES
(43, 6473874, 6473874, 1077, 1078, 1145, 1145, '2024-04-10 01:37:02', 2),
(44, 6473874, 6473874, 1077, 1078, 1139, 1139, '2024-04-16 02:21:06', 1),
(45, 1003397093, 1003397093, 1077, 1078, 1143, 1143, '2024-04-16 02:33:24', 3),
(46, 6473874, 6473874, 1077, 1078, 1139, 1139, '2024-04-16 18:47:58', 3),
(47, 6473874, 6473874, 1077, 1078, 1139, 1139, '2024-04-17 01:57:42', 1),
(48, 6473874, 1003397093, 1077, 1078, 1140, 1140, '2024-04-17 02:00:35', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoactivos`
--

CREATE TABLE `tipoactivos` (
  `idtipoactivos` int NOT NULL,
  `nombre_tipoactivos` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipoactivos`
--

INSERT INTO `tipoactivos` (`idtipoactivos`, `nombre_tipoactivos`) VALUES
(1, 'CONSTRUCCIONES Y EDIFICACIONES'),
(2, 'EQUIPO DE COMPUTACIÓN Y COMUNICACIÓN'),
(3, 'EQUIPOS DE OFICINA'),
(4, 'FLOTA Y EQUIPO DE TRANSPORTE'),
(5, 'MAQUINARIA Y EQUIPO'),
(6, 'TERRENO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `ubica_id` int NOT NULL,
  `nombre_ubicacion` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fk_desti_id` int DEFAULT NULL,
  `fk_pais` int DEFAULT NULL,
  `fk_departamento` int DEFAULT NULL,
  `fk_ciudad` int DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`ubica_id`, `nombre_ubicacion`, `fk_desti_id`, `fk_pais`, `fk_departamento`, `fk_ciudad`, `estado`) VALUES
(1139, 'MONTERIA SUPERENVIOS', 1139, 1, 1, 1, 1),
(1140, 'MONTERIA BASE 1 - S03', 1140, 1, 1, 1, 1),
(1143, 'MONTERIA BASE 2 - S06', 1143, 1, 1, 1, 1),
(1144, 'MONTERIA BASE 3 - S07', 1144, 1, 1, 1, 1),
(1145, 'MONTERIA CALLE 33 CON 4 - S09', 1145, 1, 1, 1, 1),
(1146, 'MONTERIA CALLE 32 CON 3 - S11', 1146, 1, 1, 1, 1),
(1147, 'MONTERIA CALLE 29 CON 4TA - S12', 1147, 1, 1, 1, 1),
(1149, 'MONTERIA CALLE 34 CON 4TA - S14', 1149, 1, 1, 1, 1),
(1150, 'MONTERIA CALLE 41 CON 4TA - S15', 1150, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `identificacion` int NOT NULL,
  `nombres` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellidos` varchar(50) NOT NULL,
  `usuario` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rol` int DEFAULT NULL,
  `fk_idzona` int DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`identificacion`, `nombres`, `apellidos`, `usuario`, `password`, `rol`, `fk_idzona`, `estado`) VALUES
(1, 'JOSE DANIEL', 'JIMENEZ MARTINEZ', 'jose@gmail.com', '123', 2, 1077, 1),
(2, 'USUARIO NORMAL', 'CAUSIL MESTRA', 'josedaniel@gmail.com', '123', 2, 1077, 1),
(12, 'brayan', 'machado', 'brayanmachado2@gmail.com', '123', 2, 1077, 1),
(6473874, 'BRAYAN ALBERTO', 'MACHADO RODRIGUEZ', 'brayanmachado2015@gmail.com', '123', 1, 1077, 1),
(1003397093, 'CLIENTE', 'REGULAR', 'cliente@gmail.com', '123', 2, 1077, 1),
(1003397094, 'BRAYAN M', 'RODRIGUEZ', 'brayanmachado0513@gmail.com', '123456', 2, 1077, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `idzona` int NOT NULL,
  `nombre_zona` varchar(45) DEFAULT NULL,
  `fk_pais` int DEFAULT NULL,
  `fk_departamento` int DEFAULT NULL,
  `fk_ciudad` int DEFAULT NULL,
  `estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`idzona`, `nombre_zona`, `fk_pais`, `fk_departamento`, `fk_ciudad`, `estado`) VALUES
(1077, 'MONTERIA', 1, 1, 1, 1),
(1390, 'PLANETA RICA', 1, 1, 4, 1),
(1409, 'AYAPEL', 1, 1, 3, 1),
(1431, 'CERETE', 1, 1, 5, 1),
(1692, 'MONTELIBANO', 1, 1, 2, 1),
(1696, 'LORICA', 1, 1, 6, 1),
(1703, 'SAHAGUN', 1, 1, 7, 1),
(1708, 'TIERRALTA', 1, 1, 8, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos_fijos`
--
ALTER TABLE `activos_fijos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cedula` (`fk_cedula`),
  ADD KEY `fk_idcentrocosto` (`fk_idcentrocosto`),
  ADD KEY `fk_desti_id` (`fk_desti_id`),
  ADD KEY `fk_idtipoactivos` (`fk_idtipoactivos`),
  ADD KEY `fk_ubica_id` (`fk_ubica_id`),
  ADD KEY `fk_idmarcas` (`fk_idmarcas`),
  ADD KEY `fk_idjerarquiactivo` (`fk_idjerarquiactivo`),
  ADD KEY `fk_idzona` (`fk_idzona`),
  ADD KEY `fk_idprovedor` (`fk_idprovedor`),
  ADD KEY `fk_producto` (`nombre_producto`),
  ADD KEY `fk_estado` (`estado`),
  ADD KEY `activofijo_repuesto` (`activofijo_repuesto`),
  ADD KEY `num_placa_activo` (`num_placa_activo`);

--
-- Indices de la tabla `activos_solicitud`
--
ALTER TABLE `activos_solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_activo` (`id_activo`),
  ADD KEY `estado` (`estado`),
  ADD KEY `fk_id_usuario_destino` (`id_usuario_destino`),
  ADD KEY `fk_destino_inicial` (`destino_inicial`),
  ADD KEY `fk_ubicacion_inical` (`ubicacion_inicial`);

--
-- Indices de la tabla `centrocosto`
--
ALTER TABLE `centrocosto`
  ADD PRIMARY KEY (`idcentrocosto`),
  ADD KEY `fk_idzona` (`fk_idzona`),
  ADD KEY `centrocosto_fk_pais` (`fk_pais`),
  ADD KEY `centrocosto_fk_departamento` (`fk_departamento`),
  ADD KEY `centrocosto_fk_ciudad` (`fk_ciudad`),
  ADD KEY `fk_estadoc` (`estado`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departamento` (`id_departamento`) USING BTREE,
  ADD KEY `fk_estadoci` (`estado`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pais` (`id_pais`) USING BTREE,
  ADD KEY `fk_estadode` (`estado`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`desti_id`),
  ADD KEY `fk_idcentrocosto` (`fk_idcentrocosto`),
  ADD KEY `fk_pais` (`fk_pais`),
  ADD KEY `fk_departamento` (`fk_departamento`),
  ADD KEY `fk_ciudad` (`fk_ciudad`),
  ADD KEY `fk_estadodes` (`estado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadotraslado`
--
ALTER TABLE `estadotraslado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cedula` (`fk_cedula`),
  ADD KEY `fk_idcentrocosto` (`fk_idcentrocosto`),
  ADD KEY `fk_desti_id` (`fk_desti_id`),
  ADD KEY `fk_idtipoactivos` (`fk_idtipoactivos`),
  ADD KEY `fk_ubica_id` (`fk_ubica_id`),
  ADD KEY `fk_idmarcas` (`fk_idmarcas`),
  ADD KEY `fk_idjerarquiactivo` (`fk_idjerarquiactivo`),
  ADD KEY `fk_idzona` (`fk_idzona`),
  ADD KEY `fk_idprovedor` (`fk_idprovedor`),
  ADD KEY `fk_productos` (`nombre_producto`),
  ADD KEY `fk_estado_i` (`estado`),
  ADD KEY `num_placa_inventario` (`num_placa_inventario`),
  ADD KEY `fk_activo` (`activofijo_asociado`);

--
-- Indices de la tabla `jerarquiactivo`
--
ALTER TABLE `jerarquiactivo`
  ADD PRIMARY KEY (`idjerarquiactivo`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarcas`),
  ADD KEY `fk_estadomar` (`estado`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estadopa` (`estado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estadopro` (`estado`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`idprovedor`),
  ADD KEY `fk_estadoprovedor` (`estado`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idroles`),
  ADD KEY `fk_estadorol` (`estado`);

--
-- Indices de la tabla `solicitudes_transferencia`
--
ALTER TABLE `solicitudes_transferencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_origen` (`usuario_origen`),
  ADD KEY `usuario_destino` (`usuario_destino`),
  ADD KEY `centro_costo` (`centro_costo`),
  ADD KEY `destino` (`destino`),
  ADD KEY `ubicacion` (`ubicacion`),
  ADD KEY `estado` (`estado`),
  ADD KEY `fk_idzona` (`zona`);

--
-- Indices de la tabla `tipoactivos`
--
ALTER TABLE `tipoactivos`
  ADD PRIMARY KEY (`idtipoactivos`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`ubica_id`),
  ADD KEY `fk_desti_id` (`fk_desti_id`),
  ADD KEY `ubicacion_fk_pais` (`fk_pais`),
  ADD KEY `ubicacion_fk_departamento` (`fk_departamento`),
  ADD KEY `ubicacion_fk_ciudad` (`fk_ciudad`),
  ADD KEY `fk_estadoubi` (`estado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`identificacion`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `fk_idroles` (`rol`),
  ADD KEY `fk_idzona` (`fk_idzona`),
  ADD KEY `fk_estadousu` (`estado`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`idzona`),
  ADD KEY `zona_fk_pais` (`fk_pais`) USING BTREE,
  ADD KEY `zona_fk_ciudad` (`fk_ciudad`) USING BTREE,
  ADD KEY `zona_fk_departamento` (`fk_departamento`) USING BTREE,
  ADD KEY `fk_estadozona` (`estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activos_fijos`
--
ALTER TABLE `activos_fijos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `activos_solicitud`
--
ALTER TABLE `activos_solicitud`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estadotraslado`
--
ALTER TABLE `estadotraslado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3456;

--
-- AUTO_INCREMENT de la tabla `solicitudes_transferencia`
--
ALTER TABLE `solicitudes_transferencia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activos_fijos`
--
ALTER TABLE `activos_fijos`
  ADD CONSTRAINT `activos_fijos_ibfk_1` FOREIGN KEY (`fk_cedula`) REFERENCES `usuarios` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_10` FOREIGN KEY (`fk_idprovedor`) REFERENCES `provedor` (`idprovedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_2` FOREIGN KEY (`fk_cedula`) REFERENCES `usuarios` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_3` FOREIGN KEY (`fk_idcentrocosto`) REFERENCES `centrocosto` (`idcentrocosto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_4` FOREIGN KEY (`fk_desti_id`) REFERENCES `destino` (`desti_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_5` FOREIGN KEY (`fk_idtipoactivos`) REFERENCES `tipoactivos` (`idtipoactivos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_6` FOREIGN KEY (`fk_ubica_id`) REFERENCES `ubicacion` (`ubica_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_7` FOREIGN KEY (`fk_idmarcas`) REFERENCES `marca` (`idmarcas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_8` FOREIGN KEY (`fk_idjerarquiactivo`) REFERENCES `jerarquiactivo` (`idjerarquiactivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activos_fijos_ibfk_9` FOREIGN KEY (`fk_idzona`) REFERENCES `zona` (`idzona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `fk_inventario` FOREIGN KEY (`activofijo_repuesto`) REFERENCES `inventarios` (`num_placa_inventario`),
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`nombre_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `activos_solicitud`
--
ALTER TABLE `activos_solicitud`
  ADD CONSTRAINT `activos_solicitud_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes_transferencia` (`id`),
  ADD CONSTRAINT `activos_solicitud_ibfk_2` FOREIGN KEY (`id_activo`) REFERENCES `activos_fijos` (`num_placa_activo`),
  ADD CONSTRAINT `activos_solicitud_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `estadotraslado` (`id`),
  ADD CONSTRAINT `fk_destino_inicial` FOREIGN KEY (`destino_inicial`) REFERENCES `destino` (`desti_id`),
  ADD CONSTRAINT `fk_id_usuario_destino` FOREIGN KEY (`id_usuario_destino`) REFERENCES `usuarios` (`identificacion`),
  ADD CONSTRAINT `fk_ubicacion_inical` FOREIGN KEY (`ubicacion_inicial`) REFERENCES `ubicacion` (`ubica_id`);

--
-- Filtros para la tabla `centrocosto`
--
ALTER TABLE `centrocosto`
  ADD CONSTRAINT `centrocosto_fk_ciudad` FOREIGN KEY (`fk_ciudad`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `centrocosto_fk_departamento` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id`),
  ADD CONSTRAINT `centrocosto_fk_pais` FOREIGN KEY (`fk_pais`) REFERENCES `pais` (`id`),
  ADD CONSTRAINT `centrocosto_ibfk_1` FOREIGN KEY (`fk_idzona`) REFERENCES `zona` (`idzona`),
  ADD CONSTRAINT `centrocosto_ibfk_2` FOREIGN KEY (`fk_idzona`) REFERENCES `zona` (`idzona`),
  ADD CONSTRAINT `fk_estadoc` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estadoci` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estadode` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `destino`
--
ALTER TABLE `destino`
  ADD CONSTRAINT `destino_ibfk_1` FOREIGN KEY (`fk_idcentrocosto`) REFERENCES `centrocosto` (`idcentrocosto`),
  ADD CONSTRAINT `destino_ibfk_2` FOREIGN KEY (`fk_idcentrocosto`) REFERENCES `centrocosto` (`idcentrocosto`),
  ADD CONSTRAINT `destino_ibfk_3` FOREIGN KEY (`fk_idcentrocosto`) REFERENCES `centrocosto` (`idcentrocosto`),
  ADD CONSTRAINT `fk_ciudad` FOREIGN KEY (`fk_ciudad`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id`),
  ADD CONSTRAINT `fk_estadodes` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`fk_pais`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `fk_activo` FOREIGN KEY (`activofijo_asociado`) REFERENCES `activos_fijos` (`num_placa_activo`),
  ADD CONSTRAINT `fk_cedula_u` FOREIGN KEY (`fk_cedula`) REFERENCES `usuarios` (`identificacion`),
  ADD CONSTRAINT `fk_centrocosto` FOREIGN KEY (`fk_idcentrocosto`) REFERENCES `centrocosto` (`idcentrocosto`),
  ADD CONSTRAINT `fk_destino` FOREIGN KEY (`fk_desti_id`) REFERENCES `destino` (`desti_id`),
  ADD CONSTRAINT `fk_estado_i` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `fk_jerarquiainventario` FOREIGN KEY (`fk_idjerarquiactivo`) REFERENCES `jerarquiactivo` (`idjerarquiactivo`),
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`fk_idmarcas`) REFERENCES `marca` (`idmarcas`),
  ADD CONSTRAINT `fk_productos` FOREIGN KEY (`nombre_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `fk_provedor` FOREIGN KEY (`fk_idprovedor`) REFERENCES `provedor` (`idprovedor`),
  ADD CONSTRAINT `fk_tipoactivos` FOREIGN KEY (`fk_idtipoactivos`) REFERENCES `tipoactivos` (`idtipoactivos`),
  ADD CONSTRAINT `fk_ubicacion` FOREIGN KEY (`fk_ubica_id`) REFERENCES `ubicacion` (`ubica_id`),
  ADD CONSTRAINT `fk_zona` FOREIGN KEY (`fk_idzona`) REFERENCES `zona` (`idzona`);

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `fk_estadomar` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `fk_estadopa` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_estadopro` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD CONSTRAINT `fk_estadoprovedor` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `fk_estadorol` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `solicitudes_transferencia`
--
ALTER TABLE `solicitudes_transferencia`
  ADD CONSTRAINT `fk_idzona` FOREIGN KEY (`zona`) REFERENCES `zona` (`idzona`),
  ADD CONSTRAINT `solicitudes_transferencia_ibfk_1` FOREIGN KEY (`usuario_origen`) REFERENCES `usuarios` (`identificacion`),
  ADD CONSTRAINT `solicitudes_transferencia_ibfk_2` FOREIGN KEY (`usuario_destino`) REFERENCES `usuarios` (`identificacion`),
  ADD CONSTRAINT `solicitudes_transferencia_ibfk_3` FOREIGN KEY (`centro_costo`) REFERENCES `centrocosto` (`idcentrocosto`),
  ADD CONSTRAINT `solicitudes_transferencia_ibfk_4` FOREIGN KEY (`destino`) REFERENCES `destino` (`desti_id`),
  ADD CONSTRAINT `solicitudes_transferencia_ibfk_5` FOREIGN KEY (`ubicacion`) REFERENCES `ubicacion` (`ubica_id`),
  ADD CONSTRAINT `solicitudes_transferencia_ibfk_6` FOREIGN KEY (`estado`) REFERENCES `estadotraslado` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD CONSTRAINT `fk_estadoubi` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `ubicacion_fk_ciudad` FOREIGN KEY (`fk_ciudad`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `ubicacion_fk_departamento` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id`),
  ADD CONSTRAINT `ubicacion_fk_pais` FOREIGN KEY (`fk_pais`) REFERENCES `pais` (`id`),
  ADD CONSTRAINT `ubicacion_ibfk_1` FOREIGN KEY (`fk_desti_id`) REFERENCES `destino` (`desti_id`),
  ADD CONSTRAINT `ubicacion_ibfk_2` FOREIGN KEY (`fk_desti_id`) REFERENCES `destino` (`desti_id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_estadousu` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idroles`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`fk_idzona`) REFERENCES `zona` (`idzona`);

--
-- Filtros para la tabla `zona`
--
ALTER TABLE `zona`
  ADD CONSTRAINT `fk_estadozona` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `zona_fk_ciudad` FOREIGN KEY (`fk_ciudad`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `zona_fk_departamento` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id`),
  ADD CONSTRAINT `zona_ibfk_1` FOREIGN KEY (`fk_pais`) REFERENCES `pais` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
