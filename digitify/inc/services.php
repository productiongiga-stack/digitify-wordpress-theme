<?php
/**
 * Service landing page content — Digitify
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digitify_get_service_slugs() {
	return array( 'webdesign', 'media', 'marketing' );
}

function digitify_get_service_data( $slug = '' ) {
	if ( ! $slug ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
	}

	$services = array(
		'webdesign' => array(
			'title'           => 'Webdesign',
			'subtitle'        => 'Websites die converteren, niet alleen mooi zijn',
			'intro'           => 'Een goede website is meer dan design. Het is een digitale verkooptool die vertrouwen opbouwt, bezoekers overtuigt en klanten oplevert. Bij Digitify ontwerpen en bouwen we snelle, gebruiksvriendelijke websites die perfect aansluiten bij jouw merk en doelstellingen.',
			'icon'            => 'globe',
			'image'           => 'element-webdesign.png',
			'highlight'       => 'vanaf',
			'highlight_label' => '€850',
			'panel_badge'     => 'Webdesign · Gent',
			'process_title'   => 'Van concept tot live website',
			'process_lead'    => 'Design, UX en marketing in één doorlopend traject.',
			'faq_lead'        => 'Alles over onze webdesign-aanpak, oplevering en prijzen.',
			'related_lead'    => 'Combineer webdesign met media en marketing voor maximale impact.',
			'usps'            => array(
				'Gericht op leads, aanvragen en verkoop',
				'Snel, veilig en toekomstgericht',
				'Volledig afgestemd op jouw doelgroep',
				'Gebouwd met oog op marketing & advertenties',
			),
			'steps'           => array(
				array( 'Discover', 'Kennismaking en analyse van doelen, doelgroep en concurrentie.' ),
				array( 'Create', 'Wireframes, design en structuur op maat van jouw merk.' ),
				array( 'Build & Launch', 'Ontwikkeling, testing en livegang van de website.' ),
				array( 'Optimize', 'Doorlopende optimalisatie op conversie en performance.' ),
			),
			'faq'             => array(
				array(
					'q' => 'Welke soorten websites bouwen jullie?',
					'a' => 'Van onepage websites en multipage sites tot simpele en volwaardige webshops — altijd op maat van jouw noden.',
				),
				array(
					'q' => 'Wat kost een website bij Digitify?',
					'a' => 'Onepage websites starten vanaf €850, multipage vanaf €1650 en webshops vanaf €1250. Vraag een offerte voor een exacte prijs.',
				),
				array(
					'q' => 'Is SEO inbegrepen?',
					'a' => 'Ja, elke website krijgt een basis SEO-structuur, snelle laadtijden en technische optimalisatie.',
				),
			),
		),
		'media' => array(
			'title'           => 'Media',
			'subtitle'        => 'Vertel je verhaal met impact',
			'intro'           => 'Sterke beelden maken het verschil. Met professionele video- en fotocontent brengen wij jouw merk tot leven — helder, emotioneel en visueel krachtig. Bij Digitify gaan we verder dan knippen en plakken: elke scène, overgang en kleur wordt bewust gekozen.',
			'icon'            => 'bolt',
			'image'           => 'element-media.png',
			'highlight'       => 'Video',
			'highlight_label' => '& Foto',
			'panel_badge'     => 'Media · Content',
			'process_title'   => 'Van briefing tot eindresultaat',
			'process_lead'    => 'Creatie, productie en post-productie onder één dak.',
			'faq_lead'        => 'Praktische info over video, fotografie en oplevering.',
			'related_lead'    => 'Media werkt het best in combinatie met webdesign en marketing.',
			'usps'            => array(
				'Videomontage & post-productie',
				'Social media content',
				'Color grading & sound design',
				'Platform-specifieke exports',
			),
			'steps'           => array(
				array( 'Briefing', 'We bespreken doel, stijl, platforms en planning.' ),
				array( 'Productie', 'Opnames, montage en creatieve uitwerking.' ),
				array( 'Post-productie', 'Color grading, sound design en finetuning.' ),
				array( 'Oplevering', 'Bestanden klaar voor web, social en campagnes.' ),
			),
			'faq'             => array(
				array(
					'q' => 'Welke media-diensten bieden jullie?',
					'a' => 'Videocontent, fotocontent, branding shoots, productfotografie, bedrijfsvideo\'s, aftermovies en advertenties.',
				),
				array(
					'q' => 'Voor welke platforms leveren jullie content?',
					'a' => 'Website, Instagram, Facebook, YouTube, LinkedIn en andere kanalen — altijd in het juiste formaat.',
				),
				array(
					'q' => 'Kunnen jullie ook employer branding doen?',
					'a' => 'Ja, wij maken authentieke bedrijfs- en teambeelden voor websites, social media en recruitment.',
				),
			),
		),
		'marketing' => array(
			'title'           => 'Marketing',
			'subtitle'        => 'Marketing die resultaat oplevert',
			'intro'           => 'Goede marketing draait niet om zoveel mogelijk views, maar om meetbare groei. Bij Digitify zetten we gerichte marketingcampagnes op die zorgen voor meer zichtbaarheid, leads en verkoop — online én offline.',
			'icon'            => 'shield',
			'image'           => 'element-marketing.png',
			'highlight'       => 'vanaf',
			'highlight_label' => '€350',
			'panel_badge'     => 'Marketing · Data',
			'process_title'   => 'Strategie, creatie en optimalisatie',
			'process_lead'    => 'Campagnes die meetbaar resultaat opleveren.',
			'faq_lead'        => 'Google Ads, Meta Ads, drukwerk en performance marketing uitgelegd.',
			'related_lead'    => 'Combineer marketing met een sterke website en visuele content.',
			'usps'            => array(
				'Gericht op leads & omzet',
				'Volledig meetbaar en transparant',
				'Online & offline op elkaar afgestemd',
				'Eén aanspreekpunt voor marketing, media & web',
			),
			'steps'           => array(
				array( 'Analyse', 'Doelgroep, concurrentie en huidige online aanwezigheid in kaart.' ),
				array( 'Strategie', 'Campagneplan op maat met duidelijke KPI\'s.' ),
				array( 'Creatie & launch', 'Advertenties, visuals en landingspagina\'s live zetten.' ),
				array( 'Optimalisatie', 'Meten, bijsturen en schalen op basis van data.' ),
			),
			'faq'             => array(
				array(
					'q' => 'Welke marketingkanalen beheren jullie?',
					'a' => 'Google Ads, Meta Ads, YouTube, drukwerk en content marketing — online én offline.',
				),
				array(
					'q' => 'Wat kosten marketingcampagnes?',
					'a' => 'Google Ads en Meta Ads starten vanaf €350. Drukwerk vanaf €100. Advertentiebudget komt daar bovenop.',
				),
				array(
					'q' => 'Krijg ik rapportages?',
					'a' => 'Ja, wij werken transparant met correcte tracking, metingen en duidelijke rapportering.',
				),
			),
		),
	);

	return isset( $services[ $slug ] ) ? $services[ $slug ] : null;
}

/**
 * Representative portfolio case for a service landing panel.
 *
 * @param string $slug Service slug.
 * @return array<string, mixed>|null
 */
function digitify_get_service_panel_case( $slug ) {
	$preferred = array(
		'webdesign' => 'breadless',
		'media'     => 'black-mountain',
		'marketing' => 'zon-dak',
	);

	if ( isset( $preferred[ $slug ] ) ) {
		$case = digitify_get_case( $preferred[ $slug ] );
		if ( $case ) {
			return $case;
		}
	}

	$cases = digitify_get_cases( $slug );
	foreach ( $cases as $case ) {
		if ( ! empty( $case['featured'] ) ) {
			return $case;
		}
	}

	return ! empty( $cases[0] ) ? $cases[0] : null;
}

/**
 * Panel / hero image for a service page.
 *
 * @param string $slug Service slug.
 * @return array{src:string,alt:string}
 */
function digitify_get_service_panel_image( $slug ) {
	$case = digitify_get_service_panel_case( $slug );
	if ( $case ) {
		return array(
			'src' => $case['img'],
			'alt' => sprintf(
				/* translators: 1: client name */
				__( '%1$s — Digitify', 'digitify' ),
				$case['label']
			),
		);
	}

	$fallbacks = array(
		'webdesign' => 'element-webdesign.png',
		'media'     => 'element-media.png',
		'marketing' => 'element-marketing.png',
	);

	$service = digitify_get_service_data( $slug );
	$src     = isset( $fallbacks[ $slug ] ) ? $fallbacks[ $slug ] : 'element-webdesign.png';
	$title   = $service ? $service['title'] : __( 'Digitify', 'digitify' );

	return array(
		'src' => $src,
		'alt' => $title . ' — Digitify',
	);
}

function digitify_get_fleet_items() {
	return digitify_get_cases();
}

function digitify_fleet_status_html( $value ) {
	$mods = array(
		'Live'    => 'yes',
		'Google'  => 'yes',
		'Meta'    => 'yes',
		'Video'   => 'yes',
		'Brand'   => 'yes',
		'Social'  => 'yes',
		'Gent'    => 'opt',
		'België'  => 'opt',
	);
	$mod  = isset( $mods[ $value ] ) ? $mods[ $value ] : 'opt';

	return sprintf(
		'<span class="digitify-fleet-status digitify-fleet-status--%1$s"><span class="digitify-fleet-status__dot" aria-hidden="true"></span>%2$s</span>',
		esc_attr( $mod ),
		esc_html( $value )
	);
}

function digitify_fleet_ton_html( $ton ) {
	return sprintf(
		'<span class="digitify-fleet-ton">%s</span>',
		esc_html( $ton )
	);
}

function digitify_get_fleet_hub_cards() {
	$cards = array();
	foreach ( digitify_get_fleet_items() as $item ) {
		$cards[] = array(
			'slug'  => $item['slug'],
			'image' => $item['img'],
			'title' => $item['label'],
		);
	}
	return $cards;
}

function digitify_get_fleet_nav_children() {
	$items = array();
	foreach ( array_slice( digitify_get_featured_cases(), 0, 4 ) as $item ) {
		$items[] = array(
			'slug'  => $item['slug'],
			'label' => $item['label'],
			'url'   => digitify_get_case_url( $item['slug'] ),
		);
	}
	return $items;
}

function digitify_get_service_hub_cards() {
	$cards = array(
		array(
			'slug'  => 'webdesign',
			'icon'  => 'globe',
			'image' => 'element-webdesign.png',
			'title' => 'Webdesign',
			'desc'  => 'Moderne websites die converteren en perfect aansluiten bij jouw merk.',
		),
		array(
			'slug'  => 'media',
			'icon'  => 'bolt',
			'image' => 'element-media.png',
			'title' => 'Media',
			'desc'  => 'Professionele video- en fotocontent die jouw verhaal tot leven brengt.',
		),
		array(
			'slug'  => 'marketing',
			'icon'  => 'shield',
			'image' => 'element-marketing.png',
			'title' => 'Marketing',
			'desc'  => 'Gerichte campagnes voor meer zichtbaarheid, leads en omzet.',
		),
	);

	foreach ( $cards as $index => $card ) {
		$panel_image               = digitify_get_service_panel_image( $card['slug'] );
		$cards[ $index ]['image'] = $panel_image['src'];
	}

	return $cards;
}

/**
 * Transparent service element illustration for hub cards.
 *
 * @param string $slug Service slug.
 * @return string Theme image path relative to assets/images.
 */
function digitify_get_service_element_image( $slug ) {
	$map = array(
		'webdesign' => 'element-webdesign.png',
		'media'     => 'element-media.png',
		'marketing' => 'element-marketing.png',
	);

	return isset( $map[ $slug ] ) ? $map[ $slug ] : 'element-webdesign.png';
}

/**
 * Teaser image for the Cases card in service related grids.
 *
 * @return string Theme image path relative to assets/images.
 */
function digitify_get_cases_related_image() {
	$preferred = array( 'next-hire', 'im-the-label', 'black-mountain', 'zon-dak' );

	foreach ( $preferred as $slug ) {
		$case = digitify_get_case( $slug );
		if ( $case && ! empty( $case['img'] ) ) {
			return $case['img'];
		}
	}

	$featured = digitify_get_featured_cases( 1 );

	return ! empty( $featured[0]['img'] ) ? $featured[0]['img'] : 'case-next-hire.png';
}
