# Librería PHP

Una aplicación web simple en PHP para gestionar categorías y sitios (enlaces). Permite crear, editar, eliminar y listar categorías y sitios web.

## Características

- Gestión de categorías
- Gestión de sitios web (enlaces)
- Interfaz web simple
- Base de datos MySQL
- Arquitectura MVC básica

## Requisitos

- PHP 8.1 o superior
- MySQL
- Composer

## Instalación

1. Clona el repositorio:
   ```
   git clone https://github.com/tu-usuario/libreria-php.git
   cd libreria-php
   ```

2. Instala las dependencias con Composer:
   ```
   composer install
   ```

3. Crea la base de datos MySQL llamada `libreria`.

4. Configura la conexión a la base de datos en `config/config.php` si es necesario.

5. Ejecuta el servidor web apuntando al directorio `public/` (por ejemplo, con Apache o Nginx).

   Si usas Laragon (como parece en tu setup), simplemente abre el proyecto en Laragon.

## Uso

- Accede a `http://localhost/git/libreria-PHP/public/` para ver la página principal.
- Desde ahí puedes navegar a las secciones de categorías y sitios.

## Estructura del Proyecto

```
libreria-PHP/
├── app/
│   ├── Controllers/
│   │   ├── CategoryController.php
│   │   ├── HomeController.php
│   │   └── SiteController.php
│   └── Models/
│       ├── Category.php
│       └── Site.php
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── categories.js
│       └── landing.js
├── config/
│   ├── config.php
│   └── database.php
├── public/
│   └── index.php
├── vendor/
├── Views/
│   ├── 404.php
│   ├── add.php
│   ├── footer.php
│   ├── header.php
│   ├── home.php
│   └── categories/
│       ├── add.php
│       ├── index.php
│       └── show.php
└── composer.json
```

## Tecnologías Utilizadas

- PHP (con PSR-4 autoloading)
- MySQL
- HTML/CSS/JavaScript
- Composer

## Autor

Jeison Ramirez - ramirezjeisonandres@gmail.com