<?php
/**
 * One-time local WordPress install helper.
 * Run: php install-local.php
 */
define( 'WP_INSTALLING', true );
require __DIR__ . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

if ( get_option( 'siteurl' ) ) {
	echo "WordPress already installed: " . get_option( 'siteurl' ) . PHP_EOL;
	exit( 0 );
}

wp_install(
	'Digitify',
	'admin',
	'contact@digitify.be',
	true,
	'',
	'DigitifyLocal2026!',
	false
);

switch_theme( 'digitify' );
update_option( 'show_on_front', 'page' );

set_theme_mod( 'digitify_shop_enabled', true );
set_theme_mod( 'digitify_shop_3d_enabled', true );
set_theme_mod( 'digitify_shop_url', 'http://localhost:3737' );

$home = get_page_by_path( 'home' );
if ( $home ) {
	update_option( 'page_on_front', $home->ID );
}

echo "Installed. Login: admin / DigitifyLocal2026!" . PHP_EOL;
echo "Site: http://localhost:8080" . PHP_EOL;
