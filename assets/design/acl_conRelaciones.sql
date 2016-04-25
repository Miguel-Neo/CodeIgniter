-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-04-2016 a las 19:11:05
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
(1, 'public', 'public'),
(2, 'Root', 'root');

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
(1, 'root');

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
(1, 2, 1);

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
(1, 'root', '', 'root', 'cbde9d2cec1bf2daeaee644fcd87ad174d901ccb79a58afe3dee2891f0110579', 1, 1, 1, '0000-00-00 00:00:00', 0, '2016-04-25 12:05:09', 0, '2016-04-25 12:05:09');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indices de la tabla `acl_role_permissions`
--
ALTER TABLE `acl_role_permissions`
  ADD UNIQUE KEY `role` (`role`,`permission`),
  ADD KEY `permission` (`permission`);

--
-- Indices de la tabla `acl_users`
--
ALTER TABLE `acl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `acl_user_permissions`
--
ALTER TABLE `acl_user_permissions`
  ADD UNIQUE KEY `user` (`user`,`permission`),
  ADD KEY `permission` (`permission`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acl_permissions`
--
ALTER TABLE `acl_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `acl_roles`
--
ALTER TABLE `acl_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `acl_users`
--
ALTER TABLE `acl_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acl_role_permissions`
--
ALTER TABLE `acl_role_permissions`
  ADD CONSTRAINT `acl_role_permissions_ibfk_1` FOREIGN KEY (`permission`) REFERENCES `acl_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_role_permissions_ibfk_2` FOREIGN KEY (`role`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `acl_user_permissions`
--
ALTER TABLE `acl_user_permissions`
  ADD CONSTRAINT `acl_user_permissions_ibfk_1` FOREIGN KEY (`permission`) REFERENCES `acl_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_user_permissions_ibfk_2` FOREIGN KEY (`user`) REFERENCES `acl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
