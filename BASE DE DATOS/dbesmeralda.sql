-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2021 a las 01:58:30
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsistemas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(100) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `estadoCategoria` enum('0','1') NOT NULL,
  `idUsuarioCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombreCategoria`, `descripcion`, `estadoCategoria`, `idUsuarioCategoria`) VALUES
(13, 'Cafe Marago - Maduro', 'Ninguna', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `nombreCliente` varchar(45) NOT NULL,
  `apellidoCliente` varchar(45) NOT NULL,
  `telefonoCliente` varchar(20) DEFAULT NULL,
  `direccionCliente` varchar(100) DEFAULT NULL,
  `correoCliente` varchar(70) DEFAULT NULL,
  `fechaRegistro` date NOT NULL,
  `estadoCliente` enum('0','1') NOT NULL,
  `idUsuarioCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nit`, `nombreCliente`, `apellidoCliente`, `telefonoCliente`, `direccionCliente`, `correoCliente`, `fechaRegistro`, `estadoCliente`, `idUsuarioCliente`) VALUES
(1, '20200324', 'Jasson', 'Herrera', '30455248', 'Guatemala', 'jassonhm54@gmail.com', '2020-03-24', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idCompra` int(11) NOT NULL,
  `fechaCompra` date NOT NULL,
  `numero_compra` varchar(45) NOT NULL,
  `idUsuarioCompra` int(11) NOT NULL,
  `Contacto` varchar(100) DEFAULT NULL,
  `moneda` varchar(45) DEFAULT NULL,
  `subtotal` varchar(45) NOT NULL,
  `totalIVA` varchar(45) DEFAULT NULL,
  `totalCompra` varchar(45) NOT NULL,
  `idTipoPago` int(11) NOT NULL,
  `tipoProducto` varchar(2) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `proveedor` varchar(45) NOT NULL,
  `nitProveedor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `idCreditos` int(11) NOT NULL,
  `idClienteCredito` int(11) NOT NULL,
  `idCategoriaCredito` int(11) NOT NULL,
  `idProductoCredito` int(11) NOT NULL,
  `precioCredito` varchar(20) NOT NULL,
  `cantidadCredito` varchar(70) NOT NULL,
  `subtotalCredito` varchar(100) NOT NULL,
  `totalPagado` varchar(45) NOT NULL,
  `idUsuarioCredito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombreDepartamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombreDepartamento`) VALUES
(1, 'Alta Verapaz'),
(2, 'Baja Verapaz'),
(3, 'Chimaltenango'),
(4, 'Chiquimula'),
(5, 'Peten'),
(6, 'El Progreso'),
(7, 'Quiche'),
(8, 'Escuintla'),
(9, 'Guatemala'),
(10, 'Huehuetenango'),
(11, 'Izabal'),
(12, 'Jalapa'),
(13, 'Jutiapa'),
(14, 'Quetzaltenango'),
(15, 'Retalhuleu'),
(16, 'Sacatepequez'),
(17, 'San Marcos'),
(18, 'Santa Rosa'),
(19, 'Solola'),
(20, 'Suchitepequez'),
(21, 'Totonicapan'),
(22, 'Zacapa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `idDeposito` int(11) NOT NULL,
  `idProductoDepositos` int(11) NOT NULL,
  `idUsuariosDepositos` int(11) NOT NULL,
  `idClientesDepositos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `Monto` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `idDescuento` int(11) NOT NULL,
  `idProductos` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `PorcentajeDescuento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompras`
--

CREATE TABLE `detallecompras` (
  `idDetalleCompras` int(11) NOT NULL,
  `numero_compra` varchar(200) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Producto` varchar(100) CHARACTER SET big5 NOT NULL,
  `moneda` varchar(10) DEFAULT NULL,
  `PrecioCompra` varchar(100) NOT NULL,
  `CantidadCompra` varchar(100) NOT NULL,
  `descuento` varchar(100) DEFAULT NULL COMMENT '%',
  `importe` varchar(100) DEFAULT NULL,
  `FechaCompra` date DEFAULT NULL,
  `idUsuarioCompras` int(11) NOT NULL,
  `idProveedorCompra` int(11) NOT NULL,
  `nitProveedor` varchar(100) NOT NULL,
  `estadoCompra` enum('0','1') NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `idDetalleFactura` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `cantidad` varchar(45) NOT NULL,
  `precioUnitario` varchar(45) NOT NULL,
  `idDescuento` int(11) DEFAULT NULL,
  `subtotalDetallefactura` varchar(45) NOT NULL,
  `totalDetalleFactura` varchar(45) NOT NULL,
  `descripcionFactura` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `idDetalleVentas` int(11) NOT NULL,
  `numero_venta` varchar(45) NOT NULL,
  `nitCliente` varchar(45) DEFAULT NULL,
  `idProducto` int(11) NOT NULL,
  `Producto` varchar(100) NOT NULL,
  `PrecioVenta` varchar(100) NOT NULL,
  `CantidadVenta` varchar(100) NOT NULL,
  `moneda` varchar(10) DEFAULT NULL,
  `descuento` varchar(45) DEFAULT NULL,
  `importe` varchar(255) NOT NULL,
  `fechaVenta` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `estadoVenta` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idEmpresa` int(11) NOT NULL,
  `nombreEmpresa` varchar(70) NOT NULL,
  `nitEmpresa` varchar(20) NOT NULL,
  `direccionEmpresa` varchar(100) NOT NULL,
  `telefonoEmpresa` varchar(15) NOT NULL,
  `correoEmpresa` varchar(40) NOT NULL,
  `horarioEmpresa` varchar(45) NOT NULL,
  `idUsuarioEmpresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `nombreEmpresa`, `nitEmpresa`, `direccionEmpresa`, `telefonoEmpresa`, `correoEmpresa`, `horarioEmpresa`, `idUsuarioEmpresa`) VALUES
(1, 'Finca Esmeralda', '30450158-2', 'Guatemala', '45671234', 'company@gmail.com', '07:00 a 05:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `idProductoFactura` int(11) NOT NULL,
  `idEmpresaFactura` int(11) NOT NULL,
  `idUsuarioFactura` int(11) NOT NULL,
  `Empleado` varchar(45) NOT NULL,
  `idClienteFactura` int(11) DEFAULT NULL,
  `nombreCliente` varchar(100) DEFAULT NULL,
  `direccionCliente` varchar(100) DEFAULT NULL,
  `nitCliente` varchar(45) DEFAULT NULL,
  `moneda` varchar(10) DEFAULT NULL,
  `fechaFactura` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermiso` int(11) NOT NULL,
  `nombrePermiso` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermiso`, `nombrePermiso`) VALUES
(1, 'Categoria'),
(2, 'Productos'),
(3, 'Proveedores'),
(4, 'Compras'),
(5, 'Clientes'),
(6, 'Ventas'),
(7, 'Reporte de Compras'),
(8, 'Reporte de Ventas'),
(9, 'Usuarios'),
(10, 'Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `producto` varchar(45) NOT NULL,
  `presentacion` varchar(20) DEFAULT NULL,
  `UnidadMedida` varchar(10) DEFAULT NULL,
  `productoSimilar` varchar(45) DEFAULT NULL,
  `moneda` varchar(10) NOT NULL,
  `precioCompra` varchar(45) NOT NULL,
  `precioVenta` varchar(45) NOT NULL,
  `stock` varchar(45) DEFAULT NULL,
  `tipoProducto` varchar(2) NOT NULL,
  `estadoProducto` enum('0','1') NOT NULL,
  `imagen` varchar(70) NOT NULL,
  `fechaExpiracion` date DEFAULT NULL,
  `idProveedor` int(30) NOT NULL,
  `idUsuarioProductos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `idCategoria`, `producto`, `presentacion`, `UnidadMedida`, `productoSimilar`, `moneda`, `precioCompra`, `precioVenta`, `stock`, `tipoProducto`, `estadoProducto`, `imagen`, `fechaExpiracion`, `idProveedor`, `idUsuarioProductos`) VALUES
(13, 13, 'Cafe Maduro 1ra Calidad', 'Saco', 'Quintal', '', 'Q', '150.00', '500', '11', 'SF', '0', '', '1970-01-01', 2, 1),
(14, 13, 'Cafe Maduro 2da Calidad', 'Saco', 'Quintal', '', 'Q', '150.00', '500', '30', 'CF', '0', '', '2020-10-28', 2, 1),
(15, 13, 'Cafe Maduro 3ra Calidad', 'Saco', 'Quintal', '', 'Q', '150.00', '500', '6', 'SF', '0', '', '2021-03-30', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(45) NOT NULL,
  `contacto` varchar(45) DEFAULT NULL,
  `telefonoContacto` varchar(45) DEFAULT NULL,
  `nitProveedor` varchar(45) DEFAULT NULL,
  `telefonoProveedor` varchar(45) NOT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `idDepartamentoProveedor` int(11) NOT NULL,
  `idRegionProveedor` int(11) NOT NULL,
  `FechaInicioProveedor` date DEFAULT NULL,
  `idUsuarioProveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombreProveedor`, `contacto`, `telefonoContacto`, `nitProveedor`, `telefonoProveedor`, `correo`, `direccion`, `estado`, `idDepartamentoProveedor`, `idRegionProveedor`, `FechaInicioProveedor`, `idUsuarioProveedor`) VALUES
(2, 'Luis Alvarez', 'Luis Alvarez', '45657845', '78451269', '56458222', 'cocacola@yahoo.com', 'Guatemala', '0', 9, 5, '2020-04-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `idRegion` int(11) NOT NULL,
  `nombreRegion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`idRegion`, `nombreRegion`) VALUES
(1, 'Metropolitana'),
(2, 'Norte'),
(3, 'Nororiente'),
(4, 'Suroriente'),
(5, 'Central'),
(6, 'Noroccidente'),
(7, 'Suroccidente'),
(8, 'Region Peten');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrodeactividad`
--

CREATE TABLE `registrodeactividad` (
  `idActividad` int(11) NOT NULL,
  `idProductos_Actividad` int(11) DEFAULT NULL,
  `producto` varchar(100) NOT NULL,
  `idUsuarios_Actividad` int(11) NOT NULL,
  `FechaActividad` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` varchar(100) DEFAULT NULL,
  `precioCompra` varchar(100) DEFAULT NULL,
  `precioVenta` varchar(100) NOT NULL,
  `estadoActual` varchar(1) NOT NULL,
  `descripcionActividad` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `idTipoPago` int(11) NOT NULL,
  `nombreTipoPago` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`idTipoPago`, `nombreTipoPago`) VALUES
(1, 'Efectivo'),
(2, 'Cheque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `apellidoUsuario` varchar(100) NOT NULL,
  `tipoDocumento` varchar(20) NOT NULL,
  `numDocumento` varchar(20) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password2` varchar(255) NOT NULL,
  `fechaRegistro` date DEFAULT NULL,
  `imagen` varchar(256) DEFAULT NULL,
  `estadoUsuario` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `tipoDocumento`, `numDocumento`, `direccion`, `telefono`, `email`, `cargo`, `userName`, `password`, `password2`, `fechaRegistro`, `imagen`, `estadoUsuario`) VALUES
(1, 'Jasson', 'Herrera', 'DPI', '3051997490203', 'Guatemala', '30466252', 'jherreram8@miumg.edu.gt', 1, 'jherrera', '912d0af78b8769d06d8f6db04fa547b5', '912d0af78b8769d06d8f6db04fa547b5', '2020-03-24', '330310718.jpg', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_permisos`
--

CREATE TABLE `usuarios_permisos` (
  `idUsuarios_Permiso` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_permisos`
--

INSERT INTO `usuarios_permisos` (`idUsuarios_Permiso`, `idUsuario`, `idPermiso`) VALUES
(129, 1, 1),
(130, 1, 2),
(131, 1, 3),
(132, 1, 4),
(133, 1, 5),
(134, 1, 6),
(135, 1, 7),
(136, 1, 8),
(137, 1, 9),
(138, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVentas` int(11) NOT NULL,
  `fechaVenta` date NOT NULL,
  `numero_venta` varchar(45) NOT NULL,
  `nombreCliente` varchar(70) DEFAULT NULL,
  `nitCliente` varchar(45) DEFAULT NULL,
  `Vendedor` varchar(45) DEFAULT NULL,
  `moneda` varchar(10) DEFAULT NULL,
  `subtotal` varchar(100) NOT NULL,
  `totalIVA` varchar(45) NOT NULL,
  `total` varchar(100) NOT NULL,
  `idTipoPago` int(11) NOT NULL,
  `tipoProducto` varchar(2) NOT NULL,
  `estadoVenta` enum('0','1') NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `fk_Categoria_Usuarios_idx` (`idUsuarioCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `fk_Clientes_Usuario_idx` (`idUsuarioCliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `fk_Compras_Usuarios_idx` (`idUsuarioCompra`),
  ADD KEY `fk_Compras_TipoPago_idx` (`idTipoPago`),
  ADD KEY `fk_Compras_Proveedor_idx` (`idProveedor`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`idCreditos`),
  ADD KEY `fk_Credito_Cliente_idx` (`idClienteCredito`),
  ADD KEY `fk_Credito_Producto_idx` (`idProductoCredito`),
  ADD KEY `fk_Credito_Usuario_idx` (`idUsuarioCredito`),
  ADD KEY `fk_Credito_Categoria_idx` (`idCategoriaCredito`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`idDeposito`),
  ADD KEY `fk_Depositos_Productos_idx` (`idProductoDepositos`),
  ADD KEY `fk_Depositos_Usuarios_idx` (`idUsuariosDepositos`),
  ADD KEY `fk_Depositos_Cliente_idx` (`idClientesDepositos`);

--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`idDescuento`),
  ADD KEY `fk_Descuento_Productos_idx` (`idProductos`),
  ADD KEY `fk_Descuento_Categoria_idx` (`idCategoria`);

--
-- Indices de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD PRIMARY KEY (`idDetalleCompras`),
  ADD KEY `fk_DetalleCompras_Productos_idx` (`idProducto`),
  ADD KEY `fk_DetalleCompras_Usuarios_idx` (`idUsuarioCompras`),
  ADD KEY `fkDetalleCompras_Proveedor_idx` (`idProveedorCompra`),
  ADD KEY `fk_DetalleCompras_Categoria_idx` (`idCategoria`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`idDetalleFactura`),
  ADD KEY `fk_DetalleFactura_Descuento_idx` (`idDescuento`),
  ADD KEY `fk_DetalleFactura_Factura_idx` (`idFactura`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`idDetalleVentas`),
  ADD KEY `fk_DetalleVentas_Productos_idx` (`idProducto`),
  ADD KEY `fk_DetalleVentas_Usuarios_idx` (`idUsuario`),
  ADD KEY `fk_DetalleVentas_Cliente_idx` (`idCliente`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idEmpresa`),
  ADD KEY `fk_Empresa_Usuarios_idx` (`idUsuarioEmpresa`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_Factura_Productos_idx` (`idProductoFactura`),
  ADD KEY `fk_Factura_Empresa_idx` (`idEmpresaFactura`),
  ADD KEY `fk_Factura_Usuarios_idx` (`idUsuarioFactura`),
  ADD KEY `fk_Factura_Cliente_idx` (`idClienteFactura`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermiso`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProductos`),
  ADD KEY `fk_Productos_Usuarios_idx` (`idUsuarioProductos`),
  ADD KEY `fk_Productos_Categoria_idx` (`idCategoria`),
  ADD KEY `idProveedor` (`idProveedor`) USING BTREE;

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`),
  ADD KEY `fk_Proeedor_Usuarios_idx` (`idUsuarioProveedor`),
  ADD KEY `fk_Proveedor_Departamento_idx` (`idDepartamentoProveedor`),
  ADD KEY `fk_Proveedor_Region_idx` (`idRegionProveedor`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`idRegion`);

--
-- Indices de la tabla `registrodeactividad`
--
ALTER TABLE `registrodeactividad`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `fk_Actividad_Productos_idx` (`idProductos_Actividad`),
  ADD KEY `fk_Actividad_Usuarios_idx` (`idUsuarios_Actividad`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`idTipoPago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD PRIMARY KEY (`idUsuarios_Permiso`),
  ADD KEY `fk_Usuario_Permiso_Usuario_idx` (`idUsuario`),
  ADD KEY `fk_Usuario_Permiso_Permiso_idx` (`idPermiso`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVentas`),
  ADD KEY `fk_ventas_usuarios_idx` (`idUsuario`),
  ADD KEY `fk_Ventas_Cliente_idx` (`idCliente`),
  ADD KEY `fk_Ventas_TipoPago_idx` (`idTipoPago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `idCreditos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `idDeposito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descuento`
--
ALTER TABLE `descuento`
  MODIFY `idDescuento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  MODIFY `idDetalleCompras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `idDetalleFactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  MODIFY `idDetalleVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `idRegion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `registrodeactividad`
--
ALTER TABLE `registrodeactividad`
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `idTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  MODIFY `idUsuarios_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_Categoria_Usuarios` FOREIGN KEY (`idUsuarioCategoria`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_Clientes_Usuario` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_Compras_Proveedor` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Compras_TipoPago` FOREIGN KEY (`idTipoPago`) REFERENCES `tipopago` (`idTipoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Compras_Usuarios` FOREIGN KEY (`idUsuarioCompra`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `fk_Credito_Categoria` FOREIGN KEY (`idCategoriaCredito`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Credito_Cliente` FOREIGN KEY (`idClienteCredito`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Credito_Producto` FOREIGN KEY (`idProductoCredito`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Credito_Usuario` FOREIGN KEY (`idUsuarioCredito`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD CONSTRAINT `fk_Depositos_Cliente` FOREIGN KEY (`idClientesDepositos`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Depositos_Productos` FOREIGN KEY (`idProductoDepositos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Depositos_Usuarios` FOREIGN KEY (`idUsuariosDepositos`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD CONSTRAINT `fk_Descuento_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD CONSTRAINT `fk_DetalleCompras_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleCompras_Productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleCompras_Proveedor` FOREIGN KEY (`idProveedorCompra`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleCompras_Usuarios` FOREIGN KEY (`idUsuarioCompras`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `fk_DetalleFactura_Descuento` FOREIGN KEY (`idDescuento`) REFERENCES `descuento` (`idDescuento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleFactura_Factura` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD CONSTRAINT `fk_DetalleVentas_Cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleVentas_Productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleVentas_Usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_Empresa_Usuarios` FOREIGN KEY (`idUsuarioEmpresa`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_Cliente` FOREIGN KEY (`idClienteFactura`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_Empresa` FOREIGN KEY (`idEmpresaFactura`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_Productos` FOREIGN KEY (`idProductoFactura`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_Usuarios` FOREIGN KEY (`idUsuarioFactura`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Productos_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_Usuarios` FOREIGN KEY (`idUsuarioProductos`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_Proveedor_Departamento` FOREIGN KEY (`idDepartamentoProveedor`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proveedor_Region` FOREIGN KEY (`idRegionProveedor`) REFERENCES `region` (`idRegion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proveedor_Usuarios` FOREIGN KEY (`idUsuarioProveedor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registrodeactividad`
--
ALTER TABLE `registrodeactividad`
  ADD CONSTRAINT `fk_Actividad_Productos` FOREIGN KEY (`idProductos_Actividad`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Actividad_Usuarios` FOREIGN KEY (`idUsuarios_Actividad`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD CONSTRAINT `fk_Usuario_Permiso_Permiso` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_Permiso_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_Ventas_Cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ventas_TipoPago` FOREIGN KEY (`idTipoPago`) REFERENCES `tipopago` (`idTipoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
