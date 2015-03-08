-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 03-02-2012 a las 23:46:45
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `bdsima`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `clientes`
-- 

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL auto_increment,
  `id_provincia` int(11) default NULL,
  `nombre_comercial` varchar(100) default NULL,
  `razon_social` varchar(100) default NULL,
  `nif_cif` varchar(15) default NULL,
  `contacto` varchar(100) default NULL,
  `pagina_web` varchar(150) default NULL,
  `email` varchar(80) default NULL,
  `poblacion` varchar(80) default NULL,
  `direccion` text,
  `cp` varchar(5) character set latin1 default NULL,
  `telefono` varchar(10) character set latin1 default NULL,
  `movil` varchar(10) character set latin1 default NULL,
  `fax` varchar(10) character set latin1 default NULL,
  `tipo_empresa` varchar(80) default NULL,
  `entidad_bancaria` varchar(100) default NULL,
  `numero_cuenta` varchar(50) character set latin1 default NULL,
  `observaciones` text,
  PRIMARY KEY  (`id_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `clientes`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `configuracion`
-- 

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL auto_increment,
  `nombre_configuracion` varchar(40) NOT NULL default '',
  `valor_configuracion` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id_configuracion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Volcar la base de datos para la tabla `configuracion`
-- 

INSERT INTO `configuracion` VALUES (1, 'NOMBRE_SITIO', 'Sima Climatización');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `facturas`
-- 

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL auto_increment,
  `id_cliente` int(11) NOT NULL,
  `numero` varchar(10) character set latin1 NOT NULL,
  `monto` float(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY  (`id_factura`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `facturas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `facturas_detalles`
-- 

CREATE TABLE `facturas_detalles` (
  `id_factura_detalle` int(11) NOT NULL auto_increment,
  `id_factura` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY  (`id_factura_detalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `facturas_detalles`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `modulos`
-- 

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL auto_increment,
  `nombre_modulo` varchar(80) NOT NULL,
  PRIMARY KEY  (`id_modulo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Volcar la base de datos para la tabla `modulos`
-- 

INSERT INTO `modulos` VALUES (1, 'Inicio');
INSERT INTO `modulos` VALUES (2, 'Datos');
INSERT INTO `modulos` VALUES (6, 'Facturación');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `presupuestos`
-- 

CREATE TABLE `presupuestos` (
  `id_presupuesto` int(11) NOT NULL auto_increment,
  `id_cliente` int(11) NOT NULL,
  `numero` varchar(10) character set latin1 NOT NULL,
  `monto` float(10,2) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY  (`id_presupuesto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `presupuestos`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `presupuestos_detalles`
-- 

CREATE TABLE `presupuestos_detalles` (
  `id_presupuesto_detalle` int(11) NOT NULL auto_increment,
  `id_presupuesto` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY  (`id_presupuesto_detalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `presupuestos_detalles`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `productos`
-- 

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float(10,2) NOT NULL,
  PRIMARY KEY  (`id_producto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `productos`
-- 

INSERT INTO `productos` VALUES (1, 'Producto 01', 'Carne molida', 45.00);
INSERT INTO `productos` VALUES (2, 'producto 2', 'xxxx', 33.00);
INSERT INTO `productos` VALUES (3, 'producto 3', 'texto', 11.00);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `proformas`
-- 

CREATE TABLE `proformas` (
  `id_proforma` int(11) NOT NULL auto_increment,
  `id_cliente` int(11) NOT NULL,
  `numero` varchar(10) character set latin1 NOT NULL,
  `monto` float(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY  (`id_proforma`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `proformas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `proformas_detalles`
-- 

CREATE TABLE `proformas_detalles` (
  `id_proforma_detalle` int(11) NOT NULL auto_increment,
  `id_proforma` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY  (`id_proforma_detalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `proformas_detalles`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `proveedores`
-- 

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL auto_increment,
  `id_provincia` int(11) default NULL,
  `nombre_comercial` varchar(100) default NULL,
  `razon_social` varchar(100) default NULL,
  `nif_cif` varchar(15) default NULL,
  `contacto` varchar(100) default NULL,
  `pagina_web` varchar(150) default NULL,
  `email` varchar(80) default NULL,
  `poblacion` varchar(80) default NULL,
  `direccion` text,
  `cp` varchar(5) character set latin1 default NULL,
  `telefono` varchar(10) character set latin1 default NULL,
  `movil` varchar(10) character set latin1 default NULL,
  `fax` varchar(10) character set latin1 default NULL,
  `tipo_empresa` varchar(80) default NULL,
  `entidad_bancaria` varchar(100) default NULL,
  `numero_cuenta` varchar(50) character set latin1 default NULL,
  `observaciones` text,
  PRIMARY KEY  (`id_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `proveedores`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `provincias`
-- 

CREATE TABLE `provincias` (
  `id_provincia` int(11) NOT NULL auto_increment,
  `nombre_provincia` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_provincia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

-- 
-- Volcar la base de datos para la tabla `provincias`
-- 

INSERT INTO `provincias` VALUES (1, 'Ávila');
INSERT INTO `provincias` VALUES (2, 'Álava');
INSERT INTO `provincias` VALUES (3, 'Albacete');
INSERT INTO `provincias` VALUES (4, 'Alicante');
INSERT INTO `provincias` VALUES (5, 'Almería');
INSERT INTO `provincias` VALUES (6, 'Asturias');
INSERT INTO `provincias` VALUES (7, 'Badajoz');
INSERT INTO `provincias` VALUES (8, 'Baleares');
INSERT INTO `provincias` VALUES (9, 'Barcelona');
INSERT INTO `provincias` VALUES (10, 'Burgos');
INSERT INTO `provincias` VALUES (11, 'Cáceres');
INSERT INTO `provincias` VALUES (12, 'Cádiz');
INSERT INTO `provincias` VALUES (13, 'Córdoba');
INSERT INTO `provincias` VALUES (14, 'Cantabria');
INSERT INTO `provincias` VALUES (15, 'Castellón');
INSERT INTO `provincias` VALUES (16, 'Ceuta');
INSERT INTO `provincias` VALUES (17, 'Ciudad Real');
INSERT INTO `provincias` VALUES (18, 'Coruña');
INSERT INTO `provincias` VALUES (19, 'Cuenca');
INSERT INTO `provincias` VALUES (20, 'Gerona');
INSERT INTO `provincias` VALUES (21, 'Granada');
INSERT INTO `provincias` VALUES (22, 'Guadalajara');
INSERT INTO `provincias` VALUES (23, 'Gipuzcoa');
INSERT INTO `provincias` VALUES (24, 'Huelva');
INSERT INTO `provincias` VALUES (25, 'Huesca');
INSERT INTO `provincias` VALUES (26, 'Jaén');
INSERT INTO `provincias` VALUES (27, 'Lérida');
INSERT INTO `provincias` VALUES (28, 'La Rioja');
INSERT INTO `provincias` VALUES (29, 'Las Palmas');
INSERT INTO `provincias` VALUES (30, 'León');
INSERT INTO `provincias` VALUES (31, 'Lugo');
INSERT INTO `provincias` VALUES (32, 'Málaga');
INSERT INTO `provincias` VALUES (33, 'Madrid');
INSERT INTO `provincias` VALUES (34, 'Melilla');
INSERT INTO `provincias` VALUES (35, 'Murcia');
INSERT INTO `provincias` VALUES (36, 'Navarra');
INSERT INTO `provincias` VALUES (37, 'Orense');
INSERT INTO `provincias` VALUES (38, 'Palencia');
INSERT INTO `provincias` VALUES (39, 'Pontevedra');
INSERT INTO `provincias` VALUES (40, 'Salamanca');
INSERT INTO `provincias` VALUES (41, 'Santa Cruz de Tenerife');
INSERT INTO `provincias` VALUES (42, 'Segovia');
INSERT INTO `provincias` VALUES (43, 'Sevilla');
INSERT INTO `provincias` VALUES (44, 'Soria');
INSERT INTO `provincias` VALUES (45, 'Tarragona');
INSERT INTO `provincias` VALUES (46, 'Teruel');
INSERT INTO `provincias` VALUES (47, 'Toledo');
INSERT INTO `provincias` VALUES (48, 'Valencia');
INSERT INTO `provincias` VALUES (49, 'Valladolid');
INSERT INTO `provincias` VALUES (50, 'Vizcaya');
INSERT INTO `provincias` VALUES (51, 'Zamora');
INSERT INTO `provincias` VALUES (52, 'Zaragoza');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `roles`
-- 

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL auto_increment,
  `nombre_rol` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_rol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `roles`
-- 

INSERT INTO `roles` VALUES (1, 'Super Admin');
INSERT INTO `roles` VALUES (2, 'Admin');
INSERT INTO `roles` VALUES (3, 'Cliente');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `secciones`
-- 

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) NOT NULL,
  `nombre_seccion` varchar(100) NOT NULL,
  `url_seccion` varchar(200) NOT NULL,
  PRIMARY KEY  (`id_seccion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Volcar la base de datos para la tabla `secciones`
-- 

INSERT INTO `secciones` VALUES (1, 1, 'Inicio', '');
INSERT INTO `secciones` VALUES (3, 1, 'Cuentas', 'cuentas');
INSERT INTO `secciones` VALUES (5, 2, 'Clientes', 'clientes');
INSERT INTO `secciones` VALUES (26, 2, 'Servicios', 'servicios');
INSERT INTO `secciones` VALUES (23, 6, 'Facturas', 'facturas');
INSERT INTO `secciones` VALUES (27, 6, 'Presupuestos', 'presupuestos');
INSERT INTO `secciones` VALUES (21, 2, 'Productos', 'productos');
INSERT INTO `secciones` VALUES (24, 6, 'Proformas', 'proformas');
INSERT INTO `secciones` VALUES (7, 2, 'Proveedores', 'proveedores');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `servicios`
-- 

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float(10,2) NOT NULL,
  PRIMARY KEY  (`id_servicio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `servicios`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `id_rol` int(11) default NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `nick_usuario` varchar(50) NOT NULL,
  `clave_usuario` varchar(50) NOT NULL,
  `mail_usuario` varchar(50) NOT NULL,
  `nivel_usuario` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (1, 1, 'Jorge Luis', 'admin', '123', 'guty_888@hotmail.com', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios_secciones`
-- 

CREATE TABLE `usuarios_secciones` (
  `id_usuario` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `usuarios_secciones`
-- 

INSERT INTO `usuarios_secciones` VALUES (1, 1);
INSERT INTO `usuarios_secciones` VALUES (1, 3);
INSERT INTO `usuarios_secciones` VALUES (1, 5);
INSERT INTO `usuarios_secciones` VALUES (1, 7);
INSERT INTO `usuarios_secciones` VALUES (1, 26);
INSERT INTO `usuarios_secciones` VALUES (1, 21);
INSERT INTO `usuarios_secciones` VALUES (1, 23);
INSERT INTO `usuarios_secciones` VALUES (1, 24);
INSERT INTO `usuarios_secciones` VALUES (1, 22);
INSERT INTO `usuarios_secciones` VALUES (18, 1);
INSERT INTO `usuarios_secciones` VALUES (18, 5);
INSERT INTO `usuarios_secciones` VALUES (18, 6);
INSERT INTO `usuarios_secciones` VALUES (18, 20);
INSERT INTO `usuarios_secciones` VALUES (18, 16);
