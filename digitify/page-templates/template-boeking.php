<?php
/**
 * Template Name: Contact
 *
 * @package Digitify
 */

get_header();

get_template_part( 'template-parts/page-header', null, array(
	'title'    => __( 'Contact', 'digitify' ),
	'subtitle' => __( 'Stuur ons een bericht — offerte, vraag of kennismaking.', 'digitify' ),
	'image'    => 'logo-black.png',
	'size'     => 'compact',
) );
?>

<div class="digitify-contact-bar digitify-reveal">
	<div class="digitify-container digitify-contact-bar__inner">
		<a href="tel:+32486515773" class="digitify-contact-bar__item digitify-contact-bar__item--primary">
			<span class="digitify-contact-bar__icon"><?php echo digitify_svg_icon( 'phone' ); ?></span>
			<span class="digitify-contact-bar__text">
				<small><?php esc_html_e( 'Bel direct', 'digitify' ); ?></small>
				<strong>+32 486 51 57 73</strong>
			</span>
		</a>
		<a href="mailto:contact@digitify.be" class="digitify-contact-bar__item">
			<span class="digitify-contact-bar__icon"><?php echo digitify_svg_icon( 'mail' ); ?></span>
			<span class="digitify-contact-bar__text">
				<small><?php esc_html_e( 'E-mail', 'digitify' ); ?></small>
				<strong>contact@digitify.be</strong>
			</span>
		</a>
		<a href="https://www.instagram.com/digitify.be/" class="digitify-contact-bar__item" target="_blank" rel="noopener noreferrer">
			<span class="digitify-contact-bar__icon"><?php echo digitify_svg_icon( 'instagram' ); ?></span>
			<span class="digitify-contact-bar__text">
				<small><?php esc_html_e( 'Instagram', 'digitify' ); ?></small>
				<strong>@digitify.be</strong>
			</span>
		</a>
	</div>
</div>

<section class="digitify-section digitify-section--tight digitify-section--gray digitify-contact-page digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-contact-layout digitify-contact-layout--manifest digitify-contact-layout--wizard">
			<div class="digitify-contact-wizard-card">
				<div class="digitify-contact-pane digitify-contact-pane--wizard">
					<div class="digitify-contact-wizard__progress" aria-label="<?php esc_attr_e( 'Formulierstappen', 'digitify' ); ?>">
						<div class="digitify-contact-wizard__step-indicator is-active" data-wizard-indicator="1">
							<span class="digitify-contact-wizard__step-num">01</span>
							<span class="digitify-contact-wizard__step-label"><?php esc_html_e( 'Project', 'digitify' ); ?></span>
						</div>
						<div class="digitify-contact-wizard__step-indicator" data-wizard-indicator="2">
							<span class="digitify-contact-wizard__step-num">02</span>
							<span class="digitify-contact-wizard__step-label"><?php esc_html_e( 'Contact', 'digitify' ); ?></span>
						</div>
						<div class="digitify-contact-wizard__step-indicator" data-wizard-indicator="3">
							<span class="digitify-contact-wizard__step-num">03</span>
							<span class="digitify-contact-wizard__step-label"><?php esc_html_e( 'Controle', 'digitify' ); ?></span>
						</div>
					</div>

					<div class="digitify-contact-pane__head">
						<div>
							<h2 data-wizard-title><?php esc_html_e( 'Uw project', 'digitify' ); ?></h2>
							<p data-wizard-lead><?php esc_html_e( 'Vertel ons welke dienst u zoekt en wat u wilt bereiken.', 'digitify' ); ?></p>
						</div>
						<span class="digitify-contact-pane__step" data-wizard-badge><?php esc_html_e( 'Stap 1 · Project', 'digitify' ); ?></span>
					</div>

					<form class="digitify-form digitify-form--contact digitify-form--manifest digitify-contact-wizard" action="mailto:contact@digitify.be" method="post" enctype="text/plain" data-contact-wizard>
						<div class="digitify-contact-wizard__panel is-active" data-wizard-panel="1">
							<div class="digitify-form__row digitify-form__row--wizard-stack">
								<div class="digitify-form__group">
									<label for="digitify-service"><?php esc_html_e( 'Type dienst', 'digitify' ); ?></label>
									<select id="digitify-service" name="service">
										<option value=""><?php esc_html_e( 'Selecteer een dienst', 'digitify' ); ?></option>
										<option value="webdesign"><?php esc_html_e( 'Webdesign', 'digitify' ); ?></option>
										<option value="media"><?php esc_html_e( 'Media', 'digitify' ); ?></option>
										<option value="marketing"><?php esc_html_e( 'Marketing', 'digitify' ); ?></option>
										<option value="combo"><?php esc_html_e( 'Combinatie (web + media + marketing)', 'digitify' ); ?></option>
									</select>
								</div>
								<div class="digitify-form__group">
									<label for="digitify-message"><?php esc_html_e( 'Beschrijf uw project', 'digitify' ); ?> *</label>
									<textarea id="digitify-message" name="message" required rows="6" placeholder="<?php esc_attr_e( 'Doelen, timing, budget, referenties...', 'digitify' ); ?>"></textarea>
								</div>
							</div>
						</div>

						<div class="digitify-contact-wizard__panel" data-wizard-panel="2" hidden>
							<div class="digitify-form__row digitify-form__row--quad digitify-form__row--wizard-duo">
								<div class="digitify-form__group">
									<label for="digitify-name"><?php esc_html_e( 'Naam', 'digitify' ); ?> *</label>
									<input type="text" id="digitify-name" name="name" required placeholder="<?php esc_attr_e( 'Uw naam', 'digitify' ); ?>">
								</div>
								<div class="digitify-form__group">
									<label for="digitify-company-field"><?php esc_html_e( 'Bedrijf', 'digitify' ); ?></label>
									<input type="text" id="digitify-company-field" name="company" placeholder="<?php esc_attr_e( 'Bedrijfsnaam', 'digitify' ); ?>">
								</div>
								<div class="digitify-form__group">
									<label for="digitify-email"><?php esc_html_e( 'E-mail', 'digitify' ); ?> *</label>
									<input type="email" id="digitify-email" name="email" required placeholder="info@uwbedrijf.be">
								</div>
								<div class="digitify-form__group">
									<label for="digitify-phone"><?php esc_html_e( 'Telefoon', 'digitify' ); ?></label>
									<input type="tel" id="digitify-phone" name="phone" placeholder="+32 ...">
								</div>
							</div>
						</div>

						<div class="digitify-contact-wizard__panel" data-wizard-panel="3" hidden>
							<dl class="digitify-contact-wizard__summary">
								<div><dt><?php esc_html_e( 'Dienst', 'digitify' ); ?></dt><dd data-wizard-summary="service">—</dd></div>
								<div class="digitify-contact-wizard__summary-message"><dt><?php esc_html_e( 'Project', 'digitify' ); ?></dt><dd data-wizard-summary="message">—</dd></div>
								<div><dt><?php esc_html_e( 'Naam', 'digitify' ); ?></dt><dd data-wizard-summary="name">—</dd></div>
								<div><dt><?php esc_html_e( 'Bedrijf', 'digitify' ); ?></dt><dd data-wizard-summary="company">—</dd></div>
								<div><dt><?php esc_html_e( 'E-mail', 'digitify' ); ?></dt><dd data-wizard-summary="email">—</dd></div>
								<div><dt><?php esc_html_e( 'Telefoon', 'digitify' ); ?></dt><dd data-wizard-summary="phone">—</dd></div>
							</dl>
						</div>

						<div class="digitify-contact-wizard__nav">
							<button type="button" class="digitify-btn digitify-btn--outline digitify-btn--sm" data-wizard-prev hidden><?php esc_html_e( 'Terug', 'digitify' ); ?></button>
							<button type="button" class="digitify-btn digitify-btn--primary digitify-btn--sm" data-wizard-next><?php esc_html_e( 'Volgende', 'digitify' ); ?></button>
							<button type="submit" class="digitify-btn digitify-btn--primary digitify-btn--sm" data-wizard-submit hidden><?php esc_html_e( 'Verzend aanvraag', 'digitify' ); ?></button>
						</div>
					</form>

					<footer class="digitify-contact-wizard__meta">
						<p class="digitify-contact-wizard__meta-line">
							<span>Boekweitstraat 7, 9000 Gent</span>
							<span class="digitify-contact-wizard__meta-sep" aria-hidden="true">·</span>
							<a href="tel:+32486515773">+32 486 51 57 73</a>
							<span class="digitify-contact-wizard__meta-sep" aria-hidden="true">·</span>
							<a href="mailto:contact@digitify.be">contact@digitify.be</a>
						</p>
						<p class="digitify-contact-wizard__meta-note"><?php esc_html_e( 'Reactie meestal binnen enkele uren · Webdesign · Media · Marketing', 'digitify' ); ?></p>
					</footer>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
