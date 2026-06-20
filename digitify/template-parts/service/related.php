<?php
/**
 * Service related section — compact grid
 *
 * @package Digitify
 *
 * Args: slug, lead
 */

$slug = isset( $args['slug'] ) ? $args['slug'] : digitify_get_current_slug();
$lead = isset( $args['lead'] ) ? $args['lead'] : __( 'Andere digitale oplossingen van Digitify.', 'digitify' );

$related = array();
foreach ( digitify_get_service_hub_cards() as $card ) {
	if ( $card['slug'] === $slug ) {
		continue;
	}
	$related[] = $card;
}
$related[] = array(
	'slug'  => 'cases',
	'image' => digitify_get_cases_related_image(),
	'title' => __( 'Cases', 'digitify' ),
	'desc'  => __( 'Bekijk onze webdesign, media en marketing projecten.', 'digitify' ),
);
?>
<section class="digitify-section digitify-section--tight digitify-service-related digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-service-related__head">
			<span class="digitify-section__label"><?php esc_html_e( 'Gerelateerd', 'digitify' ); ?></span>
			<h2><?php esc_html_e( 'Ontdek ook', 'digitify' ); ?></h2>
			<p><?php echo esc_html( $lead ); ?></p>
		</div>
		<div class="digitify-service-related__grid">
			<?php foreach ( $related as $card ) : ?>
				<a href="<?php echo esc_url( digitify_get_page_url( $card['slug'] ) ); ?>" class="digitify-service-related__card">
					<div class="digitify-service-related__media">
						<img src="<?php echo esc_url( digitify_get_image( $card['image'] ) ); ?>" alt="" loading="lazy" width="480" height="480">
					</div>
					<div class="digitify-service-related__body">
						<h3><?php echo esc_html( $card['title'] ); ?></h3>
						<p><?php echo esc_html( $card['desc'] ); ?></p>
					</div>
					<span class="digitify-service-related__arrow" aria-hidden="true">&rarr;</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
