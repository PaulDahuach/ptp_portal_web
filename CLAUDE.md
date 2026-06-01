# Portal PTP — contexto para Claude

Puerta de entrada / selector de los sistemas web de PTP. Página única (`index.php`
config-driven, array `$SISTEMAS`) con tarjetas premium dark que rutean a cada sistema.

- **Repo:** github.com/PaulDahuach/ptp_portal_web.git (rama `master`)
- **NO usa el kit** (no abre `.mdb`, no tiene login): es solo una landing de navegación.
- Rutea a: **Producción** (`/produccion_ptp`), **Supervisores** (`/supervisores_ptp`),
  **Administración** (marcada "pronto"). En localhost apunta a `http://localhost/...`;
  cambiar al **host LAN** en la instalación real del cliente.

## Estructura
- `index.php` — define `$SISTEMAS` (nombre, url, color de acento, estado). Editar ahí para
  agregar/cambiar destinos.
- `assets/logo.svg` — logo TextilParque vectorizado (de logo-textilparque.jpg con vtracer),
  blanco inline (`fill=currentColor`, sin fondo), ~135px.
- Los dashboards de produccion_ptp y supervisores_ptp tienen un grupo de menú "Acceso" →
  "Portal de Sistemas" para volver acá (cambiar de sistema). Usa `bu()` que respeta URLs
  absolutas.

## Reglas técnicas
- **CRLF** EOL (`.gitattributes` puesto). PHP simple (sin dependencias del kit).
- `git -C C:\wamp64\www\ptp_portal` para todo git.

## Contexto general PTP
Los 4 sistemas (kit + producción + supervisores + portal) y su historia están en la memoria
de **inforemp_inside**:
`C:\Users\pauld\.claude\projects\C--wamp64-www-inforemp-inside\memory\inforemp_web_kit.md`.
Registrados en el módulo Sistemas del inside (`inside_desarrollos`, codcue=18).
