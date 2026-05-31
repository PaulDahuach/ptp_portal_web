# Portal PTP — Puerta de entrada / selector de sistemas

Página única (sin dependencias propias) que sirve de **acceso unificado** a los sistemas de
Procesadora Textil Parque: rutea a **Producción**, **Supervisores** y **Administración**
(esta última "próximamente", hasta su migración).

Va en el **directorio raíz** del servidor (en la PC del cliente / LAN). Cada tarjeta enlaza a la
URL del sistema correspondiente. No tiene login propio: cada sistema autentica por su cuenta.

## Estructura
```
index.php                  ← la página (config + render). Editá $SISTEMAS para agregar/cambiar.
assets/logo.svg            ← logo TP vectorizado (currentColor → recolor por CSS)
assets/logo-textilparque.jpg ← logo original (fuente del vectorizado)
```

## Configuración
En `index.php`, el array `$SISTEMAS` define cada tarjeta: nombre, descripción, features, ícono
(Bootstrap Icons), color de acento, URL y estado (`activo` | `pronto`). Las URLs son `localhost/...`
en desarrollo; en producción apuntar a los hosts/puertos de la LAN. Cuando migre Administración,
poner `'estado' => 'activo'` y su URL.

## Tecnología
PHP (solo para incrustar el config) + HTML/CSS · Bootstrap Icons + Inter por CDN · logo SVG inline.
Diseño dark, tarjetas premium con acento por sistema, estado y hover.
