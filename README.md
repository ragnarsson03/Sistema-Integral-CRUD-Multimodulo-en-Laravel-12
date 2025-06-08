# Sistema Integral CRUD Multimódulo en Laravel 12

Este proyecto es un sistema web construido con **Laravel 12**, **Vite**, y **AdminLTE** como plantilla de administración.

---

## 🚀 Requisitos

- PHP >= 8.1
- Composer
- Node.js >= 16
- NPM
- PostgreSQL

---

## ⚙️ Instalación

Sigue estos pasos después de clonar el repositorio:

```bash
# Clonar el repositorio
git clone https://github.com/ragnarsson03/Sistema-Integral-CRUD-Multimodulo-en-Laravel-12

# Instalar dependencias PHP
composer install

# Copiar archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Instalar dependencias JS
npm install

# Compilar assets con Vite
npm run build

# Ejecutar migraciones
php artisan migrate
