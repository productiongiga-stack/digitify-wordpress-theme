<?php
/**
 * Template Name: Cases
 *
 * @package Digitify
 */

get_header();

get_template_part(
	'template-parts/page-header',
	null,
	array(
		'title'    => __( 'Cases & projecten', 'digitify' ),
		'subtitle' => __( 'Webdesign, media en marketing — compact overzicht per discipline.', 'digitify' ),
		'image'    => 'element-media.png',
		'size'     => 'default',
	)
);

$categories = digitify_get_case_categories();
$fleet      = digitify_get_cases();
$total_count = count( $fleet );
$display_fleet = $fleet;
shuffle( $display_fleet );
$category_counts = array();

foreach ( $categories as $slug => $label ) {
	$category_counts[ $slug ] = count( digitify_get_cases( $slug ) );
}
?>

<section class="digitify-section digitify-section--compact digitify-cases-page digitify-cases-page--light">
	<div class="digitify-container">
		<div class="digitify-cases-catalog">
			<div class="digitify-cases-catalog__toolbar">
				<div class="digitify-cases-catalog__head">
					<span class="digitify-section__label"><?php esc_html_e( 'Portfolio', 'digitify' ); ?></span>
					<h2><?php esc_html_e( 'Alle projecten', 'digitify' ); ?></h2>
				</div>

				<div class="digitify-cases-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Filter op discipline', 'digitify' ); ?>">
					<button
						type="button"
						class="digitify-cases-tabs__btn is-active"
						data-filter="all"
						role="tab"
						aria-selected="true"
					>
						<span><?php esc_html_e( 'Alles', 'digitify' ); ?></span>
						<span class="digitify-cases-tabs__count"><?php echo esc_html( (string) $total_count ); ?></span>
					</button>
				<?php foreach ( $categories as $slug => $label ) : ?>
					<button
						type="button"
						class="digitify-cases-tabs__btn"
						data-filter="<?php echo esc_attr( $slug ); ?>"
						role="tab"
						aria-selected="false"
					>
						<span><?php echo esc_html( $label ); ?></span>
						<span class="digitify-cases-tabs__count"><?php echo esc_html( (string) $category_counts[ $slug ] ); ?></span>
					</button>
				<?php endforeach; ?>
				</div>
			</div>

			<div class="digitify-cases-catalog__shell">
			<div class="digitify-cases-catalog__grid">
				<?php foreach ( $display_fleet as $item ) : ?>
					<a
						href="<?php echo esc_url( digitify_get_case_url( $item['slug'] ) ); ?>"
						class="digitify-case-card digitify-case-card--catalog"
						data-category="<?php echo esc_attr( $item['category'] ); ?>"
					>
						<div class="digitify-case-card__img">
							<img src="<?php echo esc_url( digitify_get_image( $item['img'] ) ); ?>" alt="<?php echo esc_attr( $item['title'] . ' — Digitify' ); ?>" loading="lazy" decoding="async" fetchpriority="low" width="480" height="480">
							<span class="digitify-case-card__tag"><?php echo esc_html( $item['project_label'] ); ?></span>
						</div>
						<div class="digitify-case-card__body">
							<div class="digitify-case-card__meta">
								<span><?php echo esc_html( $item['project_label'] ); ?></span>
								<span><?php echo esc_html( $item['year'] ); ?></span>
							</div>
							<h3><?php echo esc_html( $item['client'] ); ?></h3>
							<p><?php echo esc_html( $item['subtitle'] ); ?></p>
							<span class="digitify-case-card__cta"><?php esc_html_e( 'Bekijk case', 'digitify' ); ?> &rarr;</span>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
