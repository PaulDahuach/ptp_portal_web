<?php
/** DEMO formato B — Paneles inmersivos a pantalla completa. */
$SISTEMAS = [
    ['nombre'=>'Producción','desc'=>'Órdenes, lotes y cotizaciones','icon'=>'bi-gear-wide-connected','color'=>'#0ea5e9','url'=>'http://localhost/produccion_ptp/','estado'=>'activo'],
    ['nombre'=>'Supervisores','desc'=>'Avance de planta por sector','icon'=>'bi-people-fill','color'=>'#10b981','url'=>'http://localhost/supervisores_ptp/','estado'=>'activo'],
    ['nombre'=>'Administración','desc'=>'Cuentas, facturación, AFIP','icon'=>'bi-bar-chart-line-fill','color'=>'#f59e0b','url'=>'#','estado'=>'pronto'],
];
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Procesadora Textil Parque — Acceso (paneles)</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Inter',system-ui,sans-serif;height:100vh;overflow:hidden;background:#0b1220;color:#fff}
  .wrap{display:flex;height:100vh}
  .panel{flex:1;position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;
    text-decoration:none;color:#fff;text-align:center;padding:2rem;overflow:hidden;
    transition:flex .45s cubic-bezier(.4,0,.2,1), background .35s ease;
    background:linear-gradient(160deg, color-mix(in srgb,var(--c) 26%, #0b1220), #0b1220 70%);
    border-right:1px solid rgba(255,255,255,.06);}
  .panel:last-child{border-right:0}
  .panel::before{content:"";position:absolute;inset:0 0 auto 0;height:5px;background:var(--c)}
  .panel.activo:hover{flex:1.7;background:linear-gradient(160deg, color-mix(in srgb,var(--c) 48%, #0b1220), #0b1220 75%)}
  .ic{width:104px;height:104px;border-radius:26px;display:grid;place-items:center;font-size:3rem;margin-bottom:1.6rem;
    color:#fff;background:color-mix(in srgb,var(--c) 32%, transparent);border:1px solid color-mix(in srgb,var(--c) 55%, transparent);
    transition:transform .35s ease}
  .panel.activo:hover .ic{transform:scale(1.12) translateY(-4px)}
  .panel h2{font-size:2rem;font-weight:800;letter-spacing:-.01em}
  .panel .ln{width:54px;height:3px;background:var(--c);margin:.9rem auto 1rem;border-radius:3px}
  .panel p{color:rgba(255,255,255,.72);font-size:1rem;max-width:240px}
  .st{margin-top:1.6rem;font-size:.8rem;font-weight:600;display:inline-flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.85)}
  .st .dot{width:9px;height:9px;border-radius:50%;background:var(--c)}
  .activo .st .dot{animation:p 2s infinite}
  @keyframes p{0%{box-shadow:0 0 0 0 var(--c)}70%{box-shadow:0 0 0 8px transparent}100%{box-shadow:0 0 0 0 transparent}}
  .enter{margin-top:.4rem;font-size:.82rem;color:rgba(255,255,255,.55);opacity:0;transition:opacity .3s}
  .panel.activo:hover .enter{opacity:1}
  .panel.pronto{filter:saturate(.5) brightness(.8);cursor:default}
  .brand{position:fixed;top:18px;left:50%;transform:translateX(-50%);z-index:5;color:#fff;opacity:.9}
  .brand svg{height:46px;width:auto;filter:drop-shadow(0 3px 10px rgba(0,0,0,.6))}
</style></head><body>
  <div class="brand"><?= file_get_contents(__DIR__ . '/../assets/logo.svg') ?></div>
  <div class="wrap">
    <?php foreach ($SISTEMAS as $s): $on=$s['estado']==='activo'; $t=$on?'a':'div'; $href=$on?' href="'.htmlspecialchars($s['url']).'"':''; ?>
    <<?= $t ?><?= $href ?> class="panel <?= $on?'activo':'pronto' ?>" style="--c:<?= $s['color'] ?>">
      <div class="ic"><i class="bi <?= $s['icon'] ?>"></i></div>
      <h2><?= $s['nombre'] ?></h2>
      <div class="ln"></div>
      <p><?= $s['desc'] ?></p>
      <span class="st"><span class="dot"></span><?= $on?'Activo':'Próximamente' ?></span>
      <?php if($on): ?><span class="enter">clic para entrar →</span><?php endif; ?>
    </<?= $t ?>>
    <?php endforeach; ?>
  </div>
</body></html>
