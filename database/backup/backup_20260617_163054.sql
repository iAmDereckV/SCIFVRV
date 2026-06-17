

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categorias` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('1','Filtros','Filtros para vehículos','ACTIVO','2026-06-03 09:46:27');
INSERT INTO `categorias` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('2','Frenos','Sistema de frenos','ACTIVO','2026-06-03 09:46:27');
INSERT INTO `categorias` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('3','Lubricantes','Aceites y lubricantes','ACTIVO','2026-06-03 09:46:27');
INSERT INTO `categorias` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('4','Motor','Partes de motor','ACTIVO','2026-06-03 09:46:27');
INSERT INTO `categorias` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('5','Luces','Luces frotarles y de stoc','ACTIVO','2026-06-03 10:18:46');


DROP TABLE IF EXISTS `categorias_gastos`;
CREATE TABLE `categorias_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categorias_gastos` (id,nombre) VALUES ('1','Luz');
INSERT INTO `categorias_gastos` (id,nombre) VALUES ('2','Agua');
INSERT INTO `categorias_gastos` (id,nombre) VALUES ('3','Arquiler');


DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(150) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `identificacion` varchar(50) DEFAULT NULL,
  `tipo_cliente` enum('NORMAL','TALLER','EMPRESA') DEFAULT 'NORMAL',
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `apellidos` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `clientes` (id,nombres,telefono,correo,direccion,identificacion,tipo_cliente,estado,fecha_registro,apellidos) VALUES ('1','Juan Pérez','88887777','juan@email.com','Managuad','001-000000-0000b','NORMAL','ACTIVO','2026-06-01 14:43:49','');
INSERT INTO `clientes` (id,nombres,telefono,correo,direccion,identificacion,tipo_cliente,estado,fecha_registro,apellidos) VALUES ('2','Lucas','85747485','lucas@gmail.com','constado norte cancha','000-000000-0000s','TALLER','ACTIVO','2026-06-04 09:27:28','Ponce');
INSERT INTO `clientes` (id,nombres,telefono,correo,direccion,identificacion,tipo_cliente,estado,fecha_registro,apellidos) VALUES ('3','magdalena','85968596','mag@gmail.com','dasdad','093-292929-2222m','NORMAL','ACTIVO','2026-06-04 17:46:51','sanchez');


DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `factura_proveedor` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT 0.00,
  `archivo_factura` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proveedor_id` (`proveedor_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`),
  CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `compras` (id,proveedor_id,usuario_id,factura_proveedor,fecha,total,archivo_factura) VALUES ('32','1','4','','2026-06-08 11:51:44','600.00',NULL);
INSERT INTO `compras` (id,proveedor_id,usuario_id,factura_proveedor,fecha,total,archivo_factura) VALUES ('33','1','4','','2026-06-08 11:52:04','600.00',NULL);
INSERT INTO `compras` (id,proveedor_id,usuario_id,factura_proveedor,fecha,total,archivo_factura) VALUES ('34','1','4','','2026-06-08 11:52:37','3900.00',NULL);
INSERT INTO `compras` (id,proveedor_id,usuario_id,factura_proveedor,fecha,total,archivo_factura) VALUES ('35','1','4','002','2026-06-10 18:36:27','150.00',NULL);
INSERT INTO `compras` (id,proveedor_id,usuario_id,factura_proveedor,fecha,total,archivo_factura) VALUES ('36','1','4','003','2026-06-10 18:38:28','1500.00','uploads/facturas/factura_1781138308.jpg');
INSERT INTO `compras` (id,proveedor_id,usuario_id,factura_proveedor,fecha,total,archivo_factura) VALUES ('37','1','4','','2026-06-10 19:43:40','20.00',NULL);


DROP TABLE IF EXISTS `configuracion_empresa`;
CREATE TABLE `configuracion_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(150) NOT NULL,
  `ruc` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `configuracion_empresa` (id,nombre_empresa,ruc,telefono,correo,direccion,slogan,logo) VALUES ('1','Moto Servicio tellezmondragon','000_inventandoruc','84672704','sistema@empresa.com','en nicaragua','mejores repuesto','logo_empresa.png');


DROP TABLE IF EXISTS `detalle_compras`;
CREATE TABLE `detalle_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `compra_id` (`compra_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `detalle_compras_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`),
  CONSTRAINT `detalle_compras_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `detalle_compras` (id,compra_id,producto_id,cantidad,costo,subtotal) VALUES ('32','32','1','2','300.00','600.00');
INSERT INTO `detalle_compras` (id,compra_id,producto_id,cantidad,costo,subtotal) VALUES ('33','33','2','2','300.00','600.00');
INSERT INTO `detalle_compras` (id,compra_id,producto_id,cantidad,costo,subtotal) VALUES ('34','34','1','13','300.00','3900.00');
INSERT INTO `detalle_compras` (id,compra_id,producto_id,cantidad,costo,subtotal) VALUES ('35','35','1','6','25.00','150.00');
INSERT INTO `detalle_compras` (id,compra_id,producto_id,cantidad,costo,subtotal) VALUES ('36','36','1','5','300.00','1500.00');
INSERT INTO `detalle_compras` (id,compra_id,producto_id,cantidad,costo,subtotal) VALUES ('37','37','2','2','10.00','20.00');


DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
  CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('1','15','1','1','250.00','250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('2','16','1','1','250.00','250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('3','17','1','1','250.00','250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('4','18','1','1','250.00','250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('5','19','1','5','250.00','1250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('6','20','1','1','250.00','250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('7','21','1','1','250.00','250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('8','22','1','5','250.00','1250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('9','23','2','2','500.00','1000.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('10','24','2','2','500.00','1000.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('11','25','2','2','500.00','1000.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('12','26','2','2','500.00','1000.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('13','27','1','3','250.00','750.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('14','28','1','9','250.00','2250.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('15','29','1','3','250.00','750.00');
INSERT INTO `detalle_ventas` (id,venta_id,producto_id,cantidad,precio_unitario,subtotal) VALUES ('16','29','2','4','500.00','2000.00');


DROP TABLE IF EXISTS `gastos`;
CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `archivo_factura` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_gastos` (`id`),
  CONSTRAINT `gastos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gastos` (id,categoria_id,usuario_id,descripcion,monto,fecha,archivo_factura) VALUES ('1','1','4','dissnorte ','50.00','2026-06-05','1781198145_e67eb556-f125-4e24-95ad-8aff21b9926a.jpg');
INSERT INTO `gastos` (id,categoria_id,usuario_id,descripcion,monto,fecha,archivo_factura) VALUES ('2','2','4','enacal','300.00','2026-06-05',NULL);
INSERT INTO `gastos` (id,categoria_id,usuario_id,descripcion,monto,fecha,archivo_factura) VALUES ('4','3','4','asldnasdn','200.00','2026-06-11','1781277631_9440461.jpg');


DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `marcas` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('1','Toyota',NULL,'ACTIVO','2026-06-03 10:24:46');
INSERT INTO `marcas` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('2','Nissan',NULL,'ACTIVO','2026-06-03 10:24:46');
INSERT INTO `marcas` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('3','Hyundai',NULL,'ACTIVO','2026-06-03 10:24:46');
INSERT INTO `marcas` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('4','Bosch',NULL,'ACTIVO','2026-06-03 10:24:46');
INSERT INTO `marcas` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('5','Mobil',NULL,'ACTIVO','2026-06-03 10:24:46');
INSERT INTO `marcas` (id,nombre,descripcion,estado,fecha_creacion) VALUES ('6','Nissan','car','ACTIVO','2026-06-03 11:06:53');


DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `vehiculo_aplicable` varchar(255) DEFAULT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `stock_minimo` int(11) DEFAULT 5,
  `ubicacion` varchar(100) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `categoria_id` (`categoria_id`),
  KEY `marca_id` (`marca_id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos` (id,categoria_id,marca_id,codigo,nombre,descripcion,vehiculo_aplicable,precio_compra,precio_venta,stock,stock_minimo,ubicacion,imagen,estado,fecha_creacion) VALUES ('1','1','4','FIL001','Filtro de Aceite Toyota','Filtro original Toyota','','300.00','250.00','30','5','',NULL,'ACTIVO','2026-06-03 11:12:41');
INSERT INTO `productos` (id,categoria_id,marca_id,codigo,nombre,descripcion,vehiculo_aplicable,precio_compra,precio_venta,stock,stock_minimo,ubicacion,imagen,estado,fecha_creacion) VALUES ('2','2','4','FRE001','Pastillas de Freno','Juego de pastillas delanteras','Bosch','10.00','600.00','12','5','a13','1781147532_54b19ada-d53e-4ee9-8882-9dfed1bf1396.jpg','ACTIVO','2026-06-03 11:12:41');
INSERT INTO `productos` (id,categoria_id,marca_id,codigo,nombre,descripcion,vehiculo_aplicable,precio_compra,precio_venta,stock,stock_minimo,ubicacion,imagen,estado,fecha_creacion) VALUES ('3','5','3','LUZ001','luzces gaviota','decoracion lateral','todos','200.00','500.00','25','2','','1781194747_logo.png','ACTIVO','2026-06-11 10:19:07');


DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `contacto` varchar(150) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `proveedores` (id,nombre,contacto,telefono,correo,direccion,estado) VALUES ('1','Casa Pella','rooberto Pellas','85966966','rooberto@gmail.com','managua','ACTIVO');


DROP TABLE IF EXISTS `respaldos`;
CREATE TABLE `respaldos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `respaldos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `respaldos` (id,usuario_id,archivo,fecha) VALUES ('10','4','backup_20260615_190341.sql','2026-06-15 11:03:41');


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `roles` (id,nombre,descripcion,estado) VALUES ('1','Administrador','Control total del sistema','ACTIVO');
INSERT INTO `roles` (id,nombre,descripcion,estado) VALUES ('2','Supervisor','Supervisa operaciones','ACTIVO');
INSERT INTO `roles` (id,nombre,descripcion,estado) VALUES ('3','Vendedor','Realiza ventas','ACTIVO');
INSERT INTO `roles` (id,nombre,descripcion,estado) VALUES ('4','Consulta','Solo lectura','ACTIVO');


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `ultimo_acceso` datetime DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (id,rol_id,nombre,usuario,correo,password,estado,fecha_creacion,ultimo_acceso,foto) VALUES ('4','1','Administrador','admin','admin@sistema.com','$2y$10$7HwIDR5f5K1WUzoWgGVsX.Cne1VLYzp9TLAf7/HXjFLk0dHMGozAe','ACTIVO','2026-06-01 14:38:36','2026-06-17 08:25:54','1781200865_e67eb556-f125-4e24-95ad-8aff21b9926a.jpg');
INSERT INTO `usuarios` (id,rol_id,nombre,usuario,correo,password,estado,fecha_creacion,ultimo_acceso,foto) VALUES ('8','3','lucas','lucas','lucasmodrid@gmail.com','$2y$10$xirXhGwCVVYx9MXrOU5MduTp0qVUbvMG7DxOOSpvsb3qJGu7XYgJ.','ACTIVO','2026-06-08 09:57:47',NULL,'1781195736_e67eb556-f125-4e24-95ad-8aff21b9926a.jpg');
INSERT INTO `usuarios` (id,rol_id,nombre,usuario,correo,password,estado,fecha_creacion,ultimo_acceso,foto) VALUES ('11','4','roberto','roberto','rooberto@gmail.com','roberto123','ACTIVO','2026-06-11 12:17:24',NULL,NULL);
INSERT INTO `usuarios` (id,rol_id,nombre,usuario,correo,password,estado,fecha_creacion,ultimo_acceso,foto) VALUES ('12','2','pablo','pablo2','pablo@gmail.com','$2y$10$w/1daVTKN/hcv1zmvpouZ.aO/.fH1H4kjsTpWwIxI3s9WGZMXZzKK','ACTIVO','2026-06-11 12:25:25','2026-06-11 12:26:01','1781202503_logo.png');


DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `subtotal` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `impuesto` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('COMPLETADA','ANULADA') DEFAULT 'COMPLETADA',
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('15','1','4','2026-06-04 11:04:17','250.00','0.00','0.00','250.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('16','1','4','2026-06-04 11:20:27','250.00','0.00','0.00','250.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('17','2','4','2026-06-04 11:20:50','250.00','0.00','0.00','250.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('18','1','4','2026-06-04 11:21:46','250.00','0.00','0.00','250.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('19','1','4','2026-06-05 09:16:44','1250.00','0.00','0.00','1250.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('20','1','4','2026-06-10 12:29:25','250.00','0.00','0.00','250.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('21','2','4','2026-06-10 12:31:14','250.00','0.00','0.00','250.00','ANULADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('22','1','4','2026-06-10 14:27:02','1250.00','500.00','187.50','937.50','ANULADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('23','2','4','2026-06-10 14:28:55','1000.00','100.00','150.00','1050.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('24','2','4','2026-06-10 14:30:28','1000.00','50.00','150.00','1100.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('25','2','4','2026-06-10 14:32:11','1000.00','100.00','150.00','1050.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('26','2','4','2026-06-10 14:33:01','1000.00','0.00','150.00','1150.00','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('27','3','4','2026-06-10 14:33:46','750.00','0.00','112.50','862.50','COMPLETADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('28','2','4','2026-06-10 15:52:47','2250.00','0.00','337.50','2587.50','ANULADA');
INSERT INTO `ventas` (id,cliente_id,usuario_id,fecha,subtotal,descuento,impuesto,total,estado) VALUES ('29','2','4','2026-06-10 20:50:20','2750.00','0.00','412.50','3162.50','COMPLETADA');
