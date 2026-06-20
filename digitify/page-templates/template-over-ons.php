<?php
/**
 * Template Name: Over ons
 *
 * @package Digitify
 */

get_header();

get_template_part( 'template-parts/page-header', null, array(
	'title'    => __( 'Over Digitify', 'digitify' ),
	'subtitle' => __( 'De digitale kracht achter uw bedrijf.', 'digitify' ),
	'image'    => 'hero-marketing.png',
) );
?>

<section class="digitify-section digitify-section--tight digitify-about-story digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-split digitify-split--compact digitify-split--story digitify-split--story-atelier">
			<div class="digitify-split-story__main">
				<div class="digitify-split__content digitify-content-shield">
					<span class="digitify-split-story__eyebrow"><?php esc_html_e( 'Onze visie', 'digitify' ); ?></span>
					<h2 class="digitify-split-story__title">
						<?php esc_html_e( 'Groei sneller met', 'digitify' ); ?>
						<span class="digitify-split-story__title-accent"><?php esc_html_e( 'slimme digitale oplossingen', 'digitify' ); ?></span>
					</h2>
					<p><?php esc_html_e( 'Bij Digitify geloven we dat digitale groei begint met een sterke online fundering. Daarom combineren we strategisch webdesign, krachtige contentcreatie en resultaatgerichte marketing in één geheel. Wij helpen bedrijven zichtbaar worden, opvallen en groeien in een steeds competitievere digitale wereld.', 'digitify' ); ?></p>
					<ul class="digitify-split-story__disciplines" aria-label="<?php esc_attr_e( 'Diensten', 'digitify' ); ?>">
						<li><?php esc_html_e( 'Webdesign', 'digitify' ); ?></li>
						<li><?php esc_html_e( 'Media', 'digitify' ); ?></li>
						<li><?php esc_html_e( 'Marketing', 'digitify' ); ?></li>
					</ul>
				</div>
				<div class="digitify-split-story__media">
					<figure class="digitify-split-story__figure">
						<img src="<?php echo esc_url( digitify_get_image( 'case-digitify.png' ) ); ?>" alt="<?php esc_attr_e( 'Digitify team Gent', 'digitify' ); ?>" loading="lazy" width="560" height="320">
					</figure>
					<span class="digitify-split-story__badge"><?php esc_html_e( '40+ projecten', 'digitify' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--gray digitify-section--tight digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-section__header digitify-section__header--compact">
			<span class="digitify-section__label"><?php esc_html_e( 'Proces', 'digitify' ); ?></span>
			<h2><?php esc_html_e( 'Onze aanpak', 'digitify' ); ?></h2>
		</div>
		<div class="digitify-timeline">
			<div class="digitify-timeline__item">
				<div class="digitify-timeline__year">01</div>
				<h3><?php esc_html_e( 'Discover', 'digitify' ); ?></h3>
				<p><?php esc_html_e( 'Kennismaking en analyse van doelen in webdesign, media en marketing.', 'digitify' ); ?></p>
			</div>
			<div class="digitify-timeline__item">
				<div class="digitify-timeline__year">02</div>
				<h3><?php esc_html_e( 'Create', 'digitify' ); ?></h3>
				<p><?php esc_html_e( 'Concept, structuur, design, content en campagnes op maat van uw merk.', 'digitify' ); ?></p>
			</div>
			<div class="digitify-timeline__item">
				<div class="digitify-timeline__year">03</div>
				<h3><?php esc_html_e( 'Build & Launch', 'digitify' ); ?></h3>
				<p><?php esc_html_e( 'Website, visuals, video en marketingacties werken als één geheel.', 'digitify' ); ?></p>
			</div>
			<div class="digitify-timeline__item">
				<div class="digitify-timeline__year">04</div>
				<h3><?php esc_html_e( 'Optimize & Grow', 'digitify' ); ?></h3>
				<p><?php esc_html_e( 'Meten, bijsturen en schalen waar het werkt voor continue groei.', 'digitify' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--tight digitify-about-team digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-team digitify-team--atelier">
			<div class="digitify-team__intro">
				<span class="digitify-team__eyebrow"><?php esc_html_e( 'Team', 'digitify' ); ?></span>
				<h2>
					<span class="digitify-team__title-line digitify-team__title-line--lead"><?php esc_html_e( 'Maak kennis met', 'digitify' ); ?></span>
					<span class="digitify-team__title-line">
						<?php esc_html_e( 'het team achter', 'digitify' ); ?>
						<span class="digitify-team__title-accent"><?php esc_html_e( 'Digitify', 'digitify' ); ?></span>
					</span>
				</h2>
				<p><?php esc_html_e( 'We zijn een klein, efficiënt team van designers, developers, mediacreators en marketeers. Dankzij korte lijnen en strakke samenwerking zetten we ideeën snel om in sterke digitale resultaten.', 'digitify' ); ?></p>
			</div>
			<div class="digitify-team__grid">
				<article class="digitify-team-card digitify-team-card--featured digitify-team-card--stacked">
					<figure class="digitify-team-card__figure">
						<img src="<?php echo esc_url( digitify_get_image( 'team-klim-gaikalov.png' ) ); ?>" alt="<?php esc_attr_e( 'Klim Gaikalov — Creative Director Digitify', 'digitify' ); ?>" loading="lazy" width="800" height="800">
					</figure>
					<div class="digitify-team-card__body">
						<span class="digitify-team-card__num" aria-hidden="true">01</span>
						<div class="digitify-team-card__head">
							<p class="digitify-team-card__role"><?php esc_html_e( 'Creative Director', 'digitify' ); ?></p>
							<h3><?php esc_html_e( 'Klim Gaikalov', 'digitify' ); ?></h3>
						</div>
						<p class="digitify-team-card__stat"><?php esc_html_e( '13+ jaar · Media', 'digitify' ); ?></p>
						<p class="digitify-team-card__bio"><?php esc_html_e( 'Verantwoordelijk voor strategie, design en de creatieve richting achter elk Digitify-project — van webdesign tot media en marketing. Met meer dan 13 jaar ervaring in media vertaalt hij ideeën naar sterke visuele content.', 'digitify' ); ?></p>
						<ul class="digitify-team-card__tags" aria-label="<?php esc_attr_e( 'Expertise', 'digitify' ); ?>">
							<li><?php esc_html_e( 'Webdesign', 'digitify' ); ?></li>
							<li><?php esc_html_e( 'Media', 'digitify' ); ?></li>
							<li><?php esc_html_e( 'Marketing', 'digitify' ); ?></li>
						</ul>
						<div class="digitify-team-card__foot">
							<div class="digitify-team-card__social">
								<a href="https://www.instagram.com/digitify.be/" class="digitify-social-btn digitify-social-btn--instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><?php echo digitify_svg_icon( 'instagram' ); ?></a>
								<a href="https://www.facebook.com/digitify.be" class="digitify-social-btn digitify-social-btn--facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><?php echo digitify_svg_icon( 'facebook' ); ?></a>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--tight digitify-about-values digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-values digitify-values--manifest digitify-values--atelier">
			<aside class="digitify-values__rail">
				<span class="digitify-values__eyebrow"><?php esc_html_e( 'Waarom Digitify', 'digitify' ); ?></span>
				<h2 class="digitify-values__title"><?php esc_html_e( 'Eén partner voor alles digitaal', 'digitify' ); ?></h2>
				<p class="digitify-values__motto"><?php esc_html_e( 'Webdesign · Media · Marketing', 'digitify' ); ?></p>
			</aside>

			<div class="digitify-values__grid">
				<div class="digitify-values__cell digitify-values__cell--featured">
					<span class="digitify-values__num">01</span>
					<span class="digitify-values__icon"><?php echo digitify_svg_icon( 'globe' ); ?></span>
					<div class="digitify-values__body">
						<h3><?php esc_html_e( 'Webdesign', 'digitify' ); ?></h3>
						<p><?php esc_html_e( 'Websites die converteren en perfect aansluiten bij uw merk.', 'digitify' ); ?></p>
					</div>
				</div>
				<div class="digitify-values__cell">
					<span class="digitify-values__num">02</span>
					<span class="digitify-values__icon"><?php echo digitify_svg_icon( 'bolt' ); ?></span>
					<div class="digitify-values__body">
						<h3><?php esc_html_e( 'Media', 'digitify' ); ?></h3>
						<p><?php esc_html_e( 'Video- en fotocontent die opvalt en blijft hangen.', 'digitify' ); ?></p>
					</div>
				</div>
				<div class="digitify-values__cell">
					<span class="digitify-values__num">03</span>
					<span class="digitify-values__icon"><?php echo digitify_svg_icon( 'shield' ); ?></span>
					<div class="digitify-values__body">
						<h3><?php esc_html_e( 'Marketing', 'digitify' ); ?></h3>
						<p><?php esc_html_e( 'Campagnes met meetbare resultaten en transparante rapportage.', 'digitify' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
