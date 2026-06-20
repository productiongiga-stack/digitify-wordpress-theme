<?php
/**
 * FAQ section template part
 *
 * @package Digitify
 *
 * Args: slug, lead, mark, layout (optional legacy)
 */

$slug   = isset( $args['slug'] ) ? $args['slug'] : digitify_get_current_slug();
$lead   = isset( $args['lead'] ) ? $args['lead'] : '';
$mark   = isset( $args['mark'] ) ? $args['mark'] : '';
$layout = isset( $args['layout'] ) ? $args['layout'] : '';
$faq    = digitify_get_faq_for_page( $slug );

if ( empty( $faq ) ) {
	return;
}

$use_service_layout = $lead || 'service' === $layout || in_array( $slug, digitify_get_service_slugs(), true );

if ( $use_service_layout ) {
	if ( ! $lead ) {
		$lead = __( 'Antwoorden op de meest gestelde vragen over deze dienst.', 'digitify' );
	}
	?>
	<section class="digitify-section digitify-section--gray digitify-section--tight digitify-service-faq digitify-reveal">
		<div class="digitify-container">
			<div class="digitify-service-faq__head">
				<div>
					<span class="digitify-section__label"><?php esc_html_e( 'Veelgestelde vragen', 'digitify' ); ?></span>
					<h2><?php esc_html_e( 'FAQ', 'digitify' ); ?></h2>
					<p><?php echo esc_html( $lead ); ?></p>
				</div>
				<?php if ( $mark ) : ?>
					<span class="digitify-service-faq__mark" aria-hidden="true"><?php echo esc_html( $mark ); ?></span>
				<?php endif; ?>
			</div>
			<div class="digitify-service-faq__list">
				<?php foreach ( $faq as $item ) : ?>
					<details class="digitify-service-faq__item">
						<summary class="digitify-service-faq__question"><?php echo esc_html( $item['q'] ); ?></summary>
						<div class="digitify-service-faq__answer"><p><?php echo esc_html( $item['a'] ); ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return;
}

$section_class = 'digitify-section digitify-section--gray digitify-section--tight digitify-faq digitify-faq--' . sanitize_html_class( $layout ? $layout : 'default' ) . ' digitify-reveal';
?>
<section class="<?php echo esc_attr( $section_class ); ?>">
	<div class="digitify-container">
		<div class="digitify-faq__shell">
			<div class="digitify-section__header digitify-section__header--compact">
				<span class="digitify-section__label"><?php esc_html_e( 'Veelgestelde vragen', 'digitify' ); ?></span>
				<h2><?php esc_html_e( 'FAQ', 'digitify' ); ?></h2>
			</div>
			<div class="digitify-faq__list">
				<?php foreach ( $faq as $i => $item ) : ?>
					<details class="digitify-faq__item">
						<summary class="digitify-faq__question">
							<span class="digitify-faq__index"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<?php echo esc_html( $item['q'] ); ?>
						</summary>
						<div class="digitify-faq__answer"><p><?php echo esc_html( $item['a'] ); ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
