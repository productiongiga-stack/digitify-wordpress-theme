<?php
/**
 * Logo template part
 *
 * @package Digitify
 */

$variant = isset( $args['variant'] ) ? $args['variant'] : 'header';
$class   = 'digitify-logo digitify-logo--' . esc_attr( $variant );

$logo_map = array(
	'header' => 'black',
	'footer' => 'white',
	'light'  => 'white',
);

$logo_key = isset( $logo_map[ $variant ] ) ? $logo_map[ $variant ] : 'black';
$logo     = digitify_get_logo( $logo_key );

if ( 'white' === $logo_key ) {
	$class .= ' digitify-logo--light';
}

$dimensions = array(
	'black' => array( 'width' => 200, 'height' => 56 ),
	'white' => array( 'width' => 200, 'height' => 56 ),
);
$size = isset( $dimensions[ $logo_key ] ) ? $dimensions[ $logo_key ] : $dimensions['black'];
?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php echo esc_attr( $class ); ?>" aria-label="<?php esc_attr_e( 'Digitify — Home', 'digitify' ); ?>">
	<img
		class="digitify-logo__img digitify-logo__img--brand"
		src="<?php echo esc_url( $logo ); ?>"
		alt="Digitify"
		width="<?php echo (int) $size['width']; ?>"
		height="<?php echo (int) $size['height']; ?>"
		<?php echo 'footer' === $variant ? 'loading="lazy" decoding="async"' : 'loading="eager" fetchpriority="high" decoding="async"'; ?>
	>
</a>
