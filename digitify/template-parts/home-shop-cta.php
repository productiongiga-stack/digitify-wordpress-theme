<?php
/**
 * Homepage webshop CTA with rotating 3D preview
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$models   = digitify_get_home_3d_models();
$shop_url = digitify_get_shop_url();
$first    = ! empty( $models[0] ) ? $models[0] : null;
?>

<section class="digitify-section digitify-home-shop-cta digitify-reveal" id="digitify-home-shop-cta">
	<div class="digitify-container">
		<div class="digitify-home-shop-cta__grid">
			<div class="digitify-home-shop-cta__copy">
				<span class="digitify-section__label"><?php esc_html_e( 'Digitify Webshop', 'digitify' ); ?></span>
				<h2><?php esc_html_e( 'NFC-tags, LED lichtbakken & smart producten', 'digitify' ); ?></h2>
				<p><?php esc_html_e( 'Bekijk geselecteerde producten in 3D en bestel direct via onze webshop op Vercel.', 'digitify' ); ?></p>
				<p class="digitify-home-shop-cta__product-name" id="digitifyHome3dLabel">
					<?php echo $first ? esc_html( $first['name'] ) : ''; ?>
				</p>
				<div class="digitify-home-shop-cta__actions">
					<a href="<?php echo esc_url( $shop_url ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm">
						<?php esc_html_e( 'Bekijk onze webshop', 'digitify' ); ?>
					</a>
					<a href="<?php echo esc_url( $shop_url . '/shop' ); ?>" class="digitify-btn digitify-btn--ghost digitify-btn--sm">
						<?php esc_html_e( 'Alle producten', 'digitify' ); ?>
					</a>
				</div>
			</div>
			<div class="digitify-home-shop-cta__viewer" aria-label="<?php esc_attr_e( '3D product preview', 'digitify' ); ?>">
				<?php if ( $first ) : ?>
					<model-viewer
						id="digitifyHome3dViewer"
						src="<?php echo esc_url( $first['glb'] ); ?>"
						poster="<?php echo esc_url( $first['poster'] ); ?>"
						alt="<?php echo esc_attr( $first['name'] ); ?>"
						camera-controls
						touch-action="pan-y"
						shadow-intensity="0.85"
						exposure="1"
						auto-rotate
						rotation-per-second="18deg"
						interaction-prompt="none"
						loading="eager"
					></model-viewer>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
