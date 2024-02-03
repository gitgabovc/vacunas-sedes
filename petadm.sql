-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 19-09-2022 a las 19:31:00
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `petadm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `foto`) VALUES
(1, 'auwfar', 'f0a047143d1da15b630c73f0256d5db0', 'Guillermo Rojas', 'Koala.jpg'),
(2, 'ozil', '202cb962ac59075b964b07152d234b70', 'Victor Rivas B.', 'profil2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brigadas`
--

CREATE TABLE `brigadas` (
  `id` int(11) NOT NULL,
  `responsable_id` int(11) NOT NULL,
  `nrobrigada` int(11) NOT NULL,
  `lugar` varchar(225) NOT NULL,
  `fechas_id` int(11) NOT NULL,
  `dosis` int(11) NOT NULL,
  `add_at` datetime NOT NULL DEFAULT current_timestamp(),
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `brigadas`
--

INSERT INTO `brigadas` (`id`, `responsable_id`, `nrobrigada`, `lugar`, `fechas_id`, `dosis`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 1, 3, 'de la rosa', 2, 4, '2022-09-09 12:33:00', NULL, NULL),
(2, 2, 56, 'papapaulo', 3, 2, '2022-09-09 12:33:00', NULL, NULL),
(3, 4, 3, 'juan azurdui', 3, 4, '2022-09-09 12:33:00', NULL, NULL),
(4, 5, 13, 'papapaulo', 7, 2, '2022-09-09 12:33:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campana`
--

CREATE TABLE `campana` (
  `id` int(11) NOT NULL,
  `tipo_campana_id` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `gestion` int(11) DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `vigente` varchar(1) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `campana`
--

INSERT INTO `campana` (`id`, `tipo_campana_id`, `descripcion`, `gestion`, `fechaini`, `fechafin`, `vigente`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 1, 'Vacunación Capinota IIa', 2022, '2022-08-23', '2022-07-15', '', '2022-07-11 01:07:37', '2022-08-24 06:08:52', NULL),
(4, 1, 'awdwad', 2022, '2022-08-17', '2022-08-10', '', '2022-08-17 07:08:45', NULL, NULL),
(5, 1, 'dwad', 2022, '2022-08-27', '2022-08-19', '', '2022-08-22 04:08:17', '2022-08-24 06:08:13', NULL),
(6, 1, 'dawd', 2022, '2022-08-14', '2022-08-24', '', '2022-08-22 05:08:53', NULL, NULL),
(7, 1, 'dawdawd', 2022, '2022-08-24', '2022-09-10', '', '2022-08-24 04:08:29', NULL, NULL),
(8, 1, 'vacunar gatos', 2022, '2022-08-23', '2022-09-03', '', '2022-08-24 04:08:31', NULL, NULL),
(9, 1, 'dawffafaf', 2019, '2022-08-29', '2022-08-30', '', '2022-08-29 02:08:57', NULL, NULL),
(10, 1, 'jhgg', 2019, '2022-08-29', '2022-08-30', '', '2022-08-29 02:08:22', NULL, NULL),
(11, 1, 'gfdghh', 2020, '2022-08-29', '2022-08-30', '', '2022-08-29 02:08:38', NULL, NULL),
(12, 1, 'gnhhhh', 2020, '2022-08-29', '2022-08-30', '', '2022-08-29 02:08:11', NULL, NULL),
(13, 1, 'ghgffrrrr', 2021, '2022-08-29', '2022-08-30', '', '2022-08-29 02:08:27', NULL, NULL),
(14, 1, 'hhtre', 2021, '2022-08-29', '2022-08-30', '', '2022-08-29 02:08:40', NULL, NULL),
(15, 1, 'daddada', 2022, '2022-09-04', '2022-09-09', '', '2022-09-04 12:09:42', NULL, NULL),
(16, 1, 'hogar', 2022, '2022-09-08', '2022-09-09', '', '2022-09-08 07:09:49', '2022-09-08 07:09:08', NULL),
(17, 1, 'cualqiera', 2019, '2022-09-13', '2022-09-15', NULL, '2022-09-13 04:09:18', NULL, NULL),
(18, 1, 'asdff', 2019, '2022-09-19', '2022-09-20', NULL, '2022-09-19 03:09:28', NULL, NULL),
(19, 1, 'avanzadas', 2022, '2022-09-19', '2022-09-20', NULL, '2022-09-19 03:09:55', '2022-09-19 03:09:13', '2022-09-19 03:09:31'),
(20, 1, 'avanzadas', 2019, '2022-09-19', '2022-09-20', NULL, '2022-09-19 03:09:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento`
--

CREATE TABLE `establecimiento` (
  `id` int(11) NOT NULL,
  `municipio_id` int(11) DEFAULT NULL,
  `nombre` varchar(65) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL,
  `codigo` varchar(50) NOT NULL,
  `responsable_id` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `establecimiento`
--

INSERT INTO `establecimiento` (`id`, `municipio_id`, `nombre`, `add_at`, `mod_at`, `del_at`, `codigo`, `responsable_id`) VALUES
(1, 1, 'LIBERTAD CENTRO H', '2022-07-07 00:00:00', '2022-08-25 07:08:49', NULL, '12', '1'),
(3, 2, 'ejemplo de establecimiento', NULL, '2022-08-16 06:08:59', NULL, '31', '2'),
(4, 1, 'otro establecimiento', '0000-00-00 00:00:00', '2022-08-16 06:08:04', NULL, '12', '2'),
(7, 1, 'kdhaskdhasj', '2022-08-16 09:08:18', '2022-09-19 03:09:55', NULL, '311', '1'),
(9, 1, 'sad', '2022-08-16 06:08:22', NULL, '2022-09-13 04:09:52', '1233', '4'),
(10, 2, 'awd', '2022-08-16 06:08:10', '2022-08-16 06:08:15', NULL, 'dwad', '1'),
(11, 1, 'awd', '2022-08-16 06:08:03', '2022-08-16 06:08:21', NULL, '21d', '2'),
(12, 2, 'awd', '2022-08-16 06:08:47', '2022-08-17 03:08:08', NULL, 'afe42', '3'),
(13, 2, 'juan', '2022-08-25 05:08:26', NULL, NULL, '6772', '4'),
(15, 1, 'aaaaaaaaaaaa', '2022-08-25 06:08:26', '2022-09-13 04:09:27', '2022-09-13 04:09:42', 'las', '5'),
(16, 1, 'dadada', '2022-08-25 07:08:06', NULL, NULL, 'dad', '6'),
(17, 1, 'aaaa', '2022-08-25 07:08:37', NULL, NULL, 'aaa', '1'),
(18, 1, 'juana azurduy', '2022-09-13 03:09:16', NULL, NULL, 'dbuoawdb23', ''),
(19, 1, 'juana azurduy', '2022-09-13 03:09:17', NULL, NULL, 'dbuoawdb23', ''),
(20, 1, 'juana azurduy', '2022-09-13 03:09:17', NULL, NULL, 'dbuoawdb23', ''),
(21, 1, 'juana azurduy', '2022-09-13 03:09:17', NULL, NULL, 'dbuoawdb23', ''),
(22, 1, 'juana azurduy', '2022-09-13 03:09:18', NULL, NULL, 'dbuoawdb23', ''),
(23, 1, 'juana azurduy', '2022-09-13 03:09:18', NULL, NULL, 'dbuoawdb23', ''),
(24, 1, 'juana azurduy', '2022-09-13 03:09:18', NULL, NULL, 'dbuoawdb23', ''),
(25, 1, 'juana azurduy', '2022-09-13 03:09:18', NULL, NULL, 'dbuoawdb23', ''),
(26, 1, 'juana azurduy', '2022-09-13 03:09:18', NULL, NULL, 'dbuoawdb23', ''),
(27, 1, 'awdawd', '2022-09-13 03:09:16', NULL, NULL, 'dwadwa', '2'),
(28, 1, 'juanita azurduy', '2022-09-13 03:09:09', NULL, NULL, 'dabjdk423', '1'),
(29, 1, 'dadwa', '2022-09-13 04:09:33', NULL, NULL, 'dwa323', '2'),
(30, 1, 'abc', '2022-09-19 03:09:47', NULL, NULL, '323da', ''),
(31, 1, 'abc', '2022-09-19 03:09:49', NULL, NULL, '323da', ''),
(32, 1, 'mercedes', '2022-09-19 03:09:18', NULL, '2022-09-19 03:09:12', '32893da', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE `fechas` (
  `id` int(11) NOT NULL,
  `campana_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`id`, `campana_id`, `establecimiento_id`, `add_at`, `mod_at`, `del_at`) VALUES
(2, 1, 1, NULL, '2022-08-23 04:08:55', NULL),
(3, 4, 1, NULL, NULL, NULL),
(7, 1, 4, '2022-08-22 05:08:25', '2022-08-23 04:08:01', NULL),
(10, 5, 5, '2022-08-22 06:08:26', NULL, NULL),
(11, 4, 5, '2022-08-22 06:08:51', NULL, NULL),
(12, 1, 9, '2022-08-23 12:08:29', '2022-08-24 05:08:39', NULL),
(15, 6, 1, '2022-08-23 04:08:48', '2022-08-23 04:08:54', NULL),
(16, 6, 3, '2022-08-23 04:08:46', '2022-08-23 04:08:51', NULL),
(18, 6, 6, '2022-08-23 04:08:08', NULL, NULL),
(19, 6, 4, '2022-08-23 04:08:19', NULL, NULL),
(20, 6, 10, '2022-08-23 04:08:57', NULL, NULL),
(21, 6, 12, '2022-08-23 04:08:58', NULL, NULL),
(22, 4, 11, '2022-08-23 04:08:15', NULL, NULL),
(23, 9, 1, NULL, '2022-08-23 04:08:55', '2022-09-13 04:09:45'),
(24, 9, 1, NULL, NULL, NULL),
(25, 9, 4, '2022-08-22 05:08:25', '2022-08-23 04:08:01', NULL),
(26, 16, 1, '2022-09-08 07:09:20', NULL, NULL),
(27, 16, 3, '2022-09-08 07:09:27', NULL, NULL),
(28, 9, 7, '2022-09-13 04:09:36', NULL, NULL),
(29, 9, 7, '2022-09-13 04:09:21', NULL, NULL),
(30, 20, 1, '2022-09-19 03:09:14', '2022-09-19 03:09:26', NULL),
(31, 20, 13, '2022-09-19 03:09:20', '2022-09-19 03:09:32', '2022-09-19 03:09:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `raza_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `edad_meses` tinyint(4) DEFAULT NULL,
  `edad_anios` tinyint(4) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `propietario_id`, `raza_id`, `nombre`, `sexo`, `edad_meses`, `edad_anios`, `foto`, `color`, `tipo`, `estado`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 4, 1, 'diva', 'H', 3, 12, NULL, 'cafe', 'p', '1', NULL, NULL, NULL),
(2, 2, 1, 'bernardo', 'm', 12, 1, 'dwadw', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL),
(3, 3, 1, 'rodolfo', 'm', 12, 1, 'dwadw', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL),
(4, 1, 1, 'fabuidk', 'H', 3, 12, NULL, 'cafe', 'p', '1', NULL, NULL, NULL),
(5, 2, 1, 'dawdawd', 'm', 12, 1, 'dwadw', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL),
(6, 2, 1, 'bwadadrnardo', 'm', 12, 1, 'dwadwaaaaa', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL),
(7, 2, 1, 'awdawd', 'H', 3, 12, NULL, 'cafe', 'p', '1', NULL, NULL, NULL),
(8, 3, 1, 'aaaaaaaaa', 'm', 12, 1, 'dwadw', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL),
(9, 1, 1, 'dddddsdsd', 'm', 12, 1, 'dwadw', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL),
(10, 1, 1, 'qqqqqd', 'H', 3, 12, NULL, 'cafe', 'p', '1', NULL, NULL, NULL),
(11, 2, 1, 'wwwww', 'm', 12, 1, 'dwadw', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL),
(12, 4, 1, 'ggg', 'm', 12, 1, 'dwadwaaaaa', 'rojo', 'g', '1', '2022-08-26 09:12:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `nombre`, `add_at`, `mod_at`, `del_at`, `numero`) VALUES
(1, 'cercado1', '2022-07-07 00:00:00', '2022-09-19 03:09:23', NULL, 123),
(2, 'Quillacollo', '2022-07-11 09:07:44', NULL, NULL, 0),
(3, 'dgdfg fgdfg', '2022-07-11 09:07:51', '2022-07-11 09:07:56', '2022-07-11 09:07:00', 0),
(4, 'tarata', '2022-08-16 04:08:44', NULL, '2022-08-16 04:08:54', 0),
(5, 'cliza', '2022-08-16 05:08:34', NULL, '2022-08-16 05:08:32', 123),
(6, 'cercado2', '2022-09-19 03:09:16', NULL, '2022-09-19 03:09:36', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `id` int(11) NOT NULL,
  `ci` varchar(45) DEFAULT NULL,
  `nombre` varchar(65) DEFAULT NULL,
  `direccion` varchar(85) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `password` text NOT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`id`, `ci`, `nombre`, `direccion`, `telefono`, `password`, `add_at`, `mod_at`, `del_at`) VALUES
(1, '233223', 'marco', 'av suceia', '213213', 'marco', '2022-08-25 13:55:53', NULL, NULL),
(2, '2332233', 'marcodad', 'av suceiad', '213213', 'marcod', '2022-08-25 13:55:53', NULL, NULL),
(3, '2332232', 'mario', 'av suceia', '213213', 'marcodad', '2022-08-25 13:55:53', NULL, NULL),
(4, '2333', 'loan', 'av sucei', '213213', 'marcodda', '2022-08-25 13:55:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id`, `descripcion`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 'Raza común', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `ci` varchar(12) DEFAULT NULL,
  `password` text NOT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `responsable`
--

INSERT INTO `responsable` (`id`, `nombre`, `ci`, `password`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 'loan', '32', 'dadawd', '2022-08-25 14:02:00', NULL, NULL),
(2, 'juan', '23', 'dwa', NULL, NULL, NULL),
(3, 'mario', '2322', 'dwad', NULL, NULL, NULL),
(4, 'pablo', '3223', 'dadawddwad', '2022-08-25 14:02:00', NULL, NULL),
(5, 'roi', '2333', 'dwadaf', NULL, NULL, NULL),
(6, 'mardadaio', '2322', 'dwad', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_campana`
--

CREATE TABLE `tipo_campana` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_campana`
--

INSERT INTO `tipo_campana` (`id`, `descripcion`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 'Vacunacion Rural', '2022-07-11 11:07:46', '2022-07-11 11:07:59', NULL),
(2, 'Santa Cruz', '2022-07-11 11:07:04', NULL, '2022-07-11 11:07:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `nombre`, `establecimiento_id`, `estado`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 'Prueba1', '$2y$10$0I4KagW..ObXLipK/tEHC.2tnJSnLF9mvvsm//', 'Prueba Probando', 1, NULL, '2022-07-07 12:00:00', NULL, NULL),
(2, 'Prueba2', '$2y$10$Uz4n59ikQhRWS8HDN3WvyuZLq2SHk9PCNbmJf8', 'Prueba Probando', 1, NULL, NULL, NULL, NULL),
(3, 'prueba3', '$2y$10$0ofm3YK0QAvBM8MtPe43j.XjtKLeqJ5FfOS.9L.cDdiWTdPPh1NtW', 'Prueba Tres', 1, NULL, NULL, NULL, NULL),
(4, 'prueba4', '$2y$10$veji8H3Svo7V/7L5xxpqfeyKFdc6RwD4qGD.9gwL7Qhs7xRK3Ydum', 'Prueba Cuatro', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `id` int(11) NOT NULL,
  `campana_id` int(11) DEFAULT NULL,
  `mascota_id` int(11) DEFAULT NULL,
  `brigadas_id` int(11) NOT NULL,
  `fecha_vacuna` datetime DEFAULT NULL,
  `vacunado` varchar(1) NOT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id`, `campana_id`, `mascota_id`, `brigadas_id`, `fecha_vacuna`, `vacunado`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 1, 1, 1, NULL, 'S', '2022-08-26 08:58:46', NULL, NULL),
(2, 1, 2, 2, NULL, 'S', '2022-08-26 08:58:46', NULL, NULL),
(3, 23, 2, 3, NULL, 'S', '2022-09-02 12:09:19', NULL, NULL),
(4, 24, 3, 4, NULL, 'N', '2022-09-02 12:09:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id`, `descripcion`) VALUES
(1, 'Central'),
(2, 'Sud');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `brigadas`
--
ALTER TABLE `brigadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `campana`
--
ALTER TABLE `campana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_campana`
--
ALTER TABLE `tipo_campana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `brigadas`
--
ALTER TABLE `brigadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `campana`
--
ALTER TABLE `campana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `fechas`
--
ALTER TABLE `fechas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_campana`
--
ALTER TABLE `tipo_campana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
