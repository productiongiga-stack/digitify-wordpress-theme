<?php
/**
 * Template Name: Diensten
 *
 * @package Digitify
 */

get_header();

get_template_part( 'template-parts/page-header', null, array(
	'title'    => __( 'Onze diensten', 'digitify' ),
	'subtitle' => __( 'Uitgebreide digitale oplossingen om uw bedrijf te laten groeien in het online landschap.', 'digitify' ),
	'image'    => 'element-webdesign.png',
	'size'     => 'default',
) );
?>

<section class="digitify-section digitify-section--tight digitify-diensten-hub digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-diensten-hub__grid digitify-grid digitify-grid--media digitify-grid--media-compact">
			<?php foreach ( digitify_get_service_hub_cards() as $i => $card ) : ?>
				<?php
				get_template_part( 'template-parts/media-card', null, array(
					'slug'     => $card['slug'],
					'title'    => $card['title'],
					'desc'     => $card['desc'],
					'image'    => digitify_get_service_element_image( $card['slug'] ),
					'variant'  => 'icon',
					'featured' => 0 === $i,
				) );
				?>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="digitify-section digitify-section--gray digitify-section--tight digitify-diensten-unified digitify-diensten-unified--signature digitify-reveal">
	<div class="digitify-container">
		<div class="digitify-diensten-unified__shell">
			<span class="digitify-diensten-unified__shell-mark" aria-hidden="true">360°</span>
			<div class="digitify-diensten-unified__content">
				<div class="digitify-diensten-unified__head">
					<span class="digitify-section__label"><?php esc_html_e( 'Digitify', 'digitify' ); ?></span>
					<h2><?php esc_html_e( 'Alles onder één dak', 'digitify' ); ?></h2>
					<p class="digitify-diensten-unified__tagline"><?php echo esc_html( digitify_get_brand_slogan() ); ?></p>
				</div>

				<p class="digitify-diensten-unified__lead"><?php esc_html_e( 'Geen losse leveranciers, maar één aanspreekpunt voor webdesign, media én marketing — perfect op elkaar afgestemd.', 'digitify' ); ?></p>
				<p class="digitify-diensten-unified__copy"><?php esc_html_e( 'Van strategie en design tot productie en campagnes — alles loopt via één team dat uw merk kent. Geen herhaalde briefing aan drie bureaus, wel één doorlopende lijn van idee tot resultaat.', 'digitify' ); ?></p>

				<div class="digitify-diensten-unified__stats" aria-label="<?php esc_attr_e( 'Digitify in cijfers', 'digitify' ); ?>">
					<div class="digitify-diensten-unified__stat">
						<strong>40+</strong>
						<span><?php esc_html_e( 'Projecten', 'digitify' ); ?></span>
					</div>
					<div class="digitify-diensten-unified__stat">
						<strong>3</strong>
						<span><?php esc_html_e( 'Disciplines', 'digitify' ); ?></span>
					</div>
					<div class="digitify-diensten-unified__stat">
						<strong>24u</strong>
						<span><?php esc_html_e( 'Reactie', 'digitify' ); ?></span>
					</div>
				</div>

				<div class="digitify-diensten-unified__pillars">
					<?php foreach ( digitify_get_service_hub_cards() as $i => $card ) : ?>
						<a href="<?php echo esc_url( digitify_get_page_url( $card['slug'] ) ); ?>" class="digitify-diensten-unified__pillar">
							<span class="digitify-diensten-unified__pillar-num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<span class="digitify-diensten-unified__pillar-label"><?php echo esc_html( $card['title'] ); ?></span>
							<span class="digitify-diensten-unified__pillar-text"><?php echo esc_html( $card['desc'] ); ?></span>
							<span class="digitify-diensten-unified__pillar-arrow" aria-hidden="true">&rarr;</span>
						</a>
					<?php endforeach; ?>
				</div>

				<div class="digitify-diensten-unified__actions">
					<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm"><?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?></a>
					<a href="<?php echo esc_url( digitify_get_page_url( 'cases' ) ); ?>" class="digitify-btn digitify-btn--outline digitify-btn--sm"><?php esc_html_e( 'Bekijk cases', 'digitify' ); ?></a>
				</div>
			</div>

			<div class="digitify-diensten-unified__media">
				<div class="digitify-diensten-unified__grid">
					<?php foreach ( digitify_get_service_hub_cards() as $i => $card ) : ?>
						<?php
						$tile_class = 'digitify-diensten-unified__tile';
						if ( 0 === $i ) {
							$digitify_case = digitify_get_case( 'digitify' );
							$tile_image    = ( $digitify_case && ! empty( $digitify_case['img'] ) ) ? $digitify_case['img'] : 'projects/project-digitify-website.png';
							$tile_class   .= ' digitify-diensten-unified__tile--lead';
						} else {
							$tile_image = $card['image'];
						}
						?>
						<a href="<?php echo esc_url( digitify_get_page_url( $card['slug'] ) ); ?>" class="<?php echo esc_attr( $tile_class ); ?>">
							<img src="<?php echo esc_url( digitify_get_image( $tile_image ) ); ?>" alt="<?php echo esc_attr( $card['title'] . ' — Digitify' ); ?>" loading="lazy" width="480" height="480">
							<span class="digitify-diensten-unified__tile-label"><?php echo esc_html( $card['title'] ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
				<span class="digitify-diensten-unified__badge"><?php esc_html_e( 'Gent · België', 'digitify' ); ?></span>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
