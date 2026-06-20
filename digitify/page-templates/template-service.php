<?php
/**
 * Template Name: Dienst (SEO)
 *
 * @package Digitify
 */

get_header();

$slug    = digitify_get_current_slug();
$service = digitify_get_service_data( $slug );

if ( ! $service ) {
	get_template_part( 'page' );
	get_footer();
	return;
}

$panel_marks = array(
	'same-day-delivery'      => 'SD',
	'express-transport'      => 'EX',
	'opslag-stockage'        => 'OS',
	'benelux-internationaal' => 'EU',
);
$panel_mark    = isset( $panel_marks[ $slug ] ) ? $panel_marks[ $slug ] : 'DK';
$panel_image   = digitify_get_service_panel_image( $slug );
$panel_badge   = isset( $service['panel_badge'] ) ? $service['panel_badge'] : __( 'Dashdoc tracking', 'digitify' );
$faq_lead        = isset( $service['faq_lead'] ) ? $service['faq_lead'] : __( 'Antwoorden op de meest gestelde vragen over deze dienst.', 'digitify' );
$related_lead    = isset( $service['related_lead'] ) ? $service['related_lead'] : __( 'Andere digitale oplossingen van Digitify.', 'digitify' );
?>

<div class="digitify-service-page digitify-service-page--<?php echo esc_attr( $slug ); ?>">
	<?php
	get_template_part( 'template-parts/page-header', null, array(
		'title'    => $service['title'],
		'subtitle' => $service['subtitle'],
		'image'    => $panel_image['src'],
		'size'     => 'default',
	) );
	?>

	<section class="digitify-section digitify-section--tight digitify-reveal">
		<div class="digitify-container">
			<div class="digitify-service-panel">
				<div class="digitify-service-panel__main">
					<div class="digitify-service-panel__copy">
						<h2 class="digitify-service-panel__title"><?php echo esc_html( $service['title'] ); ?></h2>
						<p class="digitify-service-panel__subtitle"><?php echo esc_html( $service['subtitle'] ); ?></p>
						<p class="digitify-service-panel__intro"><?php echo esc_html( $service['intro'] ); ?></p>
						<ul class="digitify-service-panel__usps">
							<?php foreach ( $service['usps'] as $usp ) : ?>
								<li><?php echo digitify_svg_icon( 'check' ); ?> <?php echo esc_html( $usp ); ?></li>
							<?php endforeach; ?>
						</ul>
						<div class="digitify-service-panel__actions">
							<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--primary"><?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?></a>
							<a href="tel:+32486515773" class="digitify-btn digitify-btn--outline"><?php esc_html_e( 'Bel ons', 'digitify' ); ?></a>
						</div>
					</div>
					<div class="digitify-service-panel__media">
						<figure>
							<img src="<?php echo esc_url( digitify_get_image( $panel_image['src'] ) ); ?>" alt="<?php echo esc_attr( $panel_image['alt'] ); ?>" loading="lazy" width="720" height="720">
						</figure>
						<span class="digitify-service-panel__badge"><?php echo esc_html( $panel_badge ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	get_template_part(
		'template-parts/service/process',
		null,
		array(
			'service' => $service,
			'slug'    => $slug,
		)
	);

	get_template_part(
		'template-parts/faq-section',
		null,
		array(
			'slug' => $slug,
			'lead' => $faq_lead,
			'mark' => $panel_mark,
		)
	);

	get_template_part(
		'template-parts/service/related',
		null,
		array(
			'slug' => $slug,
			'lead' => $related_lead,
		)
	);
	?>
</div>

<?php get_footer(); ?>
