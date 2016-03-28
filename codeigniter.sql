-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-03-2016 a las 19:09:19
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `codeigniter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `name`) VALUES
(1, 'Publico', 'public'),
(2, 'Registrado', 'registered'),
(3, 'test', 'test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(10) unsigned NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Prueba'),
(2, 'test2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_permissions`
--

CREATE TABLE IF NOT EXISTS `role_permissions` (
  `role` int(10) unsigned NOT NULL,
  `permission` int(10) unsigned NOT NULL,
  `value` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role_permissions`
--

INSERT INTO `role_permissions` (`role`, `permission`, `value`) VALUES
(1, 1, 1),
(1, 3, 1),
(2, 1, 1),
(2, 2, 0),
(2, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `panel` enum('b','f') NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `templates`
--

INSERT INTO `templates` (`id`, `name`, `description`, `panel`, `default`) VALUES
(1, 'default', 'Template front-end', 'f', 1),
(2, 'default', 'Template back-end', 'b', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) NOT NULL DEFAULT '0',
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user`, `password`, `role`, `status`, `active`, `last_login`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(1, 'prueba', 'prueba@c.c', 'prueba', '1bab058b5d0fe2e7d75a4bace5ca92cd9e7341fedd88d2d550306031c1fe20da', 1, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'back-end', 'Template back-end', 'b', 'uio', 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'back-end', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_permissions`
--

CREATE TABLE IF NOT EXISTS `user_permissions` (
  `user` int(10) unsigned NOT NULL,
  `permission` int(10) unsigned NOT NULL,
  `value` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_permissions`
--

INSERT INTO `user_permissions` (`user`, `permission`, `value`) VALUES
(1, 2, 1),
(1, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_permissions`
--
ALTER TABLE `role_permissions`
 ADD UNIQUE KEY `role` (`role`,`permission`);

--
-- Indices de la tabla `templates`
--
ALTER TABLE `templates`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_permissions`
--
ALTER TABLE `user_permissions`
 ADD UNIQUE KEY `user` (`user`,`permission`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `templates`
--
ALTER TABLE `templates`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
