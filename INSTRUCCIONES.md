# 🍲 La Paila de Mi Abuela — Guía de Instalación con XAMPP

## Estructura del proyecto

```
paila/
├── login.html
├── index.html
├── admin.html
├── database.sql          ← importar en phpMyAdmin
├── css/style.css
├── js/
│   ├── data.js
│   ├── utils.js
│   ├── cart.js
│   └── api.js            ← conecta frontend con PHP
├── php/
│   └── config.php        ← configuración BD
├── api/
│   ├── auth.php          ← login / registro / sesión
│   ├── platos.php        ← menú
│   ├── pedidos.php       ← pedidos
│   ├── reservas.php      ← reservas
│   ├── resenas.php       ← reseñas
│   ├── newsletter.php    ← suscripciones
│   └── promociones.php   ← promos
└── *.jpg / *.png         ← imágenes
```

---

## Paso 1 — Instalar XAMPP

1. Descarga XAMPP desde https://www.apachefriends.org
2. Instálalo y abre el **Panel de Control de XAMPP**
3. Inicia **Apache** y **MySQL** (botón Start en ambos)

---

## Paso 2 — Copiar el proyecto

1. Copia la carpeta `paila/` completa dentro de:
   - **Windows:** `C:\xampp\htdocs\paila\`
   - **Mac/Linux:** `/opt/lampp/htdocs/paila/`

---

## Paso 3 — Crear la base de datos

1. Abre tu navegador y ve a: http://localhost/phpmyadmin
2. Haz clic en **"Nueva"** (panel izquierdo)
3. Escribe el nombre: `paila_db` → clic en **Crear**
4. Selecciona `paila_db` en el panel izquierdo
5. Haz clic en la pestaña **"Importar"**
6. Haz clic en **"Seleccionar archivo"** y elige `database.sql`
7. Clic en **"Continuar"** (o Ejecutar)
8. ✅ Verás las tablas creadas con datos de prueba

---

## Paso 4 — Verificar configuración

Abre `php/config.php` y confirma:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');   // usuario por defecto XAMPP
define('DB_PASS', '');       // contraseña vacía por defecto
define('DB_NAME', 'paila_db');
```

> Si pusiste contraseña a MySQL, cámbiala en `DB_PASS`.

---

## Paso 5 — Abrir el sitio

En tu navegador ve a:

```
http://localhost/paila/login.html
```

### Credenciales de acceso:

| Tipo          | Correo              | Contraseña  |
|---------------|---------------------|-------------|
| 👤 Cliente   | cliente@paila.co    | cliente123  |
| 🔑 Admin     | admin@paila.co      | admin2024   |

---

## Flujo completo del sistema

```
login.html
   ├── (cliente)  → index.html  ← carga menú desde BD
   │                            ← guarda reseñas en BD
   │                            ← reservas → BD → WhatsApp
   │                            ← pedidos  → BD → WhatsApp
   │
   └── (admin)   → admin.html  ← dashboard con stats de BD
                               ← gestión de pedidos en tiempo real
                               ← CRUD menú, reservas, promos, reseñas
```

---

## Tablas de la base de datos

| Tabla           | Descripción                        |
|-----------------|------------------------------------|
| `usuarios`      | Clientes y administradores         |
| `categorias`    | Categorías del menú                |
| `platos`        | Platos del menú con precios        |
| `pedidos`       | Cabecera de cada pedido            |
| `pedido_items`  | Ítems de cada pedido               |
| `reservas`      | Reservas de mesas                  |
| `resenas`       | Reseñas de clientes                |
| `promociones`   | Combos y promociones               |
| `newsletter`    | Suscriptores                       |
| `sesiones`      | Sesiones PHP (opcional)            |

### Vistas útiles (consultas rápidas):
- `vista_pedidos` — pedidos con ítems resumidos
- `vista_platos`  — platos con categoría
- `vista_stats_dia` — estadísticas del día actual

---

## APIs disponibles

Todas responden JSON `{ ok: true, data: ... }` o `{ ok: false, error: "..." }`

```
GET  api/platos.php?action=list&cat=mar&q=encocado&sort=asc
GET  api/platos.php?action=get&id=4
POST api/auth.php?action=login        { email, password }
POST api/auth.php?action=register     { nombre, email, password, telefono }
POST api/pedidos.php?action=create    { nombre_cliente, telefono, items:[{plato_id,cantidad}] }
GET  api/pedidos.php?action=stats     (admin)
POST api/reservas.php?action=create   { nombre, fecha, hora, personas }
POST api/resenas.php?action=create    { nombre, texto, estrellas }
POST api/newsletter.php?action=subscribe { email }
GET  api/promociones.php?action=list
```

---

## Notas importantes

- El sitio **debe correr desde XAMPP** (localhost), no como archivo local
- Las contraseñas en la BD están hasheadas con **bcrypt**
- Para producción, cambia `DB_USER` y `DB_PASS` y activa HTTPS
- El carrito sigue usando `localStorage` para agilidad; el pedido final se guarda en BD via `api/pedidos.php`

---

*Proyecto Final — Ingeniería de Software · David Hinestroza · 2025*
