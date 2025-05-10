-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 01:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beautyvibe`
--

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` int(5) NOT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `marca`, `descripcion`, `precio`, `stock`, `categoria`, `img`) VALUES
(36, 'Polvo Iluminador ', 'Rosy Glow ', '  Crea looks frescos y brillantes para que nunca dejes de estar radiante. Utiliza nuestro nuevo polvo iluminador compacto Rosy Glow para resaltar el área del rosto que quieras.', 3990, 10, 2, '1746743725.jpg'),
(37, 'Gotas Bronceadoras Drop Of Sunshine', 'ESSENCE', '  Potencia tu brillo con las Gotas Bronceadoras Drop Of Sunshine de Essence. Las gotas vienen en un tono bronce neutro con perlas sutiles y se difuminan en la piel muy fácilmente, proporcionándote un aspecto bronceado y saludable.', 3990, 10, 1, '1746743790.jpg'),
(38, 'Polvos Compactos Matificantes All About Matt!', 'ESSENCE', 'Si prefieres los polvos compactos, este producto es para ti, se puede aplicar sobre la base de maquillaje para fijarla y matificar el rostro.  Para un rostro mate y natural.  Es perfecto para cuando estás fuera.', 4990, 10, 1, '1746743854.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `categoria` (`categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
