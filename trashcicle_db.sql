-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2025 a las 20:09:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trashcicle_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canjes`
--

CREATE TABLE `canjes` (
  `id_canje` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `nombre_entrega` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  `referencias` text DEFAULT NULL,
  `fecha_canje` datetime NOT NULL,
  `estado` enum('pendiente','enviado','entregado','cancelado') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `usuario_nombre` varchar(255) DEFAULT NULL,
  `usuario_email` varchar(255) DEFAULT NULL,
  `compra` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `puntos` int(11) DEFAULT 0,
  `status` enum('activo','cancelado','eliminado') DEFAULT 'activo',
  `fecha_compra` date DEFAULT curdate(),
  `id_producto` varchar(100) DEFAULT NULL,
  `estado_compras` varchar(100) DEFAULT 'Canjeo exitoso',
  `imagen_producto` varchar(255) DEFAULT NULL,
  `compra_precio_dinero` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `usuario_id`, `usuario_nombre`, `usuario_email`, `compra`, `categoria`, `puntos`, `status`, `fecha_compra`, `id_producto`, `estado_compras`, `imagen_producto`, `compra_precio_dinero`) VALUES
(1, 1, 'María Pérez', 'maria@example.com', 'Botella Reutilizable', 'Accesorios', 500, '', '2025-04-28', '101', 'Pendiente', NULL, '0'),
(2, 2, 'Luis García', 'luis@example.com', 'Mochila Ecológica', 'Mochilas', 800, '', '2025-04-29', '102', 'Canjeo exitoso', NULL, '0'),
(3, 3, 'Ana Torres', 'ana@example.com', 'Termo Inteligente', 'Tecnología', 1200, '', '2025-04-27', '103', 'Canjeo exitoso', NULL, '0'),
(4, 999, 'Usuario Automático', 'auto@example.com', 'Producto Automático', 'Prueba', 50, 'activo', '2025-05-01', '1', 'Canjeo exitoso', NULL, '0'),
(5, 9, 'Joso', 'prueba@example.com', 'Pelota de Basketball', 'Deporte', 150, '', '2025-05-08', '999', 'Pendiente', NULL, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_frecuentes`
--

CREATE TABLE `preguntas_frecuentes` (
  `id_pregunta` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_stock` int(11) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagen_producto` varchar(100) DEFAULT NULL,
  `categria_producto` varchar(100) DEFAULT 'otros',
  `estado_producto` varchar(100) DEFAULT 'Disponible',
  `product_prices_points` int(11) DEFAULT 0,
  `product_etiqueta` varchar(100) DEFAULT ' 100% Reciclable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad_stock`, `fecha_creacion`, `imagen_producto`, `categria_producto`, `estado_producto`, `product_prices_points`, `product_etiqueta`) VALUES
(12, 'Pelota de Baloncesto', 'Es unos de los mejores productos que  existen en el marcado negro de popraganda america', 100.00, 25, '2025-05-05 00:32:21', '1746488657_basket.jpg', 'Deportes', 'Disponible', 50, ' 100%  Reciclable'),
(13, 'Pelota de Futbol', 'Es un producto 100% reciclado y hecho con los mejores materiales de nuestras oficinas', 150.00, 1, '2025-05-06 04:46:48', '68194de8c6486_balon-de-futbol-soccer.jpg', 'Deportes', 'Disponible', 0, ' 100% Reciclable'),
(14, 'Tarjeta Omsa', 'Es una tarjeta que permite tener acceso  a diferentes  servicio de mentro cruciales', 350.00, 1, '2025-05-06 04:50:19', '68194ebb56e4c_omsa.jpg', 'Otros', 'Disponible', 0, ' 100% Reciclable'),
(15, 'Abrigo  Trashcicle', 'Es uno de los mejores productos  fabricados en nuestra fábricas principales con tela  de alta calidad.', 150.00, 1, '2025-05-06 04:51:39', '68194f0bab097_trashCicleHoodie.jpg', 'Otros', 'Disponible', 0, ' 100% Reciclable'),
(16, 'Gorro Trashcicle', 'Es un gorro hecho con telas de excelente calidad, cómodo y Bonito para uso diario.', 50.00, 1, '2025-05-06 04:52:51', '1746489439_gorroTrashCicle.jpg', 'Otros', 'Disponible', 0, ' 100% Reciclable'),
(17, 'Bate de Baseball', 'Es un bate  100% reiclado de la propiar fabrica de Trashcicle con una calidad buena.', 140.00, 1, '2025-05-06 04:59:20', '681950d87a892_bate.jpg', 'Deportes', 'Disponible', 0, ' 100% Reciclable'),
(18, 'Producto looco', 'Unos de los mejores productos que existe en el mundo que ofrecen una calidad extraudinaria', 100.00, 1, '2025-05-06 08:53:59', '681987d7d0b84_hola.webp', 'Otros', 'Disponible', 100, ' 100% Reciclable'),
(19, 'RAMA', 'dmddkdckdmkdkmkdm', 232.00, 1, '2025-05-06 09:00:10', '6819894a9ee58_about-us-headerBG.jpg', 'Otros', 'Disponible', 232, ' 100% Reciclable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_real_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `is_restricted` tinyint(1) NOT NULL DEFAULT 0,
  `user_email` varchar(320) NOT NULL DEFAULT 'usuario@gmail.com',
  `user_country` varchar(100) NOT NULL DEFAULT 'pais_placeholder',
  `user_phone_number` varchar(15) NOT NULL DEFAULT 'XXX-XXX-XXXX',
  `user_points` varchar(255) NOT NULL DEFAULT '5000',
  `user_register_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_restriction_reason` text DEFAULT NULL,
  `type_users` varchar(30) DEFAULT 'cliente',
  `numero_reciclaje` int(11) DEFAULT 0,
  `foto_perfil` varchar(255) DEFAULT 'default.png',
  `cantidad_residuos_reciclados` varchar(100) DEFAULT '0',
  `c2o_evitado` varchar(100) DEFAULT '0',
  `energia_generada` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_real_name`, `user_last_name`, `user_name`, `user_password`, `is_online`, `is_restricted`, `user_email`, `user_country`, `user_phone_number`, `user_points`, `user_register_time`, `user_restriction_reason`, `type_users`, `numero_reciclaje`, `foto_perfil`, `cantidad_residuos_reciclados`, `c2o_evitado`, `energia_generada`) VALUES
(1, 'Gabriel', 'Reynoso', 'GabrielR1905', '$2y$10$TSMYEyiWFtvEn8Q8DHYL0.paIG8G2ttXR2sqkCE0f1BuCRDF/s0vG', 1, 0, 'gabrey1905@gmail.com', 'República Dominicana', '(809) 846-4642', '5000', '2025-01-16 04:34:45', '', 'cliente', 0, 'default.png', '0', '0', '0'),
(2, 'Jose', 'Abreu', 'JoseDarlin999', '$2y$10$tUFyX53Xoo6XFhr465WqvuEriiqdiAAGP0HiymJJ57Q0K7A8h8iBC', 0, 0, 'josedarlin3080@gmail.com', 'República Dominicana', '(829) 486-2096', '5000', '2025-01-16 04:34:45', '', 'cliente', 0, 'default.png', '0', '0', '0'),
(3, 'Vladimir German', 'Brito Castro', 'GermanBrito', '$2y$10$Q/F/uZKFCQTFNt0YN6o/kOzfH5R31bHiG329PK6YDGqftdfYH.CtG', 0, 0, 'germanbrito1212@gmail.com', 'República Dominicana', '(829) 866-8541', '10000', '2025-01-16 04:34:45', '', 'cliente', 0, 'default.png', '0', '0', '0'),
(4, 'Thorkell', 'Gothä', 'ThorkellElMejor', '$2y$10$GkE9gxRCU1kwBcjoeyS1e.dx3Qk7i324hFDrzScoQMI699wWDYswG', 1, 0, 'fv308@gmail.com', 'Republica Dominicana', '(829) 358-9854', '1000', '2025-01-16 12:47:02', '', 'cliente', 0, 'default.png', '0', '0', '0'),
(5, 'Francisco Abel', 'Mesa Acevedo', 'FranciscoAbel1212', '$2y$10$c2PjG8vxvQZf6vXYnAJutuhWz/AK3pO0kI0AZEzczDOQSBjUyNgLi', 0, 0, 'franciscoabel1212@gmail.com', 'Republica Dominicana', '(829) 658-9214', '7000', '2025-01-20 13:24:09', '', 'cliente', 0, 'default.png', '0', '0', '0'),
(8, 'Natanael', 'Soidere', 'Kosmo', '$2y$10$bUkEWSYT2AJDVkUGFnAAOuSaFZkZYis/S9TL6tqELv0hMZnmWw5B.', 0, 0, 'kosmoposoidere@gmail.com', 'rd', '3234345432', '0', '2025-04-14 21:57:24', NULL, 'admin', 0, 'default.png', '0', '0', '0'),
(9, 'Jose', 'Soidere', 'Joso', '$2y$10$pGTEol8rBLoxrzmABRqwwuIamoDM6lory/RFCKOU1j/C0D9RdHzfK', 0, 0, 'kosmopoe4soidere@gmail.com', 'rd', '3234345432', '0', '2025-04-14 22:16:04', NULL, 'cliente', 0, 'default.png', '0', '0', '0'),
(10, 'Json', 'Pe;a', 'json', '$2y$10$mnzXvnFmdhucsuMu0En8ouIWQ8tOR2/dpoIkLhCSLS02PJR/Xc0JO', 0, 0, 'jsonposoidere@gmail.com', 'rd', '3432343432', '0', '2025-05-06 05:13:40', NULL, 'cliente', 0, 'default.png', '0', '0', '0'),
(11, 'Mario', 'Peña', 'mario', '$2y$10$0Ls0260ybD0p8sMFzHrsp.Ox/ZWwPsNO1DolU7RzYhvFsnVKci6zK', 0, 0, 'mariooidere@gmail.com', 'rd', '4566544567', '0', '2025-05-06 05:14:58', NULL, 'cliente', 0, 'default.png', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_history`
--

CREATE TABLE `user_history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_history`
--

INSERT INTO `user_history` (`history_id`, `user_id`, `date`, `type`, `description`, `points`) VALUES
(1, 3, '2025-01-15 14:00:00', 'canje', 'Botella reutilizable', -500),
(2, 3, '2025-01-14 13:00:00', 'ganado', 'Reciclaje de plástico', 2000),
(3, 4, '2025-01-13 13:00:00', 'canje', 'Recarga tarjeta del metro', -1000),
(4, 4, '2025-01-10 13:00:00', 'ganado', 'Envases plásticos', 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zafacones_inteligentes`
--

CREATE TABLE `zafacones_inteligentes` (
  `id_zafacon` int(11) NOT NULL,
  `nombre_zafacon` varchar(255) NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `capacidad` decimal(10,2) NOT NULL,
  `residuos_actuales` decimal(10,2) DEFAULT 0.00,
  `estado` varchar(50) DEFAULT 'Operativo',
  `fecha_instalacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zafacones_inteligentes`
--

INSERT INTO `zafacones_inteligentes` (`id_zafacon`, `nombre_zafacon`, `ubicacion`, `capacidad`, `residuos_actuales`, `estado`, `fecha_instalacion`, `fecha_ultima_actualizacion`) VALUES
(1, 'ZTEL_MODEL3434', 'Santo Domingo', 0.00, 0.00, 'Vacío', '2025-05-07 03:10:25', '2025-05-07 03:10:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canjes`
--
ALTER TABLE `canjes`
  ADD PRIMARY KEY (`id_canje`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `zafacones_inteligentes`
--
ALTER TABLE `zafacones_inteligentes`
  ADD PRIMARY KEY (`id_zafacon`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canjes`
--
ALTER TABLE `canjes`
  MODIFY `id_canje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user_history`
--
ALTER TABLE `user_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `zafacones_inteligentes`
--
ALTER TABLE `zafacones_inteligentes`
  MODIFY `id_zafacon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canjes`
--
ALTER TABLE `canjes`
  ADD CONSTRAINT `canjes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `canjes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
