# Digitify website v1

WordPress theme and local development setup for [Digitify](https://digitify.be).

## Contents

- `digitify/` — Digitify WordPress theme (v4.0.3)
- `wordpress/router.php` — router for PHP built-in server
- `wordpress/wp-config.sample.php` — sample WordPress config

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

## Theme upload

Zip the `digitify` folder and upload via **Appearance → Themes → Upload** in WordPress admin.
