-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2023 a las 00:27:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
-- Estructura de tabla para la tabla `datos_emple`
--

CREATE TABLE `datos_emple` (
  `id_emple` varchar(10) NOT NULL,
  `nombre_emple` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_emple`
--

INSERT INTO `datos_emple` (`id_emple`, `nombre_emple`) VALUES
('1', 'Administrador'),
('25E678DA', 'Victor Fernando'),
('80F56923', 'Visitante 1'),
('90115823', 'Victor Gonzalez'),
('902E2923', 'Minue Paredes'),
('909F291C', 'Visitante 2'),
('90B7B71C', 'Valeria Martinez'),
('925DD321', 'Juan Perez'),
('A5CC7DDA', 'Jose Luis Lopez Diaz ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regis_ingreso`
--

CREATE TABLE `regis_ingreso` (
  `id_reg` int(11) NOT NULL,
  `id_emple` varchar(10) NOT NULL,
  `fec_hor` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(53, 'A5CC7DDA', '2023-09-26 20:11:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_emple`
--
ALTER TABLE `datos_emple`
  ADD PRIMARY KEY (`id_emple`),
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
-- AUTO_INCREMENT de la tabla `regis_ingreso`
--
ALTER TABLE `regis_ingreso`
  MODIFY `id_reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `regis_ingreso`
--
ALTER TABLE `regis_ingreso`
  ADD CONSTRAINT `regis_ingreso_ibfk_1` FOREIGN KEY (`id_emple`) REFERENCES `datos_emple` (`id_emple`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
