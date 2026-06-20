<?php
/**
 * Image media card template part
 *
 * @package Digitify
 *
 * Args: slug, title, desc, image, featured (bool), tag (optional)
 */

$slug     = isset( $args['slug'] ) ? $args['slug'] : '';
$title    = isset( $args['title'] ) ? $args['title'] : '';
$desc     = isset( $args['desc'] ) ? $args['desc'] : '';
$image    = isset( $args['image'] ) ? $args['image'] : '';
$featured = ! empty( $args['featured'] );
$variant  = isset( $args['variant'] ) ? $args['variant'] : 'photo';
$tag      = isset( $args['tag'] ) ? $args['tag'] : '';
$url      = $slug ? digitify_get_page_url( $slug ) : '#';
$class    = 'digitify-media-card';
$class   .= $featured ? ' digitify-media-card--featured' : '';
$class   .= 'icon' === $variant ? ' digitify-media-card--icon' : '';
?>
<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<div class="digitify-media-card__img">
		<img src="<?php echo esc_url( digitify_get_image( $image ) ); ?>" alt="<?php echo esc_attr( $title . ' — Digitify' ); ?>" loading="lazy" width="600" height="380">
		<?php if ( 'icon' !== $variant ) : ?>
		<div class="digitify-media-card__overlay"></div>
		<?php endif; ?>
		<?php if ( $tag ) : ?>
			<span class="digitify-media-card__tag"><?php echo esc_html( $tag ); ?></span>
		<?php endif; ?>
	</div>
	<div class="digitify-media-card__body">
		<h3><?php echo esc_html( $title ); ?></h3>
		<p><?php echo esc_html( $desc ); ?></p>
		<span class="digitify-media-card__arrow">&rarr;</span>
	</div>
</a>
