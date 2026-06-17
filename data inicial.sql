-- Active: 1780330694464@@127.0.0.1@3306@scifvrv

INSERT INTO
    usuarios (
        rol_id,
        nombre,
        usuario,
        correo,
        password,
        estado
    )
VALUES (
        1,
        'Administrador',
        'admin',
        'admin@sistema.com',
        'admin123',
        'ACTIVO'
    );

INSERT INTO
    usuarios (
        rol_id,
        nombre,
        usuario,
        correo,
        password,
        estado
    )
VALUES (
        1,
        'Administrador2',
        'admin2',
        'admin2@sistema.com',
        'system',
        'ACTIVO'
    );

INSERT INTO
    roles (id, nombre, descripcion)
VALUES (
        1,
        'Administrador',
        'Control total del sistema'
    ),
    (
        2,
        'Supervisor',
        'Supervisa operaciones'
    ),
    (
        3,
        'Vendedor',
        'Realiza ventas'
    ),
    (4, 'Consulta', 'Solo lectura');

INSERT INTO
    empresa (
        nombre,
        telefono,
        correo,
        direccion,
        impuesto
    )
VALUES (
        'Repuestos El Motor',
        '8888-8888',
        'info@repuestos.com',
        'Managua, Nicaragua',
        15
    );

INSERT INTO
    categorias (nombre, descripcion)
VALUES (
        'Filtros',
        'Filtros para vehículos'
    ),
    ('Frenos', 'Sistema de frenos'),
    (
        'Lubricantes',
        'Aceites y lubricantes'
    ),
    ('Motor', 'Partes de motor');

INSERT INTO
    marcas (nombre)
VALUES ('Toyota'),
    ('Nissan'),
    ('Hyundai'),
    ('Bosch'),
    ('Mobil');

INSERT INTO
    productos (
        categoria_id,
        marca_id,
        codigo,
        nombre,
        descripcion,
        costo,
        precio,
        stock,
        stock_minimo,
        estado
    )
VALUES (
        1,
        4,
        'FIL001',
        'Filtro de Aceite Toyota',
        'Filtro original Toyota',
        150,
        250,
        20,
        5,
        'ACTIVO'
    ),
    (
        2,
        4,
        'FRE001',
        'Pastillas de Freno',
        'Juego de pastillas delanteras',
        300,
        500,
        15,
        5,
        'ACTIVO'
    );

INSERT INTO
    clientes (
        nombres,
        telefono,
        correo,
        direccion,
        identificacion
    )
VALUES (
        'Juan Pérez',
        '88887777',
        'juan@email.com',
        'Managua',
        '001-000000-0000A'
    );

SHOW CREATE TABLE roles;

SHOW CREATE TABLE marcas;

SHOW CREATE TABLE productos;

SELECT v.*, CONCAT(c.nombres, " ", c.apellidos) cliente, c.telefono, u.nombre usuario
FROM
    ventas v
    INNER JOIN clientes c ON c.id = v.cliente_id
    INNER JOIN usuarios u ON u.id = v.usuario_id
WHERE
    v.id = 28;

SELECT * FROM roles;