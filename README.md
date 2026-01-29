# Gatexport - Catalogo de Productos

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-FF69B4?style=flat-square&logo=livewire&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=flat-square&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)

Sistema de catálogo de productos con panel de administración, integración con HubSpot para gestión de leads y blog.

## Requisitos

- PHP 8.4+
- MySQL 8.0+
- Node.js 18+
- Composer
- pnpm

## Instalación

```bash
# Clonar el repositorio
git clone <repository-url>
cd gatexport

# Instalar dependencias de PHP
composer install

# Instalar dependencias de Node
pnpm install

# Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Compilar assets
pnpm run build

# Iniciar servidor de desarrollo
php artisan serve
```

## Scripts de Utilidad

### Backup de Base de Datos
```bash
./backup.sh
```
Genera un backup de la base de datos MySQL con formato `DDMMYYYY_backup.sql` en la carpeta `backups/`.

### Despliegue en Producción
```bash
./bin/deploy.sh
```
Ejecuta las tareas de optimización para producción:
- Migraciones de base de datos
- Limpieza y regeneración de caché
- Reinicio de workers de cola

## Deployment Steps

### Step 1: Enable Maintenance Mode

```bash
php artisan down --secret="your-secret-token"
```

### Step 2: Run Database Migration

```bash
php artisan migrate --force
```

### Step 3: Clear Application Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Step 4: Rebuild Cache (Production)

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 5: Disable Maintenance Mode

```bash
php artisan up
```

## Características

### Sitio Público

#### Header
- Logo de la empresa
- Buscador de productos
- Menú de navegación con sticky header
- Información de contacto (dirección, email, teléfonos)

#### Home Page
- Carousel de imágenes con banners ordenables por posición
- Proveedores
- Descripción de la empresa
- Últimas categorías
- Bloques de productos por subcategoría
- Mapa interactivo de países de envío

#### Catálogo de Productos (PLP)
- Cards de productos con imagen, título y botón de detalle
- Ordenamiento por posición
- Filtrado por categoría/subcategoría

#### Ficha de Producto (PDP)
- Galería de imágenes con carousel
- Badges de promoción
- Breadcrumb de navegación
- Especificaciones técnicas (key-value)
- Productos relacionados
- Formulario de cotización con integración HubSpot
- Botones para compartir en redes sociales

#### Blog
- Integración con HubSpot para obtener artículos
- Vista de listado y artículo individual

#### Páginas Adicionales
- Página de nosotros con catálogo descargable
- FAQs y políticas de la empresa
- Términos y condiciones

### Panel de Administración

#### Configuración General
- Logo y nombre de la empresa
- Descripción corta
- Redes sociales
- Información de contacto
- Proveedores (nombre y logo)
- Etiquetas SEO

#### Gestión de Contenido
- **Categorías**: crear, editar, eliminar, ordenar por posición
- **Subcategorías**: crear, editar, eliminar, ordenar por posición
- **Productos**: crear, editar, eliminar, ordenar por posición, especificaciones
- **Banners**: gestión con ordenamiento por posición
- **Artículos**: gestión de contenido para blog
- **FAQs y Políticas**: gestión de preguntas frecuentes y políticas
- **Catálogos**: gestión de archivos PDF descargables

### Integraciones

#### HubSpot
- Captura de leads desde formularios de cotización
- Gestión de contactos
- Obtención de artículos para blog

URLs de referencia:
- Contacts: `https://app.hubspot.com/contacts/<USER_ID>/objects/0-1/views/all/list`
- Leads: `https://app.hubspot.com/contacts/<USER_ID>/objects/0-3/views/all/board`

## Desarrollo

```bash
# Servidor de desarrollo con hot reload
pnpm run dev

# Formatear código PHP
vendor/bin/pint

# Ejecutar tests
php artisan test
```

## Changelog Reciente

- Ordenamiento de productos por posición en subcategorías
- Integración con HubSpot para leads y contactos
- Sticky header en navegación
- Mejoras en galería de productos y badges de promoción
- Gestión de banners con ordenamiento
- Componente de etiquetas SEO
- Gestión de artículos para blog
- FAQs y políticas de empresa
- Mejoras en versión mobile del menú de navegación
