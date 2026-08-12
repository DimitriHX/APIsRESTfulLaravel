# API RESTful y Menú Digital - Restaurante "La Buena Mesa"

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-24.x-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15.x-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)
![Architecture](https://img.shields.io/badge/Architecture-Service--Repository-purple?style=for-the-badge)

API RESTful profesional y sistema de administración en tiempo real desarrollado para el restaurante gastronómico "La Buena Mesa", utilizando Laravel, Eloquent ORM, Arquitectura Limpia (Service-Repository Pattern / Principios SOLID) y orquestación con Docker (PHP 8.3 FPM, Nginx y PostgreSQL 15).

---

## 1. Arquitectura de Software y Principios SOLID

El proyecto evita controladores sobrecargados ("Fat Controllers") separando responsabilidades en capas independientes:

```
[ HTTP Request ] -> [ Route (api.php) ] -> [ Form Request Validation ] 
                                                   |
[ HTTP Response ] <- [ API Resource ] <- [ Controller ] <- [ Service Layer ] <- [ Repository Interface ] <- [ Eloquent Repository ] <- [ PostgreSQL ]
```

### Aplicación de Principios SOLID

- **S (Responsabilidad Única)**: StoreMenuItemRequest solo valida entradas; MenuItemController solo coordina peticiones HTTP; MenuItemService procesa lógica de negocio; MenuItemRepository maneja la persistencia de datos.
- **O (Abierto/Cerrado)**: Los repositorios permiten cambiar el origen de datos (ejemplo: Redis, MongoDB) sin modificar la capa de servicios.
- **L (Sustitución de Liskov)**: MenuItemRepository puede ser sustituido por cualquier implementación de MenuItemRepositoryInterface sin alterar el comportamiento esperado.
- **I (Segregación de Interfaces)**: Interfaces delgadas enfocadas exclusivamente en la entidad del menú.
- **D (Inversión de Dependencias)**: Los controladores y servicios dependen de la abstracción MenuItemRepositoryInterface, no de una clase concreta de Eloquent.

---

## 2. Instrucciones de Instalación y Despliegue con Docker

### Requisitos Previos
- Docker Engine y Docker Compose (docker compose).

### Pasos de Despliegue

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio>
cd apirestfulLaravel

# 2. Levantar los contenedores Docker en segundo plano
docker compose -f Docker-Laravel.yml up -d

# 3. Instalar dependencias PHP de Laravel
docker compose -f Docker-Laravel.yml exec app composer install --no-security-blocking

# 4. Generar la clave secreta de la aplicación
docker compose -f Docker-Laravel.yml exec app php artisan key:generate

# 5. Configurar permisos de almacenamiento y caché
docker compose -f Docker-Laravel.yml exec app sh -c "mkdir -p storage/app storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && chmod -R 777 storage bootstrap/cache"

# 6. Ejecutar migraciones y poblar la base de datos (Seeder con 21 platillos)
docker compose -f Docker-Laravel.yml exec app php artisan migrate:fresh --seed
```

---

## 3. Endpoints de la API REST

**Base URL**: `http://localhost:8000/api/menu-items`  
**Panel Web Interactivo**: `http://localhost:8000/menu`

| Método | Endpoint | Descripción | Parámetros / Body | Status HTTP |
| :---: | :--- | :--- | :--- | :---: |
| GET | `/api/menu-items` | Listar todos los 21 platillos del menú | N/A | 200 OK |
| GET | `/api/menu-items/{id}` | Obtener un platillo por su ID | id (entero en URL) | 200 OK / 404 |
| POST | `/api/menu-items` | Crear un nuevo platillo | JSON Body: name, description, price, category, is_available | 201 Created |
| PUT | `/api/menu-items/{id}` | Actualizar un platillo existente | JSON Body: campos a actualizar | 200 OK / 404 |
| DELETE | `/api/menu-items/{id}` | Eliminar un platillo por su ID | id (entero en URL) | 200 OK / 404 |
| GET | `/api/menu-items/category/{category}` | Filtrar por categoría (Entrada, Plato Fuerte, Postre, Bebida) | category (string en URL) | 200 OK |

---

## 4. Ejemplos de Uso de la API (cURL)

### Listar todos los platillos (GET)
```bash
curl -X GET -H "Accept: application/json" http://localhost:8000/api/menu-items
```

### Consultar platillo por ID (GET)
```bash
curl -X GET -H "Accept: application/json" http://localhost:8000/api/menu-items/1
```

### Filtrar platillos por categoría (GET)
```bash
curl -X GET -H "Accept: application/json" "http://localhost:8000/api/menu-items/category/Plato%20Fuerte"
```

### Crear un nuevo platillo (POST)
```bash
curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" \
  -d '{
    "name": "Tacos de Atún Encantado",
    "description": "Atún aleta amarilla sellado al ajonjolí con guacamole y tortilla de maíz morado.",
    "price": 16.50,
    "category": "Entrada",
    "is_available": true
  }' \
  http://localhost:8000/api/menu-items
```

### Actualizar platillo existente (PUT)
```bash
curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" \
  -d '{
    "price": 17.50,
    "is_available": true
  }' \
  http://localhost:8000/api/menu-items/1
```

### Eliminar platillo (DELETE)
```bash
curl -X DELETE -H "Accept: application/json" http://localhost:8000/api/menu-items/1
```

---

## 5. Estructura Completa del Proyecto

```
apirestfulLaravel/
├── Docker-Laravel.yml                        # Orquestador Docker (PHP 8.3, Nginx, Postgres 15)
├── nginx/
│   └── default.conf                          # Configuración de Nginx Proxy para PHP-FPM
├── laravel/
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Api/MenuItemController.php # Controlador REST slim
│   │   │   │   ├── MenuViewController.php     # Controlador de interfaz Web
│   │   │   │   └── Controller.php             # Clase Base Controller
│   │   │   ├── Requests/
│   │   │   │   ├── StoreMenuItemRequest.php   # Validación para creación
│   │   │   │   └── UpdateMenuItemRequest.php  # Validación para actualización
│   │   │   └── Resources/
│   │   │       └── MenuItemResource.php       # Transformador JSON de la API
│   │   ├── Models/
│   │   │   └── MenuItem.php                   # Modelo Eloquent
│   │   ├── Providers/
│   │   │   └── AppServiceProvider.php         # Binding de Interfaces a Repositorios
│   │   ├── Repositories/
│   │   │   ├── Interfaces/
│   │   │   │   └── MenuItemRepositoryInterface.php # Contrato del Repositorio
│   │   │   └── Eloquent/
│   │   │       └── MenuItemRepository.php     # Implementación Eloquent
│   │   └── Services/
│   │       └── MenuItemService.php            # Capa de Lógica de Negocio
│   ├── bootstrap/
│   │   ├── app.php                            # Bootstrap de Laravel 11
│   │   └── providers.php                      # Registro de Providers
│   ├── database/
│   │   ├── migrations/
│   │   │   └── 2026_01_01_000000_create_menu_items_table.php
│   │   └── seeders/
│   │       ├── DatabaseSeeder.php
│   │       └── MenuItemSeeder.php            # Seeder con 21 platillos gastronómicos
│   ├── resources/
│   │   └── views/
│   │       ├── layout.blade.php               # Layout principal (Bebas/Oswald/Montserrat + Footbar)
│   │       └── menu/
│   │           └── index.blade.php            # Dashboard en 2 columnas con probador API
│   ├── routes/
│   │   ├── api.php                            # Endpoints REST /api/menu-items
│   │   └── web.php                            # Ruta principal /menu
│   ├── .env                                   # Configuración de producción/desarrollo
│   ├── .env.example                           # Plantilla de variables de entorno
│   ├── composer.json                          # Dependencias del proyecto
│   └── artisan                                # CLI de Laravel
└── README.md                                 # Documentación principal del repositorio
```

---

© 2026 Restaurante "La Buena Mesa" - API RESTful Kodigo 2026
