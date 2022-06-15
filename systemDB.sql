-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2022 a las 20:35:51
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `client01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `second_name` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `role` int(1) NOT NULL,
  `file_n` varchar(255) NOT NULL,
  `file` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `name`, `second_name`, `mail`, `pass`, `role`, `file_n`, `file`, `status`, `deleted`) VALUES
(1, 'Andrés', 'Aguilar López', 'andres@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'user1.png', '7823e4bde4697ea430dd2788c3afd53a', 1, 0),
(2, 'Claudia', 'López Hernández', 'claudia@hotmail.com', 'ab56b4d92b40713acc5af89985d4b786', 1, 'user2.png', 'd00d5149e54757861fa03191da352f1f', 1, 0),
(3, 'Diego Andrés', 'Martínez Mercado', 'diego@gmail.com', '57c48dcd266eadf089325affe125151f', 2, 'user3.png', 'f64fc35d83858ad30414c0fe2c555051', 1, 0),
(4, 'Marco Antonio', 'Urzúa Grande', 'marco99@gmail.com', 'ac9ec49afb308497ff99a4e9ab88bd3f', 2, 'user4.png', '6b0022312d41080436c52da571d5c697', 1, 0),
(5, 'Karla', 'Martínez Abarca', 'karla.marab@hotmail.com', '850361bdf359ecf677676968b0db44ad', 2, 'user5.png', '5a99c620f8f50ca006a3e08feb8ce74f', 1, 0),
(6, 'José Miguel', 'Alvarado Piceno', 'josé.mike@outlook.com', 'dae1de15107f403c02a21de0f6b7e541', 2, '', '', 1, 0),
(7, 'Cristian Ismael', 'Roncero Bonilla', 'crisIS@outlook.com', '01cfcd4f6b8770febfb40cb906715822', 2, '', '', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `file_n` varchar(255) NOT NULL,
  `file` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `name`, `file_n`, `file`, `status`, `deleted`) VALUES
(1, 'Sega Genesis', 'banner1.jpg', 'c21b0040d78e9fb146385c0c1a88246c', 1, 0),
(2, 'Nintendo 64', 'banner2.jpg', '0eeb33d4304cecdfa5fbcf8e49dcf44e', 1, 0),
(3, 'Nintendo Switch', 'banner3.jpg', '5d9a1a522c553d25b664337b903fb6df', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `file_n` varchar(255) NOT NULL,
  `file` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `description`, `price`, `stock`, `file_n`, `file`, `status`, `deleted`) VALUES
(1, 'PlayStation 5', 'PRDC00PS5', 'Etiam suscipit mi eros, id auctor turpis eleifend vel. Proin dui arcu, posuere non orci non, ullamcorper commodo sem. Suspendisse viverra est purus, a mattis nulla placerat eu. Vestibulum elementum sapien quis eros convallis, ullamcorper tincidunt neque venenatis. ', 13000, 50, '1.jpg', 'c2881d473dd0f3b12b29292b07c644ed', 1, 0),
(2, 'Nintendo Switch', 'PRDC00NSW', 'Sed fringilla ornare ultrices. Duis finibus a lectus nec sodales. Pellentesque id dictum sem. Vestibulum sem mi, cursus a feugiat non, hendrerit nec dolor. Etiam eget pretium mi.', 7999.99, 75, '2.jpg', 'b4516aed00673d5f15e36ef6c8b5cdb2', 1, 0),
(3, 'Xbox Series S', 'PRDC00XBS', 'Cras auctor pellentesque tortor fringilla blandit. Proin commodo enim at magna maximus, quis venenatis ipsum mollis. Donec eleifend augue vel sem malesuada venenatis. ', 8500, 60, '3.jpg', 'ba5dce5d36c1dc35d36381aaf80c8498', 1, 0),
(4, 'Nintendo Switch Lite', 'PRDC00NSL', 'In aliquet mollis velit eu ullamcorper. Mauris tortor sem, molestie vitae felis eu, fermentum tincidunt mi. Aliquam dolor ex, auctor et lacus accumsan, ultricies pretium lacus. ', 6999.99, 100, '4.jpg', '6fadd7cea7a3aa58e31c1a650cefef76', 1, 0),
(5, 'Play Station 4', 'PRDC00PS4', 'In et fringilla mi, sed varius nisl. Suspendisse posuere elit a nulla iaculis, sed iaculis mauris commodo. Cras turpis odio, posuere sed varius sit amet, dictum et risus. ', 5999.99, 100, '5.jpg', '59bcaa5c5b0cacd9fe4fdccb75533bc6', 1, 0),
(6, 'Mini Sega Genesis', 'PRDC00MSG', 'Morbi pulvinar a purus non dignissim. In quis diam arcu. Mauris malesuada magna quis risus finibus consequat. Donec ligula augue, consequat ac arcu vel, sagittis aliquet velit.', 4999.99, 200, '6.jpg', '1a5b8b8074ec177a70e0c3bfc46985c6', 1, 0),
(7, 'Mini consola retro Pac Man Edition - Azul', 'PRDC00MCPAZ', 'Nunc in lacus sit amet nulla condimentum luctus. Donec tincidunt ac odio aliquam feugiat. ', 999.99, 120, '7.jpg', '2e0a2fe34b754798b2b7693a6a823966', 1, 0),
(8, 'Mini consola retro Pac Man Edition - Amarilla', 'PRDC00MCPAM', 'Nunc in lacus sit amet nulla condimentum luctus. Donec tincidunt ac odio aliquam feugiat. ', 999.99, 120, '8.jpg', '913c4399e26b3712bd5c7569f771ccd6', 1, 0),
(9, 'Play Station Dualshock 5 - Negro', 'PRDC00PS5DSK', 'Aenean at turpis non nisl gravida fermentum at et sem. Nulla eu condimentum dolor, a commodo neque. Phasellus in urna nulla. Donec eu felis eros.', 1999.99, 300, '9.jpg', '7e8579ae63b241ffddcfb42496b59a8d', 1, 0),
(10, 'Control Xbox Series alámbrico', 'PRDC00XBSCTA', 'Maecenas vitae hendrerit ipsum, vitae tristique felis. Aenean condimentum malesuada nisl id rhoncus. Proin aliquam elit eget fermentum rutrum. ', 999.99, 200, '10.jpg', '43651fd0e1b1bfac734d4a8f357b67aa', 1, 0),
(11, 'Control Nintendo Switch alámbrico', 'PRDC00NSWCTA', 'Duis eu sapien metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer malesuada eros eget libero blandit vehicula. ', 599.99, 80, '11.jpg', '93b52307357a7f25facfecff392bd823', 1, 0),
(12, 'Drone Joystick Play Station 4', 'PRDC00PS4DRN', 'Morbi non tellus eu risus malesuada cursus elementum a velit. Curabitur sollicitudin ut orci sed molestie. Vestibulum in lacinia turpis. Phasellus vel malesuada neque, a dignissim libero. Sed risus turpis, blandit et accumsan vel, accumsan a ipsum. Nulla in eros a orci fermentum ultrices. ', 2499.99, 30, '12.jpg', '7827f211479a061f439c87f67df6186f', 1, 0),
(13, 'Tanjiro Kamado - Funko POP', 'PRDC00FKTAN', 'Praesent quis ligula non eros ullamcorper consequat. Nam scelerisque, lacus at dapibus ultricies, tellus leo semper tortor, in mollis risus erat a sem. ', 399.99, 55, '13.jpg', 'cb422a171e800a9e883af209f6a1664f', 1, 0),
(14, 'Zenitsu Agatsuma - Funko POP', 'PRDC00FKZEN', 'Praesent quis ligula non eros ullamcorper consequat. Nam scelerisque, lacus at dapibus ultricies, tellus leo semper tortor, in mollis risus erat a sem. ', 399.99, 40, '14.jpg', 'e2d0adef769b67177ed4886dc152dfb7', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
