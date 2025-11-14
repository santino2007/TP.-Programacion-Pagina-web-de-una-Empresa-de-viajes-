-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-11-2025 a las 20:46:34
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
  `id_metodo` int(15) NOT NULL,
  `tipo_pago` varchar(35) NOT NULL,
  `detalles_pago` varchar(35) NOT NULL,
  `id_usuario` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_metodo`, `tipo_pago`, `detalles_pago`, `id_usuario`) VALUES
(1, 'Tarjeta de Crédito', 'Visa terminada en 4567', 1),
(2, 'Tarjeta de Débito', 'Mastercard terminada en 8901', 2),
(3, 'Transferencia Bancaria', 'Banco XYZ, Cuenta Ahorros', 3),
(4, 'PayPal', 'Correo: usuario1@mail.com', 4),
(5, 'Tarjeta de Crédito', 'Amex terminada en 2345', 5),
(6, 'Pago en Efectivo', 'Tienda de conveniencia', 6),
(7, 'Transferencia Bancaria', 'Banco ABC, Cuenta Corriente', 7),
(8, 'Tarjeta de Débito', 'Visa terminada en 6789', 8),
(9, 'PayPal', 'Correo: usuario2@mail.com', 9),
(10, 'Monedero Virtual', 'Alias: VirtualPay-123', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_planes` int(15) NOT NULL,
  `nom_planes` varchar(35) NOT NULL,
  `detalles_planes` varchar(70) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `f_inicio` date NOT NULL,
  `f_fin` date NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_planes`, `nom_planes`, `detalles_planes`, `estado`, `f_inicio`, `f_fin`, `precio`) VALUES
(1, 'Plan Básico', 'Paquete completo de playa con excursiones y comidas incluidas.', 'Activo', '2025-01-10', '2025-06-10', 6500.00),
(2, 'Plan Familiar', 'Aventura por las sierras con caminatas y paseos en bici.', 'Activo', '2025-02-01', '2025-08-01', 11800.00),
(3, 'Plan Premium', 'Tour cultural por ciudades con museos y monumentos.', 'Inactivo', '2025-03-05', '2025-12-05', 18500.00),
(4, 'Plan Empresarial', 'Escapada romántica con hotel boutique y spa.', 'Activo', '2025-04-15', '2025-10-15', 29900.00),
(5, 'Plan Estudiantil', 'Plan familiar con parques, actividades y pensión completa.', 'Suspendido', '2025-05-01', '2025-11-01', 5200.00),
(6, 'Plan Plus', 'Excursión ecológica en contacto con la naturaleza.', 'Activo', '2025-03-10', '2025-09-10', 9300.00),
(7, 'Plan Familiar Plus', 'Circuito gastronómico con degustaciones y clases de cocina.', 'Activo', '2025-06-01', '2025-12-01', 14500.00),
(8, 'Plan Corporativo', 'Tour internacional con vuelos, guía y hoteles incluidos.', 'Activo', '2025-07-15', '2026-01-15', 25200.00),
(9, 'Plan Económico', 'Paquete de relax con termas, masajes y spa.', 'Activo', '2025-02-05', '2025-07-05', 4800.00),
(10, 'Plan Ejecutivo', 'Aventura extrema con senderismo y deportes acuáticos.', 'Activo', '2025-05-20', '2025-11-20', 18800.00),
(11, 'Plan Premium Plus', 'Viaje al norte argentino con pueblos y viñedos.', 'Inactivo', '2025-03-25', '2025-09-25', 21500.00),
(12, 'Plan PyME', 'Tour fotográfico por paisajes destacados con guía.', 'Activo', '2025-04-05', '2025-10-05', 16700.00),
(13, 'Plan Avanzado', 'Programa de turismo aventura con rafting y canopy.', 'Activo', '2025-01-20', '2025-07-20', 13200.00),
(14, 'Plan Ultra', 'Paquete cultural con espectáculos y gastronomía local.', 'Suspendido', '2025-06-10', '2025-12-10', 27400.00),
(15, 'Plan Anual Completo', 'Viaje de lujo con hoteles cinco estrellas y traslados privados.', 'Activo', '2025-01-01', '2025-12-31', 31500.00);

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
  `id_servicio` int(15) NOT NULL,
  `tipo_servicio` varchar(25) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `tipo_servicio`, `descripcion`, `precio`) VALUES
(1, 'room_service', 'Desayuno continental incluido en la tarifa de la habitación.', 8500.00),
(2, 'tipo_transporte', 'Traslado privado del aeropuerto al hotel en furgoneta de lujo.', 35000.00),
(3, 'seguro', 'Póliza de seguro de viaje de cobertura médica internacional básica.', 22000.00),
(4, 'parcking_lot', 'Estacionamiento cubierto y vigilado incluido por 3 noches.', 3300.00),
(5, 'tipo_transporte', 'Alquiler de coche económico por un día (kilometraje ilimitado).', 28000.00),
(6, 'room_service', 'Servicio de cena a la habitación para dos personas (menú fijo).', 17500.00),
(7, 'seguro', 'Suplemento de seguro de cancelación de viaje por cualquier causa.', 45000.00),
(8, 'parcking_lot', 'Estacionamiento de larga estancia en aeropuerto (7 días).', 55000.00),
(9, 'tipo_transporte', 'Billete de tren de larga distancia entre provincias (clase turista).', 65000.00),
(10, 'Excursión', 'Tour de avistamiento de fauna local (medio día).', 40000.00);

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
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id_metodo`),
  ADD KEY `fk_id_usiario` (`id_usuario`);

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
-- Filtros para la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD CONSTRAINT `fk_id_usiario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

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
