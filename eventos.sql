-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 00:06:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `evento_ti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `cedula` int(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `telefono` int(10) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `num_boleto` int(100) NOT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`cedula`, `nombres`, `telefono`, `correo`, `fecha`, `num_boleto`, `precio`) VALUES
(168645363, 'Tony Guevara', 789456389, 'tony@gmail.com', '2024-05-25', 43033883, 5.75),
(346497463, 'Marcelo Pozo', 984672836, 'marcelo@gmail.com', '2024-05-25', 80964198, 1.15),
(401789565, 'Anderson Garzon', 746473278, 'ander@gmail.com', '2024-05-26', 78688927, 5.75),
(455378495, 'Jeff Fraga', 968831507, 'lalkskj@gmail.com', '2024-05-26', 16105371, 1.15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`cedula`),
  ADD UNIQUE KEY `num_boleto` (`num_boleto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
