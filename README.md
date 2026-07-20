# SCIFVRV

### Sistema de Control de Inventario y Facturación para Venta de Repuestos de Vehículos

SCIFVRV es una aplicación web desarrollada en **PHP** y **MySQL** orientada a la gestión integral de un negocio de venta de repuestos para vehículos. El sistema permite administrar inventario, compras, ventas, clientes, proveedores, gastos y generar reportes administrativos.

---

# Características

- Inicio de sesión con autenticación.
- Gestión de usuarios y roles.
- Control de permisos por módulo.
- Administración de productos.
- Administración de categorías y marcas.
- Administración de clientes.
- Administración de proveedores.
- Registro de compras.
- Registro de ventas.
- Control automático de inventario.
- Kardex de movimientos.
- Gestión de gastos.
- Dashboard administrativo.
- Reportes en PDF.
- Exportación de información a Excel.
- Sistema de respaldos de base de datos.
- Restauración desde respaldos.
- Instalación automática del sistema.

---

# Tecnologías utilizadas

- PHP 8
- MySQL
- Bootstrap 5
- JavaScript
- jQuery
- DataTables
- Chart.js
- SweetAlert2
- FPDF
- PhpSpreadsheet
- Composer

---

# Estructura del proyecto

```
SCIFVRV
│
├── api
├── app
│   ├── config
│   ├── controllers
│   ├── helpers
│   ├── libraries
│   ├── middleware
│   └── models
│
├── database
│   ├── backup
│   ├── schema.sql
│   ├── seed.sql
│   └── instalar.php
│
├── public
│   ├── assets
│   |   ├── css
│   |   ├── img
│   |   └── js
│   └── uploads
│       |-- empresa
│       |-- factura
│       |-- gastos
│       |-- productos
│       └-- usuarios
|
│
├── storage
│
├── vendor
│
├── view
│
├── composer.json
│
└── index.php
```

---

# Instalación

1. Clonar el repositorio.

```
git clone https://github.com/iAmDereckV/SCIFVRV.git
```

2. Abrir el proyecto en el servidor web.

3. Acceder desde el navegador.

```
http://localhost/SCIFVRV
```

El instalador realizará:

- Creación de la base de datos.
- Ejecución del esquema (schema.sql).
- Inserción de datos iniciales (seed.sql).
- Generación del archivo de configuración.
- Creación del archivo de bloqueo de instalación.

---

# Credenciales iniciales

Usuario:

```
admin
```

Contraseña:

```
admin123
```

> Estas credenciales son generadas por el archivo `seed.sql`.

---

# Funcionalidades principales

## Inventario

- Productos
- Categorías
- Marcas
- Kardex
- Stock mínimo

## Compras

- Registro de compras
- Historial
- Actualización automática del inventario

## Ventas

- Facturación
- Impresión en PDF
- Anulación de facturas
- Actualización automática del inventario

## Administración

- Usuarios
- Roles
- Permisos
- Configuración de empresa

## Reportes

- Maestro detalle
- Exportación a Excel
- Exportación PDF
- Dashboard estadístico

---

# Seguridad

- Contraseñas cifradas mediante `password_hash()`.
- Control de sesiones.
- Middleware de autenticación.
- Middleware de permisos.
- Protección por roles.

---

# Dependencias

Las dependencias del proyecto son administradas mediante Composer.

Instalar:

```
composer install
```

---

# Autor

**Dereck Vivas Vargas**

Sistema de Control de Inventario y Facturación para Venta de Repuestos de Vehículos.

2026
