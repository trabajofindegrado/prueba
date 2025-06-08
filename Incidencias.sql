-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2025 at 07:32 PM
-- Server version: 8.0.42-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Incidencias`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int NOT NULL,
  `IdHistorial` int NOT NULL,
  `NombreUsuario` varchar(100) NOT NULL,
  `Comentario` text NOT NULL,
  `FechaComentario` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `IdHistorial`, `NombreUsuario`, `Comentario`, `FechaComentario`) VALUES
(1, 1, 'helpdesk', 'se ha realizado correctamente', '2025-04-16 12:56:34'),
(2, 2, 'helpdesk', 'todo correcto', '2025-04-16 12:56:42'),
(3, 3, 'helpdesk', 'ok', '2025-04-16 12:56:46'),
(4, 3, 'helpdesk', 'todo ok', '2025-04-16 13:28:01'),
(5, 1, 'Javier', 'muy amable ', '2025-04-16 14:06:45'),
(6, 6, 'helpdesk', 'prueba', '2025-05-16 17:03:23'),
(7, 8, 'helpdesk', 'todo solucionado', '2025-05-21 21:03:49'),
(8, 8, 'helpdesk', 'que pasa', '2025-05-21 21:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `historialIncidencia`
--

CREATE TABLE `historialIncidencia` (
  `id` int NOT NULL,
  `Título` varchar(150) NOT NULL,
  `Descripción` text NOT NULL,
  `Prioridad` enum('baja','media','alta') NOT NULL,
  `FechaCreación` datetime NOT NULL,
  `IdUsuario` int NOT NULL,
  `NombreUsuario` varchar(100) NOT NULL,
  `FechaCierre` datetime DEFAULT CURRENT_TIMESTAMP,
  `Categoria` varchar(100) DEFAULT 'otros',
  `Subcategoria` varchar(100) DEFAULT 'general'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `historialIncidencia`
--

INSERT INTO `historialIncidencia` (`id`, `Título`, `Descripción`, `Prioridad`, `FechaCreación`, `IdUsuario`, `NombreUsuario`, `FechaCierre`, `Categoria`, `Subcategoria`) VALUES
(1, 'prueba', 'prueba2', 'baja', '2025-04-15 12:47:12', 4, 'helpdesk', '2025-04-15 14:47:52', 'otros', 'general'),
(2, 'prueba3', 'prueba3', 'media', '2025-04-15 13:01:57', 4, 'helpdesk', '2025-04-15 15:04:20', 'otros', 'general'),
(3, 'prueba4', 'prueba4', 'baja', '2025-04-15 13:12:27', 4, 'helpdesk', '2025-04-15 15:12:53', 'otros', 'general'),
(4, 'pruieba categoria', 'esto es una prueba', 'baja', '2025-05-16 12:32:12', 4, 'helpdesk', '2025-05-16 16:48:58', NULL, 'general'),
(5, 'prueba subcategoria', 'pureba subcategoria', 'baja', '2025-05-16 12:40:27', 4, 'helpdesk', '2025-05-16 16:49:37', NULL, 'disco duro'),
(6, 'incidencia redes', 'incidencia redes', 'baja', '2025-05-16 15:02:56', 4, 'helpdesk', '2025-05-16 17:03:12', 'redes', 'general'),
(7, 'wqdad', 'afsaf', 'baja', '2025-05-16 15:03:46', 4, 'helpdesk', '2025-05-16 17:03:57', 'software', 'general'),
(8, 'arbol', 'arbol', 'baja', '2025-05-21 18:55:37', 4, 'helpdesk', '2025-05-21 21:03:35', 'redes', 'aplicación');

-- --------------------------------------------------------

--
-- Table structure for table `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int NOT NULL,
  `Título` varchar(150) NOT NULL,
  `Descripción` text NOT NULL,
  `Estado` enum('abierta','cerrada') NOT NULL,
  `Prioridad` enum('baja','media','alta') NOT NULL,
  `FechaCreación` datetime NOT NULL,
  `idUsuario` int NOT NULL,
  `Categoria` enum('hardware','software','redes','otros') DEFAULT NULL,
  `Subcategoria` varchar(100) DEFAULT 'general'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `incidencias`
--

INSERT INTO `incidencias` (`id`, `Título`, `Descripción`, `Estado`, `Prioridad`, `FechaCreación`, `idUsuario`, `Categoria`, `Subcategoria`) VALUES
(8, 'Problema con wifi', 'Hemos tenido un problema con el wifi ya que el equipo no puede acceder a internet', 'abierta', 'alta', '2025-04-16 11:59:46', 4, NULL, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `usuario`, `accion`, `fecha`) VALUES
(1, 'helpdesk', 'Creó la incidencia: arbol', '2025-05-21 20:55:37'),
(2, 'helpdesk', 'Cerró incidencia: arbol', '2025-05-21 21:03:35'),
(3, 'helpdesk', 'Añadió un comentario en la incidencia: 8', '2025-05-21 21:03:49'),
(4, 'helpdesk', 'Añadió un comentario en la incidencia nº 8', '2025-05-21 21:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Rol` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `Nombre`, `Email`, `Contraseña`, `Rol`) VALUES
(1, 'Javier', 'javierB@gmail.com', '$2y$10$FSaSUiYkBVRH8f63fGXVveWhnWdLMjtp.nfpghwn6R3dro8E/V7Ve', 'usuario'),
(2, 'prueba', 'prueba@gmail.com', '$2y$10$CmndePQZF5Wk0r9fTjPSSO2cIY6q1eckD9A4usl5yPhjsMM8TiBkO', 'usuario'),
(3, 'prueba2', 'prueba2@gmail.com', '$2y$10$e91dzjNC/o6sb7AXXhPxseMyIiisbywnU6OmItHPr.eJdWRAgYRC2', 'usuario'),
(4, 'helpdesk', 'helpdesk@gmail.com', '$2y$10$pNbvUFJAuf/8G0pIP1JgguAo8j0pt3xnxviATXkbq0BMeMobyeXE6', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdHistorial` (`IdHistorial`);

--
-- Indexes for table `historialIncidencia`
--
ALTER TABLE `historialIncidencia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `historialIncidencia`
--
ALTER TABLE `historialIncidencia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`IdHistorial`) REFERENCES `historialIncidencia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
