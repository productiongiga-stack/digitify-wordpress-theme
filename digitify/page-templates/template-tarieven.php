<?php
/**
 * Template Name: Tarieven
 *
 * @package Digitify
 */

get_header();

get_template_part( 'template-parts/page-header', null, array(
	'title'    => __( 'Transparante tarieven', 'digitify' ),
	'subtitle' => __( 'Indicatieve prijzen voor webdesign, marketing en media — offerte op maat na kennismaking.', 'digitify' ),
) );
?>

<section class="digitify-section digitify-section--tight digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-section__header digitify-section__header--compact">
			<span class="digitify-section__label"><?php esc_html_e( 'Webdesign', 'digitify' ); ?></span>
			<h2><?php esc_html_e( 'Websites op maat', 'digitify' ); ?></h2>
		</div>
		<div class="digitify-grid digitify-grid--4">
			<div class="digitify-pricing-card">
				<div class="digitify-pricing-card__name"><?php esc_html_e( 'Onepage website', 'digitify' ); ?></div>
				<?php digitify_render_price( '850', __( 'project', 'digitify' ) ); ?>
				<p class="digitify-pricing-card__desc"><?php esc_html_e( 'Ideaal voor freelancers en kleine bedrijven.', 'digitify' ); ?></p>
				<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--outline"><?php esc_html_e( 'Offerte', 'digitify' ); ?></a>
			</div>
			<div class="digitify-pricing-card digitify-pricing-card--featured">
				<span class="digitify-pricing-card__badge"><?php esc_html_e( 'Meest gekozen', 'digitify' ); ?></span>
				<div class="digitify-pricing-card__name"><?php esc_html_e( 'Multipage website', 'digitify' ); ?></div>
				<?php digitify_render_price( '1650', __( 'project', 'digitify' ) ); ?>
				<p class="digitify-pricing-card__desc"><?php esc_html_e( 'Meerdere pagina\'s, SEO en professionele uitstraling.', 'digitify' ); ?></p>
				<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--primary"><?php esc_html_e( 'Start project', 'digitify' ); ?></a>
			</div>
			<div class="digitify-pricing-card">
				<div class="digitify-pricing-card__name"><?php esc_html_e( 'Simpele webshop', 'digitify' ); ?></div>
				<?php digitify_render_price( '1250', __( 'project', 'digitify' ) ); ?>
				<p class="digitify-pricing-card__desc"><?php esc_html_e( 'Compacte webshop voor een beperkt aanbod.', 'digitify' ); ?></p>
				<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--outline"><?php esc_html_e( 'Offerte', 'digitify' ); ?></a>
			</div>
			<div class="digitify-pricing-card">
				<div class="digitify-pricing-card__name"><?php esc_html_e( 'Full webshop', 'digitify' ); ?></div>
				<?php digitify_render_price( '2250', __( 'project', 'digitify' ) ); ?>
				<p class="digitify-pricing-card__desc"><?php esc_html_e( 'Volwaardige webshop, klaar voor groei.', 'digitify' ); ?></p>
				<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--outline"><?php esc_html_e( 'Offerte', 'digitify' ); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--gray digitify-section--tight digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-section__header digitify-section__header--compact">
			<span class="digitify-section__label"><?php esc_html_e( 'Marketing', 'digitify' ); ?></span>
			<h2><?php esc_html_e( 'Campagnes & drukwerk', 'digitify' ); ?></h2>
		</div>
		<div class="digitify-grid digitify-grid--3">
			<div class="digitify-pricing-card">
				<div class="digitify-pricing-card__name"><?php esc_html_e( 'Google Ads', 'digitify' ); ?></div>
				<?php digitify_render_price( '350', __( 'maand', 'digitify' ) ); ?>
				<p class="digitify-pricing-card__desc"><?php esc_html_e( 'Zoekcampagnes, remarketing en conversietracking.', 'digitify' ); ?></p>
			</div>
			<div class="digitify-pricing-card digitify-pricing-card--featured">
				<div class="digitify-pricing-card__name"><?php esc_html_e( 'Meta Ads', 'digitify' ); ?></div>
				<?php digitify_render_price( '350', __( 'maand', 'digitify' ) ); ?>
				<p class="digitify-pricing-card__desc"><?php esc_html_e( 'Leadgeneratie, retargeting en advertentiecreatie.', 'digitify' ); ?></p>
			</div>
			<div class="digitify-pricing-card">
				<div class="digitify-pricing-card__name"><?php esc_html_e( 'Drukwerk', 'digitify' ); ?></div>
				<?php digitify_render_price( '100', __( 'project', 'digitify' ) ); ?>
				<p class="digitify-pricing-card__desc"><?php esc_html_e( 'Flyers, visitekaartjes, posters en brochures.', 'digitify' ); ?></p>
			</div>
		</div>
		<p class="digitify-section__note"><?php esc_html_e( 'Alle prijzen exclusief btw. Advertentiebudget niet inbegrepen.', 'digitify' ); ?></p>
	</div>
</section>

<?php get_template_part( 'template-parts/faq-section', null, array( 'slug' => 'tarieven' ) ); ?>

<?php get_footer(); ?>
