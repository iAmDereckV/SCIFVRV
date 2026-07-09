-- Active: 1780330694464@@127.0.0.1@3306@scifvrv
SET FOREIGN_KEY_CHECKS = 0;
-- ? EMPRESA
INSERT INTO
    `configuracion_empresa` (
        nombre_empresa,
        ruc,
        telefono,
        correo,
        direccion,
        slogan,
        logo
    )
VALUES (
        'NOMBRE EMPRESA',
        'RUC',
        '8888-8888',
        'correo@gmail.com',
        'Nicaragua',
        'SLOGAN',
        ''
    );
-- ? ROLES
INSERT INTO
    `roles` (nombre, descripcion, estado)
VALUES (
        'Administrador',
        'Control total del sistema',
        'ACTIVO'
    ),
    (
        'Supervisor',
        'Supervisa operaciones',
        'ACTIVO'
    ),
    (
        'Vendedor',
        'Realiza ventas',
        'ACTIVO'
    ),
    (
        'Consulta',
        'Solo lectura',
        'ACTIVO'
    );
-- ? PERMISOS

INSERT INTO
    `permisos` (codigo, descripcion)
VALUES (
        'dashboard_ver',
        'Ver dashboard'
    ),
    (
        'productos_ver',
        'Ver productos'
    ),
    (
        'productos_crear',
        'Crear productos'
    ),
    (
        'productos_editar',
        'Editar productos'
    ),
    (
        'productos_eliminar',
        'Anular productos'
    ),
    ('marcas_ver', 'Ver marcas'),
    (
        'marcas_crear',
        'Crear marcas'
    ),
    (
        'marcas_editar',
        'Editar marcas'
    ),
    (
        'marcas_eliminar',
        'Anular marcas'
    ),
    (
        'categorias_ver',
        'Ver categorias'
    ),
    (
        'categorias_crear',
        'Crear categorias'
    ),
    (
        'categorias_editar',
        'Editar categorias'
    ),
    (
        'categorias_eliminar',
        'Anular categorias'
    ),
    ('kardex_ver', 'Ver kardex'),
    (
        'clientes_ver',
        'Ver clientes'
    ),
    (
        'clientes_crear',
        'Crear clientes'
    ),
    (
        'clientes_editar',
        'Editar clientes'
    ),
    (
        'clientes_eliminar',
        'Anular clientes'
    ),
    (
        'proveedores_ver',
        'Ver proveedores'
    ),
    (
        'proveedores_crear',
        'Crear proveedores'
    ),
    (
        'proveedores_editar',
        'Editar proveedores'
    ),
    (
        'proveedores_eliminar',
        'Anular proveedores'
    ),
    ('ventas_ver', 'Ver ventas'),
    (
        'ventas_crear',
        'Crear ventas'
    ),
    (
        'ventas_anular',
        'Anular ventas'
    ),
    ('compras_ver', 'Ver compras'),
    (
        'compras_crear',
        'Crear compras'
    ),
    (
        'compras_editar',
        'Editar compras'
    ),
    (
        'compras_anular',
        'Anular compras'
    ),
    ('gastos_ver', 'Ver gastos'),
    (
        'gastos_crear',
        'Crear gastos'
    ),
    (
        'gastos_editar',
        'Editar gastos'
    ),
    (
        'usuarios_eliminar',
        'Anular usuarios'
    ),
    (
        'usuarios_ver',
        'Ver usuarios'
    ),
    (
        'usuarios_crear',
        'Crear usuarios'
    ),
    (
        'usuarios_editar',
        'Editar usuarios'
    ),
    ('roles_ver', 'Ver roles'),
    (
        'roles_editar',
        'Editar roles'
    ),
    ('roles_crear', 'Crear roles'),
    (
        'roles_eliminar',
        'Anular roles'
    ),
    ('backup_ver', 'Ver backup'),
    (
        'backup_generar',
        'Generar backup'
    ),
    (
        'backup_restaurar',
        'Restaurar backup'
    ),
    (
        'backup_reiniciar',
        'Reiniciar backup'
    ),
    (
        'backup_eliminar',
        'Eliminar Backup'
    ),
    (
        'empresa_configurar',
        'Configurar empresa'
    ),
    (
        'bitacora_ver',
        'Ver bitacora'
    ),
    (
        'excel_exportar',
        'Exportar excel'
    ),
    (
        'reportes_detalle_maestro',
        'Ver reporte detalle maestro'
    ),
    (
        'reportes_ventas',
        'Ver reportes ventas'
    ),
    (
        'reportes_gastos',
        'Ver reportes gastos'
    ),
    (
        'reportes_compras',
        'Ver reportes compras'
    );

-- ? ROL_PERMISOS
INSERT INTO
    `rol_permisos` (rol_id, permiso_id)
SELECT 1, id
FROM permisos;

INSERT INTO
    `rol_permisos` (rol_id, permiso_id)
VALUES (2, 1),
    (3, 1),
    (4, 1);
-- ? USUARIOS

INSERT INTO
    `usuarios` (
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
        '$2y$10$7HwIDR5f5K1WUzoWgGVsX.Cne1VLYzp9TLAf7/HXjFLk0dHMGozAe',
        'ACTIVO'
    );

ALTER TABLE usuarios AUTO_INCREMENT = 2;

SET FOREIGN_KEY_CHECKS = 1;