<?php
/**
 * Admin UI helpers.
 *
 * @package PNS_Herstories
 */

namespace PNS\Herstories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds editor-facing conveniences for Herstories.
 */
final class Admin {
	/**
	 * Register admin hooks.
	 *
	 * @return void
	 */
	public static function register() {
		add_filter( 'manage_' . PostTypes::POST_TYPE . '_posts_columns', array( self::class, 'columns' ) );
		add_action( 'manage_' . PostTypes::POST_TYPE . '_posts_custom_column', array( self::class, 'column_content' ), 10, 2 );
		add_filter( 'manage_edit-' . PostTypes::POST_TYPE . '_sortable_columns', array( self::class, 'sortable_columns' ) );
		add_action( 'pre_get_posts', array( self::class, 'order_admin_list' ) );
	}

	/**
	 * Add useful list-table columns.
	 *
	 * @param array<string,string> $columns Current columns.
	 * @return array<string,string>
	 */
	public static function columns( $columns ) {
		$ordered = array();

		foreach ( $columns as $key => $label ) {
			$ordered[ $key ] = $label;

			if ( 'title' === $key ) {
				$ordered['menu_order'] = __( 'Order', 'pns-herstories' );
			}
		}

		return $ordered;
	}

	/**
	 * Render custom column content.
	 *
	 * @param string $column_name Column key.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public static function column_content( $column_name, $post_id ) {
		if ( 'menu_order' !== $column_name ) {
			return;
		}

		echo esc_html( (string) get_post_field( 'menu_order', $post_id ) );
	}

	/**
	 * Make custom columns sortable.
	 *
	 * @param array<string,string> $columns Sortable columns.
	 * @return array<string,string>
	 */
	public static function sortable_columns( $columns ) {
		$columns['menu_order'] = 'menu_order';

		return $columns;
	}

	/**
	 * Default the Herstories admin list to editorial order.
	 *
	 * @param \WP_Query $query Query object.
	 * @return void
	 */
	public static function order_admin_list( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( PostTypes::POST_TYPE !== $query->get( 'post_type' ) || $query->get( 'orderby' ) ) {
			return;
		}

		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
	}
}
