<?php
/**
 * CTA band template part
 *
 * @package Digitify
 */

$title    = isset( $args['title'] ) ? $args['title'] : __( 'Plan uw transport vandaag', 'digitify' );
$subtitle = isset( $args['subtitle'] ) ? $args['subtitle'] : __( 'Beschrijf uw zending en ontvang snel een voorstel op maat.', 'digitify' );
$context  = isset( $args['context'] ) ? $args['context'] : 'inline';
?>
<section class="digitify-cta-band digitify-cta-band--<?php echo esc_attr( $context ); ?>">
	<div class="digitify-container">
		<div class="digitify-cta">
			<div class="digitify-cta__text">
				<h2><?php echo esc_html( $title ); ?></h2>
				<p><?php echo esc_html( $subtitle ); ?></p>
			</div>
			<div class="digitify-cta__actions">
				<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--white"><?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?></a>
				<a href="https://wa.me/32486515773" class="digitify-btn digitify-btn--whatsapp" target="_blank" rel="noopener noreferrer"><?php echo digitify_svg_icon( 'whatsapp' ); ?> WhatsApp</a>
			</div>
		</div>
	</div>
</section>
