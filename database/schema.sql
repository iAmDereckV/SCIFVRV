-- Active: 1780330694464@@127.0.0.1@3306@scifvrv
-- ? CONFIGURACION DE EMPRESA
CREATE TABLE configuracion_empresa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_empresa VARCHAR(150) NOT NULL,
    ruc VARCHAR(50),
    telefono VARCHAR(50),
    correo VARCHAR(100),
    direccion TEXT,
    slogan VARCHAR(255),
    logo VARCHAR(255)
);
-- ? ROL y PERMISO
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(255),
    estado ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO'
);

CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE rol_permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rol_id INT NOT NULL,
    permiso_id INT NOT NULL,
    FOREIGN KEY (rol_id) REFERENCES roles (id),
    FOREIGN KEY (permiso_id) REFERENCES permisos (id)
);
-- ? USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rol_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    estado ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso datetime DEFAULT NULL,
    foto VARCHAR(255) NULL,
    FOREIGN KEY (rol_id) REFERENCES roles (id)
);

CREATE TABLE respaldos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    archivo VARCHAR(255) NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);
-- ? PRODUCTO
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    estado ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),
    estado ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    marca_id INT NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    vehiculo_aplicable VARCHAR(255) NULL,
    precio_compra DECIMAL(10, 2) NOT NULL,
    precio_venta DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    stock_minimo INT DEFAULT 5,
    ubicacion VARCHAR(100),
    imagen VARCHAR(255) NULL,
    estado ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias (id),
    FOREIGN KEY (marca_id) REFERENCES marcas (id)
);
-- ? GASTOS
CREATE TABLE categorias_gastos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE gastos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    usuario_id INT NOT NULL,
    descripcion TEXT,
    monto DECIMAL(10, 2) NOT NULL,
    fecha DATE NOT NULL,
    archivo_factura VARCHAR(255) NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias_gastos (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);
-- ? COMPRAS
CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    contacto VARCHAR(150),
    telefono VARCHAR(30),
    correo VARCHAR(100),
    direccion TEXT,
    estado ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO'
);

CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    proveedor_id INT NOT NULL,
    usuario_id INT NOT NULL,
    factura_proveedor VARCHAR(100),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) DEFAULT 0,
    archivo_factura VARCHAR(255) NULL,
    estado ENUM('COMPLETADA', 'ANULADA') DEFAULT 'COMPLETADA',
    FOREIGN KEY (proveedor_id) REFERENCES proveedores (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);

CREATE TABLE detalle_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compra_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    costo DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (compra_id) REFERENCES compras (id),
    FOREIGN KEY (producto_id) REFERENCES productos (id)
);

-- ? VENTAS
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(150) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    telefono VARCHAR(30),
    correo VARCHAR(100),
    direccion TEXT,
    identificacion VARCHAR(50),
    tipo_cliente enum('NORMAL', 'TALLER', 'EMPRESA') DEFAULT 'NORMAL',
    estado enum('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    subtotal DECIMAL(10, 2) NOT NULL,
    descuento DECIMAL(10, 2) DEFAULT 0,
    impuesto DECIMAL(10, 2) DEFAULT 0,
    total DECIMAL(10, 2) NOT NULL,
    estado ENUM('COMPLETADA', 'ANULADA') DEFAULT 'COMPLETADA',
    FOREIGN KEY (cliente_id) REFERENCES clientes (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);

CREATE TABLE detalle_ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    costo_unitario DECIMAL(10, 2),
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (venta_id) REFERENCES ventas (id),
    FOREIGN KEY (producto_id) REFERENCES productos (id)
);