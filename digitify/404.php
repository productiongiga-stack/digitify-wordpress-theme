<?php
/**
 * 404 template
 *
 * @package Digitify
 */

get_header();
?>

<div class="digitify-404">
	<div>
		<h1>404</h1>
		<h2><?php esc_html_e( 'Pagina niet gevonden', 'digitify' ); ?></h2>
		<p><?php esc_html_e( 'De pagina die u zoekt bestaat niet of is verplaatst.', 'digitify' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="digitify-btn digitify-btn--primary"><?php esc_html_e( 'Terug naar home', 'digitify' ); ?></a>
	</div>
</div>

<?php get_footer(); ?>
