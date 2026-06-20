<?php
/**
 * Template Name: Case
 *
 * @package Digitify
 */

get_header();

$case_slug = digitify_get_case_slug_from_page();
$case      = digitify_get_case( $case_slug );

if ( ! $case ) {
	get_template_part( 'page' );
	get_footer();
	return;
}

$siblings   = digitify_get_client_cases( $case['client_key'], $case['slug'] );
$related    = digitify_get_related_cases( $case['slug'] );
$categories = digitify_get_case_categories();
$platforms  = digitify_get_case_platforms( $case );
$has_view   = digitify_case_has_view_link( $case );
$view_attrs = digitify_get_case_view_attrs( $case );
$has_gallery  = digitify_case_has_gallery( $case );
$gallery      = ! empty( $case['gallery'] ) ? $case['gallery'] : array( $case['img'] );
$video_embed       = digitify_get_case_video_embed_url( $case );
$client_website    = digitify_get_case_client_website_url( $case );
$client_site_attrs = digitify_get_external_link_attrs( $client_website );
$story      = array(
	array(
		'num'   => '01',
		'title' => __( 'Uitdaging', 'digitify' ),
		'text'  => $case['challenge'],
	),
	array(
		'num'   => '02',
		'title' => __( 'Aanpak', 'digitify' ),
		'text'  => $case['approach'],
	),
	array(
		'num'   => '03',
		'title' => __( 'Resultaat', 'digitify' ),
		'accent'=> true,
		'text'  => $case['result'],
	),
);
?>

<article class="digitify-case-page digitify-case-page--editorial digitify-case-page--<?php echo esc_attr( $case['category'] ); ?>">
	<header class="digitify-case-hero digitify-case-hero--editorial digitify-reveal">
		<div class="digitify-container digitify-case-hero__inner">
			<?php get_template_part( 'template-parts/breadcrumb' ); ?>

			<div class="digitify-case-hero__layout">
				<div class="digitify-case-hero__copy">
					<div class="digitify-case-hero__meta">
						<span class="digitify-case-hero__tag"><?php echo esc_html( $case['tag'] ); ?></span>
						<span class="digitify-case-hero__type"><?php echo esc_html( $case['project_label'] ); ?></span>
						<?php if ( ! empty( $case['year'] ) ) : ?>
							<span class="digitify-case-hero__year"><?php echo esc_html( $case['year'] ); ?></span>
						<?php endif; ?>
					</div>

					<h1 class="digitify-case-hero__title">
						<?php if ( $client_website ) : ?>
							<a href="<?php echo esc_url( $client_website ); ?>" class="digitify-case-hero__title-link"<?php echo $client_site_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<?php echo esc_html( $case['client'] ); ?>
							</a>
						<?php else : ?>
							<?php echo esc_html( $case['client'] ); ?>
						<?php endif; ?>
					</h1>
					<p class="digitify-case-hero__subtitle"><?php echo esc_html( $case['subtitle'] ); ?></p>
					<p class="digitify-case-hero__intro"><?php echo esc_html( $case['intro'] ); ?></p>

					<?php if ( ! empty( $platforms ) ) : ?>
						<ul class="digitify-case-hero__platforms" aria-label="<?php esc_attr_e( 'Kanalen & tools', 'digitify' ); ?>">
							<?php foreach ( $platforms as $platform ) : ?>
								<li><?php echo esc_html( $platform ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="digitify-case-hero__actions">
						<?php if ( $has_view ) : ?>
							<a href="<?php echo esc_url( $case['view_url'] ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm"<?php echo $view_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<?php echo esc_html( $case['view_label'] ); ?> &rarr;
							</a>
						<?php endif; ?>
						<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--ghost digitify-btn--sm">
							<?php esc_html_e( 'Vergelijkbaar project?', 'digitify' ); ?>
						</a>
						<a href="<?php echo esc_url( digitify_get_page_url( 'cases' ) ); ?>" class="digitify-case-hero__back">
							<?php esc_html_e( 'Alle cases', 'digitify' ); ?> &rarr;
						</a>
					</div>
				</div>

				<?php
				$visual_class = 'digitify-case-hero__visual';
				if ( 'webdesign' === $case['category'] ) {
					$visual_class .= ' digitify-case-hero__visual--mockup';
				} elseif ( 'marketing' === $case['category'] ) {
					$visual_class .= ' digitify-case-hero__visual--creative';
				} else {
					$visual_class .= ' digitify-case-hero__visual--photo';
				}
				if ( $video_embed ) {
					$visual_class .= ' digitify-case-hero__visual--video';
				}
				?>
				<figure class="<?php echo esc_attr( $visual_class ); ?>">
					<div class="digitify-case-hero__visual-media">
						<img src="<?php echo esc_url( digitify_get_image( $case['img'] ) ); ?>" alt="<?php echo esc_attr( $case['title'] . ' — Digitify' ); ?>" loading="eager" width="960" height="960">
						<?php if ( $video_embed ) : ?>
							<span class="digitify-case-hero__visual-play" aria-hidden="true"></span>
						<?php endif; ?>
					</div>
					<figcaption class="digitify-case-hero__visual-cap">
						<span><?php echo esc_html( $case['project_label'] ); ?></span>
						<span><?php echo esc_html( $case['client'] ); ?></span>
					</figcaption>
				</figure>
			</div>
		</div>
	</header>

	<div class="digitify-case-body">
		<div class="digitify-container digitify-case-body__grid">
			<div class="digitify-case-main">
				<section class="digitify-case-story digitify-case-story--cards" aria-label="<?php esc_attr_e( 'Projectverhaal', 'digitify' ); ?>">
					<div class="digitify-case-story__head">
						<span class="digitify-section__label"><?php esc_html_e( 'Aanpak & resultaat', 'digitify' ); ?></span>
						<h2><?php esc_html_e( 'Van uitdaging tot impact', 'digitify' ); ?></h2>
					</div>
					<div class="digitify-case-story__grid">
						<?php foreach ( $story as $block ) : ?>
							<article class="digitify-case-story__card digitify-reveal<?php echo ! empty( $block['accent'] ) ? ' digitify-case-story__card--accent' : ''; ?>">
								<span class="digitify-case-story__num"><?php echo esc_html( $block['num'] ); ?></span>
								<h3><?php echo esc_html( $block['title'] ); ?></h3>
								<p><?php echo esc_html( $block['text'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</section>

				<?php if ( $video_embed ) : ?>
					<section class="digitify-case-video digitify-reveal" aria-label="<?php esc_attr_e( 'Projectvideo', 'digitify' ); ?>">
						<div class="digitify-case-video__head">
							<span class="digitify-section__label"><?php esc_html_e( 'In beeld', 'digitify' ); ?></span>
							<h2><?php esc_html_e( 'Bekijk het resultaat', 'digitify' ); ?></h2>
						</div>
						<div class="digitify-case-video__frame">
							<iframe
								src="<?php echo esc_url( $video_embed ); ?>"
								title="<?php echo esc_attr( $case['title'] . ' — ' . __( 'video', 'digitify' ) ); ?>"
								loading="lazy"
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
								referrerpolicy="strict-origin-when-cross-origin"
								allowfullscreen
							></iframe>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( $has_gallery ) : ?>
					<section class="digitify-case-gallery" aria-label="<?php esc_attr_e( 'Projectbeelden', 'digitify' ); ?>">
						<div class="digitify-case-gallery__head">
							<span class="digitify-section__label"><?php esc_html_e( 'Visueel werk', 'digitify' ); ?></span>
							<h2><?php esc_html_e( 'Campagne & content in beeld', 'digitify' ); ?></h2>
						</div>
						<div class="digitify-case-gallery__grid">
							<?php foreach ( $gallery as $index => $gallery_img ) : ?>
								<figure class="digitify-case-gallery__item<?php echo 0 === $index ? ' digitify-case-gallery__item--lead' : ''; ?>">
									<img src="<?php echo esc_url( digitify_get_image( $gallery_img ) ); ?>" alt="<?php echo esc_attr( $case['title'] . ' — ' . ( $index + 1 ) ); ?>" loading="lazy" width="800" height="520">
								</figure>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( ! empty( $case['deliverables'] ) ) : ?>
					<section class="digitify-case-deliverables digitify-case-deliverables--inline">
						<div class="digitify-case-deliverables__head">
							<span class="digitify-section__label"><?php esc_html_e( 'Oplevering', 'digitify' ); ?></span>
							<h2><?php esc_html_e( 'Wat we hebben geleverd', 'digitify' ); ?></h2>
						</div>
						<ul class="digitify-case-deliverables__list">
							<?php foreach ( $case['deliverables'] as $i => $item ) : ?>
								<li>
									<span class="digitify-case-deliverables__index"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
									<span><?php echo esc_html( $item ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					</section>
				<?php endif; ?>
			</div>

			<aside class="digitify-case-aside">
				<div class="digitify-case-aside__panel">
					<div class="digitify-case-aside__head">
						<img src="<?php echo esc_url( digitify_get_logo( 'black' ) ); ?>" alt="" loading="lazy" aria-hidden="true" width="120" height="32">
						<span><?php esc_html_e( 'Projectdetails', 'digitify' ); ?></span>
					</div>

					<dl class="digitify-case-facts">
						<div class="digitify-case-facts__row">
							<dt><?php esc_html_e( 'Klant', 'digitify' ); ?></dt>
							<dd>
								<?php if ( $client_website ) : ?>
									<a href="<?php echo esc_url( $client_website ); ?>" class="digitify-case-facts__link"<?php echo $client_site_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php echo esc_html( $case['client'] ); ?>
									</a>
								<?php else : ?>
									<?php echo esc_html( $case['client'] ); ?>
								<?php endif; ?>
							</dd>
						</div>
						<div class="digitify-case-facts__row">
							<dt><?php esc_html_e( 'Categorie', 'digitify' ); ?></dt>
							<dd><?php echo esc_html( isset( $categories[ $case['category'] ] ) ? $categories[ $case['category'] ] : $case['tag'] ); ?></dd>
						</div>
						<div class="digitify-case-facts__row">
							<dt><?php esc_html_e( 'Projecttype', 'digitify' ); ?></dt>
							<dd><?php echo esc_html( $case['project_label'] ); ?></dd>
						</div>
						<?php if ( ! empty( $case['year'] ) ) : ?>
							<div class="digitify-case-facts__row">
								<dt><?php esc_html_e( 'Jaar', 'digitify' ); ?></dt>
								<dd><?php echo esc_html( $case['year'] ); ?></dd>
							</div>
						<?php endif; ?>
						<div class="digitify-case-facts__row">
							<dt><?php esc_html_e( 'Kanaal', 'digitify' ); ?></dt>
							<dd><?php echo digitify_fleet_status_html( $case['elec'] ); ?></dd>
						</div>
					</dl>

					<?php if ( ! empty( $case['services'] ) ) : ?>
						<div class="digitify-case-aside__services">
							<span class="digitify-case-aside__label"><?php esc_html_e( 'Diensten', 'digitify' ); ?></span>
							<ul>
								<?php foreach ( $case['services'] as $service ) : ?>
									<li><?php echo digitify_svg_icon( 'check' ); ?> <?php echo esc_html( $service ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<div class="digitify-case-aside__actions">
						<?php if ( $has_view ) : ?>
							<a href="<?php echo esc_url( $case['view_url'] ); ?>" class="digitify-btn digitify-btn--primary digitify-btn--sm digitify-case-aside__cta"<?php echo $view_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<?php echo esc_html( $case['view_label'] ); ?>
							</a>
						<?php endif; ?>
						<a href="<?php echo esc_url( digitify_get_page_url( 'contact' ) ); ?>" class="digitify-btn digitify-btn--ghost digitify-btn--sm digitify-case-aside__cta">
							<?php esc_html_e( 'Offerte aanvragen', 'digitify' ); ?>
						</a>
					</div>
				</div>
			</aside>
		</div>
	</div>

	<?php if ( digitify_case_has_browser_preview( $case ) ) : ?>
		<section class="digitify-case-browser digitify-reveal" aria-label="<?php esc_attr_e( 'Live website preview', 'digitify' ); ?>">
			<div class="digitify-container">
				<div class="digitify-case-browser__head">
					<span class="digitify-section__label"><?php esc_html_e( 'Live preview', 'digitify' ); ?></span>
					<h2><?php esc_html_e( 'Bekijk de website', 'digitify' ); ?></h2>
					<?php if ( $client_website ) : ?>
						<p>
							<a href="<?php echo esc_url( $client_website ); ?>" class="digitify-case-browser__link"<?php echo $client_site_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<?php echo esc_html( digitify_get_case_browser_host( $client_website ) ); ?> &rarr;
							</a>
						</p>
					<?php endif; ?>
				</div>
				<div class="digitify-case-browser__frame">
					<?php
					get_template_part(
						'template-parts/case-browser-preview',
						null,
						array(
							'case'  => $case,
							'size'  => 'section',
							'eager' => false,
						)
					);
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $siblings ) ) : ?>
		<section class="digitify-section digitify-section--gray digitify-section--tight digitify-case-siblings">
			<div class="digitify-container digitify-reveal">
				<div class="digitify-section__header digitify-section__header--compact digitify-section__header--left">
					<div>
						<span class="digitify-section__label"><?php esc_html_e( 'Zelfde klant', 'digitify' ); ?></span>
						<h2>
							<?php
							printf(
								/* translators: %s: client name */
								esc_html__( 'Meer van %s', 'digitify' ),
								esc_html( $case['client'] )
							);
							?>
						</h2>
					</div>
				</div>
				<div class="digitify-case-siblings__grid">
					<?php foreach ( $siblings as $item ) : ?>
						<a href="<?php echo esc_url( digitify_get_case_url( $item['slug'] ) ); ?>" class="digitify-case-sibling">
							<figure class="digitify-case-sibling__img">
								<img src="<?php echo esc_url( digitify_get_image( $item['img'] ) ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy" width="420" height="280">
							</figure>
							<div class="digitify-case-sibling__body">
								<div class="digitify-case-sibling__meta">
									<span><?php echo esc_html( $item['project_label'] ); ?></span>
									<span><?php echo esc_html( $item['year'] ); ?></span>
								</div>
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
								<p><?php echo esc_html( $item['subtitle'] ); ?></p>
								<span class="digitify-case-sibling__link"><?php esc_html_e( 'Bekijk project', 'digitify' ); ?> &rarr;</span>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $related ) ) : ?>
		<section class="digitify-section digitify-section--tight">
			<div class="digitify-container digitify-reveal">
				<div class="digitify-section__header digitify-section__header--compact digitify-section__header--left">
					<div>
						<span class="digitify-section__label"><?php esc_html_e( 'Meer cases', 'digitify' ); ?></span>
						<h2><?php esc_html_e( 'Gerelateerde projecten', 'digitify' ); ?></h2>
					</div>
					<a href="<?php echo esc_url( digitify_get_page_url( 'cases' ) ); ?>" class="digitify-link-arrow"><?php esc_html_e( 'Alle cases', 'digitify' ); ?> &rarr;</a>
				</div>
				<div class="digitify-grid digitify-grid--cases-related">
					<?php foreach ( $related as $item ) : ?>
						<a href="<?php echo esc_url( digitify_get_case_url( $item['slug'] ) ); ?>" class="digitify-case-card">
							<div class="digitify-case-card__img">
								<img src="<?php echo esc_url( digitify_get_image( $item['img'] ) ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy" width="480" height="300">
								<div class="digitify-case-card__scrim" aria-hidden="true"></div>
								<span class="digitify-case-card__tag"><?php echo esc_html( $item['tag'] ); ?></span>
							</div>
							<div class="digitify-case-card__body">
								<div class="digitify-case-card__meta">
									<span><?php echo esc_html( $item['client'] ); ?></span>
									<span><?php echo esc_html( $item['project_label'] ); ?></span>
								</div>
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
								<p><?php echo esc_html( $item['subtitle'] ); ?></p>
								<span class="digitify-case-card__link"><?php esc_html_e( 'Bekijk case', 'digitify' ); ?> &rarr;</span>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
</article>

<?php get_footer(); ?>
