<?php
/**
 * Page header template part
 *
 * @package Digitify
 *
 * Args: title, subtitle, image (optional), size (default|large|compact)
 */

$title    = isset( $args['title'] ) ? $args['title'] : get_the_title();
$subtitle = isset( $args['subtitle'] ) ? $args['subtitle'] : '';
$image    = isset( $args['image'] ) ? $args['image'] : '';
$size     = isset( $args['size'] ) ? $args['size'] : 'default';
$modifier = isset( $args['modifier'] ) ? $args['modifier'] : '';
$bar_class = 'digitify-page-header__bar';
if ( ! $subtitle ) {
	$bar_class .= ' digitify-page-header__bar--solo';
}
?>
<header class="digitify-page-header digitify-page-header--light digitify-page-header--<?php echo esc_attr( $size ); ?><?php echo $modifier ? ' digitify-page-header--' . esc_attr( $modifier ) : ''; ?><?php echo $image ? ' digitify-page-header--has-bg' : ''; ?>">
	<?php if ( $image ) : ?>
		<div class="digitify-page-header__bg" aria-hidden="true">
			<img src="<?php echo esc_url( digitify_get_image( $image ) ); ?>" alt="" loading="lazy" fetchpriority="low" decoding="async" width="1920" height="480">
			<div class="digitify-page-header__overlay"></div>
		</div>
	<?php endif; ?>
	<div class="digitify-container digitify-page-header__inner">
		<?php get_template_part( 'template-parts/breadcrumb' ); ?>
		<div class="<?php echo esc_attr( $bar_class ); ?>" data-page-title="<?php echo esc_attr( $title ); ?>">
			<div class="digitify-page-header__lead">
				<h1 class="digitify-page-header__title">
					<span class="digitify-page-header__title-text"><?php echo esc_html( $title ); ?></span>
				</h1>
			</div>
			<?php if ( $subtitle ) : ?>
				<p class="digitify-page-header__subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</header>
