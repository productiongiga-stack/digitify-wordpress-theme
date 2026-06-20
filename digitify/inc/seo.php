<?php
/**
 * Built-in SEO: meta, Open Graph, JSON-LD, sitemap
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digitify_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || class_exists( 'AIOSEO\\Plugin\\AIOSEO' );
}

function digitify_get_seo_data( $slug = '' ) {
	if ( ! $slug ) {
		$slug = digitify_get_current_slug();
	}

	$defaults = array(
		'title'       => get_bloginfo( 'name' ) . ' | Webdesign, Media & Marketing Gent',
		'description' => 'Digitify is een creatief webdesign, media en marketingbureau in Gent. Van websites en videocontent tot digitale campagnes die écht resultaat opleveren.',
		'keywords'    => 'digitify, webdesign gent, marketingbureau, videocontent, digital agency',
		'image'       => digitify_get_logo( 'black' ),
		'og_type'     => 'website',
	);

	$map = array(
		'home' => array(
			'title'       => 'Digitify.be | Webdesign, Media & Marketingbureau in Gent',
			'description' => 'Digitify is een creatief webdesign, media en marketingbureau in Gent. Van websites en videocontent tot digitale campagnes die écht resultaat opleveren.',
			'keywords'    => 'digitify, webdesign gent, marketingbureau belgië',
		),
		'diensten' => array(
			'title'       => 'Diensten | Digitify Gent',
			'description' => 'Uitgebreide digitale oplossingen: webdesign, media en marketing om uw bedrijf te laten groeien online.',
			'keywords'    => 'digitale diensten, webdesign, marketing, media productie',
		),
		'webdesign' => array(
			'title'       => 'Webdesign | Digitify Gent',
			'description' => 'Websites die converteren, niet alleen mooi zijn. Snelle, gebruiksvriendelijke websites op maat vanaf €850.',
			'keywords'    => 'webdesign gent, website laten maken, webshop',
			'og_type'     => 'article',
		),
		'media' => array(
			'title'       => 'Media | Digitify Gent',
			'description' => 'Professionele video- en fotocontent die jouw merk tot leven brengt. Van social content tot brand films.',
			'keywords'    => 'videoproductie, fotografie, content creatie',
			'og_type'     => 'article',
		),
		'marketing' => array(
			'title'       => 'Marketing | Digitify Gent',
			'description' => 'Marketing die resultaat oplevert. Google Ads, Meta Ads en drukwerk vanaf €350.',
			'keywords'    => 'google ads, meta ads, digital marketing gent',
			'og_type'     => 'article',
		),
		'cases' => array(
			'title'       => 'Cases & Projecten | Digitify',
			'description' => 'Ontdek onze webdesign, media en marketing projecten voor merken, kmo\'s en zelfstandigen.',
			'keywords'    => 'portfolio, cases, webdesign projecten',
		),
		'over-ons' => array(
			'title'       => 'Over Ons | Digitify Gent',
			'description' => 'De digitale kracht achter uw bedrijf. Webdesign, contentcreatie en marketing in één geheel.',
			'keywords'    => 'over digitify, digital agency gent',
		),
		'contact' => array(
			'title'       => 'Contact | Digitify Gent',
			'description' => 'Neem contact op voor webdesign, media of marketing. Boekweitstraat 7, 9000 Gent. +32 486 51 57 73.',
			'keywords'    => 'contact digitify, offerte webdesign',
		),
		'algemene-voorwaarden' => array(
			'title'       => 'Algemene Voorwaarden | Digitify',
			'description' => 'Algemene voorwaarden van Digitify voor webdesign, marketing en digitale diensten.',
		),
		'cookiebeleid' => array(
			'title'       => 'Cookiebeleid | Digitify',
			'description' => 'Informatie over het gebruik van cookies op digitify.be.',
		),
		'privacyverklaring' => array(
			'title'       => 'Privacyverklaring | Digitify',
			'description' => 'Privacyverklaring en gegevensbescherming conform GDPR/AVG — Digitify Gent.',
		),
	);

	$data = isset( $map[ $slug ] ) ? wp_parse_args( $map[ $slug ], $defaults ) : $defaults;

	if ( digitify_is_case_page() ) {
		$case_slug = digitify_get_case_slug_from_page();
		$case      = digitify_get_case( $case_slug );
		if ( $case ) {
			$data['title']       = $case['title'] . ' — Case | Digitify';
			$data['description'] = $case['intro'];
			$data['image']       = digitify_get_image( $case['img'] );
			$data['og_type']     = 'article';
			$data['keywords']    = strtolower( $case['tag'] ) . ', ' . $case['title'] . ', digitify case';
		}
	}

	$data['url'] = is_front_page() ? home_url( '/' ) : ( is_page() ? get_permalink() : home_url( '/' ) );

	return $data;
}

function digitify_output_meta_tags() {
	if ( digitify_seo_plugin_active() ) {
		return;
	}

	$seo = digitify_get_seo_data();
	?>
	<meta name="description" content="<?php echo esc_attr( $seo['description'] ); ?>">
	<meta name="keywords" content="<?php echo esc_attr( $seo['keywords'] ); ?>">
	<link rel="canonical" href="<?php echo esc_url( $seo['url'] ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $seo['og_type'] ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $seo['title'] ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $seo['description'] ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $seo['url'] ); ?>">
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $seo['image'] ); ?>">
	<meta property="og:locale" content="nl_BE">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $seo['title'] ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $seo['description'] ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $seo['image'] ); ?>">
	<?php
}
add_action( 'wp_head', 'digitify_output_meta_tags', 1 );

function digitify_filter_document_title( $title ) {
	if ( digitify_seo_plugin_active() || ! is_page() && ! is_front_page() ) {
		return $title;
	}
	$seo = digitify_get_seo_data();
	return $seo['title'];
}
add_filter( 'pre_get_document_title', 'digitify_filter_document_title' );

function digitify_get_breadcrumbs() {
	$crumbs = array(
		array(
			'name' => 'Home',
			'url'  => home_url( '/' ),
		),
	);

	if ( is_front_page() ) {
		return $crumbs;
	}

	if ( is_page() ) {
		$page = get_queried_object();
		$slug = $page->post_name;

		$service_parent = array( 'webdesign', 'media', 'marketing' );
		if ( in_array( $slug, $service_parent, true ) ) {
			$crumbs[] = array(
				'name' => 'Diensten',
				'url'  => digitify_get_page_url( 'diensten' ),
			);
		}

		if ( digitify_is_case_page() ) {
			$crumbs[] = array(
				'name' => 'Cases',
				'url'  => digitify_get_page_url( 'cases' ),
			);
		}

		$crumbs[] = array(
			'name' => get_the_title(),
			'url'  => get_permalink(),
		);
	}

	return $crumbs;
}

function digitify_output_json_ld() {
	if ( digitify_seo_plugin_active() ) {
		return;
	}

	$schemas = array();

	$schemas[] = array(
		'@context'    => 'https://schema.org',
		'@type'       => array( 'Organization', 'LocalBusiness' ),
		'name'        => 'Digitify',
		'url'         => home_url( '/' ),
		'logo'        => digitify_get_logo( 'black' ),
		'image'       => digitify_get_logo( 'black' ),
		'telephone'   => '+32486515773',
		'email'       => 'contact@digitify.be',
		'description' => 'Creatief webdesign, media en marketingbureau in Gent.',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Boekweitstraat 7',
			'addressLocality' => 'Gent',
			'postalCode'      => '9000',
			'addressCountry'  => 'BE',
		),
		'geo' => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => 51.0543,
			'longitude' => 3.7174,
		),
		'sameAs' => array(
			'https://digitify.be',
			'https://www.instagram.com/digitify.be/',
			'https://www.facebook.com/digitify.be',
			'https://www.linkedin.com/company/digitify-be/',
		),
	);

	$schemas[] = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'WebSite',
		'name'            => get_bloginfo( 'name' ),
		'url'             => home_url( '/' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => home_url( '/?s={search_term_string}' ),
			'query-input' => 'required name=search_term_string',
		),
	);

	$crumbs = digitify_get_breadcrumbs();
	if ( count( $crumbs ) > 1 ) {
		$list = array();
		foreach ( $crumbs as $i => $crumb ) {
			$list[] = array(
				'@type'    => 'ListItem',
				'position' => $i + 1,
				'name'     => $crumb['name'],
				'item'     => $crumb['url'],
			);
		}
		$schemas[] = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $list,
		);
	}

	$slug = digitify_get_current_slug();
	$service_slugs = array( 'webdesign', 'media', 'marketing' );
	if ( in_array( $slug, $service_slugs, true ) ) {
		$service_data = digitify_get_service_data( $slug );
		if ( $service_data ) {
			$schemas[] = array(
				'@context'    => 'https://schema.org',
				'@type'       => 'Service',
				'name'        => $service_data['title'],
				'description' => $service_data['intro'],
				'provider'    => array(
					'@type' => 'LocalBusiness',
					'name'  => 'Digitify',
				),
				'areaServed'  => array( 'Belgium', 'Europe' ),
				'url'         => get_permalink(),
			);
		}
	}

	$faq = digitify_get_faq_for_page( $slug );
	if ( ! empty( $faq ) ) {
		$entities = array();
		foreach ( $faq as $item ) {
			$entities[] = array(
				'@type'          => 'Question',
				'name'           => $item['q'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item['a'],
				),
			);
		}
		$schemas[] = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $entities,
		);
	}

	foreach ( $schemas as $schema ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'digitify_output_json_ld', 5 );

function digitify_get_faq_for_page( $slug ) {
	$faqs = array(
		'home' => array(
			array(
				'q' => 'Wat doet Digitify?',
				'a' => 'Digitify is een creatief webdesign, media en marketingbureau in Gent. Wij bouwen websites, maken video- en fotocontent en zetten digitale campagnes op die resultaat opleveren.',
			),
			array(
				'q' => 'Waar is Digitify gevestigd?',
				'a' => 'Ons kantoor bevindt zich te Boekweitstraat 7, 9000 Gent, België.',
			),
			array(
				'q' => 'Hoe vraag ik een offerte aan?',
				'a' => 'Neem contact op via het formulier, e-mail of telefoon. We bespreken uw doelen en sturen een heldere offerte op maat.',
			),
		),
	);

	if ( isset( $faqs[ $slug ] ) ) {
		return $faqs[ $slug ];
	}

	if ( function_exists( 'digitify_get_service_data' ) ) {
		$service = digitify_get_service_data( $slug );
		if ( $service && ! empty( $service['faq'] ) ) {
			return $service['faq'];
		}
	}

	return array();
}

function digitify_sitemap_rewrite() {
	add_rewrite_rule( '^digitify-sitemap\.xml$', 'index.php?digitify_sitemap=1', 'top' );
}
add_action( 'init', 'digitify_sitemap_rewrite' );

function digitify_sitemap_query_var( $vars ) {
	$vars[] = 'digitify_sitemap';
	return $vars;
}
add_filter( 'query_vars', 'digitify_sitemap_query_var' );

function digitify_render_sitemap() {
	if ( ! get_query_var( 'digitify_sitemap' ) ) {
		return;
	}

	header( 'Content-Type: application/xml; charset=utf-8' );
	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	$pages = get_pages( array( 'post_status' => 'publish' ) );
	foreach ( $pages as $page ) {
		echo '<url>';
		echo '<loc>' . esc_url( get_permalink( $page ) ) . '</loc>';
		echo '<lastmod>' . esc_html( get_the_modified_date( 'c', $page ) ) . '</lastmod>';
		echo '<changefreq>weekly</changefreq>';
		echo '<priority>' . ( get_option( 'page_on_front' ) == $page->ID ? '1.0' : '0.8' ) . '</priority>';
		echo '</url>' . "\n";
	}

	echo '</urlset>';
	exit;
}
add_action( 'template_redirect', 'digitify_render_sitemap' );

function digitify_robots_txt( $output ) {
	$output .= "Sitemap: " . home_url( '/digitify-sitemap.xml' ) . "\n";
	return $output;
}
add_filter( 'robots_txt', 'digitify_robots_txt' );

function digitify_flush_rewrite_on_switch() {
	digitify_sitemap_rewrite();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'digitify_flush_rewrite_on_switch' );
