-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-05-2016 a las 23:34:01
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `neommuni_neocrm3`
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
(2, 'Root', 'root'),
(3, 'Proyectos', 'Proyectos/index'),
(4, 'usuario/permisosusuario', 'usuario/permisosusuario'),
(5, 'Es para los proyectos', 'desarrollador'),
(6, 'Presmiso para desarrollador de proyecto', '1_desarrollador'),
(7, 'Presmiso para desarrollador de proyecto', '1_administrador'),
(8, 'Presmiso para desarrollador de proyecto', '2_desarrollador'),
(9, 'Presmiso para desarrollador de proyecto', '7_administrador'),
(12, 'administrador de proyecto', '9_administrador');

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
(1, 'root', '', 'root', '$2y$10$.PjXIjfHsgOy2b20AGnJ8uLpI2VyGJuYqHyxipkI.v070NIMqAFxe', 1, 1, 1, '0000-00-00 00:00:00', 0, '2016-04-25 12:05:09', 0, '2016-04-25 12:05:09');

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
-- Volcado de datos para la tabla `acl_user_permissions`
--

INSERT INTO `acl_user_permissions` (`user`, `permission`, `value`) VALUES
(1, 2, 1),
(1, 6, 0),
(1, 7, 0),
(1, 8, 1),
(1, 12, 1),
(4, 6, 1),
(4, 7, 1),
(5, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_cliente`
--

CREATE TABLE `crm_cliente` (
  `id` int(11) NOT NULL,
  `razonSocial` text NOT NULL,
  `estadoActivoInactivo` int(11) NOT NULL,
  `created` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm_cliente`
--

INSERT INTO `crm_cliente` (`id`, `razonSocial`, `estadoActivoInactivo`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(31, 'Razon Social', 1, 1, '2016-05-11 13:03:51', 1, '2016-05-13 16:01:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_cliente_contacto`
--

CREATE TABLE `crm_cliente_contacto` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcliente` int(10) UNSIGNED NOT NULL,
  `idcontacto` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_contacto`
--

CREATE TABLE `crm_contacto` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `estadoActivoInactivo` tinyint(1) NOT NULL DEFAULT '0',
  `created` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) UNSIGNED NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm_contacto`
--

INSERT INTO `crm_contacto` (`id`, `nombre`, `apellidos`, `estadoActivoInactivo`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(2, '2', '2', 1, 1, '2016-05-02 13:35:30', 1, '2016-05-02 13:35:30'),
(3, '6', '6', 1, 1, '2016-05-02 13:38:19', 1, '2016-05-02 13:38:19'),
(7, 'contacto 1.1', '', 1, 1, '2016-05-10 11:29:42', 1, '2016-05-10 11:29:42'),
(8, 'contacto 1.2', '', 1, 1, '2016-05-10 11:29:46', 1, '2016-05-10 11:29:46'),
(9, 'contacto 1.3', '', 1, 1, '2016-05-10 11:29:53', 1, '2016-05-10 11:29:53'),
(10, 'contacto 1.1', 'tres', 1, 1, '2016-05-11 09:38:17', 1, '2016-05-11 09:38:17'),
(11, '1', '', 1, 1, '2016-05-11 13:07:09', 1, '2016-05-11 13:07:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_detallesCliente`
--

CREATE TABLE `crm_detallesCliente` (
  `idCliente` int(10) UNSIGNED NOT NULL,
  `atributo` varchar(100) NOT NULL,
  `valor` text NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) UNSIGNED NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm_detallesCliente`
--

INSERT INTO `crm_detallesCliente` (`idCliente`, `atributo`, `valor`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(31, 'cp', '', 1, '2016-05-11 13:03:51', 1, '2016-05-13 16:01:10'),
(31, 'direccion', '', 1, '2016-05-11 13:03:51', 1, '2016-05-13 16:01:10'),
(31, 'logotipo', 'access_public/imagenes/logo/Razon_Social/manzanas.jpeg', 1, '2016-05-13 16:01:10', 1, '2016-05-13 16:01:10'),
(31, 'sitio_web', '', 1, '2016-05-11 13:03:51', 1, '2016-05-13 16:01:10'),
(31, 'telefono_1', '', 1, '2016-05-11 13:03:51', 1, '2016-05-13 16:01:10'),
(31, 'telefono_2', '', 1, '2016-05-11 13:03:51', 1, '2016-05-13 16:01:10'),
(31, 'tipo_de_empresa', 'AAA', 1, '2016-05-11 13:03:51', 1, '2016-05-13 16:01:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_detallesContacto`
--

CREATE TABLE `crm_detallesContacto` (
  `idContacto` int(11) NOT NULL,
  `atributo` varchar(100) NOT NULL,
  `valor` text NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) UNSIGNED NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm_detallesContacto`
--

INSERT INTO `crm_detallesContacto` (`idContacto`, `atributo`, `valor`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(2, 'celular', '2', 1, '2016-05-02 13:35:31', 1, '2016-05-02 13:35:31'),
(2, 'e-mail', '2', 1, '2016-05-02 13:35:31', 1, '2016-05-02 13:35:31'),
(2, 'puesto', '2', 1, '2016-05-02 13:35:31', 1, '2016-05-02 13:35:31'),
(2, 'telefono_1', '2 ext. 2', 1, '2016-05-02 13:35:31', 1, '2016-05-02 13:35:31'),
(2, 'telefono_2', '2 ext. 2', 1, '2016-05-02 13:35:31', 1, '2016-05-02 13:35:31'),
(3, 'celular', '6', 1, '2016-05-02 13:38:19', 1, '2016-05-02 13:38:19'),
(3, 'e-mail', '6', 1, '2016-05-02 13:38:19', 1, '2016-05-02 13:38:19'),
(3, 'puesto', '6', 1, '2016-05-02 13:38:19', 1, '2016-05-02 13:38:19'),
(3, 'telefono_1', '6 ext. 6', 1, '2016-05-02 13:38:19', 1, '2016-05-02 13:38:19'),
(3, 'telefono_2', '6 ext. 6', 1, '2016-05-02 13:38:19', 1, '2016-05-02 13:38:19'),
(7, 'celular', '', 1, '2016-05-10 11:29:42', 1, '2016-05-10 11:29:42'),
(7, 'e-mail', '', 1, '2016-05-10 11:29:42', 1, '2016-05-10 11:29:42'),
(7, 'puesto', '', 1, '2016-05-10 11:29:42', 1, '2016-05-10 11:29:42'),
(7, 'telefono_1', ' ext. ', 1, '2016-05-10 11:29:42', 1, '2016-05-10 11:29:42'),
(7, 'telefono_2', ' ext. ', 1, '2016-05-10 11:29:42', 1, '2016-05-10 11:29:42'),
(8, 'celular', '', 1, '2016-05-10 11:29:46', 1, '2016-05-10 11:29:46'),
(8, 'e-mail', '', 1, '2016-05-10 11:29:46', 1, '2016-05-10 11:29:46'),
(8, 'puesto', '', 1, '2016-05-10 11:29:46', 1, '2016-05-10 11:29:46'),
(8, 'telefono_1', ' ext. ', 1, '2016-05-10 11:29:46', 1, '2016-05-10 11:29:46'),
(8, 'telefono_2', ' ext. ', 1, '2016-05-10 11:29:46', 1, '2016-05-10 11:29:46'),
(9, 'celular', '', 1, '2016-05-10 11:29:53', 1, '2016-05-10 11:29:53'),
(9, 'e-mail', '', 1, '2016-05-10 11:29:53', 1, '2016-05-10 11:29:53'),
(9, 'puesto', '', 1, '2016-05-10 11:29:53', 1, '2016-05-10 11:29:53'),
(9, 'telefono_1', ' ext. ', 1, '2016-05-10 11:29:53', 1, '2016-05-10 11:29:53'),
(9, 'telefono_2', ' ext. ', 1, '2016-05-10 11:29:53', 1, '2016-05-10 11:29:53'),
(10, 'celular', '', 1, '2016-05-11 09:38:17', 1, '2016-05-11 09:38:17'),
(10, 'e-mail', '', 1, '2016-05-11 09:38:17', 1, '2016-05-11 09:38:17'),
(10, 'puesto', '', 1, '2016-05-11 09:38:17', 1, '2016-05-11 09:38:17'),
(10, 'telefono_1', ' ext. ', 1, '2016-05-11 09:38:17', 1, '2016-05-11 09:38:17'),
(10, 'telefono_2', ' ext. ', 1, '2016-05-11 09:38:17', 1, '2016-05-11 09:38:17'),
(11, 'celular', '', 1, '2016-05-11 13:07:09', 1, '2016-05-11 13:07:09'),
(11, 'e-mail', '', 1, '2016-05-11 13:07:09', 1, '2016-05-11 13:07:09'),
(11, 'puesto', '', 1, '2016-05-11 13:07:09', 1, '2016-05-11 13:07:09'),
(11, 'telefono_1', ' ext. ', 1, '2016-05-11 13:07:09', 1, '2016-05-11 13:07:09'),
(11, 'telefono_2', ' ext. ', 1, '2016-05-11 13:07:09', 1, '2016-05-11 13:07:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_proyecto`
--

CREATE TABLE `crm_proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `idServicio` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fechaEntrega` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm_proyecto`
--

INSERT INTO `crm_proyecto` (`id`, `nombre`, `descripcion`, `idServicio`, `idCliente`, `estado`, `fechaInicio`, `fechaEntrega`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(1, 'test', 'test', 6, 6, 1, '2016-05-06 00:00:00', '2016-05-13 00:00:00', 4, '2016-05-03 11:40:21', 4, '2016-05-03 11:40:21'),
(2, 'hola mundo ', 'fotos2', 6, 6, 1, '2016-05-04 00:00:00', '2016-05-25 00:00:00', 4, '2016-05-03 11:45:25', 4, '2016-05-03 11:45:25'),
(3, '', '', 6, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, '2016-05-03 11:52:05', 4, '2016-05-03 11:52:05'),
(4, '', '', 6, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2016-05-06 09:34:28', 1, '2016-05-06 09:34:28'),
(5, 'dos', 'algo', 6, 6, 1, '2016-05-10 00:00:00', '2016-05-19 00:00:00', 1, '2016-05-06 09:38:10', 1, '2016-05-06 09:38:10'),
(6, 'test', '', 6, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2016-05-06 12:14:35', 1, '2016-05-06 12:14:35'),
(7, 'test', '', 6, 6, 1, '2016-05-04 00:00:00', '2016-05-10 00:00:00', 1, '2016-05-06 12:17:50', 1, '2016-05-06 12:17:50'),
(8, '', '', 6, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2016-05-10 10:48:28', 1, '2016-05-10 10:48:28'),
(9, 'test4', '', 6, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2016-05-10 11:46:52', 1, '2016-05-10 11:46:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_proyecto_contactos`
--

CREATE TABLE `crm_proyecto_contactos` (
  `idProyecto` int(10) UNSIGNED NOT NULL,
  `idContacto` int(10) UNSIGNED NOT NULL,
  `dscripcion` text NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) UNSIGNED NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_proyecto_users`
--

CREATE TABLE `crm_proyecto_users` (
  `idProyecto` int(10) UNSIGNED NOT NULL,
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `rol` enum('administrador','desarrollador') NOT NULL DEFAULT 'desarrollador',
  `created` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` int(10) UNSIGNED NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm_proyecto_users`
--

INSERT INTO `crm_proyecto_users` (`idProyecto`, `idUsuario`, `rol`, `created`, `created_at`, `modified`, `modified_at`) VALUES
(1, 1, 'administrador', 1, '2016-05-06 10:35:56', 1, '2016-05-06 10:35:56'),
(1, 4, 'desarrollador', 1, '2016-05-06 10:36:37', 1, '2016-05-06 10:36:37'),
(2, 1, 'desarrollador', 1, '2016-05-06 10:36:12', 1, '2016-05-06 10:36:12'),
(7, 5, 'administrador', 1, '2016-05-06 13:23:51', 1, '2016-05-06 13:23:51'),
(9, 1, 'administrador', 1, '2016-05-10 11:52:28', 1, '2016-05-10 11:52:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_servicio`
--

CREATE TABLE `crm_servicio` (
  `id` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm_servicio`
--

INSERT INTO `crm_servicio` (`id`, `fechaRegistro`, `nombre`, `descripcion`) VALUES
(6, '2016-04-25 15:41:38', 'diseno23', 'descripciono');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acl_permissions`
--
ALTER TABLE `acl_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indices de la tabla `acl_user_permissions`
--
ALTER TABLE `acl_user_permissions`
  ADD UNIQUE KEY `user` (`user`,`permission`),
  ADD KEY `permission` (`permission`);

--
-- Indices de la tabla `crm_cliente`
--
ALTER TABLE `crm_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crm_cliente_contacto`
--
ALTER TABLE `crm_cliente_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crm_contacto`
--
ALTER TABLE `crm_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crm_detallesCliente`
--
ALTER TABLE `crm_detallesCliente`
  ADD UNIQUE KEY `idCliente` (`idCliente`,`atributo`);

--
-- Indices de la tabla `crm_detallesContacto`
--
ALTER TABLE `crm_detallesContacto`
  ADD UNIQUE KEY `idContacto` (`idContacto`,`atributo`);

--
-- Indices de la tabla `crm_proyecto`
--
ALTER TABLE `crm_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crm_proyecto_contactos`
--
ALTER TABLE `crm_proyecto_contactos`
  ADD UNIQUE KEY `idProyecto` (`idProyecto`,`idContacto`);

--
-- Indices de la tabla `crm_proyecto_users`
--
ALTER TABLE `crm_proyecto_users`
  ADD UNIQUE KEY `idProyecto` (`idProyecto`,`idUsuario`);

--
-- Indices de la tabla `crm_servicio`
--
ALTER TABLE `crm_servicio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acl_permissions`
--
ALTER TABLE `acl_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
-- AUTO_INCREMENT de la tabla `crm_cliente`
--
ALTER TABLE `crm_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `crm_cliente_contacto`
--
ALTER TABLE `crm_cliente_contacto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crm_contacto`
--
ALTER TABLE `crm_contacto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `crm_proyecto`
--
ALTER TABLE `crm_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `crm_servicio`
--
ALTER TABLE `crm_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
