# HorizonteAzul

HorizonteAzul es una aplicación web desarrollada en **PHP** orientada a la gestión y visualización de viajes turísticos.
El proyecto incluye una zona pública para usuarios y una zona de administración para gestionar usuarios y viajes.

---

## Características principales

### Zona pública

* Página principal con presentación del sitio.
* Registro de usuarios.
* Inicio de sesión.
* Cierre de sesión.
* Visualización de ofertas y viajes disponibles.
* Consulta de información detallada de viajes.

### Zona privada (Administrador)

* Gestión completa de usuarios:

  * Crear usuarios
  * Editar usuarios
  * Eliminar usuarios

* Gestión completa de viajes:

  * Crear viajes
  * Editar viajes
  * Eliminar viajes

* Control de acceso para administradores.

---

## Estructura del proyecto

```text
HorizonteAzul/
│── app/
│   ├── admin/          # Panel de administración
│   ├── assets/         # CSS, JS, imágenes
│   ├── public/         # Parte pública del sitio
│   └── vistas/         # Componentes reutilizables
│
│── sql/
│   ├── conexion.php    # Conexión a la base de datos
│   ├── crearBD.php     # Script creación BD
│   └── crearTablas.php # Script creación tablas
│
└── README.md
```

---

## Instalación y configuración

### Clonar el repositorio

```bash
git clone https://github.com/anacolon04/HorizonteAzul.git
```

### Mover el proyecto al servidor local

Si usas XAMPP:

```text
C:/xampp/htdocs/HorizonteAzul
```

Si usas Laragon:

```text
C:/laragon/www/HorizonteAzul
```

---

### Configurar base de datos

1. Inicia Apache y MySQL.
2. Entra en phpMyAdmin.
3. Ejecuta los archivos de la carpeta `/sql`:

   * `crearBD.php`
   * `crearTablas.php`

O importa manualmente el contenido SQL.

---

### Configurar conexión

Revisa el archivo:

```text
/sql/conexion.php
```

Y ajusta si es necesario:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "horizonteazul";
```

---

## Ejecución

Abre en navegador:

```text
http://localhost/HorizonteAzul/app/public/
```

---

## Archivos principales

### Zona pública

* `index.php`
* `login.php`
* `register.php`
* `ofertas.php`
* `viaje.php`

### Zona administración

* `crud_usuarios.php`
* `crud_viajes.php`
* `insertar_usuario.php`
* `insertar_viaje.php`
* `editar_usuario.php`
* `editar_viaje.php`
* `borrar_usuario.php`
* `borrar_viaje.php`
