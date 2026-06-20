</main>

<footer class="digitify-footer digitify-footer--light-premium digitify-footer--atelier" role="contentinfo">
	<div class="digitify-footer__top-rail" aria-hidden="true"><span></span></div>

	<div class="digitify-footer__closing">
		<div class="digitify-footer__cta digitify-footer__cta--band">
			<div class="digitify-footer__cta-accent-rail" aria-hidden="true"><span></span></div>
			<div class="digitify-footer__cta-band">
				<div class="digitify-footer__cta-copy">
					<span class="digitify-footer__cta-eyebrow"><?php esc_html_e( 'Klaar om te groeien?', 'digitify' ); ?></span>
					<h2>
						<?php esc_html_e( 'Start uw digitale project', 'digitify' ); ?>
						<span class="digitify-footer__cta-highlight"><?php esc_html_e( 'vandaag', 'digitify' ); ?></span>
					</h2>
					<p><?php esc_html_e( 'Vertel ons over uw plannen — wij reageren binnen 24 uur met concrete tips.', 'digitify' ); ?></p>
				</div>
				<div class="digitify-footer__cta-actions digitify-footer__cta-actions--band">
					<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--primary digitify-footer__cta-primary">
						<?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?>
						<span class="digitify-footer__cta-primary-icon" aria-hidden="true">&rarr;</span>
					</a>
					<p class="digitify-footer__cta-trust"><?php esc_html_e( '24u reactie', 'digitify' ); ?> · <?php esc_html_e( 'Gratis kennismaking', 'digitify' ); ?> · <?php esc_html_e( 'Gent & remote', 'digitify' ); ?></p>
					<div class="digitify-footer__cta-quick">
						<a href="tel:+32486515773"><?php echo digitify_svg_icon( 'phone' ); ?> <?php esc_html_e( 'Bel ons', 'digitify' ); ?></a>
						<a href="https://wa.me/32486515773" class="digitify-footer__cta-quick--wa" target="_blank" rel="noopener noreferrer"><?php echo digitify_svg_icon( 'whatsapp' ); ?> WhatsApp</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="digitify-footer__container">
		<div class="digitify-footer__studio">
			<div class="digitify-footer__studio-inner">
				<div class="digitify-footer__brand digitify-footer__brand-hero">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="digitify-footer__logo-link" aria-label="<?php esc_attr_e( 'Digitify — Home', 'digitify' ); ?>">
						<img class="digitify-footer__logo-main" src="<?php echo esc_url( digitify_get_logo( 'black' ) ); ?>" alt="Digitify" width="200" height="56" loading="lazy" decoding="async">
					</a>
					<p class="digitify-footer__tagline"><span><?php echo esc_html( digitify_get_brand_slogan() ); ?></span></p>
					<p class="digitify-footer__brand-note"><?php esc_html_e( 'Webdesign, media & marketing voor groeiende merken.', 'digitify' ); ?></p>
					<div class="digitify-footer__disciplines">
						<span><?php esc_html_e( 'Webdesign', 'digitify' ); ?></span>
						<span><?php esc_html_e( 'Media', 'digitify' ); ?></span>
						<span><?php esc_html_e( 'Marketing', 'digitify' ); ?></span>
					</div>
					<div class="digitify-footer__social">
						<a href="https://www.facebook.com/digitify.be" class="digitify-social-btn digitify-social-btn--facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><?php echo digitify_svg_icon( 'facebook' ); ?></a>
						<a href="https://www.instagram.com/digitify.be/" class="digitify-social-btn digitify-social-btn--instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><?php echo digitify_svg_icon( 'instagram' ); ?></a>
					</div>
				</div>

				<div class="digitify-footer__grid">
					<nav class="digitify-footer__col digitify-footer__col--nav" aria-label="<?php esc_attr_e( 'Footer navigatie', 'digitify' ); ?>">
						<span class="digitify-footer__col-label"><?php esc_html_e( 'Navigatie', 'digitify' ); ?></span>
						<ul class="digitify-footer__links digitify-footer__links--numbered">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'digitify' ); ?></a></li>
							<li><a href="<?php echo esc_url( digitify_get_page_url( 'diensten' ) ); ?>"><?php esc_html_e( 'Diensten', 'digitify' ); ?></a></li>
							<li><a href="<?php echo esc_url( digitify_get_page_url( 'cases' ) ); ?>"><?php esc_html_e( 'Cases', 'digitify' ); ?></a></li>
							<li><a href="<?php echo esc_url( digitify_get_page_url( 'over-ons' ) ); ?>"><?php esc_html_e( 'Over ons', 'digitify' ); ?></a></li>
							<li><a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'digitify' ); ?></a></li>
						</ul>
					</nav>

					<nav class="digitify-footer__col digitify-footer__col--services" aria-label="<?php esc_attr_e( 'Footer diensten', 'digitify' ); ?>">
						<span class="digitify-footer__col-label"><?php esc_html_e( 'Expertise', 'digitify' ); ?></span>
						<ul class="digitify-footer__links digitify-footer__links--numbered">
							<li><a href="<?php echo esc_url( digitify_get_page_url( 'webdesign' ) ); ?>"><?php esc_html_e( 'Websites & webshops', 'digitify' ); ?></a></li>
							<li><a href="<?php echo esc_url( digitify_get_page_url( 'media' ) ); ?>"><?php esc_html_e( 'Video & content', 'digitify' ); ?></a></li>
							<li><a href="<?php echo esc_url( digitify_get_page_url( 'marketing' ) ); ?>"><?php esc_html_e( 'Ads & campagnes', 'digitify' ); ?></a></li>
						</ul>
					</nav>

					<div class="digitify-footer__col digitify-footer__col--contact">
						<span class="digitify-footer__col-label"><?php esc_html_e( 'Contact', 'digitify' ); ?></span>
						<ul class="digitify-footer__links digitify-footer__links--contact">
							<li>
								<?php echo digitify_svg_icon( 'map' ); ?>
								<span>Boekweitstraat 7, 9000 Gent</span>
							</li>
							<li>
								<?php echo digitify_svg_icon( 'phone' ); ?>
								<a href="tel:+32486515773">+32 486 51 57 73</a>
							</li>
							<li>
								<?php echo digitify_svg_icon( 'mail' ); ?>
								<a href="mailto:contact@digitify.be">contact@digitify.be</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="digitify-footer__ticker" aria-hidden="true">
			<div class="digitify-footer__ticker-track">
				<span><?php esc_html_e( 'Webdesign', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Media', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Marketing', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Gent', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Digital Solutions', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Cases', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Webdesign', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Media', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Marketing', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Gent', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Digital Solutions', 'digitify' ); ?></span>
				<span><?php esc_html_e( 'Cases', 'digitify' ); ?></span>
			</div>
		</div>

		<div class="digitify-footer__rail">
			<div class="digitify-footer__rail-accent" aria-hidden="true"><span></span></div>
			<div class="digitify-footer__rail-inner">
				<p class="digitify-footer__copyright">
					&copy; 2026 <?php esc_html_e( 'Digitify', 'digitify' ); ?>
					<span class="digitify-footer__bar-dot" aria-hidden="true">&middot;</span>
					BE0685.556.507
				</p>
				<nav class="digitify-footer__legal" aria-label="<?php esc_attr_e( 'Juridische links', 'digitify' ); ?>">
					<a href="<?php echo esc_url( digitify_get_page_url( 'algemene-voorwaarden' ) ); ?>"><?php esc_html_e( 'Algemene Voorwaarden', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'cookiebeleid' ) ); ?>"><?php esc_html_e( 'Cookiebeleid', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'privacyverklaring' ) ); ?>"><?php esc_html_e( 'Privacyverklaring', 'digitify' ); ?></a>
				</nav>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
