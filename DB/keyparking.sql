-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2020 at 08:54 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `Departamento`
--

CREATE TABLE `Departamento` (
  `codigo_Departamento` int(11) NOT NULL,
  `nombre_Departamento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Factura`
--

CREATE TABLE `Factura` (
  `codigo_Factura` int(11) NOT NULL,
  `fecha_Factura` datetime NOT NULL,
  `codigo_Usuario` int(11) NOT NULL,
  `precio_Factura` decimal(10,0) DEFAULT NULL,
  `cancelado_Factura` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `MarcaVehiculo`
--

CREATE TABLE `MarcaVehiculo` (
  `codigo_MarcaVehiculo` int(11) NOT NULL,
  `nombre_MarcaVehiculo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Municipio`
--

CREATE TABLE `Municipio` (
  `codigo_Municipio` int(11) NOT NULL,
  `nombre_Municipio` varchar(30) NOT NULL,
  `codigo_Departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ParqueaderosAlternos`
--

CREATE TABLE `ParqueaderosAlternos` (
  `codigo_ParqueaderosAlternos` int(11) NOT NULL,
  `nombre_ParqueaderosAlternos` varchar(45) NOT NULL,
  `direccion_ParqueaderosAlternos` varchar(45) NOT NULL,
  `codigo_SedeParqueadero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Rol`
--

CREATE TABLE `Rol` (
  `nombre_Rol` varchar(30) NOT NULL,
  `descripcion_Rol` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `SedeParqueadero`
--

CREATE TABLE `SedeParqueadero` (
  `codigo_SedeParqueadero` int(11) NOT NULL,
  `nombre_SedeParqueadero` varchar(45) NOT NULL,
  `direccion_SedeParqueadero` varchar(45) NOT NULL,
  `apertura_SedeParqueadero` time NOT NULL,
  `cierre_SedeParqueadero` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `SitioParqueadero`
--

CREATE TABLE `SitioParqueadero` (
  `codigo_SitioParqueadero` varchar(4) NOT NULL,
  `ubicacion_SitioParqueadero` varchar(8) NOT NULL,
  `disponibilidad_SitioParqueadero` varchar(2) NOT NULL,
  `codigo_SedeParqueadero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `TipoVehiculo`
--

CREATE TABLE `TipoVehiculo` (
  `codigo_TipoVehiculo` int(11) NOT NULL,
  `nombre_TipoVehiculo` varchar(25) DEFAULT NULL,
  `cobroMinuto` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `UsoParqueadero`
--

CREATE TABLE `UsoParqueadero` (
  `codigo_UsoParqueadero` int(11) NOT NULL,
  `codigo_Vehiculo` int(11) NOT NULL,
  `codigo_SitioParqueadero` varchar(4) NOT NULL,
  `codigo_Factura` int(11) NOT NULL,
  `inicio_UsoParqueadero` datetime NOT NULL,
  `fin_UsoParqueadero` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

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
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Vehiculo`
--

CREATE TABLE `Vehiculo` (
  `codigo_Vehiculo` int(11) NOT NULL,
  `placa_Vehiculo` varchar(15) NOT NULL,
  `color_Vehiculo` varchar(15) NOT NULL,
  `codigo_TipoVehiculo` int(11) NOT NULL,
  `codigo_MarcaVehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `codigo_MarcaVehiculo` (`codigo_MarcaVehiculo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Factura`
--
ALTER TABLE `Factura`
  MODIFY `codigo_Factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `MarcaVehiculo`
--
ALTER TABLE `MarcaVehiculo`
  MODIFY `codigo_MarcaVehiculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ParqueaderosAlternos`
--
ALTER TABLE `ParqueaderosAlternos`
  MODIFY `codigo_ParqueaderosAlternos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SedeParqueadero`
--
ALTER TABLE `SedeParqueadero`
  MODIFY `codigo_SedeParqueadero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TipoVehiculo`
--
ALTER TABLE `TipoVehiculo`
  MODIFY `codigo_TipoVehiculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UsoParqueadero`
--
ALTER TABLE `UsoParqueadero`
  MODIFY `codigo_UsoParqueadero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Vehiculo`
--
ALTER TABLE `Vehiculo`
  MODIFY `codigo_Vehiculo` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `Vehiculo_ibfk_2` FOREIGN KEY (`codigo_MarcaVehiculo`) REFERENCES `MarcaVehiculo` (`codigo_MarcaVehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
