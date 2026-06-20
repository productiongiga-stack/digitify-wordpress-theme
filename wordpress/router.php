<?php
/**
 * Router for PHP built-in server (WordPress permalinks).
 */
$root = __DIR__;
$uri  = urldecode( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );

if ( $uri !== '/' && file_exists( $root . $uri ) ) {
	return false;
}

require_once $root . '/index.php';
