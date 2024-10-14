# Proyecto de Gestión de Posts Backend

Este proyecto es un sistema de gestión de posts desarrollado con Laravel 10 en el backend y Vue.js en el frontend, utilizando autenticación basada en tokens con Sanctum.

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalados:

- PHP (>= 8.1)
- Composer
- MySQL o MariaDB
- Node.js y npm (para el frontend)

## Instalación

1. **Clona el repositorio:**

   ```bash
   git clone https://github.com/tu_usuario/tu_repositorio.git
   cd tu_repositorio 
   ```

    Instala las dependencias del backend:
 


2. **Instala las dependencias del backend:**

 ```bash
composer install
```

3. **Configura el archivo .env:**

 ```bash
Copia el archivo .env.example a .env y configura la conexión a la base de datos:

cp .env.example .env

Luego, edita las variables según tu entorno.
```

4. **Genera la clave de la aplicación:**
 ```bash
php artisan key:generate
```

5. **Ejecuta las migraciones:**
 ```bash
php artisan migrate --seed
```
6. **Esto creará las tablas necesarias y poblará la base de datos con datos de prueba.**

Inicia el servidor de desarrollo:
 ```bash
php artisan serve
```

7. **Instala las dependencias del frontend:**

Ve al directorio del frontend (si es un repositorio separado):

```bash
cd frontend
npm install
```
8. **Inicia el servidor del frontend:**

```bash
npm run serve
```

API

Rutas Públicas

    GET /api/posts: Obtener todos los posts.
    GET /api/posts/{post}: Obtener un post específico.
    GET /api/users/{id}/posts: Obtener posts de un usuario específico.

Rutas Protegidas (requiere autenticación)

    POST /api/posts: Crear un nuevo post.
    PUT /api/posts/{post}: Modificar un post existente.
    DELETE /api/posts/{post}: Eliminar un post.

Rutas de Autenticación

    POST /api/register: Registrar un nuevo usuario.
    POST /api/login: Iniciar sesión.
    GET /api/logout: Cerrar sesión.

Rutas de Administración (requiere rol de admin)

    GET /api/admin/users: Obtener todos los usuarios.
    POST /api/admin/users: Crear un nuevo usuario.
    GET /api/admin/users/{user}: Obtener un usuario específico.
    PUT /api/admin/users/{user}: Modificar un usuario existente.
    DELETE /api/admin/users/{user}: Eliminar un usuario.

Migraciones

Las migraciones para las tablas users y posts, junto con la gestión de permisos, se encuentran en la carpeta database/migrations. Asegúrate de ejecutar las migraciones después de configurar tu base de datos.
Factories

Las factories para los modelos User y Post se encuentran en database/factories. Se utilizan para generar datos de prueba durante el desarrollo.
