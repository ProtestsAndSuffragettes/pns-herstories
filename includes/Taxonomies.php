<?php
/**
 * Taxonomy registration.
 *
 * @package PNS_Herstories
 */

namespace PNS\Herstories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers Herstories taxonomies.
 */
final class Taxonomies {
	public const TAG = 'herstory_tag';

	/**
	 * Register taxonomies.
	 *
	 * @return void
	 */
	public static function register() {
		register_taxonomy(
			self::TAG,
			array( PostTypes::POST_TYPE ),
			array(
				'labels'            => self::tag_labels(),
				'description'       => __( 'Tags for grouping Herstory entries.', 'pns-herstories' ),
				'public'            => true,
				'hierarchical'      => false,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => array(
					'slug'       => 'herstories/tag',
					'with_front' => false,
				),
			)
		);
	}

	/**
	 * Get taxonomy labels.
	 *
	 * @return array<string,string>
	 */
	private static function tag_labels() {
		return array(
			'name'                       => __( 'Herstory Tags', 'pns-herstories' ),
			'singular_name'              => __( 'Herstory Tag', 'pns-herstories' ),
			'search_items'               => __( 'Search Herstory Tags', 'pns-herstories' ),
			'popular_items'              => __( 'Popular Herstory Tags', 'pns-herstories' ),
			'all_items'                  => __( 'All Herstory Tags', 'pns-herstories' ),
			'edit_item'                  => __( 'Edit Herstory Tag', 'pns-herstories' ),
			'view_item'                  => __( 'View Herstory Tag', 'pns-herstories' ),
			'update_item'                => __( 'Update Herstory Tag', 'pns-herstories' ),
			'add_new_item'               => __( 'Add New Herstory Tag', 'pns-herstories' ),
			'new_item_name'              => __( 'New Herstory Tag Name', 'pns-herstories' ),
			'separate_items_with_commas' => __( 'Separate herstory tags with commas', 'pns-herstories' ),
			'add_or_remove_items'        => __( 'Add or remove herstory tags', 'pns-herstories' ),
			'choose_from_most_used'      => __( 'Choose from the most used herstory tags', 'pns-herstories' ),
			'not_found'                  => __( 'No herstory tags found.', 'pns-herstories' ),
			'no_terms'                   => __( 'No herstory tags', 'pns-herstories' ),
			'items_list_navigation'      => __( 'Herstory tags list navigation', 'pns-herstories' ),
			'items_list'                 => __( 'Herstory tags list', 'pns-herstories' ),
			'back_to_items'              => __( 'Back to herstory tags', 'pns-herstories' ),
		);
	}
}
