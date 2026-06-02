<?php
/**
 * Portal PTP — puerta de entrada / selector de sistemas.
 * Página única (sin dependencias) que rutea a cada sistema. Editá $SISTEMAS para
 * agregar/quitar/cambiar URLs (en producción, apuntar a los hosts/puertos de la LAN).
 */
$EMPRESA  = 'Procesadora Textil Parque';
$SUBTITULO = 'Suite de Gestión · Inforemp';

$SISTEMAS = [
    [
        'nombre' => 'Producción',
        'desc'   => 'Órdenes de proceso, lotes, definición, programación y cotizaciones.',
        'feats'  => ['Recepción y definición', 'Consultas x lote / sector', 'Muestras y presupuestos'],
        'icon'   => 'bi-gear-wide-connected',
        'color'  => '#0ea5e9',                 // sky
        'url'    => '/produccion_ptp/',        // relativa a la raíz: funciona en cualquier host (localhost o IP de la LAN)
        'estado' => 'activo',
    ],
    [
        'nombre' => 'Supervisores',
        'desc'   => 'Interfaz de planta: avance de los lotes de tu sector y despacho.',
        'feats'  => ['Login por operario + sector', 'Avance al próximo proceso', 'Despacho a Administración'],
        'icon'   => 'bi-people-fill',
        'color'  => '#10b981',                 // emerald
        'url'    => '/supervisores_ptp/',      // relativa a la raíz: funciona en cualquier host
        'estado' => 'activo',
    ],
    [
        'nombre' => 'Administración',
        'desc'   => 'Cuenta corriente, IVA, contabilidad, cheques y bancos.',
        'feats'  => ['Saldos y resúmenes de cuenta', 'IVA Ventas / Compras', 'Mayor, Balance, Cheques'],
        'icon'   => 'bi-bar-chart-line-fill',
        'color'  => '#f59e0b',                 // amber
        'url'    => '#',
        'estado' => 'pronto',                  // DESHABILITADO: la consulta muestra blanco/negro (dato sensible) — no exponer
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($EMPRESA) ?> — Acceso</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
  :root { --bg:#0b1220; --card:#121a2b; --ink:#e7edf6; --muted:#8aa0bd; --line:#1e2a40; }
  * { box-sizing:border-box; }
  body {
    margin:0; min-height:100vh; font-family:'Inter',system-ui,Segoe UI,Roboto,sans-serif;
    color:var(--ink); background:var(--bg);
    background-image:
      radial-gradient(1100px 600px at 15% -10%, rgba(14,165,233,.16), transparent 60%),
      radial-gradient(1000px 600px at 110% 10%, rgba(16,185,129,.12), transparent 55%),
      radial-gradient(900px 700px at 50% 120%, rgba(245,158,11,.08), transparent 60%);
    display:flex; flex-direction:column; align-items:center; justify-content:center; padding:3rem 1.25rem;
  }
  .brand { text-align:center; margin-bottom:2.6rem; }
  .logo { display:inline-block; color:#fff; line-height:0; margin-bottom:1.1rem; filter:drop-shadow(0 6px 18px rgba(0,0,0,.5)); }
  .logo svg { height:135px; width:auto; display:block; }
  .brand h1 { font-size:1.55rem; font-weight:800; margin:.2rem 0 .15rem; letter-spacing:-.01em; }
  .brand p { color:var(--muted); margin:0; font-size:.95rem; letter-spacing:.02em; }
  .grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:1.5rem; width:100%; max-width:1060px; }
  @media (max-width:820px){ .grid{ grid-template-columns:1fr; max-width:420px; } }
  .card {
    position:relative; background:var(--card); border:1px solid var(--line); border-radius:18px;
    padding:1.6rem 1.5rem 1.4rem; overflow:hidden; text-decoration:none; color:inherit;
    display:flex; flex-direction:column; min-height:300px;
    transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
  }
  .card::before { content:""; position:absolute; inset:0 0 auto 0; height:4px; background:var(--accent); opacity:.9; }
  .card.activo:hover {
    transform:translateY(-6px); border-color:color-mix(in srgb,var(--accent) 55%, var(--line));
    box-shadow:0 18px 50px rgba(0,0,0,.45), 0 0 0 1px color-mix(in srgb,var(--accent) 30%, transparent),
               0 10px 40px -10px var(--accent);
  }
  .ico {
    width:56px; height:56px; border-radius:14px; display:grid; place-items:center; font-size:1.7rem; margin-bottom:1rem;
    color:var(--accent); background:color-mix(in srgb,var(--accent) 16%, transparent);
    border:1px solid color-mix(in srgb,var(--accent) 30%, transparent);
  }
  .card h2 { font-size:1.35rem; font-weight:700; margin:0 0 .35rem; }
  .card .d { color:var(--muted); font-size:.92rem; line-height:1.45; margin:0 0 1rem; }
  .feats { list-style:none; padding:0; margin:0 0 1.2rem; }
  .feats li { font-size:.82rem; color:var(--muted); padding:.18rem 0 .18rem 1.3rem; position:relative; }
  .feats li::before { content:"\F26E"; font-family:"bootstrap-icons"; position:absolute; left:0; color:var(--accent); font-size:.8rem; }
  .foot { margin-top:auto; display:flex; align-items:center; justify-content:space-between; }
  .enter {
    display:inline-flex; align-items:center; gap:.5rem; font-weight:600; font-size:.92rem;
    padding:.55rem 1.1rem; border-radius:11px; color:#04121f;
    background:var(--accent); transition:gap .15s ease, filter .15s ease;
  }
  .card.activo:hover .enter { gap:.85rem; filter:brightness(1.08); }
  .status { font-size:.78rem; font-weight:600; display:inline-flex; align-items:center; gap:.45rem; color:var(--muted); }
  .dot { width:8px; height:8px; border-radius:50%; background:var(--accent); box-shadow:0 0 0 0 var(--accent); }
  .activo .dot { animation:pulse 2s infinite; }
  @keyframes pulse { 0%{box-shadow:0 0 0 0 color-mix(in srgb,var(--accent) 70%,transparent);} 70%{box-shadow:0 0 0 7px transparent;} 100%{box-shadow:0 0 0 0 transparent;} }
  .card.pronto { opacity:.62; filter:saturate(.65); cursor:default; }
  .card.pronto .badge-soon {
    position:absolute; top:14px; right:-34px; transform:rotate(45deg); background:var(--accent); color:#1a1300;
    font-size:.66rem; font-weight:800; letter-spacing:.08em; padding:.25rem 2.4rem; text-transform:uppercase;
  }
  .pageftr { margin-top:2.6rem; color:var(--muted); font-size:.82rem; text-align:center; }
  .pageftr b { color:var(--ink); font-weight:600; }
</style>
</head>
<body>
  <div class="brand">
    <div class="logo"><?= file_get_contents(__DIR__ . '/assets/logo.svg') ?></div>
    <h1><?= htmlspecialchars($EMPRESA) ?></h1>
    <p><?= htmlspecialchars($SUBTITULO) ?></p>
  </div>

  <div class="grid">
    <?php foreach ($SISTEMAS as $s):
      $activo = $s['estado'] === 'activo';
      $tag = $activo ? 'a' : 'div';
      $href = $activo ? ' href="' . htmlspecialchars($s['url']) . '"' : '';
    ?>
    <<?= $tag ?><?= $href ?> class="card <?= $activo ? 'activo' : 'pronto' ?>" style="--accent:<?= htmlspecialchars($s['color']) ?>">
      <?php if (!$activo): ?><span class="badge-soon">Pronto</span><?php endif; ?>
      <div class="ico"><i class="bi <?= htmlspecialchars($s['icon']) ?>"></i></div>
      <h2><?= htmlspecialchars($s['nombre']) ?></h2>
      <p class="d"><?= htmlspecialchars($s['desc']) ?></p>
      <ul class="feats">
        <?php foreach ($s['feats'] as $f): ?><li><?= htmlspecialchars($f) ?></li><?php endforeach; ?>
      </ul>
      <div class="foot">
        <?php if ($activo): ?>
          <span class="enter">Entrar <i class="bi bi-arrow-right"></i></span>
          <span class="status"><span class="dot"></span>Activo</span>
        <?php else: ?>
          <span class="status"><span class="dot"></span>Próximamente</span>
        <?php endif; ?>
      </div>
    </<?= $tag ?>>
    <?php endforeach; ?>
  </div>

  <div class="pageftr"><b>Inforemp</b> · acceso unificado · <?= date('Y') ?></div>
</body>
</html>
