-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2016 a las 12:26:49
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL,
  `cod_categoria` varchar(20) DEFAULT NULL,
  `nombre_cat` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `mostrar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `cod_categoria`, `nombre_cat`, `descripcion`, `mostrar`) VALUES
(1, 'CAT_ALT', 'alternativa', 'Musica Alertnativa', 1),
(2, 'CAT_POP', 'pop', 'Musica Pop', 1),
(3, 'CAT_HIP', 'hip_hop', 'Musica hip hop', 1),
(4, 'CAT_ROC', 'rock', 'Musica rock', 1),
(5, 'CAT_ELE', 'electronica', 'Musica electronica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE IF NOT EXISTS `linea_pedido` (
  `id_LineaPedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  `importe` decimal(20,2) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `linea_pedido`
--

INSERT INTO `linea_pedido` (`id_LineaPedido`, `idPedido`, `idProducto`, `cantidad`, `precio`, `importe`, `iva`) VALUES
(1, 1, 5, 1, '20.70', '20.70', '21.00'),
(2, 2, 5, 1, '20.70', '20.70', '21.00'),
(3, 3, 5, 1, '20.70', '20.70', '21.00'),
(4, 4, 5, 1, '20.70', '20.70', '21.00'),
(5, 5, 5, 1, '20.70', '20.70', '21.00'),
(6, 5, 6, 2, '20.70', '41.40', '21.00'),
(7, 6, 5, 1, '20.70', '20.70', '21.00'),
(8, 6, 6, 2, '20.70', '41.40', '21.00'),
(9, 7, 5, 1, '20.70', '20.70', '21.00'),
(10, 7, 6, 2, '20.70', '41.40', '21.00'),
(11, 8, 5, 1, '20.70', '20.70', '21.00'),
(12, 8, 6, 2, '20.70', '41.40', '21.00'),
(13, 9, 5, 1, '20.70', '20.70', '21.00'),
(14, 9, 6, 2, '20.70', '41.40', '21.00'),
(15, 10, 6, 1, '20.70', '20.70', '21.00'),
(16, 12, 6, 2, '20.70', '41.40', '21.00'),
(17, 13, 6, 1, '20.70', '20.70', '21.00'),
(18, 13, 5, 1, '20.70', '20.70', '21.00'),
(19, 14, 6, 1, '20.70', '20.70', '21.00'),
(20, 15, 6, 1, '20.70', '20.70', '21.00'),
(21, 15, 4, 1, '20.70', '20.70', '21.00'),
(22, 16, 5, 1, '20.70', '20.70', '21.00'),
(23, 17, 5, 1, '20.70', '20.70', '21.00'),
(24, 18, 6, 1, '20.70', '20.70', '21.00'),
(25, 18, 5, 1, '20.70', '20.70', '21.00'),
(26, 19, 6, 1, '20.70', '20.70', '21.00'),
(27, 20, 6, 1, '20.70', '20.70', '21.00'),
(28, 21, 6, 1, '20.70', '20.70', '21.00'),
(29, 21, 5, 2, '20.70', '41.40', '21.00'),
(30, 22, 9, 6, '17.99', '107.94', '21.00'),
(31, 22, 5, 1, '20.70', '20.70', '21.00'),
(32, 23, 9, 6, '17.99', '107.94', '21.00'),
(33, 23, 5, 1, '20.70', '20.70', '21.00'),
(34, 24, 5, 12, '20.70', '248.40', '21.00'),
(35, 24, 12, 8, '9.50', '76.00', '21.00'),
(36, 25, 5, 12, '20.70', '248.40', '21.00'),
(37, 25, 12, 8, '9.50', '76.00', '21.00'),
(38, 26, 7, 1, '8.46', '8.46', '21.00'),
(39, 27, 10, 1, '15.50', '15.50', '21.00'),
(40, 28, 10, 10, '15.50', '155.00', '21.00'),
(41, 29, 66, 1, '13.50', '13.50', '21.00'),
(42, 30, 6, 2, '20.70', '41.40', '21.00'),
(43, 30, 10, 3, '15.50', '46.50', '21.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `importe` decimal(10,2) DEFAULT NULL,
  `cantidad_total` int(11) DEFAULT NULL,
  `estado` varchar(10) DEFAULT 'Pendiente',
  `fecha_pedido` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `cod_provincia` varchar(45) DEFAULT NULL,
  `correo` varchar(128) DEFAULT NULL,
  `importeiva` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `idUsuario`, `importe`, `cantidad_total`, `estado`, `fecha_pedido`, `direccion`, `cp`, `cod_provincia`, `correo`, `importeiva`) VALUES
(1, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(2, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(3, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(4, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(5, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(6, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(7, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(8, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(9, 2, '62.10', 3, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(10, 2, '20.70', 1, 'Anulado', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(11, 2, '0.00', 0, 'Pendiente', '2016-05-25', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(12, 2, '41.40', 2, 'Anulado', '2016-05-26', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(13, 2, '41.40', 2, 'Pendiente', '2016-05-26', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(14, 2, '20.70', 1, 'Pendiente', '2016-05-26', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(15, 2, '41.40', 2, 'Pendiente', '2016-05-26', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(16, 2, '20.70', 1, 'Pendiente', '2016-05-26', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', NULL),
(17, 2, '20.70', 1, 'Pendiente', '2016-05-26', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', '25.05'),
(18, 2, '41.40', 2, 'Pendiente', '2016-05-27', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', '50.09'),
(19, 2, '20.70', 1, 'Pendiente', '2016-05-27', 'Avda. Andalucía Nº85 2º', 21500, '01', 'mfmoradaw@gmail.com', '25.05'),
(20, 8, '20.70', 1, 'Anulado', '2016-05-30', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '25.05'),
(21, 8, '62.10', 3, 'Anulado', '2016-05-31', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '75.14'),
(22, 8, '128.64', 7, 'Anulado', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '155.65'),
(23, 8, '128.64', 7, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '155.65'),
(24, 8, '324.40', 20, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '392.52'),
(25, 8, '324.40', 20, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '392.52'),
(26, 8, '8.46', 1, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '10.24'),
(27, 8, '15.50', 1, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '18.75'),
(28, 8, '155.00', 10, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '50', 'mfmoradaw@gmail.com', '187.55'),
(29, 8, '13.50', 1, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '21', 'mfmoradaw@gmail.com', '16.33'),
(30, 9, '87.90', 5, 'Pendiente', '2016-06-07', 'Avda. Andalucía Nº85 2º', 21500, '21', 'mfmora2@gmail.com', '106.36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `cod_producto` varchar(20) DEFAULT NULL,
  `nombre_pro` varchar(100) DEFAULT NULL,
  `precio` decimal(7,2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL,
  `descripcion` text,
  `seleccionado` tinyint(1) DEFAULT NULL,
  `mostrar` tinyint(1) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `idCategoria`, `cod_producto`, `nombre_pro`, `precio`, `descuento`, `imagen`, `iva`, `descripcion`, `seleccionado`, `mostrar`, `fecha_inicio`, `fecha_fin`, `stock`) VALUES
(1, 1, 'CD_MUS', 'Muse - Drones', '21.50', '0.00', 'banner/1.jpg', '21.00', 'Nuevo disco de estudio de los MUSE que contiene canciones grandiosas y épicas de una de las bandas más grandes de los últimos años. Esta edición contiene un DVD con actuaciones en directo y material grabado en el estudio.', 2, 1, '2016-06-01', '2017-06-07', 11),
(2, 1, 'CD_COL', 'Coldplay - A Head Full Of Dreams', '18.99', '0.00', 'banner/2.jpg', '21.00', 'Coldplay, la banda británica de mayor éxito de la última década, publica su séptimo álbum de estudio.', 2, 1, '2016-06-01', '2017-06-07', 20),
(3, 1, 'CD_ADE', 'Adele - 25', '17.99', '0.00', 'banner/3.jpg', '21.00', 'Según palabras de ADELE, "este disco es un disco de reconciliación conmigo misma. Por el tiempo perdido, por todo aquello que hice y por lo que nunca llegué a hacer". "25" es un gran álbum que supone el regreso de ADELE después de "Skyfall"', 2, 1, '2016-06-01', '2017-06-07', 30),
(4, 1, 'CD_HUM', 'Human League - Reproduction', '23.00', '10.00', 'alternativo/1.jpg', '21.00', 'HUMAN LEAGUE - REPRODUCTION', 0, 1, '2016-06-01', '2017-06-07', 29),
(5, 1, 'CD_RED', 'Red Hot Chili Peppers - Red Hot Chilli Peppers', '23.00', '10.00', 'alternativo/2.jpg', '21.00', 'RED HOT CHILI PEPPERS - RED HOT CHILLI PEPPERS', 1, 1, '2016-06-01', '2017-06-07', 12),
(6, 1, 'CD_DIS', 'Disclosure - Settle', '23.00', '10.00', 'alternativo/3.jpg', '21.00', 'Guy y Howard Lawrence son oriundos de Reigate (Surrey) al Sudeste de Inglaterra y juntos forman el dúo #Disclosure# ', 0, 1, '2016-06-01', '2017-06-07', 13),
(7, 1, 'CD_NIR', 'Nirvana - Nevermind ', '9.50', '10.99', 'alternativo/4.jpg', '21.00', 'Se cumplen 20 años de la publicación del histórico álbum que llevó al éxito a la banda formada por Kurt Cobain', 1, 1, '2016-06-01', '2017-06-07', 10),
(8, 1, 'CD_JAY', 'Jayhawks - Paging Mr.proust', '17.99', '0.00', 'alternativo/5.jpg', '21.00', 'Nuevo trabajo de la banda estaunidiense Paging Mr. Proustproducido por el líder de la banda, el cantante y guitarrista Gary Lou', 0, 1, '2016-06-01', '2017-06-07', 11),
(9, 1, 'CD_POS', 'Posies - Solid States', '17.99', '0.00', 'alternativo/6.jpg', '21.00', 'The Posies vuelven a la carga en 2016, con nuevo disco, "Solid States.', 1, 1, '2016-06-01', '2017-06-07', 18),
(10, 1, 'CD_NEW', 'New Order - Complete Music', '15.50', '0.00', 'alternativo/7.jpg', '21.00', 'Incluye el álbum "Music complete" en Cd y cupón de descarga y los "extended mix" de cada tema publicados anteriormente en caja de vinilos.', 0, 1, '2016-06-01', '2017-06-07', 7),
(11, 1, 'CD_JAM', 'James Blake - The Colour In Anything', '16.99', '0.00', 'alternativo/8.jpg', '21.00', 'James Blake publica, por sorpresa,  su tercer álbum en Digital el viernes 6 de Mayo y el 20 en físico', 1, 1, '2016-06-01', '2017-06-07', 11),
(12, 1, 'CD_TID', 'Tides From Nebula - Eternal Movement', '9.50', '0.00', 'alternativo/9.jpg', '21.00', 'TIDES FROM NEBULA - ETERNAL MOVEMENT.', 0, 1, '2016-06-01', '2017-06-07', 12),
(13, 1, 'CD_LIV', 'Livingston - Animal', '9.50', '0.00', 'alternativo/10.jpg', '21.00', 'LIVINGSTON - ANIMAL.', 1, 1, '2016-06-01', '2017-06-07', 3),
(14, 2, 'CD_THE', 'The Pretty Reckless - Light Me Up', '18.50', '9.50', 'pop/1.jpg', '21.00', 'THE PRETTY RECKLESS - LIGHT ME UP', 0, 1, '2016-06-01', '2017-06-07', 11),
(15, 2, 'CD_BEY', 'Beyonce - Lemonade', '19.50', '25.50', 'pop/2.jpg', '21.00', 'LEMONADE, el sexto álbum de estudio de Beyoncé y su segundo álbum visual', 1, 1, '2016-06-01', '2017-06-07', 20),
(16, 2, 'CD_ADR', 'Adrian - Lleno De Vida', '15.50', '0.00', 'pop/3.jpg', '21.00', 'Lleno de Vida es sin duda un sueño cumplido. Un disco donde el joven malagueño Adrián Martín, canta a dúo con grandes artistas', 0, 1, '2016-06-01', '2017-06-07', 30),
(17, 2, 'CD_JOS', 'Jose Luis Perales - Calma', '16.99', '0.00', 'pop/4.jpg', '21.00', 'Indiscutiblemente uno de los artistas más prolíficos y exitosos de la escena española de los últimos cuarenta años.', 1, 1, '2016-06-01', '2017-06-07', 29),
(18, 2, 'CD_SER', 'Sergio Contreras - Sien7e', '13.99', '0.00', 'pop/5.jpg', '21.00', 'SERGIO CONTRERAS nos presenta su nuevo single MIEN7EME con la colaboración de Fernando Caro y la coproducción de Alejandro', 0, 1, '2016-06-01', '2017-06-07', 19),
(19, 2, 'CD_MIC', 'Michael Jackson - Thriller', '16.50', '0.00', 'pop/6.jpg', '21.00', 'MICHAEL JACKSON - THRILLER', 1, 1, '2016-06-01', '2017-06-07', 13),
(20, 2, 'CD_ALB', 'Alba Molina - Alba Canta A Lole Y Manuel', '8.99', '0.00', 'pop/7.jpg', '21.00', 'ALBA MOLINA Alba canta a Lole y Manuel Con la Guitarra de Joselito Acedo.', 0, 1, '2016-06-01', '2017-06-07', 11),
(21, 2, 'CD_ALE', 'Alex Ortiz - Sexto Sentido', '16.50', '0.00', 'pop/8.jpg', '21.00', 'Alex Ortiz es un magnífico baladista, que no hace ascos a la rumba con más ritmo o al Nuevo Flamenco', 1, 1, '2016-06-01', '2017-06-07', 11),
(22, 2, 'CD_BEB', 'Bebe - Cambio De Piel', '15.99', '0.00', 'pop/9.jpg', '21.00', 'Tras casi cuatro años de silencio, Bebe ha vuelto al estudio para grabar sus nuevas composiciones de la mano de Carlos Jean', 0, 1, '2016-06-01', '2017-06-07', 11),
(23, 2, 'CD_MAR', 'Marta Sanchez - 21 Dias', '10.99', '14.99', 'pop/10.jpg', '21.00', 'Marta Sánchez es autora de todas las canciones del disco junto a Daniel Terán, que además ha producido el trabajo junto a Pablo', 1, 1, '2016-06-01', '2017-06-07', 11),
(24, 3, 'CD_CHI', 'Chikos Del Maiz - Trap Mirror', '8.99', '0.00', 'hip_hop/1.jpg', '21.00', 'Se despiden a lo grande con cuatro bombazos, que como de costumbre arrojarán sal sobre la herida y no dejarán indiferente a nadie. El rap distópico ha llegado.', 0, 1, '2016-06-01', '2017-06-07', 19),
(25, 3, 'CD_VIO', 'Violadores Del Verso - Gira 06/07', '12.99', '0.00', 'hip_hop/2.jpg', '21.00', 'Nueva edición del celebrado CD/DVD de Violadores Del Verso en Jewelcase', 1, 1, '2016-06-01', '2017-06-07', 13),
(26, 3, 'CD_ARM', 'Arma X - Anticonstitucional', '8.99', '0.00', 'hip_hop/3.jpg', '21.00', 'El mundo es una cárcel gigante, vigila lo que dices, lo que haces, con quien te ves, los sitios que frecuentas,.', 0, 1, '2016-06-01', '2017-06-07', 11),
(27, 3, 'CD_EMI', 'Eminem - Encore(explicit)', '9.50', '18.50', 'hip_hop/4.jpg', '21.00', 'Alex Ortiz es un magnífico baladista, que no hace ascos a la rumba con más ritmo o al Nuevo Flamenco', 1, 1, '2016-06-01', '2017-06-07', 11),
(28, 3, 'CD_DJT', 'Dj T-kut and Dj Player - Wax Cutters', '10.50', '0.00', 'hip_hop/5.jpg', '21.00', 'Dj T-Kut y Dj Player presentan una herramienta esencial para la práctica del turntablism', 0, 1, '2016-06-01', '2017-06-07', 11),
(29, 3, 'CD_DAR', 'Dark La Eme - 7 Años En La Vida De', '10.50', '12.99', 'hip_hop/6.jpg', '21.00', 'LEMONADE, el sexto álbum de estudio de Beyoncé y su segundo álbum visual', 1, 1, '2016-06-01', '2017-06-07', 20),
(30, 3, 'CD_ACC', 'Accion Sanchez and Hazhe - Monkey Breaks', '14.99', '0.00', 'hip_hop/7.jpg', '21.00', 'Vinilo de batalla a la vieja usanza: dos de los más reconocidos productores de la escena, Acción Sanchez and Hazhe, unen esfuerzos', 0, 1, '2016-06-01', '2017-06-07', 30),
(31, 3, 'CD_RAY', 'Rayden - En Alma Y Hueso', '16.50', '0.00', 'hip_hop/8.jpg', '21.00', '"Sorteo "PUMA" de camiseta y zapatillas "Suede" entre todos los compradores del CD. El sorteo se celebrará el día 12 de diciembre.', 1, 1, '2016-06-01', '2017-06-07', 29),
(32, 3, 'CD_ELP', 'Elphomega - Homogeddon/el Testimonio Libra', '7.99', '15.99', 'hip_hop/9.jpg', '21.00', 'Tras casi cuatro años de silencio, Bebe ha vuelto al estudio para grabar sus nuevas composiciones de la mano de Carlos Jean', 0, 1, '2016-06-01', '2017-06-07', 11),
(33, 3, 'CD_DIO', 'Dios Ke Crew - Humanose', '14.99', '0.00', 'hip_hop/10.jpg', '21.00', 'Hablar de Dios Ke Te Krew es hablar de años de experiencia en escenarios en cientos de conciertos abarrotados', 1, 1, '2016-06-01', '2017-06-07', 11),
(44, 4, 'CD_ERI', 'Eric Clapton- An Appreciati', '7.99', '16.99', 'rock/1.jpg', '21.00', 'Eric Clapton tras años de admirar la obra de JJ Cale y de haber realizado varias versiones de canciones como After Midnight', 0, 1, '2016-06-01', '2017-06-07', 19),
(45, 4, 'CD_MOL', 'Molotov - Donde Jugaran Las Niñas?', '9.50', '11.99', 'rock/2.jpg', '21.00', 'MOLOTOV - DONDE JUGARAN LAS NIÑAS?', 1, 1, '2016-06-01', '2017-06-07', 13),
(46, 4, 'CD_BAD', 'Bad Company - Live In Concert 1977 and 1979', '19.99', '0.00', 'rock/3.jpg', '21.00', 'A pesar de su reputación como una de las bandas de directo más interesantes de la escena rock de los años 70.', 0, 1, '2016-06-01', '2017-06-07', 11),
(47, 4, 'CD_ZZT', 'Zz Top - La Futura', '9.50', '16.50', 'rock/4.jpg', '21.00', 'Despues de casi una década de sequía se publica #La Futura#, el decimoquinto trabajo de estudio del grupo texano ZZ ', 1, 1, '2016-06-01', '2017-06-07', 11),
(48, 4, 'CD_TRE', 'T. Rex - Electric Warrior', '9.50', '0.00', 'rock/5.jpg', '21.00', 'Electric Warrior fue grabado en 1971 y es considerado la quintaesencia del Glam Rock , encumbrando a su lider Marc Bolan', 0, 1, '2016-06-01', '2017-06-07', 11),
(49, 4, 'CD_SUP', 'Supertramp - Crime Of The Century', '9.50', '0.00', 'rock/6.jpg', '21.00', 'Dentro de las mejores composiciones del dúo formado por Rick Davies y  Roger Hodgson', 1, 1, '2016-06-01', '2017-06-07', 20),
(50, 4, 'CD_CRE', 'Creedence Clearwater - Green River - Remastered', '9.50', '10.50', 'rock/7.jpg', '21.00', 'CREEDENCE CLEARWATER - GREEN RIVER - REMASTERED', 0, 1, '2016-06-01', '2017-06-07', 30),
(51, 4, 'CD_JEA', 'Jean Michel Jarre - Electronica 2:the Heart Of Noise', '18.50', '0.00', 'rock/8.jpg', '21.00', 'JEAN MICHEL JARRE - ELECTRONICA 2:THE HEART OF NOISE.', 1, 1, '2016-06-01', '2017-06-07', 29),
(52, 4, 'CD_BRO', 'Brother Firetribe - Diamond In The Firepit', '13.99', '0.00', 'rock/9.jpg', '21.00', '"Diamond in the firepit" es el tercer álbum de esta banda finlandesa y se convertirá en la banda sonora del próximo verano.', 0, 1, '2016-06-01', '2017-06-07', 11),
(53, 4, 'CD_SHO', 'The Short Fuses - Duchess Hustle', '3.99', '0.00', 'rock/10.jpg', '21.00', 'THE SHORT FUSES - DUCHESS HUSTLE', 0, 1, '2016-06-01', '2017-06-07', 11),
(64, 5, 'CD_D80', 'Varios Electronica/dance - Disco 80', '17.99', '0.00', 'electronica/1.jpg', '21.00', 'Tras el éxito de Disco 90, Blanco y Negro lanza Disco 80, un álbum que contiene los sonidos más representativos de la época', 0, 1, '2016-06-01', '2017-06-07', 19),
(65, 5, 'CD_FES', 'Varios Electronica/dance - Festival Hits', '17.99', '0.00', 'electronica/2.jpg', '21.00', 'Blanco y Negro presenta el álbum más completo de la cultura EDM', 1, 1, '2016-06-01', '2017-06-07', 13),
(66, 5, 'CD_TIG', 'Tiga - No Fantasy Required', '13.50', '0.00', 'electronica/3.jpg', '21.00', 'Muchas cosas han podido cambiar en la escena dance desde el último álbum de canciones de Tiga, pero él sigue siendo un valor seguro.', 0, 1, '2016-06-01', '2017-06-07', 10),
(67, 5, 'CD_MOD', 'Moderat - Iii', '9.50', '16.50', 'electronica/4.jpg', '21.00', 'MODERAT - III', 1, 1, '2016-06-01', '2017-06-07', 11),
(68, 5, 'CD_CIR', 'Circles - Structures Unreleased Material 1985-1989', '15.99', '0.00', 'electronica/5.jpg', '21.00', 'Circles, compuesto por Mike Bohrmann y Dierk Leitert, vio la luz por primera vez en el año 1983', 1, 1, '2016-06-01', '2017-06-07', 11),
(69, 5, 'CD_TWO', 'Two Door Cinema Club - Beacon+changing Of The Seasons', '9.99', '13.99', 'electronica/6.jpg', '21.00', '"No ha pasado apenas un año desde que Two Door Cinema Club lanzara ""Beacon"", su segundo larga duración', 0, 1, '2016-06-01', '2017-06-07', 20),
(70, 5, 'CD_PAR', 'Varios Electronica/baile - Paris Lounge', '6.99', '19.50', 'electronica/7.jpg', '21.00', 'Los sonidos Cool Tempo del París de hoy en día', 1, 1, '2016-06-01', '2017-06-07', 30),
(71, 5, 'CD_PIN', 'Pinker Tones - Life In Stereo', '5.50', '14.50', 'electronica/8.jpg', '21.00', 'LIFE IN STEREO es la banda sonora original de una película que aún no existe..', 0, 1, '2016-06-01', '2017-06-07', 29),
(72, 5, 'CD_DAF', 'Daft Punk - Musique V.1 1993-2005', '7.99', '19.50', 'electronica/9.jpg', '21.00', 'DAFT PUNK - MUSIQUE V.1 1993-2005', 1, 1, '2016-06-01', '2017-06-07', 11),
(73, 5, 'CD_SHA', 'Dj Shadow - Entroducing(deluxe Edition)', '3.99', '0.00', 'electronica/10.jpg', '21.00', 'DJ SHADOW - ENTRODUCING(DELUXE EDITION)', 0, 1, '2016-06-01', '2017-06-07', 11),
(84, 1, 'CD_LAS', 'THE LAST SHADOW PUPPETS', '7.50', '16.99', 'alternativo/11.jpg', '21.00', 'Last shadow puppets.', 0, 1, '2016-06-01', '2017-06-07', 11),
(85, 1, 'CD_TOM', 'TOM MCRAE - ALPHABET OF HURRI', '18.99', '0.00', 'alternativo//12.jpg', '21.00', 'Tom mcrae.', 0, 1, '2016-06-01', '2017-06-07', 20),
(86, 2, 'CD_BRA', '¡BRAVO! 2014', '16.99', '0.00', 'pop/11.jpg', '21.00', '¡BRAVO! 2014.', 0, 1, '2016-06-01', '2017-06-07', 11),
(87, 2, 'CD_MEC', 'MECANO - ¿DONDE ESTA EL PAIS..?', '9.50', '0.00', 'pop/12.jpg', '21.00', 'MECANO - ¿DONDE ESTA EL PAIS..?.', 0, 1, '2016-06-01', '2017-06-07', 20),
(88, 3, 'CD_DOM', '14 SHOTS TO THE DOME', '7.99', '10.50', 'hip_hop/11.jpg', '21.00', 'Ll cool j', 0, 1, '2016-06-01', '2017-06-07', 11),
(89, 3, 'CD_PRI', 'Primer dan - 1ERDAN', '4.95', '13.99', 'hip_hop/12.jpg', '21.00', 'Primer dan - 1ERDAN.', 0, 1, '2016-06-01', '2017-06-07', 20),
(90, 4, 'CD_SAN', 'SANTANA - CLASSIC', '5.99', '0.00', 'rock/11.jpg', '21.00', 'Santana', 0, 1, '2016-06-01', '2017-06-07', 11),
(91, 4, 'CD_STI', 'Sting - ...ALL THIS TIME', '4.95', '13.99', 'rock/12.jpg', '21.00', 'Sting - ...ALL THIS TIME.', 0, 1, '2016-06-01', '2017-06-07', 20),
(92, 5, 'CD_SOF', '12 S OF PLEASURE - PART III', '17.99', '18.50', 'electronica/11.jpg', '21.00', '12 S OF PLEASURE - PART III', 0, 1, '2016-06-01', '2017-06-07', 11),
(93, 5, 'CD_FAC', 'FAC. DANCE: FACTORY RECORDS 1', '19.50', '0.00', 'electronica/12.jpg', '21.00', 'FAC. DANCE: FACTORY RECORDS 1.', 0, 1, '2016-06-01', '2017-06-07', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `cod` char(2) NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos',
  `nombre` varchar(50) DEFAULT '' COMMENT 'Nombre de la provincia',
  `comunidad_id` tinyint(4) DEFAULT NULL COMMENT 'Código de la comunidad a la que pertenece'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cod`, `nombre`, `comunidad_id`) VALUES
('01', 'Alava', 16),
('02', 'Albacete', 7),
('03', 'Alicante', 10),
('04', 'Almería', 1),
('05', 'Avila', 8),
('06', 'Badajoz', 11),
('07', 'Balears (Illes)', 4),
('08', 'Barcelona', 9),
('09', 'Burgos', 8),
('10', 'Cáceres', 11),
('11', 'Cádiz', 1),
('12', 'Castellón', 10),
('13', 'Ciudad Real', 7),
('14', 'Córdoba', 1),
('15', 'Coruña (A)', 12),
('16', 'Cuenca', 7),
('17', 'Girona', 9),
('18', 'Granada', 1),
('19', 'Guadalajara', 7),
('20', 'Guipzcoa', 16),
('21', 'Huelva', 1),
('22', 'Huesca', 2),
('23', 'Jaén', 1),
('24', 'León', 8),
('25', 'Lleida', 9),
('26', 'Rioja (La)', 17),
('27', 'Lugo', 12),
('28', 'Madrid', 13),
('29', 'Málaga', 1),
('30', 'Murcia', 14),
('31', 'Navarra', 15),
('32', 'Ourense', 12),
('33', 'Asturias', 3),
('34', 'Palencia', 8),
('35', 'Palmas (Las)', 5),
('36', 'Pontevedra', 12),
('37', 'Salamanca', 8),
('38', 'Santa Cruz de Tenerife', 5),
('39', 'Cantabria', 6),
('40', 'Segovia', 8),
('41', 'Sevilla', 1),
('42', 'Soria', 8),
('43', 'Tarragona', 9),
('44', 'Teruel', 2),
('45', 'Toledo', 7),
('46', 'Valencia', 10),
('47', 'Valladolid', 8),
('48', 'Vizcaya', 16),
('49', 'Zamora', 8),
('50', 'Zaragoza', 2),
('51', 'Ceuta', 18),
('52', 'Melilla', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `cod_provincia` char(2) NOT NULL,
  `nombre_usu` varchar(30) DEFAULT NULL,
  `clave` varchar(260) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `correo` varchar(180) DEFAULT NULL,
  `nombre_persona` varchar(40) DEFAULT NULL,
  `apellidos_persona` varchar(60) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT 'A'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `cod_provincia`, `nombre_usu`, `clave`, `dni`, `correo`, `nombre_persona`, `apellidos_persona`, `direccion`, `cp`, `estado`) VALUES
(1, '21', 'isacm94', '$2y$10$9isiSYMKQrfYA.p7jZqbaej9Hs/VqQuLH/FdwNyPHGKYg2821PTEm', '44248212f', 'isacm94@gmail.com', 'Isabel María', 'Calvo Mateos', 'Calle Cabreros, 36', 21720, 'A'),
(2, '01', '  mfmora', '$2y$10$.XZDUU1mXErAbJMp4wBqrusO7FuEpUE/CkJSgHbgrTyFg1UHRatHm', '29056491Q', 'mfmoradaw@gmail.com', 'Manuel Francisco', 'Martín', 'Avda. Andalucía Nº85 2º', 21500, 'A'),
(3, '51', 'admin', '$2y$10$7lH0K8cSg8IEbPiTsabOaODC9oVJHaQ5KJd9WmTTb5fQ6JgIxuKby', '44248212f', 'isacm94@gmail.com', 'Admin', 'Admin Admin', 'Calle Huelva, 36', 21453, 'A'),
(8, '21', 'mfmora2', '$2y$10$ebl1ldF3MLQOylLSLxzF3e5CmcCkn/R/QPPP7QwCxTISOTMFKBFmq', '29056491Q', 'mfmoradaw@gmail.com', 'Manuel Francisco', 'Moara', 'Avda. Andalucía Nº85 2º', 21505, 'A'),
(9, '21', 'Inma', '$2y$10$45tCFkoTjqNeckki7XM55.wfQMjaJQxwMrkSeskNHKCppxqn08kl6', '44209697V', 'mfmora2@gmail.com', 'Inma', 'Ramos', 'Avda. Andalucía Nº85 2º', 21500, 'A'),
(10, '21', 'pepe', '$2y$10$9vf83e5WqR/lQC9wSM9ssOsploObvnmPNR9eILTbIynGrQhnmJK6O', '29056491Q', 'pepera@gmail.com', 'Pepe', 'Bebeia', 'Avda. Andalucía Nº25', 21500, 'B'),
(11, '21', 'pepe2', '$2y$10$pxVVpRc0W/8afMbOah8/6eF2VMJ4Z/eQMuRihr5tDwQtlfBMNqICm', '29056491Q', 'pepera@gmail.com', 'Pepe', 'Bebeia', 'Avda. Andalucía Nº25', 21500, 'B');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD UNIQUE KEY `cod_categoria_UNIQUE` (`cod_categoria`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD PRIMARY KEY (`id_LineaPedido`),
  ADD KEY `fk_Venta_has_Producto_Producto1_idx` (`idProducto`),
  ADD KEY `fk_Linea_Pedido_Pedido1_idx` (`idPedido`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `fk_Pedido_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `codigo_cam_UNIQUE` (`cod_producto`),
  ADD KEY `fk_Producto_Categoria_idx` (`idCategoria`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `FK_ComunidadAutonomaProv` (`comunidad_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombre_usu_UNIQUE` (`nombre_usu`),
  ADD KEY `fk_Usuario_tbl_provincias1_idx` (`cod_provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  MODIFY `id_LineaPedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_tbl_provincias1` FOREIGN KEY (`cod_provincia`) REFERENCES `provincias` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
