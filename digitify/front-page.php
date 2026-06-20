<?php
/**
 * Front page template — Digitify home
 *
 * @package Digitify
 */

get_header();

$case_preview = digitify_get_featured_cases( 6 );
$services     = digitify_get_service_hub_cards();
$hero_media   = digitify_get_home_hero_media();
?>

<section class="digitify-hero digitify-hero--home digitify-hero--canvas digitify-hero--premium-home<?php echo ! empty( $hero_media['video'] ) ? ' digitify-hero--has-video' : ''; ?>">
	<?php digitify_render_home_hero_media(); ?>

	<div class="digitify-container digitify-hero__stage">
		<div class="digitify-hero__canvas-layout">
			<div class="digitify-hero__canvas-content">
				<p class="digitify-hero__eyebrow digitify-hero__eyebrow--minimal">
					<span><?php esc_html_e( '9000 Gent', 'digitify' ); ?></span>
					<span class="digitify-hero__eyebrow-dot" aria-hidden="true"></span>
					<span><?php esc_html_e( 'Digital agency', 'digitify' ); ?></span>
				</p>

				<h1 class="digitify-hero__canvas-title">
					<span class="digitify-hero__canvas-title__lead"><?php esc_html_e( 'Partner in', 'digitify' ); ?></span>
					<span class="digitify-hero__canvas-title__accent-row" aria-hidden="false">
						<span class="digitify-hero__canvas-title__accent digitify-hero__canvas-title__accent--gold"><?php esc_html_e( 'Digital', 'digitify' ); ?></span>
						<span class="digitify-hero__canvas-title__accent digitify-hero__canvas-title__accent--ink"><?php esc_html_e( 'Solutions', 'digitify' ); ?></span>
					</span>
				</h1>

				<p class="digitify-hero__canvas-lead"><?php esc_html_e( 'Webdesign, media en marketing die écht resultaat opleveren — van websites en videocontent tot digitale campagnes.', 'digitify' ); ?></p>

				<div class="digitify-hero__actions">
					<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm"><?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'diensten' ) ); ?>" class="digitify-btn digitify-btn--ghost digitify-btn--sm"><?php esc_html_e( 'Onze diensten', 'digitify' ); ?></a>
				</div>

				<p class="digitify-hero__meta digitify-hero__meta--disciplines">
					<a href="<?php echo esc_url( digitify_get_page_url( 'webdesign' ) ); ?>"><?php esc_html_e( 'Webdesign', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'media' ) ); ?>"><?php esc_html_e( 'Media', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'marketing' ) ); ?>"><?php esc_html_e( 'Marketing', 'digitify' ); ?></a>
				</p>
			</div>
		</div>
	</div>
</section>

<div class="digitify-home-marquee" aria-hidden="true">
	<div class="digitify-home-marquee__track">
		<span><?php esc_html_e( 'Webdesign', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Media', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Marketing', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Google Ads', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Videocontent', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Webdesign', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Media', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Marketing', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Google Ads', 'digitify' ); ?></span>
		<span><?php esc_html_e( 'Videocontent', 'digitify' ); ?></span>
	</div>
</div>

<section class="digitify-section digitify-section--tight digitify-home-process digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-home-process__shell">
			<div class="digitify-home-process__head">
				<span class="digitify-section__label"><?php esc_html_e( 'Onze aanpak', 'digitify' ); ?></span>
				<h2><?php esc_html_e( 'Van idee tot resultaat', 'digitify' ); ?></h2>
			</div>
			<div class="digitify-home-steps digitify-home-steps--signature">
				<div class="digitify-home-steps__item">
					<span class="digitify-home-steps__num">01</span>
					<h3><?php esc_html_e( 'Discover', 'digitify' ); ?></h3>
					<p><?php esc_html_e( 'Kennismaking en analyse van doelen, merk en doelgroep.', 'digitify' ); ?></p>
				</div>
				<div class="digitify-home-steps__item">
					<span class="digitify-home-steps__num">02</span>
					<h3><?php esc_html_e( 'Create', 'digitify' ); ?></h3>
					<p><?php esc_html_e( 'Concept, design, content en campagnes op maat.', 'digitify' ); ?></p>
				</div>
				<div class="digitify-home-steps__item">
					<span class="digitify-home-steps__num">03</span>
					<h3><?php esc_html_e( 'Optimize', 'digitify' ); ?></h3>
					<p><?php esc_html_e( 'Lancering, meten en bijsturen voor continue groei.', 'digitify' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--gray digitify-section--tight digitify-home-services digitify-home-services--manifest digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-home-services__layout">
			<aside class="digitify-home-services__rail">
				<span class="digitify-section__label digitify-home-services__label"><?php esc_html_e( 'Diensten', 'digitify' ); ?></span>
				<h2 class="digitify-home-services__title">
					<?php esc_html_e( 'Digitale', 'digitify' ); ?>
					<span><?php esc_html_e( 'oplossingen', 'digitify' ); ?></span>
				</h2>
				<p class="digitify-home-services__lead"><?php esc_html_e( 'Uitgebreide digitale oplossingen om uw bedrijf te laten groeien in het online landschap — webdesign, media en marketing onder één dak.', 'digitify' ); ?></p>
				<ul class="digitify-home-services__tags" aria-label="<?php esc_attr_e( 'Kenmerken', 'digitify' ); ?>">
					<li><?php esc_html_e( 'Webdesign', 'digitify' ); ?></li>
					<li><?php esc_html_e( 'Media', 'digitify' ); ?></li>
					<li><?php esc_html_e( 'Marketing', 'digitify' ); ?></li>
				</ul>
				<a href="<?php echo esc_url( digitify_get_page_url( 'diensten' ) ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm digitify-home-services__all"><?php esc_html_e( 'Alle diensten', 'digitify' ); ?></a>
				<img class="digitify-home-services__rail-logo" src="<?php echo esc_url( digitify_get_logo( 'white' ) ); ?>" alt="" loading="lazy" aria-hidden="true">
				<div class="digitify-home-services__rail-mark" aria-hidden="true">DIGITIFY</div>
			</aside>

			<div class="digitify-home-services__manifest">
				<?php foreach ( $services as $i => $card ) : ?>
					<a
						href="<?php echo esc_url( digitify_get_page_url( $card['slug'] ) ); ?>"
						class="digitify-service-row<?php echo 0 === $i ? ' digitify-service-row--featured' : ''; ?>"
						aria-label="<?php echo esc_attr( $card['title'] . ' — ' . __( 'Meer info', 'digitify' ) ); ?>"
					>
						<span class="digitify-service-row__num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<div class="digitify-service-row__media digitify-service-row__media--icon">
							<img src="<?php echo esc_url( digitify_get_image( digitify_get_service_element_image( $card['slug'] ) ) ); ?>" alt="" loading="lazy" width="240" height="240">
						</div>
						<div class="digitify-service-row__body">
							<?php if ( 0 === $i ) : ?>
								<span class="digitify-service-row__badge"><?php esc_html_e( 'Meest gevraagd', 'digitify' ); ?></span>
							<?php endif; ?>
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['desc'] ); ?></p>
						</div>
						<span class="digitify-service-row__arrow" aria-hidden="true">&rarr;</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--tight digitify-home-about--signature digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-home-about">
			<div class="digitify-home-about__media">
				<img src="<?php echo esc_url( digitify_get_image( 'case-digitify.png' ) ); ?>" alt="<?php esc_attr_e( 'Digitify Gent', 'digitify' ); ?>" loading="lazy" width="700" height="520">
				<div class="digitify-home-about__stamp">
					<strong>40+</strong>
					<span><?php esc_html_e( 'Projecten', 'digitify' ); ?></span>
				</div>
			</div>
			<div class="digitify-home-about__content">
				<span class="digitify-section__label"><?php esc_html_e( 'Over ons', 'digitify' ); ?></span>
				<h2><?php esc_html_e( 'De digitale kracht achter uw bedrijf', 'digitify' ); ?></h2>
				<p><?php esc_html_e( 'Bij Digitify combineren we strategisch webdesign, krachtige contentcreatie en resultaatgerichte marketing. Geen standaardpakketten, maar digitale strategieën op maat.', 'digitify' ); ?></p>
				<ul class="digitify-home-about__list">
					<li><?php echo digitify_svg_icon( 'globe' ); ?> <?php esc_html_e( 'Webdesign op maat', 'digitify' ); ?></li>
					<li><?php echo digitify_svg_icon( 'bolt' ); ?> <?php esc_html_e( 'Video & fotocontent', 'digitify' ); ?></li>
					<li><?php echo digitify_svg_icon( 'shield' ); ?> <?php esc_html_e( 'Marketing met meetbaar resultaat', 'digitify' ); ?></li>
				</ul>
				<a href="<?php echo esc_url( digitify_get_page_url( 'over-ons' ) ); ?>" class="digitify-btn digitify-btn--outline digitify-btn--sm"><?php esc_html_e( 'Over Digitify', 'digitify' ); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--gray digitify-section--tight digitify-home-cases digitify-home-cases--signature digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-home-cases__shell">
			<div class="digitify-section__header digitify-section__header--compact digitify-section__header--left">
				<div>
					<span class="digitify-section__label"><?php esc_html_e( 'Cases', 'digitify' ); ?></span>
					<h2><?php esc_html_e( 'Projecten waar we trots op zijn', 'digitify' ); ?></h2>
				</div>
				<a href="<?php echo esc_url( digitify_get_page_url( 'cases' ) ); ?>" class="digitify-link-arrow"><?php esc_html_e( 'Alle cases', 'digitify' ); ?> &rarr;</a>
			</div>
			<div class="digitify-home-fleet-scroller">
				<div class="digitify-home-fleet" tabindex="0" role="region" aria-label="<?php esc_attr_e( 'Cases preview', 'digitify' ); ?>">
					<?php foreach ( $case_preview as $index => $item ) : ?>
						<a
							href="<?php echo esc_url( digitify_get_case_url( $item['slug'] ) ); ?>"
							class="digitify-home-fleet__item"
							aria-label="<?php echo esc_attr( $item['label'] . ' — ' . $item['ton'] ); ?>"
						>
							<span class="digitify-home-fleet__index"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<img src="<?php echo esc_url( digitify_get_image( $item['img'] ) ); ?>" alt="" loading="lazy" width="400" height="260">
							<div class="digitify-home-fleet__overlay" aria-hidden="true"></div>
							<div class="digitify-home-fleet__caption">
								<span class="digitify-home-fleet__label"><?php echo esc_html( $item['label'] ); ?></span>
								<span class="digitify-home-fleet__ton"><?php echo esc_html( $item['ton'] ); ?></span>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--tight digitify-home-cta digitify-home-cta--signature digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-home-cta__inner">
			<div class="digitify-home-cta__copy">
				<span class="digitify-section__label"><?php esc_html_e( 'Samenwerken', 'digitify' ); ?></span>
				<h2><?php esc_html_e( 'Elk project begint met een gesprek', 'digitify' ); ?></h2>
				<p><?php esc_html_e( 'Geen standaardpakketten — wel een heldere offerte op maat van uw doelen en budget.', 'digitify' ); ?></p>
			</div>
			<div class="digitify-home-cta__actions">
				<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm"><?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?></a>
				<a href="tel:+32486515773" class="digitify-btn digitify-btn--outline digitify-btn--sm"><?php esc_html_e( 'Bel ons', 'digitify' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
