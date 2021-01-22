-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2020 a las 21:13:43
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `oswa_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Oficina'),
(1, 'Repuestos'),
(3, 'Tecnologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_emp` int(6) NOT NULL,
  `nom_emp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_emp`, `nom_emp`) VALUES
(1, 'Abelio'),
(2, 'Adriana'),
(4, 'Amparo'),
(5, 'Brillit'),
(6, 'Christian '),
(7, 'Jose '),
(8, 'Jose '),
(9, 'Edith '),
(10, 'Joel '),
(11, 'Karen '),
(12, 'Karina '),
(13, 'Karim '),
(14, 'Kelly '),
(15, 'Kevin '),
(16, 'Mishel '),
(17, 'Marvin '),
(19, 'Magaly '),
(20, 'Miriam'),
(21, 'Geraldine '),
(22, 'Percy '),
(23, 'Ricardo '),
(24, 'Silvia '),
(25, 'Veronica '),
(26, 'Yulisa '),
(27, 'Yoshelin '),
(28, 'Lourdes '),
(29, 'Orlando '),
(31, 'Paz '),
(32, 'Milsa '),
(33, 'Lisseth '),
(34, 'Carlos '),
(35, 'Renato'),
(36, 'Juan'),
(37, 'zadkiel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `id_producto`, `cantidad`, `fecha_entrada`) VALUES
(1, 5, 10, '2020-07-15'),
(2, 5, 5, '2020-08-02'),
(3, 14, 3, '2020-08-02'),
(4, 62, 2, '2020-08-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(1, 'filter.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` date NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `name`, `quantity`, `categorie_id`, `media_id`, `date`, `id_proveedor`) VALUES
(1, 'Filtro de gasolina', 98, 1, 1, '2017-06-16', 1),
(2, 'loco', 123, 2, 1, '2020-07-21', 1),
(3, 'loco1', 123, 2, 1, '2020-07-21', 1),
(4, '787', 123, 2, 1, '2020-07-21', 1),
(5, 'Cinta de embalaje', 31, 2, 0, '0000-00-00', 1),
(6, 'Cinta  scotch pegafan', 7, 0, 0, '0000-00-00', 1),
(7, 'Clips', 11585, 0, 0, '0000-00-00', 1),
(8, 'Clips mariposa 65 mm', 8, 0, 0, '0000-00-00', 1),
(9, 'Clips mariposa 45 mm', 99, 0, 0, '0000-00-00', 1),
(10, 'Clips binder 1 pulg', 84, 0, 0, '0000-00-00', 1),
(11, 'clips binder 1  1/4 pulg', 146, 0, 0, '0000-00-00', 1),
(12, 'clip binder 1  5/8 pulg', 75, 0, 0, '0000-00-00', 1),
(13, 'Clips binder 2 pulg', 125, 0, 0, '0000-00-00', 1),
(14, 'Corrector', 8, 0, 0, '0000-00-00', 1),
(15, 'Cuaderno A4', 2, 0, 0, '0000-00-00', 1),
(16, 'Cuaderno chico', 5, 0, 0, '0000-00-00', 1),
(17, 'Cartulina duplex', 51, 0, 0, '0000-00-00', 1),
(18, 'Engrapadora', 8, 0, 0, '0000-00-00', 1),
(19, 'Fastener', 551, 0, 0, '0000-00-00', 1),
(20, 'Folder manila oficio', 121, 0, 0, '0000-00-00', 1),
(21, 'Folder manila A4', 251, 0, 0, '0000-00-00', 1),
(22, 'Grapas 23/10 oficio (barras)', 35, 0, 0, '0000-00-00', 1),
(23, 'Grapas 26/6 A4 (barras)', 217, 0, 0, '0000-00-00', 1),
(24, 'Goma liquida', 0, 0, 0, '0000-00-00', 1),
(25, 'Huellero', 4, 0, 0, '0000-00-00', 1),
(26, 'Lapiz', 36, 0, 0, '0000-00-00', 1),
(27, 'Lapicero azul', 54, 0, 0, '0000-00-00', 1),
(28, 'Lapicero negro', 54, 0, 0, '0000-00-00', 1),
(29, 'Lapicero rojo', 50, 0, 0, '0000-00-00', 1),
(30, 'Limpiatipos artesco', 9, 0, 0, '0000-00-00', 1),
(31, 'Masking pegafan', 1, 0, 0, '0000-00-00', 1),
(32, 'micas A4', 104, 0, 0, '0000-00-00', 1),
(33, 'Plumon delgado rojo', 50, 0, 0, '0000-00-00', 1),
(34, 'Plumon grueso negro indeleble', 32, 0, 0, '0000-00-00', 1),
(35, 'Plumon grueso rojo', 0, 0, 0, '0000-00-00', 1),
(36, 'Plumon grueso azul', 0, 0, 0, '0000-00-00', 1),
(37, 'Plumon grueso indeleble', 0, 0, 0, '0000-00-00', 1),
(38, 'Papel bound A4', 80820, 0, 0, '0000-00-00', 1),
(39, 'Papel contact ', 0, 0, 0, '0000-00-00', 1),
(40, 'Papel bound arco iris', 0, 0, 0, '0000-00-00', 1),
(41, 'Perforador', 5, 0, 0, '0000-00-00', 1),
(42, 'Papel lustre (pliegos)', 194, 0, 0, '0000-00-00', 1),
(43, 'Porta clip artesco', 19, 0, 0, '0000-00-00', 1),
(44, 'Porta CD', 57, 0, 0, '0000-00-00', 1),
(45, 'Porta Papel A4', 0, 0, 0, '0000-00-00', 1),
(46, 'Resaltador', 21, 0, 0, '0000-00-00', 1),
(47, 'Regla', 9, 0, 0, '0000-00-00', 1),
(48, 'Tajador', 8, 0, 0, '0000-00-00', 1),
(49, 'Tijera', 6, 0, 0, '0000-00-00', 1),
(50, 'Sobre extra oficio', 69, 0, 0, '0000-00-00', 1),
(51, 'Sobre oficio', 541, 0, 0, '0000-00-00', 1),
(52, 'Sobre 1/2 oficio', 612, 0, 0, '0000-00-00', 1),
(53, 'Sobre A4', 281, 0, 0, '0000-00-00', 1),
(54, 'Sobre de pago', 144, 0, 0, '0000-00-00', 1),
(55, 'Saca grapas', 0, 0, 0, '0000-00-00', 1),
(56, 'Banderitas (post-it)', 5, 0, 0, '0000-00-00', 1),
(57, 'Borrador chico', 11, 2, 0, '0000-00-00', 1),
(58, 'notas adhesivas 3x3 (paquetes)', 16, 0, 0, '0000-00-00', 1),
(59, 'notas adhesivas 1 3/8 X 1 7/8 (paquetes)', 8, 0, 0, '0000-00-00', 1),
(60, 'cuchilla 18mm', 9, 0, 0, '0000-00-00', 1),
(61, 'calculadora casio ', 6, 0, 0, '0000-00-00', 1),
(62, 'Bolsas Transparentes', 46, 0, 0, '0000-00-00', 1),
(63, 'Papel Film ', 4, 0, 0, '0000-00-00', 1),
(64, 'Tablero Plastico Oficio', 1, 0, 0, '0000-00-00', 1),
(65, 'Forro Autoadhesivo', 0, 0, 0, '0000-00-00', 1),
(66, 'Plumon de pizarra', 5, 0, 0, '0000-00-00', 1),
(67, 'prueba', 4, 2, 1, '2020-08-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nom_pro` varchar(100) NOT NULL,
  `n_ruc` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nom_pro`, `n_ruc`) VALUES
(1, 'Tai loy', '21321321345'),
(2, 'Cyberplaza', '54121245454');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `id_emp`, `qty`, `date`) VALUES
(1, 38, 31, 50, '2020-08-03'),
(24, 17, 2, 20, '2020-07-24'),
(25, 57, 4, 2, '2020-08-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Admin Users', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'pzg9wa7o1.jpg', 1, '2020-08-03 21:06:03'),
(2, 'Special User', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.jpg', 1, '2017-06-16 07:11:26'),
(3, 'Default User', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.jpg', 1, '2017-06-16 07:11:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Special', 2, 0),
(3, 'User', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_emp`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_entrada_prod` (`id_producto`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sal_emp` (`id_emp`),
  ADD KEY `fk_sal_prod` (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_emp` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_entrada_prod` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sal_emp` FOREIGN KEY (`id_emp`) REFERENCES `empleados` (`id_emp`),
  ADD CONSTRAINT `fk_sal_prod` FOREIGN KEY (`product_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
