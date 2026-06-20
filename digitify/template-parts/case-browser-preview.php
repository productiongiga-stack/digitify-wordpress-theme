<?php
/**
 * Fictive browser frame with live site iframe (webdesign cases).
 *
 * @package Digitify
 *
 * @var array<string, mixed> $args {
 *     @type array  $case  Normalized case row.
 *     @type string $size  hero|card|compact|section
 *     @type bool   $eager Load iframe immediately.
 * }
 */

$case = isset( $args['case'] ) ? $args['case'] : null;

if ( ! $case || ! digitify_case_has_browser_preview( $case ) ) {
	return;
}

$size  = isset( $args['size'] ) ? sanitize_key( $args['size'] ) : 'card';
$eager = ! empty( $args['eager'] );

if ( ! in_array( $size, array( 'hero', 'card', 'compact', 'section' ), true ) ) {
	$size = 'card';
}

$url      = digitify_get_case_client_website_url( $case );
$host     = digitify_get_case_browser_host( $url );
$fallback = digitify_get_image( $case['img'] );
$title    = isset( $case['title'] ) ? $case['title'] : '';
?>
<div class="digitify-browser-preview digitify-browser-preview--<?php echo esc_attr( $size ); ?>" data-browser-preview>
	<div class="digitify-browser-preview__chrome" aria-hidden="true">
		<div class="digitify-browser-preview__traffic">
			<span></span>
			<span></span>
			<span></span>
		</div>
		<div class="digitify-browser-preview__address">
			<span class="digitify-browser-preview__secure" aria-hidden="true"></span>
			<span class="digitify-browser-preview__host"><?php echo esc_html( $host ); ?></span>
		</div>
	</div>
	<div class="digitify-browser-preview__screen">
		<img
			class="digitify-browser-preview__fallback"
			src="<?php echo esc_url( $fallback ); ?>"
			alt="<?php echo esc_attr( $title . ' — ' . __( 'website preview', 'digitify' ) ); ?>"
			loading="<?php echo $eager ? 'eager' : 'lazy'; ?>"
			decoding="async"
		>
		<iframe
			class="digitify-browser-preview__frame"
			<?php if ( $eager ) : ?>
				src="<?php echo esc_url( $url ); ?>"
			<?php else : ?>
				data-src="<?php echo esc_url( $url ); ?>"
			<?php endif; ?>
			title="<?php echo esc_attr( $title . ' — ' . __( 'live website', 'digitify' ) ); ?>"
			loading="lazy"
			tabindex="-1"
			referrerpolicy="strict-origin-when-cross-origin"
			sandbox="allow-scripts allow-same-origin allow-popups allow-forms allow-popups-to-escape-sandbox"
		></iframe>
	</div>
</div>
