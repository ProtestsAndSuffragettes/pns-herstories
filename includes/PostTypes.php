<?php
/**
 * Custom post type registration.
 *
 * @package PNS_Herstories
 */

namespace PNS\Herstories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the Herstory content type.
 */
final class PostTypes {
	public const POST_TYPE = 'herstory';

	/**
	 * Register the custom post type.
	 *
	 * @return void
	 */
	public static function register() {
		register_post_type(
			self::POST_TYPE,
			array(
				'labels'             => self::labels(),
				'description'        => __( 'Herstory profiles and biographical entries.', 'pns-herstories' ),
				'public'             => true,
				'has_archive'        => 'herstories',
				'hierarchical'       => false,
				'menu_icon'          => 'dashicons-book-alt',
				'menu_position'      => 21,
				'rewrite'            => array(
					'slug'       => 'herstories',
					'with_front' => false,
				),
				'show_in_rest'       => true,
				'supports'           => array(
					'title',
					'editor',
					'excerpt',
					'thumbnail',
					'revisions',
					'author',
					'custom-fields',
					'page-attributes',
				),
				'taxonomies'         => array( Taxonomies::TAG ),
				'template'           => self::get_editor_template(),
				'template_lock'      => false,
				'delete_with_user'   => false,
				'can_export'         => true,
				'show_in_nav_menus'  => true,
			)
		);
	}

	/**
	 * Get labels for the post type.
	 *
	 * @return array<string,string>
	 */
	private static function labels() {
		return array(
			'name'                     => __( 'Herstories', 'pns-herstories' ),
			'singular_name'            => __( 'Herstory', 'pns-herstories' ),
			'add_new'                  => __( 'Add New', 'pns-herstories' ),
			'add_new_item'             => __( 'Add New Herstory', 'pns-herstories' ),
			'edit_item'                => __( 'Edit Herstory', 'pns-herstories' ),
			'new_item'                 => __( 'New Herstory', 'pns-herstories' ),
			'view_item'                => __( 'View Herstory', 'pns-herstories' ),
			'view_items'               => __( 'View Herstories', 'pns-herstories' ),
			'search_items'             => __( 'Search Herstories', 'pns-herstories' ),
			'not_found'                => __( 'No herstories found.', 'pns-herstories' ),
			'not_found_in_trash'       => __( 'No herstories found in Trash.', 'pns-herstories' ),
			'all_items'                => __( 'All Herstories', 'pns-herstories' ),
			'archives'                 => __( 'Herstory Archives', 'pns-herstories' ),
			'attributes'               => __( 'Herstory Attributes', 'pns-herstories' ),
			'insert_into_item'         => __( 'Insert into herstory', 'pns-herstories' ),
			'uploaded_to_this_item'    => __( 'Uploaded to this herstory', 'pns-herstories' ),
			'featured_image'           => __( 'Featured image', 'pns-herstories' ),
			'set_featured_image'       => __( 'Set featured image', 'pns-herstories' ),
			'remove_featured_image'    => __( 'Remove featured image', 'pns-herstories' ),
			'use_featured_image'       => __( 'Use as featured image', 'pns-herstories' ),
			'filter_items_list'        => __( 'Filter herstories list', 'pns-herstories' ),
			'items_list_navigation'    => __( 'Herstories list navigation', 'pns-herstories' ),
			'items_list'               => __( 'Herstories list', 'pns-herstories' ),
			'item_published'           => __( 'Herstory published.', 'pns-herstories' ),
			'item_published_privately' => __( 'Herstory published privately.', 'pns-herstories' ),
			'item_reverted_to_draft'   => __( 'Herstory reverted to draft.', 'pns-herstories' ),
			'item_scheduled'           => __( 'Herstory scheduled.', 'pns-herstories' ),
			'item_updated'             => __( 'Herstory updated.', 'pns-herstories' ),
			'template_name'            => __( 'Single item: Herstory', 'pns-herstories' ),
		);
	}

	/**
	 * Default editable block scaffold for new Herstory posts.
	 *
	 * @return array<int,array<int,mixed>>
	 */
	private static function get_editor_template() {
		$template = apply_filters( 'pns_herstories_editor_template', self::default_editor_template() );

		return is_array( $template ) ? $template : self::default_editor_template();
	}

	/**
	 * Default editable block scaffold for new Herstory posts.
	 *
	 * The active theme may replace this via the pns_herstories_editor_template
	 * filter so visual layout stays theme-owned.
	 *
	 * @return array<int,array<int,mixed>>
	 */
	private static function default_editor_template() {
		return array(
			array(
				'core/group',
				array(
					'align'     => 'full',
					'className' => 'pns-section pns-herstories pns-suffragette-hero',
					'metadata'  => array(
						'name' => __( 'Herstory hero', 'pns-herstories' ),
					),
				),
				array(
					array(
						'core/heading',
						array(
							'level'   => 1,
							'content' => __( 'Herstory title', 'pns-herstories' ),
						),
					),
					array(
						'core/paragraph',
						array(
							'placeholder' => __( 'Add a short introduction.', 'pns-herstories' ),
						),
					),
					array(
						'core/list',
						array(
							'className' => 'active-dates',
						),
						array(
							array(
								'core/list-item',
								array(
									'content' => __( '<strong>Active:</strong> Add dates or period', 'pns-herstories' ),
								),
							),
						),
					),
				),
			),
			array(
				'core/group',
				array(
					'align'     => 'full',
					'className' => 'pns-section pns-herstories pns-suffragette-text-media',
					'metadata'  => array(
						'name' => __( 'Main herstory content', 'pns-herstories' ),
					),
				),
				array(
					array(
						'core/heading',
						array(
							'level'   => 2,
							'content' => __( 'About this herstory', 'pns-herstories' ),
						),
					),
					array(
						'core/paragraph',
						array(
							'placeholder' => __( 'Add the main story.', 'pns-herstories' ),
						),
					),
				),
			),
			array(
				'core/group',
				array(
					'align'     => 'full',
					'className' => 'pns-section pns-herstories pns-suffragette-facts',
					'metadata'  => array(
						'name' => __( 'Herstory facts', 'pns-herstories' ),
					),
				),
				array(
					array(
						'core/heading',
						array(
							'level'   => 2,
							'content' => __( 'Key facts', 'pns-herstories' ),
						),
					),
					array(
						'core/list',
						array(
							'className' => 'fun-facts',
						),
						array(
							array(
								'core/list-item',
								array(
									'content' => __( 'Add a key fact.', 'pns-herstories' ),
								),
							),
						),
					),
				),
			),
		);
	}
}
