-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-10-2025 a las 19:03:50
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
  `id_planes` int(10) NOT NULL,
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
  `id_usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_metodo`, `transferencia`, `tar_credito`, `efectivo`, `id_usuario`) VALUES
(1, 'Sí', 'No', 'No', 1),
(2, 'No', 'Sí', 'No', 2),
(3, 'No', 'No', 'Sí', 3),
(4, 'Sí', 'Sí', 'No', 4),
(5, 'No', 'Sí', 'Sí', 5),
(6, 'Sí', 'No', 'Sí', 6),
(7, 'No', 'Sí', 'No', 7),
(8, 'Sí', 'Sí', 'Sí', 8),
(9, 'No', 'No', 'Sí', 9),
(10, 'Sí', 'No', 'No', 10);

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
-- Estructura de tabla para la tabla `planes_servicios`
--

CREATE TABLE `planes_servicios` (
  `id_planes` int(10) NOT NULL,
  `id_servicio` int(10) NOT NULL,
  `f_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes_servicios`
--

INSERT INTO `planes_servicios` (`id_planes`, `id_servicio`, `f_creacion`) VALUES
(1, 2, '2025-09-01 00:00:00'),
(1, 3, '2025-09-02 00:00:00'),
(2, 1, '2025-09-03 00:00:00'),
(2, 4, '2025-09-04 00:00:00'),
(3, 2, '2025-09-05 00:00:00'),
(3, 5, '2025-09-06 00:00:00'),
(4, 1, '2025-09-07 00:00:00'),
(4, 3, '2025-09-08 00:00:00'),
(5, 2, '2025-09-09 00:00:00'),
(5, 4, '2025-09-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(10) NOT NULL,
  `met_transporte` varchar(10) NOT NULL,
  `room_ser` varchar(15) NOT NULL,
  `park_loot` varchar(15) NOT NULL,
  `seguro` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `met_transporte`, `room_ser`, `park_loot`, `seguro`) VALUES
(1, '', 'Disponible', 'Incluido', 'Sí'),
(2, '', 'No', 'Incluido', 'No'),
(3, '', 'Disponible', 'No', 'Sí'),
(4, '', 'Disponible', 'Incluido', 'No'),
(5, '', 'No', 'No', 'Sí'),
(6, '', 'Disponible', 'Incluido', 'Sí'),
(7, '', 'No', 'Incluido', 'No'),
(8, '', 'Disponible', 'No', 'Sí'),
(9, '', 'No', 'Incluido', 'Sí'),
(10, '', 'Disponible', 'Incluido', 'No');

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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_us`, `gmail`, `num_tel`, `whatsapp`, `contraseña`, `promo`) VALUES
(1, 'JuanPerez', 'juanperez@gmail.com', '3516549872', '3516549872', 'Jp12345*', 'Sí'),
(2, 'MariaLopez', 'maria.lopez@yahoo.com', '3517654321', '3517654321', 'Ml*2024', 'No'),
(3, 'CarlosG', 'carlosg@hotmail.com', '3519988776', '3519988776', 'Cg!pass01', 'Sí'),
(4, 'SofiaM', 'sofia.m@gmail.com', '3514433221', '3514433221', 'Sm2024#', 'No'),
(5, 'LeoRod', 'leonardo.rod@gmail.com', '3512233445', '3512233445', 'LrPass*22', 'Sí'),
(6, 'ValentinaR', 'vale.r@gmail.com', '3513344556', '3513344556', 'Vr@1234', 'No'),
(7, 'MartinS', 'martin.s@hotmail.com', '3515566778', '3515566778', 'Ms*pass24', 'Sí'),
(8, 'CamilaTor', 'camila.tor@gmail.com', '3516677889', '3516677889', 'Ct!4567', 'No'),
(9, 'AndresF', 'andres.f@yahoo.com', '3517788990', '3517788990', 'Af#9876', 'Sí'),
(10, 'JulietaC', 'julieta.c@gmail.com', '3518899001', '3518899001', 'Jc*2025', 'No');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_metodo` (`id_metodo`),
  ADD KEY `id_planes` (`id_planes`),
  ADD KEY `id_usuario` (`id_usuario`);

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
-- Indices de la tabla `planes_servicios`
--
ALTER TABLE `planes_servicios`
  ADD KEY `fk_planes_servicios` (`id_planes`),
  ADD KEY `fk_servicios_planes` (`id_servicio`);

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
  MODIFY `id_metodo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_planes` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_metodo`) REFERENCES `metodo_pago` (`id_metodo`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_planes`) REFERENCES `planes` (`id_planes`),
  ADD CONSTRAINT `carrito_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `planes_servicios`
--
ALTER TABLE `planes_servicios`
  ADD CONSTRAINT `fk_planes_servicios` FOREIGN KEY (`id_planes`) REFERENCES `planes` (`id_planes`),
  ADD CONSTRAINT `fk_servicios_planes` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
