-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2020 at 06:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keyparking`
--
CREATE DATABASE IF NOT EXISTS `keyparking` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `keyparking`;

-- --------------------------------------------------------

--
-- Table structure for table `Departamento`
--

DROP TABLE IF EXISTS `Departamento`;
CREATE TABLE `Departamento` (
  `codigo_Departamento` int(11) NOT NULL,
  `nombre_Departamento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Departamento`
--

INSERT INTO `Departamento` (`codigo_Departamento`, `nombre_Departamento`) VALUES
(11, 'Bogota');

-- --------------------------------------------------------

--
-- Table structure for table `Factura`
--

DROP TABLE IF EXISTS `Factura`;
CREATE TABLE `Factura` (
  `codigo_Factura` int(11) NOT NULL,
  `fecha_Factura` datetime NOT NULL,
  `codigo_Usuario` int(11) NOT NULL,
  `precio_Factura` decimal(10,0) DEFAULT NULL,
  `cancelado_Factura` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Factura`
--

INSERT INTO `Factura` (`codigo_Factura`, `fecha_Factura`, `codigo_Usuario`, `precio_Factura`, `cancelado_Factura`) VALUES
(1, '2020-04-03 00:00:00', 1234, '39000', 'Si'),
(2, '2020-04-03 00:00:00', 1234, '39000', 'Si'),
(3, '2020-04-24 00:00:00', 1234, '57000', 'Si'),
(4, '2020-04-24 00:00:00', 1234, '57000', 'Si'),
(5, '2020-04-25 00:00:00', 1234, '24000', 'Si'),
(6, '2020-04-25 00:00:00', 1234, '50', 'Si'),
(7, '2020-04-25 00:00:00', 1234, '400', 'Si'),
(8, '2020-04-25 00:00:00', 1234, '300', 'Si'),
(9, '2020-04-25 00:00:00', 1234, '0', 'Si'),
(10, '2020-04-25 00:00:00', 1234, '50', 'Si'),
(12, '2020-04-26 00:00:00', 1234, '0', 'Si'),
(13, '2020-04-26 00:00:00', 1234, '0', 'Si'),
(14, '2020-04-26 00:00:00', 1234, '0', 'Si'),
(15, '2020-04-28 19:30:00', 1234, '81150', 'Si'),
(16, '2020-04-28 19:32:51', 1234, '81300', 'Si'),
(17, '2020-04-28 19:35:21', 1234, '81000', 'Si'),
(18, '2020-04-28 19:40:56', 1234, '81250', 'Si'),
(19, '2020-04-28 19:42:12', 1234, '80150', 'Si'),
(20, '2020-04-28 19:43:43', 1234, '0', 'Si'),
(21, '2020-04-28 19:45:37', 1234, '0', 'Si'),
(22, '2020-04-28 19:54:28', 1234, '350', 'Si'),
(23, '2020-04-28 19:55:30', 1234, '0', 'Si'),
(24, '2020-04-29 00:37:54', 1234, '0', 'Si'),
(25, '2020-04-29 00:44:38', 1234, '0', 'Si'),
(26, '2020-04-28 00:00:00', 1234, '48000', 'Si'),
(27, '2020-04-29 17:57:53', 1234, '0', 'Si'),
(28, '2020-04-29 18:41:55', 1234, '0', 'Si'),
(29, '2020-04-29 18:58:06', 1234, '50', 'Si'),
(30, '2020-04-29 18:58:10', 1234, '0', 'Si'),
(31, '2020-05-13 05:06:43', 1234, '2500', 'Si'),
(32, '2020-05-13 05:06:46', 1234, '2450', 'Si'),
(33, '2020-05-13 05:06:48', 1234, '800', 'Si'),
(34, '2020-05-13 05:22:52', 1234, '0', 'Si'),
(35, '2020-05-13 05:43:57', 1234, '0', 'Si'),
(36, '2020-05-13 05:48:22', 1234, '200', 'Si'),
(37, '2020-05-13 05:58:51', 1234, '200', 'Si'),
(38, '2020-05-13 05:59:31', 1234, '0', 'Si'),
(39, '2020-05-13 05:59:35', 1234, '0', 'Si'),
(40, '2020-05-13 05:59:40', 1234, '0', 'Si');

-- --------------------------------------------------------

--
-- Table structure for table `MarcaVehiculo`
--

DROP TABLE IF EXISTS `MarcaVehiculo`;
CREATE TABLE `MarcaVehiculo` (
  `codigo_MarcaVehiculo` int(11) NOT NULL,
  `nombre_MarcaVehiculo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MarcaVehiculo`
--

INSERT INTO `MarcaVehiculo` (`codigo_MarcaVehiculo`, `nombre_MarcaVehiculo`) VALUES
(1, 'No esta en la lista'),
(2, 'BMX'),
(3, 'Yamaha'),
(4, 'Chevrolet'),
(5, 'Mazda'),
(6, 'Suzuki'),
(1003, 'Shimano');

-- --------------------------------------------------------

--
-- Table structure for table `Municipio`
--

DROP TABLE IF EXISTS `Municipio`;
CREATE TABLE `Municipio` (
  `codigo_Municipio` int(11) NOT NULL,
  `nombre_Municipio` varchar(30) NOT NULL,
  `codigo_Departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Municipio`
--

INSERT INTO `Municipio` (`codigo_Municipio`, `nombre_Municipio`, `codigo_Departamento`) VALUES
(1101, 'Bogota', 11);

-- --------------------------------------------------------

--
-- Table structure for table `ParqueaderosAlternos`
--

DROP TABLE IF EXISTS `ParqueaderosAlternos`;
CREATE TABLE `ParqueaderosAlternos` (
  `codigo_ParqueaderosAlternos` int(11) NOT NULL,
  `nombre_ParqueaderosAlternos` varchar(45) NOT NULL,
  `direccion_ParqueaderosAlternos` varchar(45) NOT NULL,
  `codigo_SedeParqueadero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ParqueaderosAlternos`
--

INSERT INTO `ParqueaderosAlternos` (`codigo_ParqueaderosAlternos`, `nombre_ParqueaderosAlternos`, `direccion_ParqueaderosAlternos`, `codigo_SedeParqueadero`) VALUES
(1, 'Parqueadero CitySmoke', 'Cll 172 Cra - 18', 1),
(2, 'Parqueadero GoldPlace', 'Cll 180 Cra - 10', 1),
(3, 'Parqueadero HighDope', 'Cll 19 - Cra 16', 2),
(4, 'Parqueadero LasXX', 'Cll 22 - Cra. 13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Rol`
--

DROP TABLE IF EXISTS `Rol`;
CREATE TABLE `Rol` (
  `nombre_Rol` varchar(30) NOT NULL,
  `descripcion_Rol` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Rol`
--

INSERT INTO `Rol` (`nombre_Rol`, `descripcion_Rol`) VALUES
('Administrador', 'Dios todo poderoso.'),
('Auxiliar', 'Cuenta con capacidades de visualizar informacion del sistema pero no la puede modificar.'),
('Cliente', 'Tipo de rol para todos los usuarios no pertenecientes a la empresa.');

-- --------------------------------------------------------

--
-- Table structure for table `SedeParqueadero`
--

DROP TABLE IF EXISTS `SedeParqueadero`;
CREATE TABLE `SedeParqueadero` (
  `codigo_SedeParqueadero` int(11) NOT NULL,
  `nombre_SedeParqueadero` varchar(45) NOT NULL,
  `direccion_SedeParqueadero` varchar(45) NOT NULL,
  `apertura_SedeParqueadero` time NOT NULL,
  `cierre_SedeParqueadero` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SedeParqueadero`
--

INSERT INTO `SedeParqueadero` (`codigo_SedeParqueadero`, `nombre_SedeParqueadero`, `direccion_SedeParqueadero`, `apertura_SedeParqueadero`, `cierre_SedeParqueadero`) VALUES
(1, 'Sede A', 'Cll 172 - 14', '06:00:00', '23:00:00'),
(2, 'Sede B', 'Cll 19 Cra. 18', '05:00:00', '23:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `SitioParqueadero`
--

DROP TABLE IF EXISTS `SitioParqueadero`;
CREATE TABLE `SitioParqueadero` (
  `codigo_SitioParqueadero` varchar(4) NOT NULL,
  `ubicacion_SitioParqueadero` varchar(8) NOT NULL,
  `disponibilidad_SitioParqueadero` varchar(2) NOT NULL,
  `codigo_SedeParqueadero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SitioParqueadero`
--

INSERT INTO `SitioParqueadero` (`codigo_SitioParqueadero`, `ubicacion_SitioParqueadero`, `disponibilidad_SitioParqueadero`, `codigo_SedeParqueadero`) VALUES
('AB1', 'A1', 'Si', 1),
('AB2', 'A2', 'Si', 1),
('AB3', 'A3', 'Si', 1),
('AB4', 'A4', 'Si', 1),
('AB5', 'A5', 'Si', 1),
('AC1', 'C1', 'Si', 1),
('AC2', 'C2', 'Si', 1),
('AM1', 'B1', 'Si', 1),
('AM2', 'B2', 'Si', 1),
('AM3', 'B3', 'Si', 1),
('BB1', 'A1', 'Si', 2),
('BB2', 'A2', 'Si', 2),
('BC1', 'C1', 'Si', 2),
('BC2', 'C2', 'Si', 2),
('BM1', 'B1', 'Si', 2),
('BM2', 'B2', 'Si', 2);

-- --------------------------------------------------------

--
-- Table structure for table `TipoVehiculo`
--

DROP TABLE IF EXISTS `TipoVehiculo`;
CREATE TABLE `TipoVehiculo` (
  `codigo_TipoVehiculo` int(11) NOT NULL,
  `nombre_TipoVehiculo` varchar(25) DEFAULT NULL,
  `cobroMinuto_TipoVehiculo` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TipoVehiculo`
--

INSERT INTO `TipoVehiculo` (`codigo_TipoVehiculo`, `nombre_TipoVehiculo`, `cobroMinuto_TipoVehiculo`) VALUES
(1, 'Bicicleta', '4'),
(2, 'Moto', '20'),
(3, 'Automovil', '50');

-- --------------------------------------------------------

--
-- Table structure for table `UsoParqueadero`
--

DROP TABLE IF EXISTS `UsoParqueadero`;
CREATE TABLE `UsoParqueadero` (
  `codigo_UsoParqueadero` int(11) NOT NULL,
  `codigo_Vehiculo` int(11) NOT NULL,
  `codigo_SitioParqueadero` varchar(4) NOT NULL,
  `codigo_Factura` int(11) DEFAULT NULL,
  `inicio_UsoParqueadero` datetime NOT NULL,
  `fin_UsoParqueadero` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UsoParqueadero`
--

INSERT INTO `UsoParqueadero` (`codigo_UsoParqueadero`, `codigo_Vehiculo`, `codigo_SitioParqueadero`, `codigo_Factura`, `inicio_UsoParqueadero`, `fin_UsoParqueadero`) VALUES
(1, 1, 'AB1', NULL, '2020-04-03 00:00:00', '2020-04-03 14:57:46'),
(2, 1, 'AB1', NULL, '2020-04-03 00:00:00', '2020-04-03 14:58:08'),
(3, 1, 'BB2', NULL, '2020-04-24 00:00:00', '2020-04-24 20:20:39'),
(4, 1, 'AB1', NULL, '2020-04-24 00:00:00', '2020-04-24 20:29:48'),
(5, 1, 'AB1', NULL, '2020-04-25 00:00:00', '2020-04-25 09:00:08'),
(6, 1, 'AB1', NULL, '2020-04-25 09:11:56', '2020-04-25 09:12:24'),
(7, 1, 'AB1', NULL, '2020-04-25 10:11:48', '2020-04-25 10:19:37'),
(8, 1, 'AB1', NULL, '2020-04-25 10:19:13', '2020-04-25 10:25:02'),
(9, 1, 'AB2', NULL, '2020-04-25 10:29:41', '2020-04-25 10:29:50'),
(10, 1, 'AB3', NULL, '2020-04-25 10:32:54', '2020-04-25 10:33:01'),
(12, 1, 'AB3', NULL, '2020-04-26 11:09:50', '2020-04-26 11:09:55'),
(13, 1, 'AB3', NULL, '2020-04-26 12:01:40', '2020-04-26 12:01:44'),
(14, 1, 'AB1', 14, '2020-04-26 13:06:21', '2020-04-26 13:06:32'),
(15, 1, 'AB1', 16, '2020-04-27 16:26:42', '2020-04-28 19:32:51'),
(16, 1, 'AB2', 17, '2020-04-27 16:34:31', '2020-04-28 19:35:21'),
(17, 1, 'AB3', 18, '2020-04-27 16:35:26', '2020-04-28 19:40:56'),
(18, 1, 'AB4', 19, '2020-04-27 16:59:09', '2020-04-28 19:42:12'),
(19, 1, 'AB1', 20, '2020-04-28 19:43:37', '2020-04-28 19:43:43'),
(20, 1, 'AB1', 21, '2020-04-28 19:45:33', '2020-04-28 19:45:37'),
(21, 1, 'AB1', 22, '2020-04-28 19:46:57', '2020-04-28 19:54:28'),
(22, 1, 'AB1', 23, '2020-04-28 19:55:13', '2020-04-28 19:55:30'),
(23, 1, 'AB1', 24, '2020-04-29 00:37:44', '2020-04-29 00:37:54'),
(24, 1, 'AB1', 25, '2020-04-29 00:44:31', '2020-04-29 00:44:38'),
(25, 1, 'AB1', 26, '2020-04-29 02:42:38', '2020-04-28 19:47:23'),
(26, 4, 'AB1', 27, '2020-04-29 17:57:44', '2020-04-29 17:57:53'),
(27, 1, 'AB1', 28, '2020-04-29 18:41:49', '2020-04-29 18:41:55'),
(28, 1, 'AB1', 29, '2020-04-29 18:56:22', '2020-04-29 18:58:06'),
(29, 1, 'AB2', 30, '2020-04-29 18:57:11', '2020-04-29 18:58:10'),
(30, 1, 'AB1', 31, '2020-05-13 04:16:02', '2020-05-13 05:06:43'),
(31, 1, 'AB1', 32, '2020-05-13 04:16:49', '2020-05-13 05:06:46'),
(32, 4, 'AB2', 33, '2020-05-13 04:26:28', '2020-05-13 05:06:48'),
(33, 1, 'AB1', 34, '2020-05-13 05:22:49', '2020-05-13 05:22:52'),
(34, 1, 'AB1', 35, '2020-05-13 05:43:35', '2020-05-13 05:43:57'),
(35, 1, 'AB1', 36, '2020-05-13 05:44:04', '2020-05-13 05:48:22'),
(36, 4, 'AB1', 37, '2020-05-13 05:48:44', '2020-05-13 05:58:51'),
(37, 1, 'AB1', 38, '2020-05-13 05:59:06', '2020-05-13 05:59:31'),
(38, 3, 'AB2', 39, '2020-05-13 05:59:14', '2020-05-13 05:59:35'),
(39, 4, 'AB3', 40, '2020-05-13 05:59:18', '2020-05-13 05:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
CREATE TABLE `Usuario` (
  `codigo_Usuario` int(11) NOT NULL,
  `documento_Usuario` varchar(30) NOT NULL,
  `nombre_Usuario` varchar(45) NOT NULL,
  `apellido_Usuario` varchar(45) NOT NULL,
  `direccion_Usuario` varchar(45) NOT NULL,
  `telefono_Usuario` varchar(10) NOT NULL,
  `celular_Usuario` varchar(13) NOT NULL,
  `nombre_Rol` varchar(30) NOT NULL,
  `codigo_Municipio` int(11) NOT NULL,
  `password_Usuario` varbinary(40) NOT NULL,
  `email_Usuario` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`codigo_Usuario`, `documento_Usuario`, `nombre_Usuario`, `apellido_Usuario`, `direccion_Usuario`, `telefono_Usuario`, `celular_Usuario`, `nombre_Rol`, `codigo_Municipio`, `password_Usuario`, `email_Usuario`) VALUES
(1111, '1111', '1111', '1111', '1111', '1111', '1111', 'Cliente', 1101, 0x4f365a7667444a6c684c4f47734c6872426e4c5130513d3d, '1111@111'),
(1234, '1234', '1234', '1234', '1234', '1234', '1234', 'Cliente', 1101, 0x772b44635a464a644d50676a364d47664f46684f59673d3d, '1234@1234'),
(2345, '1234321', 'Raul', 'De la estrella', '12# 1234', '2224455', '3002224455', 'Cliente', 1101, 0x4c42396375624f476e6a6e53475234592f50397242413d3d, 'raul@delaestrella.com'),
(5555, '555555', 'Dummy', 'Dummy', 'asdf lkasd flk as', '555555', '555555', 'Cliente', 1101, 0x2b43786259787632445474644f6334434339592f43413d3d, 'adsf@asdflkj'),
(7777, '77779879', 'Johan', 'Goethe', 'Cra N T I', '7777777', '3007777777', 'Administrador', 1101, 0x728ca63be8a4343032d985f1be56d9f8, 'admin@keyparking.com'),
(7778, '87878787', 'Anderson', 'Botaviento', 'Cra 23 - 23', '8778787', '3008778787', 'Auxiliar', 1101, 0x7a9c20af93dcbbf7d9b1a5e5871f5adc, 'auxiliar@keyparking.com');

-- --------------------------------------------------------

--
-- Table structure for table `Vehiculo`
--

DROP TABLE IF EXISTS `Vehiculo`;
CREATE TABLE `Vehiculo` (
  `codigo_Vehiculo` int(11) NOT NULL,
  `placa_Vehiculo` varchar(15) NOT NULL,
  `color_Vehiculo` varchar(15) NOT NULL,
  `codigo_TipoVehiculo` int(11) NOT NULL,
  `codigo_MarcaVehiculo` int(11) NOT NULL,
  `codigo_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Vehiculo`
--

INSERT INTO `Vehiculo` (`codigo_Vehiculo`, `placa_Vehiculo`, `color_Vehiculo`, `codigo_TipoVehiculo`, `codigo_MarcaVehiculo`, `codigo_Usuario`) VALUES
(1, 'SQR-123', 'SQR-123', 3, 4, 1234),
(3, '122h', 'black', 2, 2, 1234),
(4, 'asd-123', 'negra', 2, 3, 1234),
(7, 'SQR-234', 'Negra', 2, 6, 1234),
(8, 'SQR-444', 'Azul', 1, 1003, 1234);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Departamento`
--
ALTER TABLE `Departamento`
  ADD PRIMARY KEY (`codigo_Departamento`);

--
-- Indexes for table `Factura`
--
ALTER TABLE `Factura`
  ADD PRIMARY KEY (`codigo_Factura`),
  ADD KEY `codigo_Usuario` (`codigo_Usuario`);

--
-- Indexes for table `MarcaVehiculo`
--
ALTER TABLE `MarcaVehiculo`
  ADD PRIMARY KEY (`codigo_MarcaVehiculo`);

--
-- Indexes for table `Municipio`
--
ALTER TABLE `Municipio`
  ADD PRIMARY KEY (`codigo_Municipio`),
  ADD KEY `codigo_Departamento` (`codigo_Departamento`);

--
-- Indexes for table `ParqueaderosAlternos`
--
ALTER TABLE `ParqueaderosAlternos`
  ADD PRIMARY KEY (`codigo_ParqueaderosAlternos`),
  ADD KEY `codigo_SedeParqueadero` (`codigo_SedeParqueadero`);

--
-- Indexes for table `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`nombre_Rol`);

--
-- Indexes for table `SedeParqueadero`
--
ALTER TABLE `SedeParqueadero`
  ADD PRIMARY KEY (`codigo_SedeParqueadero`);

--
-- Indexes for table `SitioParqueadero`
--
ALTER TABLE `SitioParqueadero`
  ADD PRIMARY KEY (`codigo_SitioParqueadero`),
  ADD KEY `codigo_SedeParqueadero` (`codigo_SedeParqueadero`);

--
-- Indexes for table `TipoVehiculo`
--
ALTER TABLE `TipoVehiculo`
  ADD PRIMARY KEY (`codigo_TipoVehiculo`);

--
-- Indexes for table `UsoParqueadero`
--
ALTER TABLE `UsoParqueadero`
  ADD PRIMARY KEY (`codigo_UsoParqueadero`),
  ADD KEY `codigo_Vehiculo` (`codigo_Vehiculo`),
  ADD KEY `codigo_SitioParqueadero` (`codigo_SitioParqueadero`),
  ADD KEY `codigo_Factura` (`codigo_Factura`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`codigo_Usuario`),
  ADD KEY `nombre_Rol` (`nombre_Rol`),
  ADD KEY `codigo_Municipio` (`codigo_Municipio`);

--
-- Indexes for table `Vehiculo`
--
ALTER TABLE `Vehiculo`
  ADD PRIMARY KEY (`codigo_Vehiculo`),
  ADD KEY `codigo_TipoVehiculo` (`codigo_TipoVehiculo`),
  ADD KEY `codigo_MarcaVehiculo` (`codigo_MarcaVehiculo`),
  ADD KEY `codigo_Usuario` (`codigo_Usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Factura`
--
ALTER TABLE `Factura`
  MODIFY `codigo_Factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `MarcaVehiculo`
--
ALTER TABLE `MarcaVehiculo`
  MODIFY `codigo_MarcaVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `ParqueaderosAlternos`
--
ALTER TABLE `ParqueaderosAlternos`
  MODIFY `codigo_ParqueaderosAlternos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `SedeParqueadero`
--
ALTER TABLE `SedeParqueadero`
  MODIFY `codigo_SedeParqueadero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TipoVehiculo`
--
ALTER TABLE `TipoVehiculo`
  MODIFY `codigo_TipoVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `UsoParqueadero`
--
ALTER TABLE `UsoParqueadero`
  MODIFY `codigo_UsoParqueadero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `Vehiculo`
--
ALTER TABLE `Vehiculo`
  MODIFY `codigo_Vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Factura`
--
ALTER TABLE `Factura`
  ADD CONSTRAINT `Factura_ibfk_1` FOREIGN KEY (`codigo_Usuario`) REFERENCES `Usuario` (`codigo_Usuario`);

--
-- Constraints for table `Municipio`
--
ALTER TABLE `Municipio`
  ADD CONSTRAINT `Municipio_ibfk_1` FOREIGN KEY (`codigo_Departamento`) REFERENCES `Departamento` (`codigo_Departamento`);

--
-- Constraints for table `ParqueaderosAlternos`
--
ALTER TABLE `ParqueaderosAlternos`
  ADD CONSTRAINT `ParqueaderosAlternos_ibfk_1` FOREIGN KEY (`codigo_SedeParqueadero`) REFERENCES `SedeParqueadero` (`codigo_SedeParqueadero`);

--
-- Constraints for table `SitioParqueadero`
--
ALTER TABLE `SitioParqueadero`
  ADD CONSTRAINT `SitioParqueadero_ibfk_1` FOREIGN KEY (`codigo_SedeParqueadero`) REFERENCES `SedeParqueadero` (`codigo_SedeParqueadero`);

--
-- Constraints for table `UsoParqueadero`
--
ALTER TABLE `UsoParqueadero`
  ADD CONSTRAINT `UsoParqueadero_ibfk_1` FOREIGN KEY (`codigo_Vehiculo`) REFERENCES `Vehiculo` (`codigo_Vehiculo`),
  ADD CONSTRAINT `UsoParqueadero_ibfk_2` FOREIGN KEY (`codigo_SitioParqueadero`) REFERENCES `SitioParqueadero` (`codigo_SitioParqueadero`),
  ADD CONSTRAINT `UsoParqueadero_ibfk_3` FOREIGN KEY (`codigo_Factura`) REFERENCES `Factura` (`codigo_Factura`);

--
-- Constraints for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`nombre_Rol`) REFERENCES `Rol` (`nombre_Rol`),
  ADD CONSTRAINT `Usuario_ibfk_2` FOREIGN KEY (`codigo_Municipio`) REFERENCES `Municipio` (`codigo_Municipio`);

--
-- Constraints for table `Vehiculo`
--
ALTER TABLE `Vehiculo`
  ADD CONSTRAINT `Vehiculo_ibfk_1` FOREIGN KEY (`codigo_TipoVehiculo`) REFERENCES `TipoVehiculo` (`codigo_TipoVehiculo`),
  ADD CONSTRAINT `Vehiculo_ibfk_2` FOREIGN KEY (`codigo_MarcaVehiculo`) REFERENCES `MarcaVehiculo` (`codigo_MarcaVehiculo`),
  ADD CONSTRAINT `Vehiculo_ibfk_3` FOREIGN KEY (`codigo_Usuario`) REFERENCES `Usuario` (`codigo_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
