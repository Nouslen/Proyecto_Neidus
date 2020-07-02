-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2020 a las 19:57:18
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `neidus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `user` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `Persona_Rut` varchar(12) NOT NULL,
  PRIMARY KEY (`idAdministrador`),
  KEY `fk_Administrador_Persona1` (`Persona_Rut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `Foto` varchar(250) DEFAULT NULL,
  `Persona_Rut` varchar(12) NOT NULL,
  `Curso_id_Curso` int(11) NOT NULL,
  PRIMARY KEY (`id_alumno`,`Curso_id_Curso`),
  KEY `fk_Alumno_Persona1` (`Persona_Rut`),
  KEY `fk_Alumno_Curso1` (`Curso_id_Curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `numero`, `Foto`, `Persona_Rut`, `Curso_id_Curso`) VALUES
(2, 1, 'pepitto.jpg', '19.948.985-2', 0),
(3, 1, 'Alumn_3.jpg', '19.983.738-9', 999),
(4, 1, 'usuario.jpg', '20.446.533-9', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE IF NOT EXISTS `apoderado` (
  `id_apoderado` int(11) NOT NULL AUTO_INCREMENT,
  `matricula_alumno` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `Persona_Rut` varchar(12) NOT NULL,
  `Alumno_id_alumno` int(11) NOT NULL,
  `Alumno_Curso_id_Curso` int(11) NOT NULL,
  PRIMARY KEY (`id_apoderado`,`Alumno_id_alumno`,`Alumno_Curso_id_Curso`),
  KEY `fk_Apoderado_Persona1` (`Persona_Rut`),
  KEY `fk_Apoderado_Alumno1` (`Alumno_id_alumno`,`Alumno_Curso_id_Curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`id_apoderado`, `matricula_alumno`, `estado`, `Persona_Rut`, `Alumno_id_alumno`, `Alumno_Curso_id_Curso`) VALUES
(1, '2', 1, '19.948.985-2', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE IF NOT EXISTS `asignatura` (
  `idAsignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(45) DEFAULT NULL,
  `Curso_id_Curso` int(11) NOT NULL,
  PRIMARY KEY (`idAsignatura`,`Curso_id_Curso`),
  KEY `fk_Asignatura_Curso1` (`Curso_id_Curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE IF NOT EXISTS `contenido` (
  `id_contenido` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `tnombre` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `Unidad_id_Unidad` int(11) NOT NULL,
  `Unidad_Asignatura_idAsignatura` int(11) NOT NULL,
  PRIMARY KEY (`id_contenido`,`Unidad_id_Unidad`,`Unidad_Asignatura_idAsignatura`),
  KEY `fk_Contenido_Unidad1` (`Unidad_id_Unidad`,`Unidad_Asignatura_idAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_Curso` int(11) NOT NULL,
  `nombre_curso` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_Curso`, `nombre_curso`, `estado`) VALUES
(0, 'Cuarto Medio', 1),
(999, 'Quinto Medio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `idNota` int(11) NOT NULL,
  `asignatura` varchar(45) DEFAULT NULL,
  `nota` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `Asignatura_idAsignatura` int(11) NOT NULL,
  PRIMARY KEY (`idNota`,`Asignatura_idAsignatura`),
  KEY `fk_Nota_Asignatura1` (`Asignatura_idAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `Rut` varchar(12) CHARACTER SET utf8 NOT NULL,
  `Nombre` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Ap_Paterno` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Ap_Materno` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Sexo` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `correo` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `clave` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`Rut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Rut`, `Nombre`, `Ap_Paterno`, `Ap_Materno`, `Telefono`, `Edad`, `Sexo`, `correo`, `numero`, `clave`) VALUES
('19.948.985-2', 'Kevin', 'Godoy', 'Perez', '56976208367', 21, 'Masculino', 'pepitto@gmail.com', 1, 'Abc-123'),
('19.983.738-9', 'Francisco', 'Ponce', 'Villalobos', '56911111111', 21, 'Masculino', 'franciso.ponce@gmail.com', 1, '19983'),
('19.983.892-k', 'Mauro', 'Peralta', 'Rojas', '56913313422', 21, 'Masculino', 'murit0@gmail.com', 3, 'Abc-123'),
('20.000.678-k', 'Benjamin', 'Ceron', 'Ramirez', '56971512473', 21, 'Masculino', 'benjamin.ceron@inacapmail.cl', 4, 'Abc-123'),
('20.288.546-2', 'Angel', 'Rodriguez', 'Herrera', '56912345678', 21, 'Masculino', 'bronipls@gmail.com', 2, 'Abc-123'),
('20.446.533-9', 'Evil5', 'frost5', 'Fire5', '56911111111', 22, 'Masculino', 'evill5@gmail.com', 1, '20446');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE IF NOT EXISTS `profesor` (
  `idProfesor` int(11) NOT NULL AUTO_INCREMENT,
  `Foto` varchar(250) DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `Persona_Rut` varchar(12) NOT NULL,
  PRIMARY KEY (`idProfesor`),
  KEY `fk_Profesor_Persona1` (`Persona_Rut`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`idProfesor`, `Foto`, `area`, `estado`, `Persona_Rut`) VALUES
(1, 'murito.jpg', 'Cs. básicas', 1, '19.983.892-k');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_has_asignatura`
--

CREATE TABLE IF NOT EXISTS `profesor_has_asignatura` (
  `Profesor_idProfesor` int(11) NOT NULL,
  `Asignatura_idAsignatura` int(11) NOT NULL,
  PRIMARY KEY (`Profesor_idProfesor`,`Asignatura_idAsignatura`),
  KEY `fk_Profesor_has_Asignatura_Asignatura1` (`Asignatura_idAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE IF NOT EXISTS `unidad` (
  `id_Unidad` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `Asignatura_idAsignatura` int(11) NOT NULL,
  PRIMARY KEY (`id_Unidad`,`Asignatura_idAsignatura`),
  KEY `fk_Unidad_Asignatura` (`Asignatura_idAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_Administrador_Persona1` FOREIGN KEY (`Persona_Rut`) REFERENCES `persona` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_Alumno_Curso1` FOREIGN KEY (`Curso_id_Curso`) REFERENCES `curso` (`id_Curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Alumno_Persona1` FOREIGN KEY (`Persona_Rut`) REFERENCES `persona` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD CONSTRAINT `fk_Apoderado_Alumno1` FOREIGN KEY (`Alumno_id_alumno`, `Alumno_Curso_id_Curso`) REFERENCES `alumno` (`id_alumno`, `Curso_id_Curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Apoderado_Persona1` FOREIGN KEY (`Persona_Rut`) REFERENCES `persona` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `fk_Asignatura_Curso1` FOREIGN KEY (`Curso_id_Curso`) REFERENCES `curso` (`id_Curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `fk_Contenido_Unidad1` FOREIGN KEY (`Unidad_id_Unidad`, `Unidad_Asignatura_idAsignatura`) REFERENCES `unidad` (`id_Unidad`, `Asignatura_idAsignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_Nota_Asignatura1` FOREIGN KEY (`Asignatura_idAsignatura`) REFERENCES `asignatura` (`idAsignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_Profesor_Persona1` FOREIGN KEY (`Persona_Rut`) REFERENCES `persona` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor_has_asignatura`
--
ALTER TABLE `profesor_has_asignatura`
  ADD CONSTRAINT `fk_Profesor_has_Asignatura_Asignatura1` FOREIGN KEY (`Asignatura_idAsignatura`) REFERENCES `asignatura` (`idAsignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Profesor_has_Asignatura_Profesor1` FOREIGN KEY (`Profesor_idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD CONSTRAINT `fk_Unidad_Asignatura` FOREIGN KEY (`Asignatura_idAsignatura`) REFERENCES `asignatura` (`idAsignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
