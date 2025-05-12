-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 12:03 AM
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
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `idCarrito` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `fechaAgregado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrito`
--

INSERT INTO `carrito` (`idCarrito`, `idUsuario`, `idProducto`, `cantidad`, `fechaAgregado`) VALUES
(10, 2, 46, 3, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `orden`) VALUES
(1, 'Serum', 10),
(3, 'Ojos', 6),
(4, 'Rostro', 7),
(5, 'Labios', 0),
(6, 'Crema Facial', 9);

-- --------------------------------------------------------

--
-- Table structure for table `despacho`
--

CREATE TABLE `despacho` (
  `id_despacho` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `direccion_entrega` varchar(255) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha_despacho` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha_pago` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` varchar(20) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `fecha`, `estado`, `total`) VALUES
(1, 1, '2025-05-10 00:13:13', 'Confirmado', 19950),
(2, 1, '2025-05-10 00:16:35', 'Confirmado', 19950),
(3, 1, '2025-05-10 23:45:57', 'Confirmado', 23920),
(4, 1, '2025-05-10 23:46:46', 'Confirmado', 666);

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
(36, 'Polvo Iluminador ', 'Rosy Glow ', '  Crea looks frescos y brillantes para que nunca dejes de estar radiante. Utiliza nuestro nuevo polvo iluminador compacto Rosy Glow para resaltar el área del rosto que quieras.', 3990, 0, 4, '1746743725.jpg'),
(37, 'Gotas Bronceadoras Drop Of Sunshine', 'ESSENCE', '  Potencia tu brillo con las Gotas Bronceadoras Drop Of Sunshine de Essence. Las gotas vienen en un tono bronce neutro con perlas sutiles y se difuminan en la piel muy fácilmente, proporcionándote un aspecto bronceado y saludable.', 3990, 10, 4, '1746743790.jpg'),
(38, 'Polvos Compactos Matificantes All About Matt!', 'ESSENCE', 'Si prefieres los polvos compactos, este producto es para ti, se puede aplicar sobre la base de maquillaje para fijarla y matificar el rostro.  Para un rostro mate y natural.  Es perfecto para cuando estás fuera.', 4990, 10, 4, '1746743854.jpg'),
(41, ' NYX PMU ', ' Bare With Me Concealer Sérum', 'Dile adiós al estrés de la piel con nuestra nueva incorporacion a la familia Bare With me. ¿Ojeras? ¡Borradas! ', 12990, 10, 4, '1746919927.jpg'),
(43, ' Corrector True Skin High Cover', 'CATRICE', '¡No hay nada más multifacético que el corrector True Skin High Cover de Catrice!  Su fórmula ultraligera a base de ácido hialurónico es verdaderamente única. Te permitirá camuflar imperfecciones, rojez u ojeras discretamente, dejando un acabado mate natural en tu rostro.', 5990, 10, 4, '1746922086.jpg'),
(44, ' Fijador De Maquillaje Marshmellow Setting Spray', ' NYX PMU ', '¡Prueba nuestro NUEVO Marshmellow Matte Setting Spray para fijar tu maquillaje en su lugar y disfrutar de él todo el día! ¡Sin decoloración, manchas ni transferencia! ', 9990, 10, 4, '1746922187.jpg'),
(45, ' 3D Hydra Lip Gloss', ' KIKO MILANO ', 'Brillo de labios suavizante con efecto 3D para un resultado brillante. La textura, suave y sensorial, se funde sobre los labios dejándolos lisos y brillantes. ', 15990, 10, 5, '1746922368.jpg'),
(46, ' 8H Matte Comfort Perfilador De Labios', 'ESSENCE', 'El perfilador de labios 8h matte comfort te permite delinear los labios con precisión, dura hasta 8h y es resistente al agua. ', 2990, 2, 5, '1746922438.jpg'),
(47, ' Brillo Labial Fat Oil', ' NYX PMU ', 'Consigue looks de alto brillo sin pegajosidad con Fat Oil Lip Drip. Este aceite labial que dejará tus labios extremadamente voluminosos y con brillo a lo GRANDE.', 9990, 10, 5, '1746922541.jpg'),
(48, ' Labial Super Stay Teddy Tint', 'MAYBELLINE', 'Superstay Teddy Tint: un labial suave como un peluche y una sensación lujosa y ligera que dura. Consigue un color mate difuminado por hasta 12 horas. ', 9990, 10, 5, '1746922611.jpg'),
(49, ' Lasting Precision Automatic Eyeliner And Khol', ' KIKO MILANO ', 'Lápiz de ojos automático para uso interno y externo. Garantiza un trazo preciso y homogéneo de larga duración.  La pigmentación es intensa e inmediata. La suave textura es fácil de difuminar, inmediatamente después de haberla aplicado, gracias al aplicador integrado.', 7000, 10, 3, '1746922976.jpg'),
(50, ' 30 Days Extension Night Treatment Booster Mascara', ' KIKO MILANO ', 'Tratamiento nocturno en gel para otorgar longitud y proteger las pestañas, perfecta para realzar la mirada.  Es especial porque:  - Su fórmula incolora, extremadamente suave y envolvente, abraza las pestañas sin endurecerlas ni pegarlas', 14000, 10, 3, '1746923785.jpg'),
(51, ' Máscara de Pestañas Waterproof Lash Sensational S', 'MAYBELLINE ', 'La máscara de pestañas Lash Sensational Sky High en versión a prueba de agua consigue una longitud sin límites y un volumen redefinido. ', 12990, 10, 3, '1746924146.jpg'),
(53, 'Niacinamida 10% - Just Niacinamide 10% 30 Ml', 'NYX PMU', 'El sérum Facial Just Niacinamid es un hidratador diario apto para todo tipo de pieles que combate la textura áspera de la piel, la sequedad, las manchas y las imperfecciones.', 10000, 20, 1, '1746997995.jpg'),
(54, ' Centella Sérum Facial Regenerador 30Ml', ' REVUELE ', 'REVUELE CENTELLA Regenerating Face Serum es un sérum facial que fortalece todo tipo de pieles.  Su rica fórmula con CICA (Centella Asiática) y Ácido Hialurónico hidrata la piel en profundidad ', 8000, 15, 1, '1746998054.jpg'),
(55, 'Niacinamide Serum 30Ml', 'REVUELE', 'REVUELE NIACINAMIDE 15% Serum es un sérum con Niacinamida al 15% que aclara la piel y ayuda a regular el sebo.  Combate eficazmente imperfecciones', 7990, 15, 1, '1746998133.jpg'),
(56, ' Crema Facial Hidratante Centella 75Ml', 'SKIN1004', 'SKIN1004 utiliza el poder de ingredientes limpios y naturales para ayudarte a obtener tu mejor piel.  La Crema Facial Madagascar Centella de Skin1004 es ideal para pieles sensibles y secas ya que crea una protección hidratante alrededor de la barrera cutánea. ', 27000, 14, 6, '1746998360.jpg'),
(57, ' Crema De Día Lift Instant Q10 60 Ml', 'BYPHASSE', '  – Su textura ligera deja la piel suave y lisa.  – Hidrata y reafirma.  – Textura agradable y aroma suave.  – Acabado liso, sin efecto pegajoso.', 9990, 15, 6, '1746998439.jpg'),
(58, ' Crema Día Y Noche 24H Hydra Infini 60 Ml', ' BYPHASSE ', '  – Hidratación duradera 24 H.  – Textura sedosa y aroma suave.  – Acabado liso, sin efecto pegajoso.', 9990, 15, 6, '1746998507.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `psw` varchar(6) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `tipo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `username`, `nombres`, `apellidos`, `email`, `telefono`, `direccion`, `psw`, `fecha_registro`, `tipo`) VALUES
(1, 'ejemploadmin', 'Karin Administradora', 'admin', 'admin@admin.cl', '324243424343', 'pasaje sin nombre', '1234', '2025-05-06 04:02:29', 1),
(2, 'ejemplouser', 'user', 'user', 'user@user.cl', '234324324', 'calle sn', '1234', '2025-05-06 04:01:17', 0),
(3, 'karinadm', 'karin', 'moraga', 'asdadds@fdaskdj.com', 's234234', '23423423', '1234', '2025-05-04 19:29:51', 1),
(4, 'Paz', 'Paz ', 'Cortes', 'paz@paz.com', '111111', '45345435', '12345', '2025-05-01 00:28:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `idUsuario`, `idProducto`) VALUES
(17, 2, 37),
(18, 2, 36),
(22, 2, 50),
(23, 2, 46);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idCarrito`),
  ADD KEY `id_producto` (`idProducto`),
  ADD KEY `carrito_ibfk_3` (`idUsuario`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `despacho`
--
ALTER TABLE `despacho`
  ADD PRIMARY KEY (`id_despacho`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indexes for table `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `usuario_cliente` (`idUsuario`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `categoria` (`categoria`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_ibfk_1` (`idProducto`),
  ADD KEY `wishlist_ibfk_2` (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idCarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `despacho`
--
ALTER TABLE `despacho`
  MODIFY `id_despacho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE;

--
-- Constraints for table `despacho`
--
ALTER TABLE `despacho`
  ADD CONSTRAINT `despacho_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`idPedido`);

--
-- Constraints for table `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`idPedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`idProducto`);

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`idPedido`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
