# CRUD Agenda de Contactos (PHP/MySQL)

Un gestor de contactos básico para practicar la integración de PHP con bases de datos relacionales y el manejo de peticiones asíncronas desde el frontend.

## 🚀 Funcionalidades
- **Gestión completa (CRUD):** Registro, consulta, edición y borrado de contactos.
- **Borrado dinámico:** Eliminación de filas mediante JavaScript/DOM para evitar recargas de página.
- **Seguridad:** Uso de `htmlspecialchars` en la salida de datos para prevenir inyecciones XSS.
- **Arquitectura:** Conexión a DB modularizada y separación de lógica JS en archivos independientes (`mensajes.js`, `acciones.js`).

## 🛠️ Stack
- **Backend:** PHP 8.x
- **Base de Datos:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, JavaScript Vanilla
