-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2018 a las 03:10:01
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--
CREATE DATABASE  IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `acompanamiento` varchar(100) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL,
  `categoria` varchar(10) DEFAULT NULL,
  `imagen` varchar(256) DEFAULT 'default.gif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `nombre`, `acompanamiento`, `descripcion`, `precio`, `categoria`, `imagen`) VALUES
(1, 'Filete a la parrilla', 'Acompañado de papa al horno, ensalda fresca y vegetales', 'Delicioso corte alto de lomo de aguja preparado al termino de tu gusto, solo la mejor carne', '25.00', 'steak', 'default.gif'),
(2, 'Medallones de Carne y cebolla', 'Acompañado de papa al horno, ensalda fresca y vegetales', 'Delicioso corte alto de pecho preparado como medallones para que te des el gusto de una buena carne de res, solo la mejor carne', '20.00', 'medallones', 'default.gif'),
(3, 'Medallones de carne y costilla de cerdo', 'Acompañado de papa al horno, ensalda fresca y vegetales', 'Deliciosas costillas de cerdo acompañadas de dos medallones de pecho de res preparad, solo la mejor carne', '35.00', 'ribs-medal', 'default.gif'),
(4, 'Costillas de ternera', 'Acompañado de papa al horno, ensalda fresca y vegetales', 'Deliciosas costillas de ternera preparadas con salsa barcacoa de piña, tamarindo o tradicional, solo la mejor carne', '25.00', 'beef-ribs', 'default.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
