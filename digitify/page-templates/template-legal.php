<?php
/**
 * Template Name: Juridisch
 *
 * @package Digitify
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<?php
	get_template_part( 'template-parts/page-header', null, array(
		'title' => get_the_title(),
	) );
	?>

	<section class="digitify-content digitify-legal-layout digitify-section--tight">
		<div class="digitify-container">
			<aside class="digitify-legal-toc digitify-reveal">
				<h2><?php esc_html_e( 'Inhoud', 'digitify' ); ?></h2>
				<nav aria-label="<?php esc_attr_e( 'Inhoudsopgave', 'digitify' ); ?>">
					<ul class="digitify-legal-toc__list"></ul>
				</nav>
			</aside>
			<article class="digitify-content__inner digitify-legal-content digitify-reveal">
				<?php the_content(); ?>
			</article>
		</div>
	</section>

	<?php
endwhile;

get_footer();
