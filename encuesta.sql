-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2021 at 12:37 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `encuesta`
--

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_clientes`
--

CREATE TABLE `encuestas_clientes` (
  `idEncuestaCliente` int(11) NOT NULL,
  `idEncuesta` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idRelacion` int(11) DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `respuesta` enum('insatisfecho','indiferente','satisfecho') DEFAULT NULL,
  `fechaEnvio` datetime DEFAULT NULL,
  `fechaEnviada` datetime DEFAULT NULL,
  `fechaRespuesta` datetime DEFAULT NULL,
  `idEstado` int(11) DEFAULT 1,
  `calificacionGeneral` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_clientes`
--

INSERT INTO `encuestas_clientes` (`idEncuestaCliente`, `idEncuesta`, `idCliente`, `idUsuario`, `idRelacion`, `mensaje`, `respuesta`, `fechaEnvio`, `fechaEnviada`, `fechaRespuesta`, `idEstado`, `calificacionGeneral`) VALUES
(43, 25, 5001, 80, NULL, NULL, NULL, '2021-11-11 00:29:04', '2021-11-11 00:29:04', '2021-11-11 00:29:04', 1, NULL),
(44, 25, 5002, 80, NULL, NULL, 'indiferente', '2021-11-11 00:30:40', '2021-11-11 00:30:40', '2021-11-11 00:32:00', 3, NULL),
(45, 25, 5003, 80, NULL, NULL, 'indiferente', '2021-11-11 00:30:49', '2021-11-11 00:30:49', '2021-11-11 00:31:00', 3, NULL),
(46, 25, 5004, 80, NULL, NULL, 'satisfecho', '2021-11-11 00:30:49', '2021-11-11 00:30:49', '2021-11-11 00:32:00', 3, NULL),
(47, 26, 5001, 80, NULL, NULL, NULL, '2021-11-11 00:32:50', '2021-11-11 00:32:50', '2021-11-11 00:32:50', 2, NULL),
(48, 26, 5004, 80, NULL, NULL, NULL, '2021-11-11 00:32:50', '2021-11-11 00:32:50', '2021-11-11 00:32:50', 1, NULL),
(49, 26, 5003, 80, NULL, NULL, 'insatisfecho', '2021-11-11 00:32:50', '2021-11-11 00:32:50', '2021-11-11 00:33:00', 3, NULL),
(50, 26, 5010, 80, NULL, NULL, 'satisfecho', '2021-11-11 00:32:50', '2021-11-11 00:32:50', '2021-11-11 00:34:00', 3, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encuestas_clientes`
--
ALTER TABLE `encuestas_clientes`
  ADD PRIMARY KEY (`idEncuestaCliente`),
  ADD KEY `fk_id_enuesta_id` (`idEncuesta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encuestas_clientes`
--
ALTER TABLE `encuestas_clientes`
  MODIFY `idEncuestaCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `encuestas_clientes`
--
ALTER TABLE `encuestas_clientes`
  ADD CONSTRAINT `fk_id_enuesta_id` FOREIGN KEY (`idEncuesta`) REFERENCES `encuestas` (`idEncuesta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
