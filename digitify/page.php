<?php
/**
 * Default page template
 *
 * @package Digitify
 */

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/page-header', null, array(
		'title' => get_the_title(),
	) );
	?>

<section class="digitify-content">
	<div class="digitify-container digitify-content__inner digitify-reveal">
		<?php the_content(); ?>
	</div>
</section>

	<?php
endwhile;

get_footer();
