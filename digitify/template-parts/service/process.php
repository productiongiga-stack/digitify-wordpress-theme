<?php
/**
 * Service process section — unified layout
 *
 * @package Digitify
 *
 * Args: service, slug
 */

$service = isset( $args['service'] ) ? $args['service'] : null;

if ( ! $service || empty( $service['steps'] ) ) {
	return;
}

$title = isset( $service['process_title'] ) ? $service['process_title'] : __( 'In 4 stappen', 'digitify' );
$lead  = isset( $service['process_lead'] ) ? $service['process_lead'] : __( 'Kort en duidelijk — van aanvraag tot levering.', 'digitify' );
?>
<section class="digitify-section digitify-section--gray digitify-section--tight digitify-service-process digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-service-process__head">
			<span class="digitify-section__label"><?php esc_html_e( 'Proces', 'digitify' ); ?></span>
			<h2><?php echo esc_html( $title ); ?></h2>
			<p><?php echo esc_html( $lead ); ?></p>
		</div>
		<div class="digitify-service-steps">
			<?php foreach ( $service['steps'] as $i => $step ) : ?>
				<div class="digitify-service-steps__step">
					<span class="digitify-service-steps__dot"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<div class="digitify-service-steps__body">
						<h3><?php echo esc_html( $step[0] ); ?></h3>
						<p><?php echo esc_html( $step[1] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
