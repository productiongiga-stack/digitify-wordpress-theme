<?php
/**
 * Case studies — Digitify portfolio
 *
 * @package Digitify
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once DIGITIFY_THEME_DIR . '/inc/cases-data.php';

function digitify_get_case_categories() {
	return array(
		'webdesign'  => __( 'Webdesign', 'digitify' ),
		'media'      => __( 'Media', 'digitify' ),
		'marketing'  => __( 'Marketing', 'digitify' ),
	);
}

function digitify_get_project_types() {
	return array(
		'website'      => __( 'Website', 'digitify' ),
		'webshop'      => __( 'Webshop', 'digitify' ),
		'webapp'       => __( 'Webapp', 'digitify' ),
		'platform'     => __( 'Platform', 'digitify' ),
		'leadgen'      => __( 'Leadgen', 'digitify' ),
		'advertentie'  => __( 'Advertentie', 'digitify' ),
		'video'        => __( 'Video', 'digitify' ),
		'documentaire' => __( 'Documentaire', 'digitify' ),
	);
}

/**
 * Flatten portfolio registry to case arrays.
 *
 * @return array<int, array<string, mixed>>
 */
function digitify_get_all_cases_flat() {
	static $cache = null;
	if ( null !== $cache ) {
		return $cache;
	}

	$cache = array();
	foreach ( digitify_get_portfolio_clients() as $client ) {
		foreach ( $client['projects'] as $project ) {
			$cache[] = digitify_normalize_case( $client, $project );
		}
	}

	usort(
		$cache,
		function ( $a, $b ) {
			if ( $a['featured'] === $b['featured'] ) {
				return strcmp( $b['year'], $a['year'] ) ?: strcmp( $a['title'], $b['title'] );
			}
			return $a['featured'] ? -1 : 1;
		}
	);

	return $cache;
}

/**
 * @param array<string, mixed> $client  Client group.
 * @param array<string, mixed> $project Project row.
 * @return array<string, mixed>
 */
function digitify_normalize_case( $client, $project ) {
	$tag = isset( $project['tag'] ) ? $project['tag'] : 'Webdesign';
	$category = 'webdesign';
	if ( 'Marketing' === $tag ) {
		$category = 'marketing';
	} elseif ( 'Media' === $tag ) {
		$category = 'media';
	}

	$type = isset( $project['type'] ) ? $project['type'] : 'website';
	$types = digitify_get_project_types();
	$type_label = isset( $types[ $type ] ) ? $types[ $type ] : ucfirst( $type );

	$case = array_merge(
		array(
			'slug'           => $project['slug'],
			'title'          => $project['title'],
			'label'          => $client['name'],
			'tag'            => $tag,
			'category'       => $category,
			'project_type'   => $type,
			'project_label'  => $type_label,
			'client_key'          => $client['key'],
			'client'              => $client['name'],
			'client_location'     => isset( $client['location'] ) ? $client['location'] : '',
			'client_website_url'  => '',
			'img'            => $project['img'],
			'image'          => $project['img'],
			'featured'       => ! empty( $project['featured'] ),
			'view_url'       => isset( $project['view_url'] ) ? $project['view_url'] : '',
			'view_label'     => isset( $project['view_label'] ) ? $project['view_label'] : '',
			'subtitle'       => '',
			'intro'          => '',
			'year'           => '2024',
			'services'       => array(),
			'challenge'      => '',
			'approach'       => '',
			'result'         => '',
			'deliverables'   => array(),
			'gallery'        => array(),
			'desc'           => '',
			'ton'            => '',
			'lift'           => '',
			'elec'           => 'Live',
		),
		$project
	);

	if ( empty( $case['desc'] ) && ! empty( $case['subtitle'] ) ) {
		$case['desc'] = $case['subtitle'];
	}

	if ( empty( $case['gallery'] ) ) {
		$case['gallery'] = array();
	}

	$website_urls = digitify_get_client_website_urls();
	if ( ! empty( $client['website_url'] ) ) {
		$case['client_website_url'] = $client['website_url'];
	} elseif ( ! empty( $website_urls[ $client['key'] ] ) ) {
		$case['client_website_url'] = $website_urls[ $client['key'] ];
	}

	if ( empty( $case['view_url'] ) && 'webdesign' === $case['category'] && ! empty( $case['client_website_url'] ) ) {
		$case['view_url'] = $case['client_website_url'];
	}

	$video_urls = digitify_get_case_video_urls();
	if ( ! empty( $video_urls[ $case['slug'] ] ) ) {
		$case['video_url'] = $video_urls[ $case['slug'] ];
		if ( empty( $case['view_url'] ) ) {
			$case['view_url']   = $case['video_url'];
			$case['view_label'] = __( 'Bekijk video', 'digitify' );
		}
	}

	return $case;
}

function digitify_get_all_cases_data() {
	$grouped = array(
		'webdesign' => array(),
		'media'     => array(),
		'marketing' => array(),
	);
	foreach ( digitify_get_all_cases_flat() as $case ) {
		if ( isset( $grouped[ $case['category'] ] ) ) {
			$grouped[ $case['category'] ][] = $case;
		}
	}
	return $grouped;
}

function digitify_get_cases( $category = '' ) {
	$all = digitify_get_all_cases_flat();
	if ( $category ) {
		return array_values(
			array_filter(
				$all,
				function ( $case ) use ( $category ) {
					return $case['category'] === $category;
				}
			)
		);
	}
	return $all;
}

function digitify_get_case( $slug ) {
	foreach ( digitify_get_all_cases_flat() as $case ) {
		if ( $case['slug'] === $slug ) {
			return $case;
		}
	}
	return null;
}

function digitify_get_case_url( $slug ) {
	return digitify_get_page_url( 'case-' . $slug );
}

/**
 * Clients grouped with all projects.
 *
 * @return array<int, array<string, mixed>>
 */
function digitify_get_portfolio_groups() {
	$groups = array();
	foreach ( digitify_get_portfolio_clients() as $client ) {
		$projects = array();
		foreach ( $client['projects'] as $project ) {
			$projects[] = digitify_normalize_case( $client, $project );
		}
		usort(
			$projects,
			function ( $a, $b ) {
				if ( $a['featured'] === $b['featured'] ) {
					return strcmp( $b['year'], $a['year'] );
				}
				return $a['featured'] ? -1 : 1;
			}
		);
		$hero = $projects[0];
		$groups[] = array(
			'key'          => $client['key'],
			'name'         => $client['name'],
			'location'     => isset( $client['location'] ) ? $client['location'] : '',
			'projects'     => $projects,
			'project_count'=> count( $projects ),
			'hero'         => $hero,
			'categories'   => array_values( array_unique( wp_list_pluck( $projects, 'category' ) ) ),
			'types'        => array_values( array_unique( wp_list_pluck( $projects, 'project_label' ) ) ),
			'featured'     => (bool) array_filter(
				$projects,
				function ( $p ) {
					return ! empty( $p['featured'] );
				}
			),
		);
	}

	usort(
		$groups,
		function ( $a, $b ) {
			if ( $a['featured'] === $b['featured'] ) {
				return strcmp( $a['name'], $b['name'] );
			}
			return $a['featured'] ? -1 : 1;
		}
	);

	return $groups;
}

function digitify_get_client_cases( $client_key, $exclude_slug = '' ) {
	return array_values(
		array_filter(
			digitify_get_all_cases_flat(),
			function ( $case ) use ( $client_key, $exclude_slug ) {
				if ( $case['client_key'] !== $client_key ) {
					return false;
				}
				if ( $exclude_slug && $case['slug'] === $exclude_slug ) {
					return false;
				}
				return true;
			}
		)
	);
}

function digitify_get_featured_cases( $limit = 6 ) {
	return array_slice(
		array_filter(
			digitify_get_all_cases_flat(),
			function ( $case ) {
				return ! empty( $case['featured'] );
			}
		),
		0,
		$limit
	);
}

function digitify_get_related_cases( $slug, $limit = 3 ) {
	$current = digitify_get_case( $slug );
	if ( ! $current ) {
		return array();
	}

	$related = array();
	$others  = array_filter(
		digitify_get_all_cases_flat(),
		function ( $case ) use ( $slug, $current ) {
			return $case['slug'] !== $slug
				&& $case['client_key'] !== $current['client_key']
				&& $case['category'] === $current['category'];
		}
	);

	foreach ( $others as $case ) {
		if ( count( $related ) >= $limit ) {
			break;
		}
		$related[] = $case;
	}

	return $related;
}

function digitify_get_case_page_definitions() {
	$pages = array();
	foreach ( digitify_get_all_cases_flat() as $case ) {
		$pages[ 'case-' . $case['slug'] ] = array(
			'title'    => $case['title'],
			'template' => 'page-templates/template-case.php',
		);
	}
	return $pages;
}

function digitify_is_case_page() {
	$slug = digitify_get_current_slug();
	return 0 === strpos( $slug, 'case-' );
}

function digitify_get_case_slug_from_page() {
	$slug = digitify_get_current_slug();
	if ( 0 === strpos( $slug, 'case-' ) ) {
		return substr( $slug, 5 );
	}
	return '';
}

function digitify_case_has_view_link( $case ) {
	return ! empty( $case['view_url'] ) && ! empty( $case['view_label'] );
}

function digitify_get_case_view_attrs( $case ) {
	return digitify_get_external_link_attrs( ! empty( $case['view_url'] ) ? $case['view_url'] : '' );
}

/**
 * @param string $url Absolute URL.
 * @return bool
 */
function digitify_is_video_url( $url ) {
	$host = wp_parse_url( $url, PHP_URL_HOST );
	if ( ! $host ) {
		return false;
	}

	$host = strtolower( $host );

	return false !== strpos( $host, 'youtube.com' )
		|| false !== strpos( $host, 'youtu.be' )
		|| false !== strpos( $host, 'vimeo.com' );
}

/**
 * @param array<string, mixed> $case Case row.
 * @return string
 */
function digitify_get_case_client_website_url( $case ) {
	if ( ! empty( $case['client_website_url'] ) ) {
		return $case['client_website_url'];
	}

	if ( ! empty( $case['view_url'] ) && ! digitify_is_video_url( $case['view_url'] ) ) {
		return $case['view_url'];
	}

	return '';
}

/**
 * Whether a case should show the live site in a browser frame.
 *
 * @param array<string, mixed> $case Case row.
 * @return bool
 */
function digitify_case_has_browser_preview( $case ) {
	if ( empty( $case['category'] ) || 'webdesign' !== $case['category'] ) {
		return false;
	}

	$url = digitify_get_case_client_website_url( $case );

	return ! empty( $url );
}

/**
 * Host label for the browser chrome URL bar.
 *
 * @param string $url Absolute URL.
 * @return string
 */
function digitify_get_case_browser_host( $url ) {
	$host = wp_parse_url( $url, PHP_URL_HOST );

	if ( ! $host ) {
		return '';
	}

	return preg_replace( '/^www\./', '', strtolower( $host ) );
}

/**
 * @param string $url Absolute URL.
 * @return string
 */
function digitify_get_external_link_attrs( $url ) {
	if ( empty( $url ) ) {
		return '';
	}

	$host     = wp_parse_url( $url, PHP_URL_HOST );
	$external = $host && false === strpos( home_url(), $host );

	return $external ? ' target="_blank" rel="noopener noreferrer"' : '';
}

/**
 * Platform / channel labels shown on case pages.
 *
 * @param array<string, mixed> $case Case row.
 * @return array<int, string>
 */
function digitify_get_case_platforms( $case ) {
	$skip   = array( 'Live', 'Brand', 'Social', 'Intern' );
	$labels = array();

	foreach ( array( 'lift', 'elec', 'ton' ) as $key ) {
		if ( empty( $case[ $key ] ) || in_array( $case[ $key ], $skip, true ) ) {
			continue;
		}
		$labels[] = $case[ $key ];
	}

	return array_values( array_unique( $labels ) );
}

/**
 * @param array<string, mixed> $case Case row.
 * @return bool
 */
function digitify_case_has_gallery( $case ) {
	return ! empty( $case['gallery'] ) && count( $case['gallery'] ) > 1;
}

/**
 * Extract a YouTube video ID from watch, youtu.be or embed URLs.
 *
 * @param string $url Video URL.
 * @return string
 */
function digitify_get_youtube_id( $url ) {
	if ( preg_match( '#(?:youtube\.com/watch\?v=|youtu\.be/|youtube-nocookie\.com/embed/)([A-Za-z0-9_-]{11})#', $url, $matches ) ) {
		return $matches[1];
	}

	return '';
}

/**
 * Privacy-friendly embed URL for case page iframes.
 *
 * @param string $url Video URL.
 * @return string
 */
function digitify_get_youtube_embed_url( $url ) {
	$video_id = digitify_get_youtube_id( $url );

	if ( ! $video_id ) {
		return '';
	}

	return 'https://www.youtube-nocookie.com/embed/' . $video_id;
}

/**
 * @param array<string, mixed> $case Case row.
 * @return string
 */
function digitify_get_case_video_embed_url( $case ) {
	if ( empty( $case['video_url'] ) ) {
		return '';
	}

	return digitify_get_youtube_embed_url( $case['video_url'] );
}
