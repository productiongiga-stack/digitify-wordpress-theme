<?php
/**
 * Auto-create pages on theme activation
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digitify_create_page( $slug, $page_data ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		if ( ! empty( $page_data['template'] ) ) {
			$current = get_post_meta( $existing->ID, '_wp_page_template', true );
			if ( $current !== $page_data['template'] ) {
				update_post_meta( $existing->ID, '_wp_page_template', $page_data['template'] );
			}
		}
		return $existing->ID;
	}

	$page_id = wp_insert_post( array(
		'post_title'   => $page_data['title'],
		'post_name'    => $slug,
		'post_content' => isset( $page_data['content'] ) ? $page_data['content'] : '',
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_author'  => 1,
	) );

	if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $page_data['template'] ) ) {
		update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
	}

	if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $page_data['is_front'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_id );
	}

	return $page_id;
}

function digitify_create_pages() {
	$pages = digitify_get_page_definitions();

	foreach ( $pages as $slug => $page_data ) {
		digitify_create_page( $slug, $page_data );
	}

	update_option( 'digitify_pages_created', true );
	update_option( 'digitify_pages_version', '2.1.0' );
}
add_action( 'after_switch_theme', 'digitify_create_pages' );

function digitify_sync_pages_v2() {
	$version = get_option( 'digitify_pages_version', '' );
	if ( '2.5.0' === $version ) {
		return;
	}

	$pages = digitify_get_page_definitions();
	foreach ( $pages as $slug => $page_data ) {
		digitify_create_page( $slug, $page_data );
	}

	$tarieven = get_page_by_path( 'tarieven' );
	if ( $tarieven ) {
		wp_update_post( array(
			'ID'          => $tarieven->ID,
			'post_status' => 'draft',
		) );
	}

	digitify_sync_primary_menu();

	update_option( 'digitify_pages_version', '2.5.0' );
}
add_action( 'init', 'digitify_sync_pages_v2' );

/**
 * Sync new case pages from portfolio registry (v2.7).
 */
function digitify_sync_pages_v27() {
	$version = get_option( 'digitify_pages_version', '' );
	if ( '2.7.0' === $version ) {
		return;
	}

	$pages = digitify_get_page_definitions();
	foreach ( $pages as $slug => $page_data ) {
		digitify_create_page( $slug, $page_data );
	}

	update_option( 'digitify_pages_version', '2.7.0' );
}
add_action( 'init', 'digitify_sync_pages_v27' );

/**
 * Remove Tarieven from WP menu and ensure Contact is linked.
 */
function digitify_sync_primary_menu() {
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['primary'] ) ) {
		return;
	}

	$menu_id = (int) $locations['primary'];
	$items   = wp_get_nav_menu_items( $menu_id );

	if ( $items ) {
		foreach ( $items as $item ) {
			$remove = false !== stripos( $item->url, '/tarieven' );
			if ( ! $remove && 'page' === $item->object ) {
				$page = get_post( (int) $item->object_id );
				if ( $page && 'tarieven' === $page->post_name ) {
					$remove = true;
				}
			}
			if ( $remove ) {
				wp_delete_post( (int) $item->ID, true );
			}
		}
	}

	$contact_page = get_page_by_path( 'contact' );
	if ( ! $contact_page ) {
		return;
	}

	$has_contact = false;
	$items       = wp_get_nav_menu_items( $menu_id );
	if ( $items ) {
		foreach ( $items as $item ) {
			if ( (int) $item->object_id === (int) $contact_page->ID ) {
				$has_contact = true;
				break;
			}
		}
	}

	if ( ! $has_contact ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'Contact',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $contact_page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}
}

/**
 * Never surface removed pages in navigation output.
 */
function digitify_filter_nav_menu_items( $items, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $items;
	}

	return array_values(
		array_filter(
			$items,
			function ( $item ) {
				return false === stripos( $item->url, '/tarieven' );
			}
		)
	);
}
add_filter( 'wp_nav_menu_objects', 'digitify_filter_nav_menu_items', 10, 2 );

function digitify_get_page_definitions() {
	$service_template = 'page-templates/template-service.php';

	$pages = array(
		'home' => array(
			'title'    => 'Home',
			'content'  => '',
			'is_front' => true,
		),
		'diensten' => array(
			'title'    => 'Diensten',
			'template' => 'page-templates/template-diensten.php',
		),
		'webdesign' => array(
			'title'    => 'Webdesign',
			'template' => $service_template,
		),
		'media' => array(
			'title'    => 'Media',
			'template' => $service_template,
		),
		'marketing' => array(
			'title'    => 'Marketing',
			'template' => $service_template,
		),
		'cases' => array(
			'title'    => 'Cases',
			'template' => 'page-templates/template-vloot.php',
		),
		'over-ons' => array(
			'title'    => 'Over ons',
			'template' => 'page-templates/template-over-ons.php',
		),
		'contact' => array(
			'title'    => 'Contact',
			'template' => 'page-templates/template-boeking.php',
		),
		'algemene-voorwaarden' => array(
			'title'    => 'Algemene Voorwaarden',
			'content'  => digitify_legal_content( 'algemene-voorwaarden' ),
			'template' => 'page-templates/template-legal.php',
		),
		'cookiebeleid' => array(
			'title'    => 'Cookiebeleid',
			'content'  => digitify_legal_content( 'cookiebeleid' ),
			'template' => 'page-templates/template-legal.php',
		),
		'privacyverklaring' => array(
			'title'    => 'Privacyverklaring',
			'content'  => digitify_legal_content( 'privacyverklaring' ),
			'template' => 'page-templates/template-legal.php',
		),
	);

	return array_merge( $pages, digitify_get_case_page_definitions() );
}

function digitify_legal_content( $type ) {
	$contents = array(
		'algemene-voorwaarden' => '
<h2 id="identiteit">1. Identiteit van de onderneming</h2>
<p><strong>Digitify</strong><br>Adres: Boekweitstraat 7, 9000 Gent<br>E-mail: <a href="mailto:contact@digitify.be">contact@digitify.be</a><br>Website: <a href="https://www.digitify.be/">https://www.digitify.be/</a></p>
<p>Digitify is een dienstverlenend bedrijf actief in digitale en online diensten (webontwikkeling, marketing, media en aanverwante diensten).</p>

<h2 id="toepasselijkheid">2. Toepasselijkheid</h2>
<p>Deze algemene voorwaarden zijn van toepassing op alle offertes, overeenkomsten en diensten van Digitify, tenzij schriftelijk anders overeengekomen.</p>

<h2 id="offertes">3. Offertes en overeenkomsten</h2>
<p>Alle offertes zijn vrijblijvend, tenzij anders vermeld. Offertes zijn geldig gedurende 30 dagen. Een overeenkomst komt tot stand na schriftelijke bevestiging door de klant.</p>

<h2 id="uitvoering">4. Uitvoering van de diensten</h2>
<p>Digitify voert haar diensten uit naar beste inzicht en vermogen. Termijnen zijn indicatief, tenzij uitdrukkelijk schriftelijk bevestigd.</p>

<h2 id="prijzen">5. Prijzen en betaling</h2>
<p>Alle prijzen zijn exclusief btw, tenzij anders vermeld. Facturen zijn betaalbaar binnen 20 dagen na factuurdatum.</p>

<h2 id="aansprakelijkheid">6. Aansprakelijkheid</h2>
<p>Digitify is niet aansprakelijk voor indirecte schade. De aansprakelijkheid is beperkt tot het bedrag van de overeenkomst waarop de schade betrekking heeft.</p>

<h2 id="privacy">7. Privacy</h2>
<p>Meer informatie over gegevensverwerking vindt u in onze <a href="' . esc_url( digitify_get_page_url( 'privacyverklaring' ) ) . '">Privacyverklaring</a>.</p>

<h2 id="recht">8. Toepasselijk recht</h2>
<p>Op alle overeenkomsten is het Belgisch recht van toepassing. Geschillen worden voorgelegd aan de rechtbanken van het arrondissement Gent.</p>
',
		'cookiebeleid' => '
<h2 id="cookies">Wat zijn cookies?</h2>
<p>Cookies zijn kleine tekstbestanden die bij het bezoeken van onze website op uw apparaat worden opgeslagen.</p>

<h2 id="doel">Waarom gebruiken wij cookies?</h2>
<p><strong>Essentiële cookies:</strong> noodzakelijk voor werking en beveiliging.<br><strong>Functionele cookies:</strong> onthouden voorkeuren.<br><strong>Analytische cookies:</strong> inzicht in websitegebruik.<br><strong>Marketingcookies:</strong> enkel mits toestemming.</p>

<h2 id="contact">Contact</h2>
<p>Vragen? Mail ons via <a href="mailto:contact@digitify.be">contact@digitify.be</a>.</p>
',
		'privacyverklaring' => '
<h2 id="verantwoordelijke">1. Verwerkingsverantwoordelijke</h2>
<p><strong>Digitify</strong>, Boekweitstraat 7, 9000 Gent — <a href="mailto:contact@digitify.be">contact@digitify.be</a></p>

<h2 id="gegevens">2. Welke gegevens verwerken wij?</h2>
<p>Naam, e-mail, telefoon, bedrijfsnaam en inhoud van contact- of offerteformulieren. Automatisch verzamelde gegevens zoals IP-adres en browsegedrag.</p>

<h2 id="doel">3. Doeleinden</h2>
<p>Beantwoorden van vragen, opvolgen van offertes, uitvoering van diensten, verbetering van de website en marketing (mits toestemming).</p>

<h2 id="rechten">4. Uw rechten</h2>
<p>Inzage, rectificatie, verwijdering, beperking, bezwaar en dataportabiliteit via <a href="mailto:contact@digitify.be">contact@digitify.be</a>.</p>
',
	);

	return isset( $contents[ $type ] ) ? trim( $contents[ $type ] ) : '';
}

function digitify_register_page_templates( $templates ) {
	$templates['page-templates/template-diensten.php']   = 'Diensten';
	$templates['page-templates/template-service.php']    = 'Dienst (SEO)';
	$templates['page-templates/template-vloot.php']      = 'Cases';
	$templates['page-templates/template-case.php']       = 'Case';
	$templates['page-templates/template-over-ons.php']   = 'Over ons';
	$templates['page-templates/template-boeking.php']    = 'Contact';
	$templates['page-templates/template-legal.php']      = 'Juridisch';
	return $templates;
}
add_filter( 'theme_page_templates', 'digitify_register_page_templates' );

function digitify_get_mega_hub_card( $slug, $hub = 'service' ) {
	$cards = 'fleet' === $hub ? digitify_get_fleet_hub_cards() : digitify_get_service_hub_cards();
	foreach ( $cards as $card ) {
		if ( $card['slug'] === $slug ) {
			return $card;
		}
	}
	return null;
}

function digitify_get_service_nav_children() {
	$children = array();
	foreach ( digitify_get_service_hub_cards() as $card ) {
		$children[] = array(
			'slug'  => $card['slug'],
			'label' => $card['title'],
			'url'   => digitify_get_page_url( $card['slug'] ),
		);
	}
	return $children;
}

function digitify_get_cases_nav_children() {
	$children = array(
		array(
			'slug'  => 'cases',
			'label' => __( 'Alle projecten', 'digitify' ),
			'url'   => digitify_get_page_url( 'cases' ),
		),
	);

	foreach ( digitify_get_case_categories() as $slug => $label ) {
		$children[] = array(
			'slug'  => 'case-cat-' . $slug,
			'label' => $label,
			'url'   => digitify_get_page_url( 'cases' ) . '#' . rawurlencode( $slug ),
		);
	}

	return $children;
}

function digitify_get_primary_nav_items() {
	return array(
		array(
			'slug'  => 'home',
			'label' => __( 'Home', 'digitify' ),
			'url'   => home_url( '/' ),
		),
		array(
			'slug'     => 'diensten',
			'label'    => __( 'Diensten', 'digitify' ),
			'url'      => digitify_get_page_url( 'diensten' ),
			'mega'     => 'service',
			'children' => digitify_get_service_nav_children(),
		),
		array(
			'slug'     => 'cases',
			'label'    => __( 'Cases', 'digitify' ),
			'url'      => digitify_get_page_url( 'cases' ),
			'mega'     => 'fleet',
			'children' => digitify_get_cases_nav_children(),
		),
		array(
			'slug'  => 'over-ons',
			'label' => __( 'Over ons', 'digitify' ),
			'url'   => digitify_get_page_url( 'over-ons' ),
		),
		array(
			'slug'  => 'contact',
			'label' => __( 'Contact', 'digitify' ),
			'url'   => digitify_get_page_url( 'contact' ),
		),
	);
}

function digitify_render_mega_dropdown( $children, $hub = 'service' ) {
	$class = 'digitify-nav__dropdown digitify-nav__dropdown--mega';
	if ( 'fleet' === $hub ) {
		$class .= ' digitify-nav__dropdown--fleet digitify-nav__dropdown--text';
	}

	echo '<ul class="' . esc_attr( $class ) . '">';
	foreach ( $children as $child ) {
		$card         = 'fleet' === $hub ? null : digitify_get_mega_hub_card( $child['slug'], $hub );
		$child_active = ( 'cases' === $child['slug'] && is_page( 'cases' ) && ! digitify_is_case_page() )
			|| digitify_is_current( $child['slug'] );
		echo '<li><a href="' . esc_url( $child['url'] ) . '" class="digitify-nav__mega-link' . ( $child_active ? ' is-active' : '' ) . '">';
		if ( 'fleet' !== $hub && $card ) {
			$thumb_class = 'digitify-nav__mega-thumb';
			if ( 'service' === $hub ) {
				$thumb_class .= ' digitify-nav__mega-thumb--icon';
				$image        = digitify_get_service_element_image( $child['slug'] );
			} elseif ( ! empty( $card['image'] ) ) {
				$image = $card['image'];
			} else {
				$image = null;
			}

			if ( $image ) {
				echo '<span class="' . esc_attr( $thumb_class ) . '"><img src="' . esc_url( digitify_get_image( $image ) ) . '" alt="" loading="lazy" decoding="async" width="80" height="80"></span>';
			}
		}
		echo '<span class="digitify-nav__mega-text">' . esc_html( $child['label'] ) . '</span>';
		echo '</a></li>';
	}
	echo '</ul>';
}

function digitify_render_primary_nav() {
	$items = digitify_get_primary_nav_items();

	echo '<ul class="digitify-nav__list">';
	foreach ( $items as $item ) {
		$has_children = ! empty( $item['children'] );
		$hub          = isset( $item['mega'] ) ? $item['mega'] : 'service';
		$active       = digitify_is_current( $item['slug'] )
			|| ( $has_children && 'service' === $hub && digitify_is_service_section() )
			|| ( $has_children && 'fleet' === $hub && digitify_is_fleet_section() );
		$class        = 'digitify-nav__item' . ( $has_children ? ' digitify-nav__item--has-dropdown' : '' );
		echo '<li class="' . esc_attr( $class ) . '"' . ( $has_children ? ' aria-haspopup="true"' : '' ) . '>';
		echo '<a href="' . esc_url( $item['url'] ) . '" class="digitify-nav__link' . ( $active ? ' is-active' : '' ) . '">';
		echo '<span class="digitify-nav__link-text">' . esc_html( $item['label'] ) . '</span>';
		if ( $has_children ) {
			echo '<span class="digitify-nav__caret" aria-hidden="true"></span>';
		}
		echo '</a>';
		if ( $has_children ) {
			digitify_render_mega_dropdown( $item['children'], $hub );
		}
		echo '</li>';
	}
	echo '</ul>';
}

function digitify_fallback_menu() {
	digitify_render_primary_nav();
}

function digitify_is_service_section() {
	$slug = digitify_get_current_slug();
	return in_array( $slug, digitify_get_service_slugs(), true ) || is_page( 'diensten' );
}

function digitify_is_fleet_section() {
	return is_page( 'cases' ) || digitify_is_case_page();
}
