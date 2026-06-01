<?php
/** DEMO formato C — Hub central / consola. */
$SISTEMAS = [
    ['nombre'=>'Producción','icon'=>'bi-gear-wide-connected','color'=>'#0ea5e9','url'=>'http://localhost/produccion_ptp/','estado'=>'activo'],
    ['nombre'=>'Supervisores','icon'=>'bi-people-fill','color'=>'#10b981','url'=>'http://localhost/supervisores_ptp/','estado'=>'activo'],
    ['nombre'=>'Administración','icon'=>'bi-bar-chart-line-fill','color'=>'#f59e0b','url'=>'#','estado'=>'pronto'],
];
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Procesadora Textil Parque — Acceso (hub)</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Inter',system-ui,sans-serif;min-height:100vh;color:#e7edf6;background:#0b1220;
    background-image:radial-gradient(900px 500px at 50% -10%, rgba(14,165,233,.18), transparent 60%),
                     radial-gradient(700px 500px at 50% 120%, rgba(16,185,129,.12), transparent 60%);
    display:flex;flex-direction:column;align-items:center;justify-content:center;padding:2rem;position:relative}
  .top{position:fixed;top:18px;left:0;right:0;display:flex;justify-content:space-between;padding:0 26px;color:#8aa0bd;font-size:.85rem;font-weight:600;letter-spacing:.05em}
  .logo{color:#fff;line-height:0;margin-bottom:1rem;filter:drop-shadow(0 6px 18px rgba(0,0,0,.5))}
  .logo svg{height:96px;width:auto}
  .sub{color:#8aa0bd;font-size:.95rem;margin-bottom:.3rem}
  .ask{font-size:1.25rem;font-weight:700;margin:1.4rem 0 2.2rem;color:#fff}
  .row{display:flex;gap:3.2rem}
  .item{text-decoration:none;color:inherit;text-align:center;display:flex;flex-direction:column;align-items:center;gap:.8rem}
  .ring{width:118px;height:118px;border-radius:50%;display:grid;place-items:center;font-size:2.7rem;color:var(--c);
    background:color-mix(in srgb,var(--c) 14%, #121a2b);border:2px solid color-mix(in srgb,var(--c) 45%, transparent);
    transition:transform .2s ease, box-shadow .2s ease}
  .item.activo:hover .ring{transform:translateY(-6px);box-shadow:0 16px 40px -8px var(--c), 0 0 0 4px color-mix(in srgb,var(--c) 22%, transparent)}
  .nm{font-weight:700;font-size:1.05rem}
  .st{font-size:.78rem;font-weight:600;color:#8aa0bd;display:inline-flex;align-items:center;gap:.4rem}
  .st .dot{width:8px;height:8px;border-radius:50%;background:var(--c)}
  .activo .st .dot{animation:p 2s infinite}
  @keyframes p{0%{box-shadow:0 0 0 0 var(--c)}70%{box-shadow:0 0 0 7px transparent}100%{box-shadow:0 0 0 0 transparent}}
  .item.pronto{opacity:.55;filter:saturate(.6);cursor:default}
  .ftr{position:fixed;bottom:18px;color:#8aa0bd;font-size:.82rem}
</style></head><body>
  <div class="top"><span>PTP</span><span id="clock">—</span></div>
  <div class="logo"><?= file_get_contents(__DIR__ . '/../assets/logo.svg') ?></div>
  <div class="sub">Procesadora Textil Parque · Suite de Gestión</div>
  <div class="ask">¿A qué sistema querés entrar?</div>
  <div class="row">
    <?php foreach ($SISTEMAS as $s): $on=$s['estado']==='activo'; $t=$on?'a':'div'; $href=$on?' href="'.htmlspecialchars($s['url']).'"':''; ?>
    <<?= $t ?><?= $href ?> class="item <?= $on?'activo':'pronto' ?>" style="--c:<?= $s['color'] ?>">
      <div class="ring"><i class="bi <?= $s['icon'] ?>"></i></div>
      <span class="nm"><?= $s['nombre'] ?></span>
      <span class="st"><span class="dot"></span><?= $on?'Activo':'Pronto' ?></span>
    </<?= $t ?>>
    <?php endforeach; ?>
  </div>
  <div class="ftr">Inforemp · acceso unificado</div>
  <script>
    function tick(){var d=new Date(),p=n=>String(n).padStart(2,'0');
      document.getElementById('clock').textContent=p(d.getDate())+'/'+p(d.getMonth()+1)+'  ·  '+p(d.getHours())+':'+p(d.getMinutes());}
    tick(); setInterval(tick,1000*20);
  </script>
</body></html>
