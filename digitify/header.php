<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="digitify-ambient" aria-hidden="true">
	<div class="digitify-ambient__mesh"></div>
	<div class="digitify-ambient__orbs">
		<span class="digitify-ambient__orb digitify-ambient__orb--a"></span>
		<span class="digitify-ambient__orb digitify-ambient__orb--b"></span>
		<span class="digitify-ambient__orb digitify-ambient__orb--c"></span>
	</div>
	<div class="digitify-ambient__sun"></div>
	<div class="digitify-ambient__sweep"></div>
	<div class="digitify-ambient__glow"></div>
</div>

<a class="digitify-skip-link" href="#digitify-main-content"><?php esc_html_e( 'Naar inhoud', 'digitify' ); ?></a>

<div class="digitify-site-header">
	<header class="digitify-header digitify-header--deck" role="banner">
		<div class="digitify-header__rail" aria-hidden="true">
			<span class="digitify-header__rail-accent"></span>
		</div>

		<div class="digitify-header__shell">
			<div class="digitify-header__grid">
				<div class="digitify-header__start">
					<div class="digitify-header__brand">
						<?php get_template_part( 'template-parts/logo', null, array( 'variant' => 'header' ) ); ?>
					</div>
					<p class="digitify-header__tag"><?php echo esc_html( digitify_get_brand_slogan() ); ?></p>
				</div>

				<nav class="digitify-header__nav digitify-nav" role="navigation" aria-label="<?php esc_attr_e( 'Hoofdnavigatie', 'digitify' ); ?>">
					<?php digitify_render_primary_nav(); ?>
				</nav>

				<div class="digitify-header__end">
					<div class="digitify-header__contact" aria-label="<?php esc_attr_e( 'Snel contact', 'digitify' ); ?>">
						<a href="tel:+32486515773" class="digitify-header__contact-btn" aria-label="<?php esc_attr_e( 'Bel ons', 'digitify' ); ?>">
							<?php echo digitify_svg_icon( 'phone' ); ?>
						</a>
						<a href="mailto:contact@digitify.be" class="digitify-header__contact-btn" aria-label="<?php esc_attr_e( 'Mail ons', 'digitify' ); ?>">
							<?php echo digitify_svg_icon( 'mail' ); ?>
						</a>
						<a href="https://wa.me/32486515773" class="digitify-header__contact-btn digitify-header__contact-btn--wa" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
							<?php echo digitify_svg_icon( 'whatsapp' ); ?>
						</a>
					</div>
					<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-header__cta">
						<span class="digitify-header__cta-label"><?php esc_html_e( 'Offerte', 'digitify' ); ?></span>
						<span class="digitify-header__cta-icon" aria-hidden="true">&rarr;</span>
					</a>
					<button class="digitify-menu-toggle" type="button" aria-label="<?php esc_attr_e( 'Menu openen', 'digitify' ); ?>" aria-expanded="false" aria-controls="digitify-mobile-nav">
						<span></span><span></span><span></span>
					</button>
				</div>
			</div>
		</div>

		<div class="digitify-header__progress" aria-hidden="true"><span></span></div>
	</header>
</div>

<div class="digitify-mobile-nav digitify-mobile-nav--atelier" id="digitify-mobile-nav" aria-hidden="true">
	<div class="digitify-mobile-nav__overlay"></div>
	<div class="digitify-mobile-nav__panel">
		<div class="digitify-mobile-nav__head">
			<div class="digitify-header__brand digitify-header__brand--mobile">
				<?php get_template_part( 'template-parts/logo', null, array( 'variant' => 'header' ) ); ?>
			</div>
			<button class="digitify-mobile-nav__close" type="button" aria-label="<?php esc_attr_e( 'Menu sluiten', 'digitify' ); ?>">&times;</button>
		</div>
		<p class="digitify-mobile-nav__meta">
			<span><?php esc_html_e( '9000 Gent', 'digitify' ); ?></span>
			<span class="digitify-mobile-nav__meta-dot" aria-hidden="true"></span>
			<span><?php esc_html_e( 'Digital agency', 'digitify' ); ?></span>
		</p>
		<div class="digitify-mobile-nav__scroll">
			<nav class="digitify-mobile-nav__links" aria-label="<?php esc_attr_e( 'Mobiel menu', 'digitify' ); ?>">
				<div class="digitify-mobile-nav__primary">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="digitify-mobile-nav__link<?php echo digitify_is_current( 'home' ) ? ' is-active' : ''; ?>"><?php esc_html_e( 'Home', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'over-ons' ) ); ?>" class="digitify-mobile-nav__link<?php echo digitify_is_current( 'over-ons' ) ? ' is-active' : ''; ?>"><?php esc_html_e( 'Over ons', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-mobile-nav__link<?php echo digitify_is_current( 'contact' ) ? ' is-active' : ''; ?>"><?php esc_html_e( 'Contact', 'digitify' ); ?></a>
				</div>

				<div class="digitify-mobile-nav__group<?php echo digitify_is_service_section() ? ' is-active' : ''; ?>">
					<div class="digitify-mobile-nav__group-head">
						<span class="digitify-mobile-nav__group-label"><?php esc_html_e( 'Diensten', 'digitify' ); ?></span>
						<a href="<?php echo esc_url( digitify_get_page_url( 'diensten' ) ); ?>" class="digitify-mobile-nav__group-title<?php echo digitify_is_current( 'diensten' ) ? ' is-active' : ''; ?>"><?php esc_html_e( 'Alle diensten', 'digitify' ); ?></a>
					</div>
					<div class="digitify-mobile-nav__chips">
						<?php foreach ( digitify_get_service_nav_children() as $child ) : ?>
							<a href="<?php echo esc_url( $child['url'] ); ?>" class="digitify-mobile-nav__chip<?php echo digitify_is_current( $child['slug'] ) ? ' is-active' : ''; ?>"><?php echo esc_html( $child['label'] ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="digitify-mobile-nav__group<?php echo digitify_is_fleet_section() ? ' is-active' : ''; ?>">
					<div class="digitify-mobile-nav__group-head">
						<span class="digitify-mobile-nav__group-label"><?php esc_html_e( 'Cases', 'digitify' ); ?></span>
						<a href="<?php echo esc_url( digitify_get_page_url( 'cases' ) ); ?>" class="digitify-mobile-nav__group-title<?php echo digitify_is_current( 'cases' ) ? ' is-active' : ''; ?>"><?php esc_html_e( 'Alle projecten', 'digitify' ); ?></a>
					</div>
					<div class="digitify-mobile-nav__chips">
						<?php foreach ( digitify_get_cases_nav_children() as $child ) : ?>
							<?php if ( 'cases' === $child['slug'] ) { continue; } ?>
							<a href="<?php echo esc_url( $child['url'] ); ?>" class="digitify-mobile-nav__chip<?php echo digitify_is_current( $child['slug'] ) ? ' is-active' : ''; ?>"><?php echo esc_html( $child['label'] ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</nav>

			<div class="digitify-mobile-nav__reach">
				<span class="digitify-mobile-nav__group-label"><?php esc_html_e( 'Direct bereikbaar', 'digitify' ); ?></span>
				<div class="digitify-mobile-nav__contact">
					<a href="tel:+32486515773" class="digitify-mobile-nav__contact-card">
						<span class="digitify-mobile-nav__contact-icon"><?php echo digitify_svg_icon( 'phone' ); ?></span>
						<span class="digitify-mobile-nav__contact-copy">
							<strong><?php esc_html_e( 'Bel direct', 'digitify' ); ?></strong>
							<span>+32 486 51 57 73</span>
						</span>
					</a>
					<a href="mailto:contact@digitify.be" class="digitify-mobile-nav__contact-card">
						<span class="digitify-mobile-nav__contact-icon"><?php echo digitify_svg_icon( 'mail' ); ?></span>
						<span class="digitify-mobile-nav__contact-copy">
							<strong><?php esc_html_e( 'E-mail', 'digitify' ); ?></strong>
							<span>contact@digitify.be</span>
						</span>
					</a>
					<a href="https://wa.me/32486515773" class="digitify-mobile-nav__contact-card digitify-mobile-nav__contact-card--wa" target="_blank" rel="noopener noreferrer">
						<span class="digitify-mobile-nav__contact-icon"><?php echo digitify_svg_icon( 'whatsapp' ); ?></span>
						<span class="digitify-mobile-nav__contact-copy">
							<strong>WhatsApp</strong>
							<span><?php esc_html_e( 'Chat met ons', 'digitify' ); ?></span>
						</span>
					</a>
				</div>
			</div>
		</div>
		<div class="digitify-mobile-nav__footer">
			<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm digitify-mobile-nav__cta"><?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?></a>
			<p class="digitify-mobile-nav__footnote"><?php esc_html_e( 'Reactie binnen 24 uur', 'digitify' ); ?></p>
		</div>
	</div>
</div>

<main class="digitify-main" id="digitify-main-content">
