# Digitify website v1

WordPress theme and local development setup for [Digitify](https://digitify.be).

## Contents

- `digitify/` — Digitify WordPress theme (v4.0.3)
- `wordpress/router.php` — router for PHP built-in server
- `wordpress/wp-config.sample.php` — sample WordPress config

## Theme upload (production)

1. Zip the **`digitify`** folder (not the parent repo folder).
2. In WordPress admin: **Appearance → Themes → Add New → Upload Theme**.
3. Activate **Digitify**.

After activation the theme creates pages automatically and sets the static front page.

## Webshop koppeling (Customizer)

Under **Appearance → Customize → Digitify Webshop**:

| Setting | Default | Purpose |
|---------|---------|---------|
| Webshop-link tonen | Aan | Toont **Webshop** in header, mobile nav en footer |
| Webshop URL | `https://shop.digitify.be` | Externe Vercel shop |
| 3D webshop-blok homepage | Aan | Roterende `<model-viewer>` CTA met GLB's van de shop |

GLB assets worden geladen van de shop-URL (niet in het theme gebundeld).

## Local development

1. Install WordPress core into `wordpress/` (or extract `wordpress.tar.gz` if available).
2. Copy the theme: `cp -R digitify wordpress/wp-content/themes/digitify`
3. Copy config: `cp wordpress/wp-config.sample.php wordpress/wp-config.php` and set DB credentials.
4. Start the server:

```bash
cd wordpress
php -S localhost:8080 router.php
```

5. Open http://localhost:8080 and activate the **Digitify** theme.

## Assets

Theme images live in `digitify/assets/images/` (logos, hero, case screenshots).  
`screenshot.png` is used as the theme preview in WordPress admin.

## Related project

The 3D webshop runs separately on Vercel — see the `digitify-3d-webshop` repository in `productiongiga-stack`.
