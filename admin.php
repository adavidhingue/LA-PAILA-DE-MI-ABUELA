<!doctype html>
<html lang="es" data-theme="dark">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Panel Admin — La Paila de Mi Abuela</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--g:#1f6f3a;--g2:#74c476;--gold:#c9983a;--bark:#5a3e23;--bg:#06100a;--sur:rgba(255,255,255,.04);--bdr:rgba(255,255,255,.08);--muted:#8faa98;--text:#eef6ef;--textm:#9fb4a6;--red:#f87171;--sb:220px}
html,body{height:100%;font-family:'DM Sans',sans-serif;color:var(--text);background:var(--bg);-webkit-font-smoothing:antialiased}
img{max-width:100%;display:block}
/* SIDEBAR */
.sidebar{position:fixed;left:0;top:0;bottom:0;width:var(--sb);background:rgba(255,255,255,.025);border-right:1px solid var(--bdr);display:flex;flex-direction:column;z-index:60;transition:transform .3s}
.sb-logo{padding:20px 18px 18px;border-bottom:1px solid var(--bdr)}
.sb-mark{font-size:26px;margin-bottom:5px}
.sb-name{font-family:'Playfair Display',serif;font-size:14px;font-weight:700}
.sb-sub{font-size:10px;color:var(--muted);margin-top:2px}
.sb-nav{flex:1;padding:14px 10px;display:flex;flex-direction:column;gap:3px;overflow-y:auto}
.sb-link{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;font-size:13px;font-weight:500;color:var(--muted);cursor:pointer;border:none;background:none;width:100%;text-align:left;transition:all .18s;text-decoration:none}
.sb-link .ic{font-size:15px;width:18px;text-align:center;flex-shrink:0}
.sb-link:hover{background:rgba(255,255,255,.05);color:var(--text)}
.sb-link.active{background:rgba(31,111,58,.25);color:var(--g2)}
.sb-bottom{padding:12px 10px;border-top:1px solid var(--bdr)}
.sb-out{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;font-size:13px;font-weight:500;color:var(--red);cursor:pointer;border:none;background:none;width:100%;text-align:left;transition:all .18s}
.sb-out:hover{background:rgba(248,113,113,.1)}
/* MAIN */
.main{margin-left:var(--sb);min-height:100vh;display:flex;flex-direction:column}
.topbar{position:sticky;top:0;z-index:50;background:rgba(6,16,10,.92);backdrop-filter:blur(14px);border-bottom:1px solid var(--bdr);padding:0 26px;height:62px;display:flex;align-items:center;justify-content:space-between;gap:14px}
.topbar-title{font-family:'Playfair Display',serif;font-size:19px;font-weight:700}
.topbar-right{display:flex;align-items:center;gap:8px}
.badge-admin{padding:5px 12px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(31,111,58,.2);color:var(--g2);border:1px solid rgba(116,196,118,.2)}
.btn-sm{padding:6px 12px;border-radius:9px;font-size:12px;font-weight:500;cursor:pointer;border:1px solid var(--bdr);background:var(--sur);color:var(--text);transition:all .18s;text-decoration:none;display:inline-block;font-family:'DM Sans',sans-serif}
.btn-sm:hover{background:rgba(255,255,255,.07)}
.btn-sm-g{background:linear-gradient(90deg,var(--g),var(--g2));border-color:transparent;color:#eef6ef;font-weight:600}
.btn-sm-g:hover{opacity:.9}
/* PAGES */
.page{padding:24px;flex:1;display:none}
.page.active{display:block}
/* STAT GRID */
.sgrid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px}
@media(max-width:960px){.sgrid{grid-template-columns:1fr 1fr}}
.scard{background:var(--sur);border:1px solid var(--bdr);border-radius:15px;padding:18px 20px}
.sc-lbl{font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:7px}
.sc-val{font-size:26px;font-weight:700}
.sc-chg{font-size:11px;margin-top:4px}
.up{color:#4ade80}.down{color:#f87171}.neu{color:var(--muted)}
/* CONTENT GRID */
.cg2{display:grid;grid-template-columns:1fr 340px;gap:16px}
@media(max-width:960px){.cg2{grid-template-columns:1fr}}
/* PANEL */
.panel{background:var(--sur);border:1px solid var(--bdr);border-radius:15px;overflow:hidden;margin-bottom:16px}
.panel-hd{padding:14px 18px;border-bottom:1px solid var(--bdr);display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap}
.panel-hd h3{font-size:14px;font-weight:600}
.panel-hd .hint{font-size:11px;color:var(--muted)}
.panel-body{padding:16px 18px}
/* TABLE */
.dt{width:100%;border-collapse:collapse;font-size:13px}
.dt th{color:var(--muted);font-weight:500;padding:7px 10px;text-align:left;border-bottom:1px solid var(--bdr);font-size:10px;text-transform:uppercase;letter-spacing:.4px}
.dt td{padding:11px 10px;border-bottom:1px solid rgba(255,255,255,.04);vertical-align:middle}
.dt tr:last-child td{border-bottom:none}
.dt tr:hover td{background:rgba(255,255,255,.02)}
.dt .price{color:var(--g2);font-weight:700}
/* BADGES */
.badge{padding:3px 9px;border-radius:999px;font-size:11px;font-weight:600;white-space:nowrap}
.b-ok{background:rgba(74,222,128,.12);color:#4ade80}
.b-pend{background:rgba(250,204,21,.12);color:#facc15}
.b-prep{background:rgba(96,165,250,.12);color:#60a5fa}
.b-cancel{background:rgba(248,113,113,.12);color:#f87171}
/* BAR CHART */
.bchart{display:flex;gap:7px;align-items:flex-end;height:80px;margin-top:8px}
.bar{flex:1;border-radius:5px 5px 0 0;background:linear-gradient(180deg,var(--g2),var(--g));opacity:.6;cursor:pointer;transition:opacity .2s;position:relative;min-width:0}
.bar:hover{opacity:1}
.bar-tip{position:absolute;bottom:calc(100%+3px);left:50%;transform:translateX(-50%);background:rgba(0,0,0,.8);color:#fff;font-size:10px;font-weight:700;padding:2px 6px;border-radius:5px;white-space:nowrap;opacity:0;transition:opacity .2s;pointer-events:none}
.bar:hover .bar-tip{opacity:1}
.bchartlbls{display:flex;gap:7px;margin-top:5px}
.bchartlbl{flex:1;text-align:center;font-size:10px;color:var(--muted);min-width:0}
/* QUICK ACTIONS */
.qa{display:grid;grid-template-columns:1fr 1fr;gap:9px}
.qa-btn{padding:13px;border-radius:11px;border:1px solid var(--bdr);background:rgba(255,255,255,.03);cursor:pointer;text-align:center;color:var(--text);font-size:12px;font-weight:500;transition:all .18s;font-family:'DM Sans',sans-serif}
.qa-btn:hover{background:rgba(116,196,118,.1);border-color:rgba(116,196,118,.3);color:var(--g2)}
.qa-ic{font-size:20px;margin-bottom:4px}
/* ACTIVITY */
.act-item{display:flex;gap:11px;padding:11px 0;border-bottom:1px solid rgba(255,255,255,.04)}
.act-item:last-child{border-bottom:none}
.act-av{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,rgba(31,111,58,.5),rgba(116,196,118,.2));display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.act-name{font-size:13px;font-weight:600}
.act-time{font-size:11px;color:var(--muted);margin-top:2px}
.act-price{margin-left:auto;font-size:13px;font-weight:700;color:var(--g2);white-space:nowrap}
/* MENU ADMIN CARDS */
.ma-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:13px}
.ma-card{background:var(--sur);border:1px solid var(--bdr);border-radius:13px;overflow:hidden}
.ma-card img{width:100%;height:120px;object-fit:cover}
.ma-body{padding:11px 13px}
.ma-name{font-weight:700;font-size:13px;margin-bottom:3px}
.ma-price{color:var(--g2);font-weight:700;font-size:13px}
.ma-cat{font-size:11px;color:var(--muted);margin-top:2px;text-transform:capitalize}
.ma-acts{display:flex;gap:6px;margin-top:8px}
.ma-btn{flex:1;padding:6px;border-radius:7px;border:1px solid var(--bdr);background:none;color:var(--text);font-size:11px;cursor:pointer;transition:all .18s;font-family:'DM Sans',sans-serif}
.ma-btn.del:hover{background:rgba(248,113,113,.12);border-color:var(--red);color:var(--red)}
/* RESERVAS */
.res-card{background:var(--sur);border:1px solid var(--bdr);border-radius:13px;padding:14px 18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:10px}
.res-name{font-weight:700;font-size:14px}
.res-det{font-size:12px;color:var(--muted);margin-top:3px;line-height:1.5}
/* FORM */
.af-row{display:grid;grid-template-columns:1fr 1fr;gap:11px;margin-bottom:11px}
@media(max-width:520px){.af-row{grid-template-columns:1fr}}
.af-lbl{font-size:10px;font-weight:600;color:var(--muted);display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:.4px}
.af-inp{width:100%;padding:10px 13px;border-radius:10px;background:rgba(255,255,255,.04);border:1px solid var(--bdr);color:var(--text);font-family:'DM Sans',sans-serif;font-size:13px;outline:none}
.af-inp:focus{border-color:rgba(116,196,118,.45)}
.af-inp::placeholder{color:rgba(255,255,255,.2)}
/* PROGRESS BARS */
.prog-row{margin-bottom:10px}
.prog-hd{display:flex;justify-content:space-between;font-size:13px;margin-bottom:4px}
.prog-bar{height:7px;border-radius:99px;background:rgba(255,255,255,.06)}
.prog-fill{height:100%;border-radius:99px}
/* MODAL */
#modalBg{position:fixed;inset:0;background:rgba(0,0,0,.72);z-index:90;display:none;align-items:center;justify-content:center;padding:18px}
#modalBg.show{display:flex}
.modal-box{background:#0d1c0f;border:1px solid var(--bdr);border-radius:20px;padding:26px;max-width:480px;width:100%;position:relative;max-height:90vh;overflow-y:auto}
.modal-x{position:absolute;top:12px;right:12px;background:rgba(255,255,255,.08);border:none;color:var(--text);width:28px;height:28px;border-radius:50%;cursor:pointer;font-size:14px;transition:background .2s}
.modal-x:hover{background:rgba(255,255,255,.16)}
.modal-title{font-family:'Playfair Display',serif;font-size:19px;font-weight:700;margin-bottom:16px}
/* OVERLAY MOBILE */
#sbOverlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:59}
.mob-sb-btn{display:none;background:none;border:none;color:var(--text);font-size:21px;cursor:pointer;padding:4px}
/* TOAST */
.toast{position:fixed;bottom:22px;left:50%;transform:translateX(-50%) translateY(10px);padding:10px 20px;border-radius:12px;font-size:13px;font-weight:600;opacity:0;transition:all .3s;pointer-events:none;z-index:9999;white-space:nowrap}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.toast.ok{background:rgba(31,111,58,.95);color:#b6f5c8;border:1px solid rgba(116,196,118,.4)}
.toast.error{background:#6b1a1a;color:#ffaaaa;border:1px solid rgba(255,80,80,.3)}
/* RESPONSIVE */
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .mob-sb-btn{display:block}
  #sbOverlay.show{display:block}
  .topbar{padding:0 14px}
  .page{padding:14px}
  .cg2{grid-template-columns:1fr}
}
</style>
</head>
<body>
<script src="js/data.js"></script>
<script>const SESSION = checkSession('admin');</script>

<div id="sbOverlay" onclick="closeSb()"></div>
<div class="toast" id="toast"></div>

<!-- MODAL -->
<div id="modalBg" onclick="if(event.target===this)closeModal()">
  <div class="modal-box"><button class="modal-x" onclick="closeModal()">✕</button><div id="modalContent"></div></div>
</div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sb-logo"><div class="sb-mark">🍲</div><div class="sb-name">La Paila de Mi Abuela</div><div class="sb-sub">Panel Administrativo</div></div>
  <nav class="sb-nav">
    <button class="sb-link active" onclick="go('dashboard',this)"><span class="ic">📊</span>Dashboard</button>
    <button class="sb-link" onclick="go('pedidos',this)"><span class="ic">📋</span>Pedidos</button>
    <button class="sb-link" onclick="go('menu',this)"><span class="ic">🍛</span>Menú</button>
    <button class="sb-link" onclick="go('reservas',this)"><span class="ic">📅</span>Reservas</button>
    <button class="sb-link" onclick="go('clientes',this)"><span class="ic">👥</span>Clientes</button>
    <button class="sb-link" onclick="go('resenas',this)"><span class="ic">💬</span>Reseñas</button>
    <button class="sb-link" onclick="go('promos',this)"><span class="ic">🎁</span>Promociones</button>
    <button class="sb-link" onclick="go('reportes',this)"><span class="ic">📈</span>Reportes</button>
    <a class="sb-link" href="index.html"><span class="ic">🌐</span>Ver Sitio Web</a>
  </nav>
  <div class="sb-bottom">
    <div style="padding:0 12px 10px;font-size:12px;color:var(--muted)" id="adminName">👤 Admin</div>
    <button class="sb-out" onclick="logout()"><span class="ic">🚪</span>Cerrar Sesión</button>
  </div>
</aside>

<!-- MAIN -->
<div class="main">
  <div class="topbar">
    <div style="display:flex;align-items:center;gap:10px">
      <button class="mob-sb-btn" onclick="openSb()">☰</button>
      <div class="topbar-title" id="pageTitle">Dashboard</div>
    </div>
    <div class="topbar-right">
      <span class="badge-admin">👨‍🍳 Admin</span>
      <a href="index.html" class="btn-sm">🌐 Ver sitio</a>
      <button class="btn-sm" onclick="logout()" style="color:var(--red);border-color:rgba(248,113,113,.3)">Salir</button>
    </div>
  </div>

  <!-- ── DASHBOARD ── -->
  <div class="page active" id="page-dashboard">
    <div class="sgrid">
      <div class="scard"><div class="sc-lbl">Pedidos hoy</div><div class="sc-val">34</div><div class="sc-chg up">↑ 12% vs ayer</div></div>
      <div class="scard"><div class="sc-lbl">Ventas del día</div><div class="sc-val" style="color:var(--g2)">$842k</div><div class="sc-chg up">↑ 8% vs ayer</div></div>
      <div class="scard"><div class="sc-lbl">Reservas activas</div><div class="sc-val">7</div><div class="sc-chg neu">→ Igual</div></div>
      <div class="scard"><div class="sc-lbl">Calificación</div><div class="sc-val">4.8 ⭐</div><div class="sc-chg up">↑ 0.1</div></div>
    </div>
    <div class="cg2">
      <div>
        <div class="panel">
          <div class="panel-hd"><h3>Pedidos Recientes</h3><span class="hint">Últimas 2 horas</span></div>
          <div class="panel-body" style="padding:0">
            <table class="dt">
              <thead><tr><th>ID</th><th>Cliente</th><th>Plato</th><th>Total</th><th>Estado</th><th>Acción</th></tr></thead>
              <tbody id="dashOrders"></tbody>
            </table>
          </div>
        </div>
        <div class="panel">
          <div class="panel-hd"><h3>Ventas esta semana</h3><span class="hint" id="weekTotal"></span></div>
          <div class="panel-body"><div class="bchart" id="weekChart"></div><div class="bchartlbls" id="weekLbls"></div></div>
        </div>
      </div>
      <div>
        <div class="panel">
          <div class="panel-hd"><h3>Acciones Rápidas</h3></div>
          <div class="panel-body">
            <div class="qa">
              <button class="qa-btn" onclick="go('menu',getSbLink('menu'));showModal('addPlato')"><div class="qa-ic">➕</div>Nuevo Plato</button>
              <button class="qa-btn" onclick="go('promos',getSbLink('promos'));showModal('newPromo')"><div class="qa-ic">🎁</div>Nueva Promo</button>
              <button class="qa-btn" onclick="showToast('📢 Notificación enviada (demo)','ok')"><div class="qa-ic">📢</div>Notificar</button>
              <button class="qa-btn" onclick="go('reportes',getSbLink('reportes'))"><div class="qa-ic">📈</div>Reportes</button>
            </div>
          </div>
        </div>
        <div class="panel">
          <div class="panel-hd"><h3>Actividad Reciente</h3></div>
          <div class="panel-body" style="padding-top:6px;padding-bottom:6px">
            <div class="act-item"><div class="act-av">🛒</div><div><div class="act-name">Nuevo pedido #1049</div><div class="act-time">Hace 2 min</div></div><div class="act-price">$32k</div></div>
            <div class="act-item"><div class="act-av">📅</div><div><div class="act-name">Reserva confirmada</div><div class="act-time">Hace 18 min · 4 personas</div></div></div>
            <div class="act-item"><div class="act-av">⭐</div><div><div class="act-name">Nueva reseña 5 estrellas</div><div class="act-time">Hace 35 min</div></div></div>
            <div class="act-item"><div class="act-av">✅</div><div><div class="act-name">Pedido #1046 entregado</div><div class="act-time">Hace 50 min</div></div></div>
            <div class="act-item" style="border:none"><div class="act-av">📋</div><div><div class="act-name">Menú actualizado</div><div class="act-time">Hace 1 hora</div></div></div>
          </div>
        </div>
        <div class="panel">
          <div class="panel-hd"><h3>Top Platos del día</h3></div>
          <div class="panel-body" style="padding-top:8px" id="topPlatos"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ── PEDIDOS ── -->
  <div class="page" id="page-pedidos">
    <div class="panel">
      <div class="panel-hd">
        <h3>Gestión de Pedidos</h3>
        <div style="display:flex;gap:8px;flex-wrap:wrap">
          <select class="btn-sm" id="filterStatus" onchange="renderOrders()" style="padding:6px 10px">
            <option value="">Todos</option><option>Pendiente</option><option>Preparando</option><option>Entregado</option><option>Cancelado</option>
          </select>
          <button class="btn-sm btn-sm-g" onclick="showModal('newOrder')">+ Nuevo pedido</button>
        </div>
      </div>
      <div class="panel-body" style="padding:0">
        <table class="dt"><thead><tr><th>ID</th><th>Cliente</th><th>Plato</th><th>Total</th><th>Hora</th><th>Estado</th><th></th></tr></thead><tbody id="ordersTbody"></tbody></table>
      </div>
    </div>
  </div>

  <!-- ── MENÚ ── -->
  <div class="page" id="page-menu">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:10px">
      <h2 style="font-family:'Playfair Display',serif;font-size:19px;font-weight:700">Gestión del Menú</h2>
      <button class="btn-sm btn-sm-g" onclick="showModal('addPlato')">+ Agregar plato</button>
    </div>
    <div class="ma-grid" id="menuAdminGrid"></div>
  </div>

  <!-- ── RESERVAS ── -->
  <div class="page" id="page-reservas">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:10px">
      <h2 style="font-family:'Playfair Display',serif;font-size:19px;font-weight:700">Reservas</h2>
      <button class="btn-sm btn-sm-g" onclick="showModal('newReserva')">+ Nueva reserva</button>
    </div>
    <div id="reservasGrid"></div>
  </div>

  <!-- ── CLIENTES ── -->
  <div class="page" id="page-clientes">
    <div class="panel">
      <div class="panel-hd"><h3>Clientes Registrados</h3><span class="hint">5 clientes</span></div>
      <div class="panel-body" style="padding:0">
        <table class="dt">
          <thead><tr><th>Nombre</th><th>Correo</th><th>Pedidos</th><th>Total gastado</th><th>Último pedido</th></tr></thead>
          <tbody>
            <tr><td>María Castillo</td><td>maria@email.com</td><td>12</td><td class="price">$384.000</td><td>Hoy</td></tr>
            <tr><td>Carlos Mena</td><td>carlos@email.com</td><td>8</td><td class="price">$248.000</td><td>Ayer</td></tr>
            <tr><td>Luisa Pino</td><td>luisa@email.com</td><td>5</td><td class="price">$162.000</td><td>Hace 3 días</td></tr>
            <tr><td>Andrés Reyes</td><td>andres@email.com</td><td>15</td><td class="price">$471.000</td><td>Hoy</td></tr>
            <tr><td>Sofía Hinestroza</td><td>sofia@email.com</td><td>3</td><td class="price">$90.000</td><td>Hace 1 semana</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ── RESEÑAS ── -->
  <div class="page" id="page-resenas">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
      <h2 style="font-family:'Playfair Display',serif;font-size:19px;font-weight:700">Reseñas de Clientes</h2>
      <button class="btn-sm" onclick="clearReviews()">Limpiar demo</button>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:12px" id="adminReviewsGrid"></div>
  </div>

  <!-- ── PROMOS ── -->
  <div class="page" id="page-promos">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:10px">
      <h2 style="font-family:'Playfair Display',serif;font-size:19px;font-weight:700">Promociones</h2>
      <button class="btn-sm btn-sm-g" onclick="showModal('newPromo')">+ Nueva promo</button>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:13px" id="promosGrid"></div>
  </div>

  <!-- ── REPORTES ── -->
  <div class="page" id="page-reportes">
    <h2 style="font-family:'Playfair Display',serif;font-size:19px;font-weight:700;margin-bottom:18px">Reportes y Estadísticas</h2>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
      <div class="panel">
        <div class="panel-hd"><h3>Ventas por Categoría</h3></div>
        <div class="panel-body" id="catReport"></div>
      </div>
      <div class="panel">
        <div class="panel-hd"><h3>Resumen del Mes</h3></div>
        <div class="panel-body" style="font-size:13px;color:var(--textm);line-height:2.1">
          <div>📦 Total pedidos: <strong style="color:var(--text)">847</strong></div>
          <div>💰 Ventas totales: <strong style="color:var(--g2)">$24.650.000</strong></div>
          <div>⭐ Calificación promedio: <strong style="color:var(--text)">4.8</strong></div>
          <div>👥 Clientes nuevos: <strong style="color:var(--text)">38</strong></div>
          <div>🔄 Clientes recurrentes: <strong style="color:var(--text)">203</strong></div>
          <div>🍽️ Plato más pedido: <strong style="color:var(--g2)">Encocado de Camarón</strong></div>
          <div>📅 Día pico: <strong style="color:var(--text)">Sábado</strong></div>
        </div>
      </div>
    </div>
    <div class="panel">
      <div class="panel-hd"><h3>Ventas diarias — últimas 2 semanas</h3></div>
      <div class="panel-body"><div class="bchart" id="bigChart"></div><div class="bchartlbls" id="bigLbls"></div></div>
    </div>
  </div>

</div><!-- /main -->

<script src="js/api.js"></script>
<script src="js/utils.js"></script>
<script>
document.getElementById('adminName').textContent = '👤 ' + (SESSION?.name || 'Admin');

// SIDEBAR
function openSb(){document.getElementById('sidebar').classList.add('open');document.getElementById('sbOverlay').classList.add('show');}
function closeSb(){document.getElementById('sidebar').classList.remove('open');document.getElementById('sbOverlay').classList.remove('show');}
function getSbLink(id){return document.querySelector(`.sb-link[onclick*="${id}"]`);}

// NAVIGATION
const TITLES={dashboard:'Dashboard',pedidos:'Pedidos',menu:'Menú',reservas:'Reservas',clientes:'Clientes',resenas:'Reseñas',promos:'Promociones',reportes:'Reportes'};
function go(id,btn){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.sb-link').forEach(l=>l.classList.remove('active'));
  const page=document.getElementById('page-'+id);
  if(page)page.classList.add('active');
  if(btn)btn.classList.add('active');
  document.getElementById('pageTitle').textContent=TITLES[id]||id;
  closeSb();
  if(id==='menu')renderMenuAdmin();
  if(id==='reservas')renderReservas();
  if(id==='resenas')renderAdminReviews();
  if(id==='promos')renderPromos();
  if(id==='pedidos')renderOrders();
  if(id==='reportes')renderReportes();
}

// MODAL
function showModal(type){
  const c=document.getElementById('modalContent');
  const inp=(id,lbl,ph,type='text',opts)=>`<div style="margin-bottom:11px"><label class="af-lbl">${lbl}</label>${opts?`<select class="af-inp" id="${id}">${opts.map(o=>`<option>${o}</option>`).join('')}</select>`:`<input class="af-inp" id="${id}" type="${type}" placeholder="${ph}">`}</div>`;
  if(type==='addPlato'){
    c.innerHTML=`<div class="modal-title">➕ Agregar Plato</div>
      <div class="af-row">${inp('mNombre','Nombre','Nombre del plato')}${inp('mPrecio','Precio','28000','number')}</div>
      <div class="af-row">${inp('mCat','Categoría','','',[' ','Principal','Sopa','Mariscos','Entrada','Postre'])}${inp('mPeso','Peso aprox.','650 g')}</div>
      <div style="margin-bottom:12px"><label class="af-lbl">Descripción</label><textarea class="af-inp" id="mDesc" rows="3" placeholder="Descripción del plato…" style="resize:vertical"></textarea></div>
      <button class="btn-sm btn-sm-g" style="width:100%;padding:11px;font-size:14px" onclick="savePlato()">Guardar plato</button>`;
  }else if(type==='newOrder'){
    c.innerHTML=`<div class="modal-title">📋 Nuevo Pedido</div>
      <div class="af-row">${inp('oCliente','Cliente','Nombre del cliente')}<div style="margin-bottom:11px"><label class="af-lbl">Plato</label><select class="af-inp" id="oPlato">${PLATOS.map(p=>`<option value="${p.id}">${p.nombre} — $${p.precio.toLocaleString('es-CO')}</option>`).join('')}</select></div></div>
      <button class="btn-sm btn-sm-g" style="width:100%;padding:11px;font-size:14px" onclick="saveOrder()">Registrar pedido</button>`;
  }else if(type==='newReserva'){
    c.innerHTML=`<div class="modal-title">📅 Nueva Reserva</div>
      <div class="af-row">${inp('rnNombre','Nombre','Nombre del cliente')}${inp('rnTel','Teléfono','310...')}</div>
      <div class="af-row">${inp('rnFecha','Fecha','','date')}${inp('rnHora','Hora','','time')}</div>
      ${inp('rnPers','Personas','','',[1,2,3,4,5,6,'Más de 6'])}
      <button class="btn-sm btn-sm-g" style="width:100%;padding:11px;font-size:14px" onclick="saveReserva()">Guardar reserva</button>`;
  }else if(type==='newPromo'){
    c.innerHTML=`<div class="modal-title">🎁 Nueva Promoción</div>
      ${inp('proTitle','Título','Nombre de la promo')}
      <div class="af-row">${inp('proPrice','Precio / Desc.','$85.000 o 2x1')}${inp('proBadge','Badge','🎉 HOY')}</div>
      <div style="margin-bottom:12px"><label class="af-lbl">Descripción</label><textarea class="af-inp" id="proDesc" rows="3" placeholder="Describe la promo…" style="resize:vertical"></textarea></div>
      <button class="btn-sm btn-sm-g" style="width:100%;padding:11px;font-size:14px" onclick="savePromo()">Guardar promo</button>`;
  }
  document.getElementById('modalBg').classList.add('show');
}
function closeModal(){document.getElementById('modalBg').classList.remove('show');}
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeModal();});

// SAVES
function savePlato(){const n=document.getElementById('mNombre')?.value.trim();if(!n){showToast('Escribe el nombre','error');return;}showToast('✓ Plato "'+n+'" guardado (demo)','ok');closeModal();}
function saveOrder(){
  const cl=document.getElementById('oCliente')?.value.trim();if(!cl){showToast('Escribe el cliente','error');return;}
  const p=PLATOS.find(x=>x.id===+document.getElementById('oPlato').value);
  const orders=JSON.parse(localStorage.getItem('lp_orders')||'[]');
  orders.unshift({id:'#'+(1050+orders.length),cliente:cl,plato:p?.nombre||'—',total:p?.precio||0,estado:'Pendiente',hora:new Date().toLocaleTimeString('es-CO',{hour:'2-digit',minute:'2-digit'})});
  localStorage.setItem('lp_orders',JSON.stringify(orders));
  showToast('✓ Pedido registrado','ok');closeModal();renderOrders();
}
function saveReserva(){
  const n=document.getElementById('rnNombre')?.value.trim();if(!n){showToast('Escribe el nombre','error');return;}
  const r=JSON.parse(localStorage.getItem('lp_reservas')||'[]');
  r.unshift({nombre:n,tel:document.getElementById('rnTel').value,fecha:document.getElementById('rnFecha').value,hora:document.getElementById('rnHora').value,personas:document.getElementById('rnPers').value,estado:'Confirmada'});
  localStorage.setItem('lp_reservas',JSON.stringify(r));
  showToast('✓ Reserva guardada','ok');closeModal();renderReservas();
}
function savePromo(){
  const t=document.getElementById('proTitle')?.value.trim();if(!t){showToast('Escribe el título','error');return;}
  const pr=JSON.parse(localStorage.getItem('lp_promos')||'[]');
  pr.unshift({titulo:t,precio:document.getElementById('proPrice').value,badge:document.getElementById('proBadge').value,desc:document.getElementById('proDesc').value});
  localStorage.setItem('lp_promos',JSON.stringify(pr));
  showToast('✓ Promo guardada','ok');closeModal();renderPromos();
}

// ORDERS
const DEMO_ORDERS=[
  {id:'#1048',cliente:'Carlos M.',plato:'Cazuela de Mariscos',total:35000,estado:'Preparando',hora:'9:48 am'},
  {id:'#1047',cliente:'Luisa P.',plato:'Encocado de Camarón',total:31000,estado:'Pendiente',hora:'9:40 am'},
  {id:'#1046',cliente:'Andrés R.',plato:'Bandeja Paisa',total:28000,estado:'Entregado',hora:'9:12 am'},
  {id:'#1045',cliente:'Sofía H.',plato:'Sancocho de Gallina',total:22000,estado:'Entregado',hora:'8:58 am'},
  {id:'#1044',cliente:'Pedro V.',plato:'Tapao de Pescado',total:30000,estado:'Cancelado',hora:'8:30 am'},
];
const BMAP={'Pendiente':'b-pend','Preparando':'b-prep','Entregado':'b-ok','Cancelado':'b-cancel'};
function renderOrders(){
  const f=document.getElementById('filterStatus')?.value||'';
  const stored=JSON.parse(localStorage.getItem('lp_orders')||'[]');
  const all=[...stored,...DEMO_ORDERS];
  const filtered=f?all.filter(o=>o.estado===f):all;
  const html=filtered.map(o=>`<tr>
    <td style="font-weight:700">${o.id}</td><td>${o.cliente}</td><td>${o.plato}</td>
    <td class="price">$${o.total.toLocaleString('es-CO')}</td><td>${o.hora}</td>
    <td><span class="badge ${BMAP[o.estado]||'b-pend'}">${o.estado}</span></td>
    <td>${o.estado!=='Entregado'&&o.estado!=='Cancelado'?`<button class="btn-sm" style="font-size:11px;padding:3px 8px" onclick="markDone(this)">✓ Listo</button>`:'—'}</td>
  </tr>`).join('');
  document.getElementById('ordersTbody').innerHTML=html||'<tr><td colspan="7" style="text-align:center;color:var(--muted);padding:20px">No hay pedidos</td></tr>';
  // también en dashboard
  const db=document.getElementById('dashOrders');
  if(db)db.innerHTML=DEMO_ORDERS.slice(0,5).map(o=>`<tr>
    <td style="font-weight:700">${o.id}</td><td>${o.cliente}</td><td>${o.plato}</td>
    <td class="price">$${o.total.toLocaleString('es-CO')}</td>
    <td><span class="badge ${BMAP[o.estado]||'b-pend'}">${o.estado}</span></td>
    <td>${o.estado==='Preparando'?`<button class="btn-sm" style="font-size:11px;padding:3px 8px" onclick="markDone(this)">✓</button>`:'—'}</td>
  </tr>`).join('');
}
function markDone(btn){const bd=btn.closest('tr').querySelector('.badge');bd.className='badge b-ok';bd.textContent='Entregado';btn.remove();showToast('Estado actualizado','ok');}

// MENU ADMIN
function renderMenuAdmin(){
  document.getElementById('menuAdminGrid').innerHTML=PLATOS.map(p=>`
    <div class="ma-card">
      <img src="${p.img}" alt="${p.nombre}" loading="lazy">
      <div class="ma-body">
        <div class="ma-name">${p.nombre}</div>
        <div class="ma-price">$${p.precio.toLocaleString('es-CO')}</div>
        <div class="ma-cat">${p.cat} · ${p.peso}</div>
        <div class="ma-acts">
          <button class="ma-btn" onclick="showToast('✏️ Editar plato (demo)','ok')">✏️ Editar</button>
          <button class="ma-btn del" onclick="this.closest('.ma-card').style.opacity='.4';showToast('🗑️ Eliminado (demo)','ok')">🗑️</button>
        </div>
      </div>
    </div>`).join('');
}

// RESERVAS
const DEMO_RESERVAS=[
  {nombre:'María Castillo',tel:'3101234567',fecha:'2025-05-18',hora:'13:00',personas:'4',estado:'Confirmada'},
  {nombre:'Carlos Mena',tel:'3209876543',fecha:'2025-05-18',hora:'19:30',personas:'2',estado:'Confirmada'},
  {nombre:'Luisa Pino',tel:'3154445566',fecha:'2025-05-19',hora:'12:00',personas:'6',estado:'Pendiente'},
];
function renderReservas(){
  const stored=JSON.parse(localStorage.getItem('lp_reservas')||'[]');
  const all=[...stored,...DEMO_RESERVAS];
  document.getElementById('reservasGrid').innerHTML=all.map(r=>`
    <div class="res-card">
      <div style="font-size:26px">📅</div>
      <div style="flex:1;min-width:0">
        <div class="res-name">${r.nombre}</div>
        <div class="res-det">📞 ${r.tel} · 📆 ${r.fecha} ${r.hora} · 👥 ${r.personas}</div>
      </div>
      <span class="badge ${r.estado==='Confirmada'?'b-ok':r.estado==='Pendiente'?'b-pend':'b-cancel'}">${r.estado}</span>
      <div style="display:flex;gap:6px">
        <button class="btn-sm" style="font-size:11px" onclick="showToast('✓ Confirmado','ok')">✓</button>
        <button class="btn-sm" style="font-size:11px;color:var(--red)" onclick="this.closest('.res-card').remove();showToast('Cancelada','ok')">✕</button>
      </div>
    </div>`).join('');
}

// RESEÑAS
function renderAdminReviews(){
  const saved=JSON.parse(localStorage.getItem('lp_reviews')||'[]');
  const def=[{name:'María C.',text:'El encocado tiene alma. Volvimos con toda la familia.',stars:5},{name:'Juan S.',text:'Sabor auténtico y servicio muy amable.',stars:5},{name:'Laura M.',text:'El sancocho me recordó a mi abuela. Excelente.',stars:5}];
  const list=saved.length?saved:def;
  document.getElementById('adminReviewsGrid').innerHTML=list.map(r=>`
    <div style="background:var(--sur);border:1px solid var(--bdr);border-radius:13px;padding:14px 16px">
      <div style="color:#ffd166;font-size:12px;margin-bottom:4px">${'⭐'.repeat(r.stars||5)}</div>
      <p style="font-size:13px;color:var(--textm);font-style:italic;line-height:1.6">"${r.text}"</p>
      <div style="font-size:11px;font-weight:700;color:var(--g2);margin-top:7px">${r.name}</div>
    </div>`).join('');
}
function clearReviews(){localStorage.removeItem('lp_reviews');renderAdminReviews();showToast('Reseñas limpiadas','ok');}

// PROMOS
const DEMO_PROMOS=[
  {titulo:'Combo Familiar Pacífico',precio:'$85.000',badge:'🎉 HOY',desc:'Encocado + Sancocho + 4 bebidas.'},
  {titulo:'Hora Feliz en Entradas',precio:'2x1',badge:'🕒 3PM–5PM',desc:'2x1 en Empanadas y Bolitas de Yuca.'},
  {titulo:'Postre de la Casa Gratis',precio:'¡Gratis!',badge:'🎁 DELIVERY',desc:'Con pedidos superiores a $50.000.'},
];
function renderPromos(){
  const stored=JSON.parse(localStorage.getItem('lp_promos')||'[]');
  const all=[...stored,...DEMO_PROMOS];
  document.getElementById('promosGrid').innerHTML=all.map(p=>`
    <div style="background:var(--sur);border:1px solid var(--bdr);border-radius:15px;padding:20px;border-top:3px solid var(--g2)">
      <div style="display:inline-block;padding:3px 11px;border-radius:999px;font-size:11px;font-weight:700;background:rgba(116,196,118,.15);color:var(--g2);margin-bottom:9px">${p.badge||'📌'}</div>
      <div style="font-family:'Playfair Display',serif;font-size:16px;font-weight:800;margin-bottom:5px">${p.titulo}</div>
      <p style="font-size:13px;color:var(--textm);line-height:1.5;margin-bottom:12px">${p.desc}</p>
      <div style="display:flex;justify-content:space-between;align-items:center">
        <div style="font-size:17px;font-weight:900;color:var(--gold)">${p.precio}</div>
        <button class="btn-sm" style="font-size:11px;color:var(--red)" onclick="this.closest('div[style]').style.opacity='.3';showToast('Promo eliminada','ok')">🗑️</button>
      </div>
    </div>`).join('');
}

// CHARTS
function makeChart(containerId,lblsId,data){
  const max=Math.max(...data.map(x=>x.v));
  document.getElementById(containerId).innerHTML=data.map(d=>`<div class="bar" style="height:${(d.v/max*100).toFixed(0)}%"><div class="bar-tip">$${d.v}k</div></div>`).join('');
  document.getElementById(lblsId).innerHTML=data.map(d=>`<div class="bchartlbl">${d.d}</div>`).join('');
}
const WEEK=[{d:'Lun',v:340},{d:'Mar',v:520},{d:'Mié',v:410},{d:'Jue',v:680},{d:'Vie',v:590},{d:'Sáb',v:842},{d:'Dom',v:620}];

function renderReportes(){
  const big=[...Array(14)].map((_,i)=>({d:`${i+5}/05`,v:Math.floor(Math.random()*600+200)}));
  makeChart('bigChart','bigLbls',big);
  const cats=[{c:'Mariscos',p:42,col:'#74c476'},{c:'Principales',p:28,col:'#ffd166'},{c:'Sopas',p:14,col:'#60a5fa'},{c:'Entradas',p:10,col:'#f97316'},{c:'Postres',p:6,col:'#c084fc'}];
  document.getElementById('catReport').innerHTML=cats.map(x=>`<div class="prog-row"><div class="prog-hd"><span>${x.c}</span><strong>${x.p}%</strong></div><div class="prog-bar"><div class="prog-fill" style="width:${x.p}%;background:${x.col}"></div></div></div>`).join('');
}

// TOP PLATOS
function renderTopPlatos(){
  [{nombre:'Encocado de Camarón',pedidos:12,img:'Encocao de camaron.png'},{nombre:'Cazuela de Mariscos',pedidos:9,img:'Cazuela de marisco.jpg'},{nombre:'Bandeja Paisa',pedidos:7,img:'Bandeja Paisa.jpg'}].forEach(t=>{
    document.getElementById('topPlatos').innerHTML+= `<div style="display:flex;align-items:center;gap:11px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.05)"><img src="${t.img}" style="width:38px;height:38px;object-fit:cover;border-radius:8px;flex-shrink:0"><div style="flex:1;min-width:0"><div style="font-size:13px;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${t.nombre}</div><div style="font-size:11px;color:var(--muted)">${t.pedidos} pedidos hoy</div></div></div>`;
  });
}

// INIT
document.addEventListener('DOMContentLoaded',()=>{
  makeChart('weekChart','weekLbls',WEEK);
  document.getElementById('weekTotal').textContent='Total: $'+WEEK.reduce((s,x)=>s+x.v,0)+'k';
  renderOrders();
  renderTopPlatos();
});
</script>
</body>
</html>
<script>
/* ── Dashboard: stats reales desde BD ── */
async function loadDashboardStats() {
  try {
    const res = await API.pedidos.stats();
    if (!res.ok) return;
    const { hoy, semana, top_platos } = res.data;
    if (hoy) {
      const cards = document.querySelectorAll('.scard .sc-val');
      if (cards[0]) cards[0].textContent = hoy.total_pedidos || 0;
      if (cards[1]) cards[1].textContent = '$' + ((hoy.ventas_totales||0)/1000).toFixed(0) + 'k';
    }
    if (semana && semana.length) {
      const data = semana.map(s => ({ d: s.dia.slice(5), v: Math.round(parseFloat(s.ventas)/1000) }));
      makeChart('weekChart','weekLbls', data);
      document.getElementById('weekTotal').textContent = 'Total: $' + semana.reduce((a,s)=>a+parseFloat(s.ventas),0).toLocaleString('es-CO');
    }
    if (top_platos && top_platos.length) {
      document.getElementById('topPlatos').innerHTML = top_platos.map(t =>
        `<div style="display:flex;align-items:center;gap:11px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.05)">
          <div style="flex:1;min-width:0"><div style="font-size:13px;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${t.nombre}</div>
          <div style="font-size:11px;color:var(--muted)">${t.total_pedidos} pedidos hoy</div></div>
        </div>`).join('');
    }
  } catch {}
}

/* ── Pedidos reales desde BD ── */
const _origRenderOrders = window.renderOrders;
window.renderOrders = async function() {
  try {
    const estado = document.getElementById('filterStatus')?.value || '';
    const res = await API.pedidos.list(estado);
    if (!res.ok || !res.data) { _origRenderOrders(); return; }
    const BMAP = { pendiente:'b-pend', preparando:'b-prep', listo:'b-prep', entregado:'b-ok', cancelado:'b-cancel' };
    const html = res.data.map(o => `<tr>
      <td style="font-weight:700">#${o.id}</td>
      <td>${o.nombre_cliente}</td>
      <td style="font-size:12px">${(o.items||'').slice(0,40)}…</td>
      <td class="price">$${parseFloat(o.total).toLocaleString('es-CO')}</td>
      <td style="font-size:11px">${new Date(o.created_at).toLocaleTimeString('es-CO',{hour:'2-digit',minute:'2-digit'})}</td>
      <td><span class="badge ${BMAP[o.estado]||'b-pend'}">${o.estado}</span></td>
      <td>${o.estado!=='entregado'&&o.estado!=='cancelado'?`<button class="btn-sm" style="font-size:11px;padding:3px 8px" onclick="markEntregado(${o.id},this)">✓</button>`:'—'}</td>
    </tr>`).join('');
    const tbody = document.getElementById('ordersTbody');
    if (tbody) tbody.innerHTML = html || '<tr><td colspan="7" style="text-align:center;color:var(--muted);padding:20px">No hay pedidos</td></tr>';
  } catch { _origRenderOrders(); }
};

async function markEntregado(id, btn) {
  const res = await API.pedidos.updateEstado(id, 'entregado');
  if (res.ok) { markDone(btn); }
  else showToast('Error al actualizar', 'error');
}

/* ── Reservas reales desde BD ── */
const _origRenderReservas = window.renderReservas;
window.renderReservas = async function() {
  try {
    const res = await API.reservas.list();
    if (!res.ok || !res.data) { _origRenderReservas(); return; }
    document.getElementById('reservasGrid').innerHTML = res.data.map(r => `
      <div class="res-card">
        <div style="font-size:26px">📅</div>
        <div style="flex:1;min-width:0">
          <div class="res-name">${r.nombre}</div>
          <div class="res-det">📞 ${r.telefono||'—'} · 📆 ${r.fecha} ${r.hora} · 👥 ${r.personas}</div>
        </div>
        <span class="badge ${r.estado==='confirmada'?'b-ok':r.estado==='pendiente'?'b-pend':'b-cancel'}">${r.estado}</span>
        <div style="display:flex;gap:6px">
          <button class="btn-sm" style="font-size:11px" onclick="confirmarReserva(${r.id},this)">✓</button>
          <button class="btn-sm" style="font-size:11px;color:var(--red)" onclick="eliminarReserva(${r.id},this)">✕</button>
        </div>
      </div>`).join('') || '<p style="color:var(--muted);padding:10px">Sin reservas</p>';
  } catch { _origRenderReservas(); }
};

async function confirmarReserva(id, btn) {
  const res = await API.reservas.updateEstado(id, 'confirmada');
  if (res.ok) { btn.closest('.res-card').querySelector('.badge').className='badge b-ok'; btn.closest('.res-card').querySelector('.badge').textContent='confirmada'; showToast('✓ Confirmada','ok'); }
}
async function eliminarReserva(id, btn) {
  const res = await API.reservas.delete(id);
  if (res.ok) { btn.closest('.res-card').remove(); showToast('Eliminada','ok'); }
}

/* ── Reseñas reales desde BD ── */
const _origRenderAdminReviews = window.renderAdminReviews;
window.renderAdminReviews = async function() {
  try {
    const res = await API.resenas.list();
    if (!res.ok || !res.data) { _origRenderAdminReviews(); return; }
    document.getElementById('adminReviewsGrid').innerHTML = res.data.map(r => `
      <div style="background:var(--sur);border:1px solid var(--bdr);border-radius:13px;padding:14px 16px">
        <div style="color:#ffd166;font-size:12px;margin-bottom:4px">${'⭐'.repeat(r.estrellas||5)}</div>
        <p style="font-size:13px;color:var(--textm);font-style:italic">"${r.texto}"</p>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px">
          <div style="font-size:11px;font-weight:700;color:var(--g2)">${r.nombre}</div>
          <button class="btn-sm" style="font-size:11px;color:var(--red)" onclick="ocultarResena(${r.id},this)">🗑️</button>
        </div>
      </div>`).join('');
  } catch { _origRenderAdminReviews(); }
};
async function ocultarResena(id, btn) {
  const res = await API.resenas.delete(id);
  if (res.ok) { btn.closest('div[style]').remove(); showToast('Reseña ocultada','ok'); }
}
const _origClearReviews = window.clearReviews;
window.clearReviews = async function() {
  showToast('Para borrar reseñas usa phpMyAdmin (producción)','error');
};

/* ── Guardar nueva promo en BD ── */
const _origSavePromo = window.savePromo;
window.savePromo = async function() {
  const titulo = document.getElementById('proTitle')?.value.trim();
  if (!titulo) { showToast('Escribe el título','error'); return; }
  const data = {
    titulo,
    descripcion: document.getElementById('proDesc')?.value || '',
    precio_txt:  document.getElementById('proPrice')?.value || '',
    badge:       document.getElementById('proBadge')?.value || '',
  };
  try {
    const res = await API.promociones.create(data);
    if (res.ok) { showToast('✓ Promo guardada en BD','ok'); closeModal(); renderPromos(); }
    else showToast(res.error || 'Error','error');
  } catch { _origSavePromo(); }
};

/* ── Promos desde BD ── */
const _origRenderPromos = window.renderPromos;
window.renderPromos = async function() {
  try {
    const res = await API.promociones.list();
    if (!res.ok || !res.data) { _origRenderPromos(); return; }
    const all = res.data;
    document.getElementById('promosGrid').innerHTML = all.map(p => `
      <div style="background:var(--sur);border:1px solid var(--bdr);border-radius:15px;padding:20px;border-top:3px solid var(--g2)">
        <div style="display:inline-block;padding:3px 11px;border-radius:999px;font-size:11px;font-weight:700;background:rgba(116,196,118,.15);color:var(--g2);margin-bottom:9px">${p.badge||'📌'}</div>
        <div style="font-family:'Playfair Display',serif;font-size:16px;font-weight:800;margin-bottom:5px">${p.titulo}</div>
        <p style="font-size:13px;color:var(--textm);line-height:1.5;margin-bottom:12px">${p.descripcion||''}</p>
        <div style="display:flex;justify-content:space-between;align-items:center">
          <div style="font-size:17px;font-weight:900;color:var(--gold)">${p.precio_txt||''}</div>
          <button class="btn-sm" style="font-size:11px;color:var(--red)" onclick="eliminarPromo(${p.id},this)">🗑️</button>
        </div>
      </div>`).join('') || '<p style="color:var(--muted)">Sin promociones activas</p>';
  } catch { _origRenderPromos(); }
};
async function eliminarPromo(id, btn) {
  const res = await API.promociones.delete(id);
  if (res.ok) { btn.closest('div[style]').style.opacity='.3'; showToast('Promo desactivada','ok'); }
}

/* ── Menú admin desde BD ── */
const _origRenderMenuAdmin = window.renderMenuAdmin;
window.renderMenuAdmin = async function() {
  try {
    const res = await API.platos.list();
    if (!res.ok || !res.data) { _origRenderMenuAdmin(); return; }
    document.getElementById('menuAdminGrid').innerHTML = res.data.map(p => `
      <div class="ma-card">
        <img src="${p.imagen}" alt="${p.nombre}" loading="lazy" onerror="this.src='LOGO PAILA.png'">
        <div class="ma-body">
          <div class="ma-name">${p.nombre}</div>
          <div class="ma-price">$${parseFloat(p.precio).toLocaleString('es-CO')}</div>
          <div class="ma-cat">${p.categoria||p.cat_slug} · ${p.peso}</div>
          <div class="ma-acts">
            <button class="ma-btn" onclick="showToast('✏️ Editar: usa phpMyAdmin o amplía el formulario','ok')">✏️ Editar</button>
            <button class="ma-btn del" onclick="desactivarPlato(${p.id},this)">🗑️</button>
          </div>
        </div>
      </div>`).join('');
  } catch { _origRenderMenuAdmin(); }
};
async function desactivarPlato(id, btn) {
  const res = await API.platos.delete(id);
  if (res.ok) { btn.closest('.ma-card').style.opacity='.3'; showToast('Plato desactivado','ok'); }
}

/* ── Guardar pedido desde modal admin ── */
const _origSaveOrder = window.saveOrder;
window.saveOrder = async function() {
  const cl = document.getElementById('oCliente')?.value.trim();
  if (!cl) { showToast('Escribe el cliente','error'); return; }
  const plato_id = +document.getElementById('oPlato').value;
  const data = { nombre_cliente: cl, telefono: '', tipo: 'local', items: [{ plato_id, cantidad: 1 }] };
  try {
    const res = await API.pedidos.create(data);
    if (res.ok) { showToast('✓ Pedido registrado en BD','ok'); closeModal(); renderOrders(); }
    else showToast(res.error||'Error','error');
  } catch { _origSaveOrder(); }
};

/* ── Guardar reserva desde modal admin ── */
const _origSaveReserva = window.saveReserva;
window.saveReserva = async function() {
  const n = document.getElementById('rnNombre')?.value.trim();
  if (!n) { showToast('Escribe el nombre','error'); return; }
  const data = {
    nombre: n, telefono: document.getElementById('rnTel').value,
    fecha: document.getElementById('rnFecha').value, hora: document.getElementById('rnHora').value,
    personas: document.getElementById('rnPers').value
  };
  try {
    const res = await API.reservas.create(data);
    if (res.ok) { showToast('✓ Reserva guardada en BD','ok'); closeModal(); renderReservas(); }
    else showToast(res.error||'Error','error');
  } catch { _origSaveReserva(); }
};

/* ── Init con BD ── */
document.addEventListener('DOMContentLoaded', () => {
  loadDashboardStats();
});
</script>
