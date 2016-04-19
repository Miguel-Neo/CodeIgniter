-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-04-2016 a las 19:20:40
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `codeigniter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_permissions`
--

CREATE TABLE `acl_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `title`, `name`) VALUES
(2, 'Esta es la descripcion de mi permiso', 'public'),
(3, 'Esta es la descripcion de mi permiso', 'test'),
(4, 'permiso dos', 'gioco4'),
(5, '5', 'ew');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_roles`
--

CREATE TABLE `acl_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acl_roles`
--

INSERT INTO `acl_roles` (`id`, `role`) VALUES
(1, 'administrador'),
(2, 'nuevoRol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_role_permissions`
--

CREATE TABLE `acl_role_permissions` (
  `role` int(10) UNSIGNED NOT NULL,
  `permission` int(10) UNSIGNED NOT NULL,
  `value` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acl_role_permissions`
--

INSERT INTO `acl_role_permissions` (`role`, `permission`, `value`) VALUES
(1, 2, 1),
(1, 3, 0),
(1, 4, 1),
(1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_users`
--

CREATE TABLE `acl_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `user` varchar(90) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`id`, `name`, `email`, `user`, `password`, `role`, `status`, `active`, `last_login`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(1, 'miguel', 'miguel@neommunications.com', 'admin', 'fc344ebf3f9834b9be769a25afee6f26ab2cc85f597a2f3c373b8da5746d0d52', 1, 1, 1, '0000-00-00 00:00:00', 1, '2016-04-18 11:12:23', 1, '2016-04-18 11:12:23'),
(2, 'test', 'acm_mauricioarmenta@hotmail.com', 'admin', 'fc344ebf3f9834b9be769a25afee6f26ab2cc85f597a2f3c373b8da5746d0d52', 2, 1, 1, '0000-00-00 00:00:00', 1, '2016-04-18 11:50:24', 1, '2016-04-18 11:50:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_user_permissions`
--

CREATE TABLE `acl_user_permissions` (
  `user` int(10) UNSIGNED NOT NULL,
  `permission` int(10) UNSIGNED NOT NULL,
  `value` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acl_permissions`
--
ALTER TABLE `acl_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `acl_roles`
--
ALTER TABLE `acl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `acl_role_permissions`
--
ALTER TABLE `acl_role_permissions`
  ADD UNIQUE KEY `role` (`role`,`permission`);

--
-- Indices de la tabla `acl_users`
--
ALTER TABLE `acl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `acl_user_permissions`
--
ALTER TABLE `acl_user_permissions`
  ADD UNIQUE KEY `user` (`user`,`permission`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acl_permissions`
--
ALTER TABLE `acl_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `acl_roles`
--
ALTER TABLE `acl_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `acl_users`
--
ALTER TABLE `acl_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
