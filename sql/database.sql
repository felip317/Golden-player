-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2026 a las 21:16:16
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
-- Base de datos: `goal`
--
CREATE DATABASE IF NOT EXISTS `goal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `goal`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canchas`
--

DROP TABLE IF EXISTS `canchas`;
CREATE TABLE `canchas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `capacidad` varchar(20) DEFAULT NULL,
  `precio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canchas`
--

INSERT INTO `canchas` (`id`, `nombre`, `descripcion`, `capacidad`, `precio`) VALUES
(1, 'Cancha 1', 'Cancha de futbol 5', '10 jugadores', '80000'),
(2, 'Cancha 2', 'Cancha de futbol 8', '16 jugadores', '120000'),
(3, 'Cancha 3', 'Cancha de futbol 11', '22 jugadores', '150000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `grupo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre`, `grupo`) VALUES
(1, 'Qatar', 'A'),
(2, 'Ecuador', 'A'),
(3, 'Senegal', 'A'),
(4, 'Paises Bajos', 'A'),
(5, 'Inglaterra', 'B'),
(6, 'Iran', 'B'),
(7, 'Usa', 'B'),
(8, 'Gales', 'B'),
(9, 'Argentina', 'C'),
(10, 'Arabia Saudita', 'C'),
(11, 'Mexico', 'C'),
(12, 'Polonia', 'C'),
(13, 'Francia', 'D'),
(14, 'Australia', 'D'),
(15, 'Dinamarca', 'D'),
(16, 'Tunez', 'D'),
(17, 'España', 'E'),
(18, 'Costa Rica', 'E'),
(19, 'Alemania', 'E'),
(20, 'Japon', 'E'),
(21, 'Belgica', 'F'),
(22, 'Canada', 'F'),
(23, 'Marruecos', 'F'),
(24, 'Croacia', 'F'),
(25, 'Brazil', 'G'),
(26, 'Serbia', 'G'),
(27, 'Suiza', 'G'),
(28, 'Camerun', 'G'),
(29, 'Portugal', 'H'),
(30, 'Ghana', 'H'),
(31, 'Uruguay', 'H'),
(32, 'Corea del Sur', 'H');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_grupos`
--

DROP TABLE IF EXISTS `equipos_grupos`;
CREATE TABLE `equipos_grupos` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_equipos`
--

DROP TABLE IF EXISTS `estadisticas_equipos`;
CREATE TABLE `estadisticas_equipos` (
  `id` int(11) NOT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  `goles_recibidos` int(11) DEFAULT 0,
  `goles_a_favor` int(11) DEFAULT 0,
  `partidos_jugados` int(11) DEFAULT 0,
  `puntos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_jugadores`
--

DROP TABLE IF EXISTS `estadisticas_jugadores`;
CREATE TABLE `estadisticas_jugadores` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `goles` int(11) DEFAULT 0,
  `asistencias` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

DROP TABLE IF EXISTS `gastos`;
CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `pagado` tinyint(1) DEFAULT 0,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `concepto`, `valor`, `fecha_limite`, `pagado`, `creado_en`) VALUES
(6, 'pago de la luz', 450000.00, '2025-12-31', 0, '2025-12-02 23:49:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  `nombre` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_equipos`
--

DROP TABLE IF EXISTS `jugadores_equipos`;
CREATE TABLE `jugadores_equipos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

DROP TABLE IF EXISTS `partidos`;
CREATE TABLE `partidos` (
  `id_partido` int(11) NOT NULL,
  `id_equipo_local` int(11) DEFAULT NULL,
  `id_equipo_visitante` int(11) DEFAULT NULL,
  `goles_local` int(11) DEFAULT 0,
  `goles_visitante` int(11) DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `jugado` tinyint(1) DEFAULT 0,
  `torneo_id` int(11) DEFAULT NULL,
  `fase` varchar(50) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO partidos (
  id_partido,
  id_equipo_local,
  id_equipo_visitante,
  goles_local,
  goles_visitante,
  fecha,
  jugado,
  torneo_id,
  fase,
  grupo_id
) VALUES
(1,1,2,0,2,'2022-11-20',1,2,'grupos',NULL),
(2,3,4,0,2,'2022-11-21',1,2,'grupos',NULL),
(3,1,3,1,3,'2022-11-25',1,2,'grupos',NULL),
(4,4,2,1,1,'2022-11-25',1,2,'grupos',NULL),
(5,4,1,2,0,'2022-11-29',1,2,'grupos',NULL),
(6,2,3,1,2,'2022-11-29',1,2,'grupos',NULL),
(7,5,6,6,2,'2022-11-21',1,2,'grupos',NULL),
(8,7,8,1,1,'2022-11-21',1,2,'grupos',NULL),
(9,8,6,0,2,'2022-11-25',1,2,'grupos',NULL),
(10,5,7,0,0,'2022-11-25',1,2,'grupos',NULL),
(11,8,5,0,3,'2022-11-29',1,2,'grupos',NULL),
(12,6,7,0,1,'2022-11-29',1,2,'grupos',NULL),
(13,9,10,1,2,'2022-11-22',1,2,'grupos',NULL),
(14,11,12,0,0,'2022-11-22',1,2,'grupos',NULL),
(15,9,11,2,0,'2022-11-26',1,2,'grupos',NULL),
(16,12,10,2,0,'2022-11-26',1,2,'grupos',NULL),
(17,9,12,2,0,'2022-11-30',1,2,'grupos',NULL),
(18,10,11,1,2,'2022-11-30',1,2,'grupos',NULL),
(19,13,14,4,1,'2022-11-22',1,2,'grupos',NULL),
(20,15,16,0,0,'2022-11-22',1,2,'grupos',NULL),
(21,16,14,0,1,'2022-11-26',1,2,'grupos',NULL),
(22,13,15,2,1,'2022-11-26',1,2,'grupos',NULL),
(23,16,13,1,0,'2022-11-30',1,2,'grupos',NULL),
(24,14,15,1,0,'2022-11-30',1,2,'grupos',NULL),
(25,17,18,7,0,'2022-11-23',1,2,'grupos',NULL),
(26,19,20,1,2,'2022-11-23',1,2,'grupos',NULL),
(27,20,18,0,1,'2022-11-27',1,2,'grupos',NULL),
(28,17,19,1,1,'2022-11-27',1,2,'grupos',NULL),
(29,20,17,2,1,'2022-12-01',1,2,'grupos',NULL),
(30,18,19,2,4,'2022-12-01',1,2,'grupos',NULL),
(31,21,22,1,0,'2022-11-23',1,2,'grupos',NULL),
(32,23,24,0,0,'2022-11-23',1,2,'grupos',NULL),
(33,21,23,0,2,'2022-11-27',1,2,'grupos',NULL),
(34,24,22,4,1,'2022-11-27',1,2,'grupos',NULL),
(35,24,21,0,0,'2022-12-01',1,2,'grupos',NULL),
(36,22,23,1,2,'2022-12-01',1,2,'grupos',NULL),
(37,25,26,2,0,'2022-11-24',1,2,'grupos',NULL),
(38,27,28,1,0,'2022-11-24',1,2,'grupos',NULL),
(39,28,26,3,3,'2022-11-28',1,2,'grupos',NULL),
(40,25,27,1,0,'2022-11-28',1,2,'grupos',NULL),
(41,28,25,1,0,'2022-12-02',1,2,'grupos',NULL),
(42,26,27,2,3,'2022-12-02',1,2,'grupos',NULL),
(43,29,30,3,2,'2022-11-24',1,2,'grupos',NULL),
(44,31,32,0,0,'2022-11-24',1,2,'grupos',NULL),
(45,32,30,2,3,'2022-11-28',1,2,'grupos',NULL),
(46,29,31,2,0,'2022-11-28',1,2,'grupos',NULL),
(47,32,29,2,1,'2022-12-02',1,2,'grupos',NULL),
(48,30,31,0,2,'2022-12-02',1,2,'grupos',NULL),
(49,4,7,3,1,'2022-12-03',1,1,'octavos',NULL),
(50,9,14,2,1,'2022-12-03',1,1,'octavos',NULL),
(51,20,24,1,1,'2022-12-04',1,1,'octavos',NULL),
(52,25,32,4,1,'2022-12-04',1,1,'octavos',NULL),
(53,5,3,3,0,'2022-12-05',1,1,'octavos',NULL),
(54,13,12,3,1,'2022-12-05',1,1,'octavos',NULL),
(55,23,17,0,0,'2022-12-06',1,1,'octavos',NULL),
(56,29,27,6,1,'2022-12-06',1,1,'octavos',NULL),
(57,4,9,2,2,'2022-12-09',1,1,'cuartos',NULL),
(58,24,25,1,1,'2022-12-09',1,2,'cuartos',NULL),
(59,5,13,1,2,'2022-12-10',1,1,'cuartos',NULL),
(60,23,29,1,0,'2022-12-10',1,1,'cuartos',NULL),
(61,9,24,3,0,'2022-12-13',1,2,'semifinal',NULL),
(62,13,23,2,0,'2022-12-14',1,2,'semifinal',NULL),
(63,9,13,3,3,'2022-12-18',1,2,'final',NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `cancha_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('en_espera','confirmada','cancelada') DEFAULT 'en_espera',
  `motivo_cancelacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `cancha_id`, `fecha`, `hora`, `nombre`, `email`, `telefono`, `creado_en`, `estado`, `motivo_cancelacion`) VALUES
(1, 1, '2025-12-22', '18:00:00', 'Laura', 'laura@gmail.com', '3005829146', '2025-12-20 15:28:10', 'cancelada', 'El clima no está favorable'),
(2, 1, '2025-12-21', '20:00:00', 'Andres', 'andres@gmail.com', '3127496038', '2025-12-20 23:40:41', 'confirmada', 'NULL'),
(3, 1, '2026-01-24', '13:00:00', 'Maria', 'maria@gmail.com', '3152684709', '2026-01-03 13:19:48', 'cancelada', 'NULL'),
(4, 1, '2026-01-24', '13:00:00', 'Julian', 'julian@gmail.com', '3019358264', '2026-01-03 13:19:48', 'cancelada', 'El clima no está favorable'),
(5, 1, '2026-01-20', '19:00:00', 'Oscar', 'oscar@gmail.com', '3204175902', '2026-01-03 13:37:53', 'en_espera', NULL),
(6, 1, '2026-01-11', '21:00:00', 'jose', 'jose@gmail.com', '3048612735', '2026-01-03 15:36:47', 'en_espera', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

DROP TABLE IF EXISTS `torneos`;
CREATE TABLE `torneos` (
  `id_torneo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`id_torneo`, `nombre`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Europa League', '2025-12-05', '2025-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `rol` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `username`, `email`, `password_hash`, `created_at`, `rol`) VALUES
(1, 'administrador', 'admin', 'Administrador', 'admin@gmail.com.co', 'A9f#Q2mL!7', '2025-12-01 17:11:12', 'admin'),
(2, 'alex', 'hernandez', 'alex913', 'alex@gmail.com', 'password', '2025-12-01 19:32:44', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `equipos_grupos`
--
ALTER TABLE `equipos_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `equipo_id` (`equipo_id`);

--
-- Indices de la tabla `estadisticas_equipos`
--
ALTER TABLE `estadisticas_equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_id` (`equipo_id`),
  ADD KEY `torneo_id` (`torneo_id`);

--
-- Indices de la tabla `estadisticas_jugadores`
--
ALTER TABLE `estadisticas_jugadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `torneo_id` (`torneo_id`);

--
-- Indices de la tabla `jugadores_equipos`
--
ALTER TABLE `jugadores_equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `equipo_id` (`equipo_id`),
  ADD KEY `torneo_id` (`torneo_id`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id_partido`),
  ADD KEY `id_equipo_local` (`id_equipo_local`),
  ADD KEY `id_equipo_visitante` (`id_equipo_visitante`),
  ADD KEY `torneo_id` (`torneo_id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancha_id` (`cancha_id`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id_torneo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canchas`
--
ALTER TABLE `canchas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `equipos_grupos`
--
ALTER TABLE `equipos_grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_equipos`
--
ALTER TABLE `estadisticas_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_jugadores`
--
ALTER TABLE `estadisticas_jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores_equipos`
--
ALTER TABLE `jugadores_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id_torneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos_grupos`
--
ALTER TABLE `equipos_grupos`
  ADD CONSTRAINT `equipos_grupos_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `equipos_grupos_ibfk_2` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipo`);

--
-- Filtros para la tabla `estadisticas_equipos`
--
ALTER TABLE `estadisticas_equipos`
  ADD CONSTRAINT `estadisticas_equipos_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipo`),
  ADD CONSTRAINT `estadisticas_equipos_ibfk_2` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id_torneo`);

--
-- Filtros para la tabla `estadisticas_jugadores`
--
ALTER TABLE `estadisticas_jugadores`
  ADD CONSTRAINT `estadisticas_jugadores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id_torneo`);

--
-- Filtros para la tabla `jugadores_equipos`
--
ALTER TABLE `jugadores_equipos`
  ADD CONSTRAINT `jugadores_equipos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `jugadores_equipos_ibfk_2` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipo`),
  ADD CONSTRAINT `jugadores_equipos_ibfk_3` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id_torneo`);

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `partidos_ibfk_1` FOREIGN KEY (`id_equipo_local`) REFERENCES `equipos` (`id_equipo`),
  ADD CONSTRAINT `partidos_ibfk_2` FOREIGN KEY (`id_equipo_visitante`) REFERENCES `equipos` (`id_equipo`),
  ADD CONSTRAINT `partidos_ibfk_3` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id_torneo`),
  ADD CONSTRAINT `partidos_ibfk_4` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`cancha_id`) REFERENCES `canchas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
