<?php
/**
 * Main template
 *
 * @package Digitify
 */

get_header();
?>

<div class="digitify-page-header">
	<div class="digitify-container">
		<h1><?php esc_html_e( 'Blog', 'digitify' ); ?></h1>
	</div>
</div>

<section class="digitify-section">
	<div class="digitify-container digitify-content__inner">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'digitify-card' ); ?> style="margin-bottom:24px;">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="digitify-btn digitify-btn--outline digitify-btn--sm"><?php esc_html_e( 'Lees meer', 'digitify' ); ?></a>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Geen berichten gevonden.', 'digitify' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
