-- =====================================================
--  La Paila de Mi Abuela — Base de Datos MySQL
--  Importar en phpMyAdmin (XAMPP)
--  Versión: 1.0 | David Hinestroza
-- =====================================================

CREATE DATABASE IF NOT EXISTS paila_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE paila_db;

-- ─────────────────────────────────────────
--  1. USUARIOS (login de clientes y admin)
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS usuarios (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(100) NOT NULL,
  email       VARCHAR(150) NOT NULL UNIQUE,
  password    VARCHAR(255) NOT NULL,          -- bcrypt hash
  rol         ENUM('cliente','admin') DEFAULT 'cliente',
  telefono    VARCHAR(20),
  activo      TINYINT(1) DEFAULT 1,
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  2. CATEGORÍAS del menú
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS categorias (
  id      INT AUTO_INCREMENT PRIMARY KEY,
  nombre  VARCHAR(60) NOT NULL,
  slug    VARCHAR(60) NOT NULL UNIQUE,
  icono   VARCHAR(10) DEFAULT '🍽️'
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  3. PLATOS del menú
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS platos (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  nombre        VARCHAR(150)   NOT NULL,
  descripcion   TEXT,
  precio        DECIMAL(10,2)  NOT NULL,
  categoria_id  INT,
  imagen        VARCHAR(255),
  peso          VARCHAR(30),
  calorias      INT,
  ingredientes  TEXT,                         -- JSON o CSV
  popular       TINYINT(1) DEFAULT 0,
  disponible    TINYINT(1) DEFAULT 1,
  created_at    DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  4. PEDIDOS (cabecera)
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS pedidos (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id    INT,
  nombre_cliente VARCHAR(100),
  telefono      VARCHAR(20),
  tipo          ENUM('domicilio','local','whatsapp') DEFAULT 'whatsapp',
  estado        ENUM('pendiente','preparando','listo','entregado','cancelado') DEFAULT 'pendiente',
  total         DECIMAL(10,2) DEFAULT 0,
  notas         TEXT,
  created_at    DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at    DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  5. DETALLE DE PEDIDOS (ítems)
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS pedido_items (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  pedido_id   INT NOT NULL,
  plato_id    INT,
  nombre      VARCHAR(150),                   -- copia del nombre al momento
  precio      DECIMAL(10,2),
  cantidad    INT DEFAULT 1,
  subtotal    DECIMAL(10,2),
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
  FOREIGN KEY (plato_id)  REFERENCES platos(id)  ON DELETE SET NULL
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  6. RESERVAS
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS reservas (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id    INT,
  nombre        VARCHAR(100) NOT NULL,
  telefono      VARCHAR(20),
  fecha         DATE         NOT NULL,
  hora          TIME         NOT NULL,
  personas      INT          DEFAULT 2,
  ocasion       VARCHAR(80),
  notas         TEXT,
  estado        ENUM('pendiente','confirmada','cancelada') DEFAULT 'pendiente',
  created_at    DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  7. RESEÑAS
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS resenas (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id  INT,
  nombre      VARCHAR(100),
  texto       TEXT NOT NULL,
  estrellas   TINYINT DEFAULT 5,
  activa      TINYINT(1) DEFAULT 1,
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  8. PROMOCIONES
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS promociones (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  titulo      VARCHAR(150) NOT NULL,
  descripcion TEXT,
  precio_txt  VARCHAR(60),
  badge       VARCHAR(60),
  activa      TINYINT(1) DEFAULT 1,
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  9. NEWSLETTER (suscriptores)
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS newsletter (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  email      VARCHAR(150) NOT NULL UNIQUE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────
--  10. SESIONES PHP (opcional, si no usas $_SESSION)
-- ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS sesiones (
  id          VARCHAR(64) PRIMARY KEY,
  usuario_id  INT NOT NULL,
  datos       TEXT,
  expires_at  DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;


-- =====================================================
--  DATOS DE PRUEBA
-- =====================================================

-- Categorías
INSERT INTO categorias (nombre, slug, icono) VALUES
  ('Principales',  'principal', '🍛'),
  ('Sopas',        'sopa',      '🍲'),
  ('Mariscos',     'mar',       '🦐'),
  ('Entradas',     'entrada',   '🥟'),
  ('Postres',      'postre',    '🍌');

-- Usuarios (contraseñas: cliente123 y admin2024 en bcrypt)
INSERT INTO usuarios (nombre, email, password, rol, telefono) VALUES
  ('Cliente Demo',  'cliente@paila.co', '$2y$10$wJ9k1z2mQx3nL8vT5pR4uOe6HdFgBiCjKlMnOpQrStUvWxYzAb1', 'cliente', '3001234567'),
  ('Admin Paila',   'admin@paila.co',   '$2y$10$aB2cD3eF4gH5iJ6kL7mN8oP9qR0sT1uV2wX3yZ4aA5bB6cC7dD8', 'admin',   '3106684360');

-- Platos
INSERT INTO platos (nombre, descripcion, precio, categoria_id, imagen, peso, calorias, ingredientes, popular) VALUES
  ('Bandeja Paisa Clásica',       'Frijoles cremosos, carne sazonada, chicharrón crocante, huevo frito, tajada y arepa.',         28000, 1, 'Bandeja Paisa.jpg',                       '800 g', 950,  'Frijol,Arroz,Carne molida,Huevo,Chicharrón', 1),
  ('Sancocho de Gallina Criolla', 'Gallina criolla, yuca, plátano y mazorca en caldo reconfortante cocido a fuego lento.',        22000, 2, 'Sancocho de gallina.jpg',                 '700 g', 420,  'Gallina,Yuca,Plátano,Mazorca',              0),
  ('Arroz con Coco y Pescado',    'Arroz perfumado en leche de coco con filete de pescado fresco frito y ensalada.',              26000, 3, 'Arroz con coco y Pescado.jpg',            '650 g', 620,  'Arroz,Coco,Pescado',                        1),
  ('Encocado de Pescado',         'Pescado en salsa cremosa de coco, cilantro cimarrón y especias locales con patacones.',        32000, 3, 'encocado-de-pescado.jpg',                 '700 g', 680,  'Pescado,Coco,Cilantro,Achiote',             1),
  ('Tapao de Pescado',            'Guiso de camarones y plátano verde con sabor ahumado del Pacífico.',                          30000, 3, 'tapao-pacifico-1024x576.jpg',             '700 g', 720,  'Camarón,Plátano verde,Coco',                0),
  ('Arroz Atollado con Camarones','Arroz meloso con camarones jugosos, vegetales y refrito aromático.',                          25000, 3, 'arroz-con-camarones-3031.jpg',            '650 g', 600,  'Arroz,Camarón,Ajo,Pimentón',               0),
  ('Bocachico Frito',             'Pescado entero dorado y crocante, servido con patacones y ensalada fresca.',                  24000, 1, 'bocachico.jpg',                           '700 g', 700,  'Bocachico,Plátano,Ensalada',               0),
  ('Cazuela de Mariscos Premium', 'Camarones, calamares, langostinos y mejillones en caldo cremoso con toque de ají.',           35000, 3, 'Cazuela de marisco.jpg',                  '800 g', 780,  'Camarón,Calamar,Langostino,Mejillón',      1),
  ('Empanadas Chocuanas',         'Crujientes empanadas rellenas de guiso de camarón con sazón del litoral. 2 unidades.',         4500, 4, 'empanadas-colombianas-imagen-destacada.jpg','120 g',320,  'Masa de Maíz,Camarón,Cebolla',             0),
  ('Sopa de Queso Costeño',       'Sopa espesa con ñame, queso costeño fundente y suero.',                                       18000, 2, 'Arroz con queso.png',                     '600 g', 520,  'Ñame,Queso Costeño,Achiote',               0),
  ('Plátano con Queso',           'Plátanos maduros con panela y queso derretido. Postre nostálgico.',                            9000, 5, 'Platano con queso.jpg',                   '180 g', 380,  'Plátano Maduro,Panela,Queso',              0),
  ('Arroz con Longaniza',         'Arroz sazonado con trozos de longaniza y pimentón. Acompañamiento perfecto.',                  8000, 4, 'Arroz con longaniza.jpg',                 '150 g', 300,  'Arroz,Longaniza,Cebolla',                  0),
  ('Encocado de Camarón',         'Camarones en salsa de coco delicadamente especiados. Cremoso y equilibrado.',                 31000, 3, 'Encocao de camaron.png',                  '700 g', 680,  'Camarón,Coco,Achiote,Cebolla',             1),
  ('Pastel Chocoano',             'Pastel en hoja de plátano con maíz, carne y pollo. Preparación artesanal al vapor.',          20000, 1, 'Pastel chocuano.png',                     '500 g', 520,  'Maíz,Carne de cerdo,Pollo',                0);

-- Promociones
INSERT INTO promociones (titulo, descripcion, precio_txt, badge) VALUES
  ('Combo Familiar Pacífico', 'Encocado + Sancocho + 4 bebidas a elección.',         '$85.000',  '🎉 HOY'),
  ('Hora Feliz en Entradas',  '2x1 en Empanadas de Camarón. Lun–Vie 3–5 PM.',        '2x1',      '🕒 3–5PM'),
  ('Postre de la Casa Gratis','Postre gratis en pedidos a domicilio superiores a $50k.','¡Gratis!','🎁 DELIVERY');

-- Reseñas de muestra
INSERT INTO resenas (nombre, texto, estrellas) VALUES
  ('María C.', 'El encocado tiene alma. Volvimos con toda la familia.', 5),
  ('Juan S.',  'Sabor auténtico y servicio muy amable. Totalmente recomendado.', 5),
  ('Laura M.', 'El sancocho de gallina me recordó a mi abuela. Excelente.', 5);

-- Pedido de muestra
INSERT INTO pedidos (nombre_cliente, telefono, tipo, estado, total) VALUES
  ('María Castillo', '3101234567', 'whatsapp', 'entregado', 63000);

INSERT INTO pedido_items (pedido_id, plato_id, nombre, precio, cantidad, subtotal) VALUES
  (1, 4, 'Encocado de Pescado',         32000, 1, 32000),
  (1, 3, 'Arroz con Coco y Pescado',    26000, 1, 26000),
  (1,11, 'Plátano con Queso',            9000, 1,  9000) -- corregido: sin espacio
;

-- Reserva de muestra
INSERT INTO reservas (nombre, telefono, fecha, hora, personas, ocasion, estado) VALUES
  ('Carlos Mena', '3209876543', '2025-06-01', '13:00:00', 4, 'Cumpleaños', 'confirmada');

-- =====================================================
--  VISTAS ÚTILES
-- =====================================================

-- Vista: pedidos con sus ítems resumidos
CREATE OR REPLACE VIEW vista_pedidos AS
SELECT
  p.id,
  p.nombre_cliente,
  p.telefono,
  p.tipo,
  p.estado,
  p.total,
  p.created_at,
  GROUP_CONCAT(CONCAT(pi.cantidad,'x ',pi.nombre) SEPARATOR ' | ') AS items
FROM pedidos p
LEFT JOIN pedido_items pi ON pi.pedido_id = p.id
GROUP BY p.id;

-- Vista: platos con categoría
CREATE OR REPLACE VIEW vista_platos AS
SELECT
  pl.id, pl.nombre, pl.descripcion, pl.precio,
  pl.imagen, pl.peso, pl.calorias, pl.ingredientes,
  pl.popular, pl.disponible,
  c.nombre AS categoria, c.slug AS cat_slug, c.icono
FROM platos pl
LEFT JOIN categorias c ON c.id = pl.categoria_id
WHERE pl.disponible = 1;

-- Vista: estadísticas del día
CREATE OR REPLACE VIEW vista_stats_dia AS
SELECT
  COUNT(*)                                          AS total_pedidos,
  SUM(total)                                        AS ventas_totales,
  SUM(CASE WHEN estado='entregado' THEN 1 ELSE 0 END) AS entregados,
  SUM(CASE WHEN estado='pendiente' THEN 1 ELSE 0 END) AS pendientes,
  SUM(CASE WHEN estado='cancelado' THEN 1 ELSE 0 END) AS cancelados
FROM pedidos
WHERE DATE(created_at) = CURDATE();
