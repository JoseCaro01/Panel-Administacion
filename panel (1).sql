-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2021 a las 12:15:43
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `panel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `cod_asignatura` int(11) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `nombre_asignatura` varchar(45) NOT NULL,
  `n_horas` int(11) NOT NULL,
  `profesor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`cod_asignatura`, `cod_curso`, `cod_usuario`, `nombre_asignatura`, `n_horas`, `profesor`) VALUES
(11, 7, 1, 'PHP', 5, 'Maria Gallego');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `cod_curso` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`cod_curso`, `cod_usuario`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(7, 1, '2º DAM', 'Grado Medio', '2021-10-12 00:00:00', '2021-12-03 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `cod_tareas` int(11) NOT NULL,
  `cod_asignatura` int(11) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `estado` enum('PENDIENTE','TRABAJANDO','TERMINADA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`cod_tareas`, `cod_asignatura`, `cod_curso`, `cod_usuario`, `descripcion`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(29, 11, 7, 1, 'cewqnvre', '2000-11-11 00:00:00', '2000-11-11 00:00:00', 'PENDIENTE'),
(30, 11, 7, 1, 'soyyo', '2001-12-30 00:00:00', '2001-12-30 00:00:00', 'TRABAJANDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `email`, `password`, `nombre`) VALUES
(1, 'jose@gmail.com', 'mascara12', 'Jose Caro'),
(2, 'andrei@gmail.com', 'mascara12', 'Andrei Szambati');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`cod_asignatura`,`cod_curso`,`cod_usuario`),
  ADD KEY `FK1 cod_curso_idx` (`cod_curso`),
  ADD KEY `FK2 cod_usuario_idx` (`cod_usuario`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod_curso`,`cod_usuario`),
  ADD KEY `FK cod_usuario_idx` (`cod_usuario`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`cod_tareas`,`cod_asignatura`,`cod_curso`,`cod_usuario`),
  ADD KEY `FK3 cod_asignatura_idx` (`cod_asignatura`),
  ADD KEY `FK4 cod_curso_idx` (`cod_curso`),
  ADD KEY `FK5 cod_usuario_idx` (`cod_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `cod_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cod_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `cod_tareas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `FK1 cod_curso` FOREIGN KEY (`cod_curso`) REFERENCES `curso` (`cod_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK2 cod_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `curso` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `FK cod_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `FK3 cod_asignatura` FOREIGN KEY (`cod_asignatura`) REFERENCES `asignatura` (`cod_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK4 cod_curso` FOREIGN KEY (`cod_curso`) REFERENCES `curso` (`cod_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK5 cod_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
