<?php
/**
 * Breadcrumb template part
 *
 * @package Digitify
 */

$crumbs = digitify_get_breadcrumbs();
if ( count( $crumbs ) <= 1 && is_front_page() ) {
	return;
}
?>
<nav class="digitify-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'digitify' ); ?>">
	<ol class="digitify-breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
		<?php foreach ( $crumbs as $i => $crumb ) : ?>
			<?php $is_last = ( $i === count( $crumbs ) - 1 ); ?>
			<li class="digitify-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<?php if ( ! $is_last ) : ?>
					<a href="<?php echo esc_url( $crumb['url'] ); ?>" itemprop="item"><span itemprop="name"><?php echo esc_html( $crumb['name'] ); ?></span></a>
				<?php else : ?>
					<span itemprop="name" aria-current="page"><?php echo esc_html( $crumb['name'] ); ?></span>
				<?php endif; ?>
				<meta itemprop="position" content="<?php echo esc_attr( $i + 1 ); ?>">
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
