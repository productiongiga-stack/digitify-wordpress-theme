<?php
/**
 * Theme Customizer — shop integration
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digitify_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'digitify_shop',
		array(
			'title'    => __( 'Digitify Webshop', 'digitify' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'digitify_shop_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'digitify_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digitify_shop_enabled',
		array(
			'label'   => __( 'Webshop-link tonen in navigatie', 'digitify' ),
			'section' => 'digitify_shop',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'digitify_shop_url',
		array(
			'default'           => 'https://shop.digitify.be',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'digitify_shop_url',
		array(
			'label'       => __( 'Webshop URL (Vercel)', 'digitify' ),
			'description' => __( 'Externe shop op bijv. shop.digitify.be', 'digitify' ),
			'section'     => 'digitify_shop',
			'type'        => 'url',
		)
	);

	$wp_customize->add_setting(
		'digitify_shop_3d_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'digitify_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digitify_shop_3d_enabled',
		array(
			'label'   => __( '3D webshop-blok op homepage', 'digitify' ),
			'section' => 'digitify_shop',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'digitify_customize_register' );

function digitify_sanitize_checkbox( $value ) {
	return (bool) $value;
}

function digitify_shop_enabled() {
	return (bool) get_theme_mod( 'digitify_shop_enabled', true );
}

function digitify_shop_3d_enabled() {
	return digitify_shop_enabled() && (bool) get_theme_mod( 'digitify_shop_3d_enabled', true );
}

function digitify_get_shop_url() {
	$url = trim( (string) get_theme_mod( 'digitify_shop_url', 'https://shop.digitify.be' ) );
	if ( ! $url ) {
		$url = 'https://shop.digitify.be';
	}
	return untrailingslashit( esc_url( $url ) );
}

function digitify_get_shop_asset_url( $path ) {
	$path = ltrim( (string) $path, '/' );
	return digitify_get_shop_url() . '/' . $path;
}

function digitify_get_home_3d_models() {
	$base = digitify_get_shop_url() . '/assets/products/digitify';
	return array(
		array(
			'id'     => 'led-lichtbak-kabel',
			'name'   => __( 'LED lichtbak (kabel)', 'digitify' ),
			'glb'    => $base . '/led-lichtbak-kabel/model.glb',
			'poster' => $base . '/led-lichtbak-kabel/poster.png',
		),
		array(
			'id'     => 'led-lichtbak-oplaadbaar',
			'name'   => __( 'LED lichtbak (oplaadbaar)', 'digitify' ),
			'glb'    => $base . '/led-lichtbak-oplaadbaar/model.glb',
			'poster' => $base . '/led-lichtbak-oplaadbaar/poster.png',
		),
		array(
			'id'     => 'nfc-polsbandjes',
			'name'   => __( 'NFC polsbandjes', 'digitify' ),
			'glb'    => $base . '/nfc-polsbandjes/model.glb',
			'poster' => $base . '/nfc-polsbandjes/poster.png',
		),
		array(
			'id'     => 'nfc-patroon-bord',
			'name'   => __( 'NFC patroon bord', 'digitify' ),
			'glb'    => $base . '/nfc-patroon-bord/model.glb',
			'poster' => $base . '/nfc-patroon-bord/poster.png',
		),
		array(
			'id'     => 'nfc-sleutelhangers',
			'name'   => __( 'NFC sleutelhangers', 'digitify' ),
			'glb'    => $base . '/nfc-sleutelhangers/model.glb',
			'poster' => $base . '/nfc-sleutelhangers/poster.png',
		),
	);
}

function digitify_render_shop_nav_link( $class = 'digitify-nav__link digitify-nav__link--shop' ) {
	if ( ! digitify_shop_enabled() ) {
		return;
	}
	printf(
		'<a href="%1$s" class="%2$s"><span class="digitify-nav__link-text">%3$s</span></a>',
		esc_url( digitify_get_shop_url() ),
		esc_attr( $class ),
		esc_html__( 'Webshop', 'digitify' )
	);
}
