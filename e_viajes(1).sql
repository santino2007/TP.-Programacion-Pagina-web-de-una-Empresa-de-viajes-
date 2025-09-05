-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-09-2025 a las 19:54:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `e_viajes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_precio` int(10) NOT NULL,
  `id_metodo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_metodo` int(10) NOT NULL,
  `transferencia` varchar(100) NOT NULL,
  `tar_credito` varchar(100) NOT NULL,
  `efectivo` varchar(100) NOT NULL,
  `id_usiario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_planes` int(15) NOT NULL,
  `nom_planes` varchar(140) NOT NULL,
  `precio` decimal(10,4) NOT NULL,
  `f_inicio` date NOT NULL,
  `f_fin` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  `id_servicio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_planes`, `nom_planes`, `precio`, `f_inicio`, `f_fin`, `estado`, `id_servicio`) VALUES
(1, 'Plan Básico', 15.0000, '2025-01-10', '2025-04-10', 'Activo', 1),
(2, 'Plan Estándar', 30.0000, '2025-02-05', '2025-08-05', 'Activo', 2),
(3, 'Plan Premium', 50.0000, '2025-03-15', '2025-09-15', 'Inactivo', 3),
(4, 'Plan Familiar', 45.0000, '2025-04-01', '2025-12-01', 'Activo', 1),
(5, 'Plan Empresarial', 80.0000, '2025-01-20', '2025-06-20', 'Pendiente', 4),
(6, 'Plan Estudiantil', 12.0000, '2025-05-10', '2025-08-10', 'Activo', 2),
(7, 'Plan Plus', 60.0000, '2025-06-01', '2025-12-01', 'Inactivo', 5),
(8, 'Plan Pro', 70.0000, '2025-07-01', '2025-10-01', 'Activo', 3),
(9, 'Plan Avanzado', 90.0000, '2025-08-05', '2025-12-31', 'Pendiente', 4),
(10, 'Plan Flexible', 25.0000, '2025-09-01', '2025-11-30', 'Activo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(10) NOT NULL,
  `room_ser` varchar(15) NOT NULL,
  `park_loot` varchar(15) NOT NULL,
  `seguro` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `nombre_us` varchar(150) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `num_tel` varchar(100) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `promo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_metodo`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_planes`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_planes` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
