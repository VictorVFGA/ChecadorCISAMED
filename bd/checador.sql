-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 25-11-2023 a las 19:56:12
-- Versión del servidor: 5.7.41
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `checador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_alum`
--

CREATE TABLE `asistencia_alum` (
  `idAsist` int(11) NOT NULL,
  `IDAlumn` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `asi_dia_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia_alum`
--

INSERT INTO `asistencia_alum` (`idAsist`, `IDAlumn`, `asi_dia_hora`) VALUES
(1, '12', '2023-11-25 02:06:10'),
(2, '12', '2023-11-25 02:06:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_alumno`
--

CREATE TABLE `datos_alumno` (
  `IDAlumn` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `NombreAlum` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `PeriodoIngre` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_alumno`
--

INSERT INTO `datos_alumno` (`IDAlumn`, `NombreAlum`, `PeriodoIngre`) VALUES
('12', 'Juan Perez', '2019B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_emple`
--

CREATE TABLE `datos_emple` (
  `id_emple` varchar(10) NOT NULL,
  `nombre_emple` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `rol` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_emple`
--

INSERT INTO `datos_emple` (`id_emple`, `nombre_emple`, `username`, `rol`) VALUES
('1', 'Administrador', 'admin', 'admin'),
('25E678DA', 'Victor Fernando', 'victor', 'empleado'),
('80F56923', 'Visitante 1', 'visitante1', 'empleado'),
('90115823', 'Victor Gonzalez', 'victorgonzalez', 'empleado'),
('902E2923', 'Minue Paredes', 'minue', 'empleado'),
('909F291C', 'Visitante 2', 'visitante2', 'empleado'),
('90B7B71C', 'Valeria Martinez', 'vale', 'empleado'),
('925DD321', 'Juan Perez', 'juan', 'empleado'),
('A5CC7DDA', 'Jose Luis Lopez Diaz ', 'jose', 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regis_ingreso`
--

CREATE TABLE `regis_ingreso` (
  `id_reg` int(11) NOT NULL,
  `id_emple` varchar(10) NOT NULL,
  `fec_hor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `regis_ingreso`
--

INSERT INTO `regis_ingreso` (`id_reg`, `id_emple`, `fec_hor`) VALUES
(1, '1', '2023-08-22 01:18:46'),
(2, '1', '2023-08-22 01:22:04'),
(3, '25E678DA', '2023-08-22 02:00:50'),
(4, '25E678DA', '2023-08-22 02:01:01'),
(5, '25E678DA', '2023-08-22 02:46:04'),
(6, '25E678DA', '2023-08-22 02:46:15'),
(7, '90B7B71C', '2023-08-22 14:29:43'),
(8, '902E2923', '2023-08-22 14:32:01'),
(12, '925DD321', '2023-08-22 14:32:52'),
(13, '90115823', '2023-08-22 14:33:08'),
(15, '90B7B71C', '2023-08-24 04:03:36'),
(17, '909F291C', '2023-08-24 05:05:01'),
(18, '25E678DA', '2023-08-20 15:00:50'),
(19, '80F56923', '2023-08-14 16:00:50'),
(20, '80F56923', '2023-08-14 18:10:40'),
(21, '25E678DA', '2023-08-20 22:17:50'),
(23, '90115823', '2023-08-20 22:00:20'),
(24, '90115823', '2023-08-22 22:30:20'),
(25, '902E2923', '2023-08-22 22:27:10'),
(26, '90B7B71C', '2023-08-22 22:40:30'),
(27, '925DD321', '2023-08-22 21:40:30'),
(28, '90115823', '2023-08-20 17:40:30'),
(29, '909F291C', '2023-08-23 23:00:24'),
(30, '90B7B71C', '2023-08-23 22:03:34'),
(31, '25E678DA', '2023-08-24 05:39:45'),
(32, '25E678DA', '2023-08-24 05:40:11'),
(33, '25E678DA', '2023-08-24 05:41:14'),
(34, '25E678DA', '2023-08-24 05:41:26'),
(35, '902E2923', '2023-08-24 13:06:36'),
(36, '909F291C', '2023-08-24 13:07:42'),
(37, '90115823', '2023-08-24 13:14:42'),
(38, '80F56923', '2023-08-24 14:31:46'),
(39, '909F291C', '2023-08-24 14:31:58'),
(40, '80F56923', '2023-08-24 14:32:52'),
(41, '90115823', '2023-08-24 14:33:01'),
(42, '909F291C', '2023-09-26 00:19:55'),
(43, '25E678DA', '2023-09-26 00:21:35'),
(44, '909F291C', '2023-09-26 00:49:07'),
(45, '925DD321', '2023-09-26 01:08:17'),
(46, '925DD321', '2023-09-26 01:27:03'),
(47, '902E2923', '2023-09-26 20:10:07'),
(53, 'A5CC7DDA', '2023-09-26 20:11:54'),
(54, '1', '2023-11-24 03:05:50'),
(55, '1', '2023-11-24 03:12:06'),
(56, '1', '2023-11-24 03:16:34'),
(57, '1', '2023-11-24 03:21:41'),
(58, '1', '2023-11-24 03:23:00'),
(59, '1', '2023-11-24 03:23:05'),
(60, '1', '2023-11-24 04:06:35'),
(61, '1', '2023-11-24 05:12:09'),
(62, '1', '2023-11-24 05:12:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia_alum`
--
ALTER TABLE `asistencia_alum`
  ADD PRIMARY KEY (`idAsist`),
  ADD KEY `IDAlumn` (`IDAlumn`);

--
-- Indices de la tabla `datos_alumno`
--
ALTER TABLE `datos_alumno`
  ADD PRIMARY KEY (`IDAlumn`);

--
-- Indices de la tabla `datos_emple`
--
ALTER TABLE `datos_emple`
  ADD PRIMARY KEY (`id_emple`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_emple` (`id_emple`);

--
-- Indices de la tabla `regis_ingreso`
--
ALTER TABLE `regis_ingreso`
  ADD PRIMARY KEY (`id_reg`),
  ADD KEY `id_emple` (`id_emple`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia_alum`
--
ALTER TABLE `asistencia_alum`
  MODIFY `idAsist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `regis_ingreso`
--
ALTER TABLE `regis_ingreso`
  MODIFY `id_reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia_alum`
--
ALTER TABLE `asistencia_alum`
  ADD CONSTRAINT `asistencia_alum_ibfk_1` FOREIGN KEY (`IDAlumn`) REFERENCES `datos_alumno` (`IDAlumn`);

--
-- Filtros para la tabla `regis_ingreso`
--
ALTER TABLE `regis_ingreso`
  ADD CONSTRAINT `regis_ingreso_ibfk_1` FOREIGN KEY (`id_emple`) REFERENCES `datos_emple` (`id_emple`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
