-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-12-2015 a las 01:08:31
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id` int(11) NOT NULL,
  `idconnection` varchar(256) DEFAULT NULL,
  `mail` varchar(256) NOT NULL,
  `tipo` int(1) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id`, `idconnection`, `mail`, `tipo`, `hora`, `ip`) VALUES
(1, NULL, 'lhorvath001@ikasle.ehu.eus', 1, '2015-12-13 23:18:29', '::1'),
(2, NULL, 'lhorvath001@ikasle.ehu.eus', 1, '2015-12-13 23:20:07', '::1'),
(3, NULL, 'lhorvath001@ikasle.ehu.eus', 1, '2015-12-13 23:20:14', '::1'),
(4, NULL, 'lhorvath001@ikasle.ehu.eus', 1, '2015-12-13 23:20:23', '::1'),
(5, NULL, 'lhorvath001@ikasle.ehu.eus', 1, '2015-12-13 23:26:00', '::1'),
(6, NULL, 'lhorvath001@ikasle.ehu.eus', 1, '2015-12-13 23:28:45', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexiones`
--

CREATE TABLE `conexiones` (
  `id` int(11) NOT NULL,
  `mail` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `conexiones`
--

INSERT INTO `conexiones` (`id`, `mail`, `hora`) VALUES
(1, 'lhorvath001@ikasle.ehu.eus', '2015-12-13 21:15:22'),
(2, 'lhorvath001@ikasle.ehu.eus', '2015-12-13 21:16:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `respuesta` varchar(150) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `complejidad` int(1) NOT NULL,
  `email` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `respuesta`, `complejidad`, `email`) VALUES
(1, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(2, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(3, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(4, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(5, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(6, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(7, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(8, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(9, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(10, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus'),
(11, 'esto funciona', 'correctamente', 3, 'lhorvath001@ikasle.ehu.eus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `especialidad` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fotografia` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `email`, `password`, `telefono`, `especialidad`, `fotografia`) VALUES
('Luis Maria Horvath', 'lhorvath001@ikasle.ehu.eus', 'ijfeifjeifjei', 923849384, 'Ingenieria del Software', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conexiones`
--
ALTER TABLE `conexiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `conexiones`
--
ALTER TABLE `conexiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
