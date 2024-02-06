-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2024 a las 17:08:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arropa_denda`
--
CREATE DATABASE IF NOT EXISTS `arropa_denda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `arropa_denda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arropa`
--

CREATE TABLE `arropa` (
  `id` int(11) NOT NULL,
  `izena` varchar(100) DEFAULT NULL,
  `prezioa` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `arropa`
--

INSERT INTO `arropa` (`id`, `izena`, `prezioa`) VALUES
(1, 'Camiseta', '15.99'),
(2, 'Jeans', '39.99'),
(3, 'Zapatillas', '59.99'),
(4, 'Gorra', '9.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `erabiltzaileak`
--

CREATE TABLE `erabiltzaileak` (
  `id` int(11) NOT NULL,
  `izena` varchar(100) DEFAULT NULL,
  `pasahitza` varchar(100) DEFAULT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `erabiltzaileak`
--

INSERT INTO `erabiltzaileak` (`id`, `izena`, `pasahitza`, `admin`) VALUES
(1, 'Juan', '$2y$10$6Bt9IVSwLVxXfzBrIGwTqeB44cFKRXDpttaHG352L0D5RQkzCfBEm', 0),
(2, 'Ana', '$2y$10$Qslv26iVEMGVmcu5EJxhj.Rjalwf7jf/F.O5qOzT1vPrvOd0A2Rba', 0),
(3, 'Carlos', '$2y$10$nKzJUa/CHKVroJnVcQncgukaG9g0jOTDB6.WXHsT4ENwsYe/3PVQC', 0),
(4, 'Maria', '$2y$10$xyvzRVRP/e8ukTzshyNcleJdbErrra6NuoiEWd9qBmGv61F6orKiW', 0),
(5, 'Luis', '$2y$10$xe.V5t3vtoABeT2HkTAckO1vvqMGuzUuKRccmhL.rtU008EgOCxhi', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eskariak`
--

CREATE TABLE `eskariak` (
  `id` int(11) NOT NULL,
  `id_erabiltzailea` int(11) DEFAULT NULL,
  `id_arropa` int(11) DEFAULT NULL,
  `kantitatea` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eskariak`
--

INSERT INTO `eskariak` (`id`, `id_erabiltzailea`, `id_arropa`, `kantitatea`) VALUES
(1, 1, 1, 2),
(2, 2, 3, 1),
(3, 3, 2, 1),
(5, 1, 2, 1),
(8, 1, 1, 1),
(9, 1, 1, 0),
(10, 1, 1, 0),
(11, 1, 1, 1),
(12, 1, 3, 6),
(13, 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arropa`
--
ALTER TABLE `arropa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `erabiltzaileak`
--
ALTER TABLE `erabiltzaileak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `izena` (`izena`);

--
-- Indices de la tabla `eskariak`
--
ALTER TABLE `eskariak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_erabiltzailea`),
  ADD KEY `id_ropa` (`id_arropa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eskariak`
--
ALTER TABLE `eskariak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eskariak`
--
ALTER TABLE `eskariak`
  ADD CONSTRAINT `eskariak_ibfk_1` FOREIGN KEY (`id_erabiltzailea`) REFERENCES `erabiltzaileak` (`id`),
  ADD CONSTRAINT `eskariak_ibfk_2` FOREIGN KEY (`id_arropa`) REFERENCES `arropa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
