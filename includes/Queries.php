<?php
/**
 * Query helpers.
 *
 * @package PNS_Herstories
 */

namespace PNS\Herstories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provides Herstory query helpers for themes.
 */
final class Queries {
	/**
	 * Register query hooks.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'pre_get_posts', array( __CLASS__, 'order_main_archive_query' ) );
	}

	/**
	 * Keep public Herstory listing routes in editorial order.
	 *
	 * @param \WP_Query $query Query instance.
	 * @return void
	 */
	public static function order_main_archive_query( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( ! $query->is_post_type_archive( PostTypes::POST_TYPE ) && ! $query->is_tax( Taxonomies::TAG ) ) {
			return;
		}

		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		$query->set( 'order', 'ASC' );
	}

	/**
	 * Get ordered Herstory query arguments.
	 *
	 * @param array<string,mixed> $args Overrides.
	 * @return array<string,mixed>
	 */
	public static function ordered_args( $args = array() ) {
		return wp_parse_args(
			$args,
			array(
				'post_type'      => PostTypes::POST_TYPE,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'title'      => 'ASC',
				),
				'order'          => 'ASC',
			)
		);
	}

	/**
	 * Query ordered Herstory posts.
	 *
	 * @param array<string,mixed> $args Overrides.
	 * @return \WP_Query
	 */
	public static function ordered_query( $args = array() ) {
		return new \WP_Query( self::ordered_args( $args ) );
	}

	/**
	 * Find adjacent Herstory posts in editorial order.
	 *
	 * @param int|\WP_Post|null $post Post object or ID.
	 * @return array{previous:\WP_Post|null,next:\WP_Post|null}
	 */
	public static function adjacent( $post = null ) {
		$post = get_post( $post );

		if ( ! $post || PostTypes::POST_TYPE !== $post->post_type ) {
			return array(
				'previous' => null,
				'next'     => null,
			);
		}

		$query = self::ordered_query(
			array(
				'fields'         => 'ids',
				'posts_per_page' => -1,
			)
		);

		$ids   = array_map( 'intval', $query->posts );
		$index = array_search( (int) $post->ID, $ids, true );

		if ( false === $index ) {
			return array(
				'previous' => null,
				'next'     => null,
			);
		}

		return array(
			'previous' => isset( $ids[ $index - 1 ] ) ? get_post( $ids[ $index - 1 ] ) : null,
			'next'     => isset( $ids[ $index + 1 ] ) ? get_post( $ids[ $index + 1 ] ) : null,
		);
	}
}
