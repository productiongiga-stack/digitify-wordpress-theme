<?php
/**
 * Theme setup
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digitify_theme_setup() {
	load_theme_textdomain( 'digitify', DIGITIFY_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 48,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Hoofdmenu', 'digitify' ),
		'footer'  => __( 'Footer menu', 'digitify' ),
	) );
}
add_action( 'after_setup_theme', 'digitify_theme_setup' );

function digitify_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'digitify-home';
	}

	if ( wp_is_mobile() ) {
		$classes[] = 'digitify-static-ambient';
	}

	return $classes;
}
add_filter( 'body_class', 'digitify_body_classes' );

function digitify_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}

	$urls[] = array(
		'href'        => 'https://fonts.googleapis.com',
		'crossorigin' => 'anonymous',
	);
	$urls[] = array(
		'href'        => 'https://fonts.gstatic.com',
		'crossorigin' => 'anonymous',
	);

	if ( digitify_shop_enabled() ) {
		$shop_host = wp_parse_url( digitify_get_shop_url(), PHP_URL_HOST );
		if ( $shop_host ) {
			$urls[] = array(
				'href' => 'https://' . $shop_host,
			);
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'digitify_resource_hints', 10, 2 );

function digitify_enqueue_assets() {
	wp_enqueue_style(
		'digitify-google-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'digitify-main',
		DIGITIFY_THEME_URI . '/assets/css/main.css',
		array( 'digitify-google-fonts' ),
		DIGITIFY_THEME_VERSION
	);

	wp_enqueue_style(
		'digitify-premium',
		DIGITIFY_THEME_URI . '/assets/css/premium.css',
		array( 'digitify-main' ),
		DIGITIFY_THEME_VERSION
	);

	wp_enqueue_style(
		'digitify-compact',
		DIGITIFY_THEME_URI . '/assets/css/compact.css',
		array( 'digitify-premium' ),
		DIGITIFY_THEME_VERSION
	);

	wp_enqueue_style(
		'digitify-brand',
		DIGITIFY_THEME_URI . '/assets/css/digitify.css',
		array( 'digitify-compact' ),
		DIGITIFY_THEME_VERSION
	);

	wp_enqueue_script(
		'digitify-main',
		DIGITIFY_THEME_URI . '/assets/js/main.js',
		array(),
		DIGITIFY_THEME_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( is_front_page() && digitify_shop_3d_enabled() ) {
		wp_enqueue_script(
			'digitify-model-viewer',
			'https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js',
			array(),
			'3.5.0',
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);

		wp_enqueue_script(
			'digitify-home-3d-cta',
			DIGITIFY_THEME_URI . '/assets/js/home-3d-cta.js',
			array( 'digitify-model-viewer' ),
			DIGITIFY_THEME_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);

		wp_localize_script(
			'digitify-home-3d-cta',
			'digitifyHome3d',
			array(
				'shopUrl' => digitify_get_shop_url(),
				'models'  => digitify_get_home_3d_models(),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'digitify_enqueue_assets' );

function digitify_get_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}

/**
 * Redirect removed pages.
 */
function digitify_redirect_removed_pages() {
	if ( is_page( 'tarieven' ) ) {
		wp_safe_redirect( digitify_get_page_url( 'contact' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'digitify_redirect_removed_pages', 1 );

function digitify_is_current( $slug ) {
	if ( is_front_page() && 'home' === $slug ) {
		return true;
	}
	return is_page( $slug );
}

function digitify_get_current_slug() {
	if ( is_front_page() ) {
		return 'home';
	}
	if ( is_page() ) {
		return get_post_field( 'post_name', get_queried_object_id() );
	}
	return '';
}

/**
 * Context label for the header utility strip.
 *
 * @return string
 */
function digitify_get_header_context_label() {
	if ( is_front_page() ) {
		return __( 'Digital agency', 'digitify' );
	}

	$labels = array(
		'diensten'  => __( 'Diensten', 'digitify' ),
		'cases'     => __( 'Cases', 'digitify' ),
		'over-ons'  => __( 'Over ons', 'digitify' ),
		'contact'   => __( 'Contact', 'digitify' ),
		'webdesign' => __( 'Webdesign', 'digitify' ),
		'media'     => __( 'Media', 'digitify' ),
		'marketing' => __( 'Marketing', 'digitify' ),
	);

	$slug = digitify_get_current_slug();

	if ( isset( $labels[ $slug ] ) ) {
		return $labels[ $slug ];
	}

	return __( 'Digitify', 'digitify' );
}

function digitify_nav_link_class( $slug ) {
	return digitify_is_current( $slug ) ? 'digitify-nav__link is-active' : 'digitify-nav__link';
}

function digitify_get_image( $filename ) {
	return digitify_theme_image_url( $filename );
}

/**
 * Prefer modern image formats when a sibling WebP exists.
 *
 * @param string $filename Image path relative to assets/images.
 * @return string Public URL.
 */
function digitify_theme_image_url( $filename ) {
	$base_dir = DIGITIFY_THEME_DIR . '/assets/images/';
	$base_uri = DIGITIFY_THEME_URI . '/assets/images/';

	if ( preg_match( '/\.(png|jpe?g)$/i', $filename ) ) {
		$webp = preg_replace( '/\.(png|jpe?g)$/i', '.webp', $filename );
		if ( file_exists( $base_dir . $webp ) ) {
			return $base_uri . $webp;
		}
	}

	return $base_uri . $filename;
}

/**
 * Digitify brand logos (black, white, animated).
 *
 * @param string $variant black|white|animated|default
 * @return string
 */
function digitify_get_logo( $variant = 'default' ) {
	$logos = array(
		'black'    => 'logo-black.png',
		'white'    => 'logo-white.png',
		'animated' => 'logo-animated.gif',
		'default'  => 'logo-black.png',
	);

	$key = isset( $logos[ $variant ] ) ? $variant : 'default';

	return digitify_get_image( $logos[ $key ] );
}

/**
 * Brand slogan for header and marketing surfaces.
 *
 * @return string
 */
function digitify_get_brand_slogan() {
	return __( 'Partner in Digital Solutions', 'digitify' );
}

/**
 * Home hero background media (image and optional video).
 *
 * Filter `digitify_home_hero_media` to swap images or enable a background video later.
 *
 * @return array{image:string,image_position:string,video:string,video_poster:string,video_mime:string}
 */
function digitify_get_home_hero_media() {
	$defaults = array(
		'image'          => 'hero-marketing.png',
		'image_position' => '82% 38%',
		'video'          => DIGITIFY_THEME_URI . '/assets/images/hero-video.mp4',
		'video_poster'   => '',
		'video_mime'     => 'video/mp4',
	);

	if ( wp_is_mobile() ) {
		$defaults['video'] = '';
	}

	return apply_filters( 'digitify_home_hero_media', $defaults );
}

/**
 * Render the home hero background layer (photo and/or video).
 */
function digitify_render_home_hero_media() {
	$media     = digitify_get_home_hero_media();
	$image_url = digitify_get_image( $media['image'] );
	$poster    = ! empty( $media['video_poster'] ) ? $media['video_poster'] : $image_url;
	$has_video = ! empty( $media['video'] );
	?>
	<div class="digitify-hero__media" aria-hidden="true">
		<?php if ( $has_video ) : ?>
			<video
				class="digitify-hero__media-video"
				autoplay
				muted
				loop
				playsinline
				preload="metadata"
				poster="<?php echo esc_url( $poster ); ?>"
			>
				<source src="<?php echo esc_url( $media['video'] ); ?>" type="<?php echo esc_attr( $media['video_mime'] ); ?>">
			</video>
		<?php else : ?>
			<img
				class="digitify-hero__media-photo"
				src="<?php echo esc_url( $image_url ); ?>"
				alt=""
				loading="eager"
				fetchpriority="high"
				decoding="async"
				width="1080"
				height="1920"
				style="--digitify-hero-media-position: <?php echo esc_attr( $media['image_position'] ); ?>;"
			>
		<?php endif; ?>
		<div class="digitify-hero__media-scrim"></div>
	</div>
	<?php
}

/**
 * Render a pricing amount with "vanaf" prefix.
 *
 * @param string|int $amount Price amount without currency symbol.
 * @param string     $unit   Unit label, e.g. "pallet".
 */
function digitify_render_price( $amount, $unit ) {
	?>
	<div class="digitify-pricing-card__price">
		<span class="digitify-pricing-card__from"><?php esc_html_e( 'vanaf', 'digitify' ); ?></span>
		<span class="digitify-pricing-card__amount">&euro;<?php echo esc_html( (string) $amount ); ?></span>
		<small>/ <?php echo esc_html( $unit ); ?></small>
	</div>
	<?php
}

/**
 * Render a pricing comparison cell.
 *
 * @param bool $included Whether the feature is included.
 * @return string
 */
function digitify_compare_cell_html( $included ) {
	if ( $included ) {
		return sprintf(
			'<span class="digitify-compare-cell digitify-compare-cell--yes" aria-label="%1$s"><span class="digitify-compare-yes__icon" aria-hidden="true">%2$s</span><span class="digitify-compare-cell__label">%3$s</span></span>',
			esc_attr__( 'Inbegrepen', 'digitify' ),
			digitify_svg_icon( 'check' ),
			esc_html__( 'Ja', 'digitify' )
		);
	}

	return sprintf(
		'<span class="digitify-compare-cell digitify-compare-cell--no" aria-label="%1$s"><span class="digitify-compare-no__icon" aria-hidden="true">&mdash;</span><span class="digitify-compare-cell__label">%2$s</span></span>',
		esc_attr__( 'Niet inbegrepen', 'digitify' ),
		esc_html__( 'Nee', 'digitify' )
	);
}

function digitify_svg_icon( $name ) {
	$icons = array(
		'truck' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a49.902 49.902 0 0 0-2.654-9.375A49.902 49.902 0 0 0 12 2.25c-2.429 0-4.785.352-7.046 1.016a49.902 49.902 0 0 0-2.654 9.375c-.039.62.469 1.124 1.09 1.124H9.75"/></svg>',
		'clock' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>',
		'shield' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>',
		'globe' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5a17.92 17.92 0 0 1-8.716-2.247m0 0A8.966 8.966 0 0 1 3 12c0-1.264.26-2.467.732-3.553"/></svg>',
		'box' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>',
		'bolt' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>',
		'phone' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>',
		'mail' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>',
		'map' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>',
		'whatsapp' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>',
		'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
		'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>',
		'check' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>',
		'leaf' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}
