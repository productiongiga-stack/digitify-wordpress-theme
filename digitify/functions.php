<?php
/**
 * Theme setup and assets
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DIGITIFY_THEME_VERSION', '4.0.3' );
define( 'DIGITIFY_THEME_DIR', get_template_directory() );
define( 'DIGITIFY_THEME_URI', get_template_directory_uri() );

require_once DIGITIFY_THEME_DIR . '/inc/setup.php';
require_once DIGITIFY_THEME_DIR . '/inc/cases.php';
require_once DIGITIFY_THEME_DIR . '/inc/services.php';
require_once DIGITIFY_THEME_DIR . '/inc/seo.php';
require_once DIGITIFY_THEME_DIR . '/inc/pages.php';
require_once DIGITIFY_THEME_DIR . '/inc/customizer.php';
