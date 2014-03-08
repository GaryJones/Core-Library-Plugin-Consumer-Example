<?php
/**
 * X Offers.
 *
 * @package   X_Offers
 * @author    Gary Jones <me@example.com>
 * @link      http://gamajo.com
 * @copyright 2014 Gary Jones, Gamajo Tech and X
 * @license   GPL-2.0+
 */

/**
 * Offer post type.
 *
 * @package X_Offers
 * @author  Gary Jones <me@example.com>
 */
class X_Post_Type_Offer extends Gamajo_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'offer';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'               => _x( 'Offers', 'post type general name', 'x-offers' ),
			'singular_name'      => _x( 'Offer', 'post type singular name', 'x-offers' ),
			'menu_name'          => _x( 'Offers', 'admin menu', 'x-offers' ),
			'name_admin_bar'     => _x( 'Offer', 'add new on admin bar', 'x-offers' ),
			'add_new'            => _x( 'Add New', 'offer', 'x-offers' ),
			'add_new_item'       => __( 'Add New Offer', 'x-offers' ),
			'new_item'           => __( 'New Offer', 'x-offers' ),
			'edit_item'          => __( 'Edit Offer', 'x-offers' ),
			'view_item'          => __( 'View Offer', 'x-offers' ),
			'all_items'          => __( 'All Offers', 'x-offers' ),
			'search_items'       => __( 'Search Offers', 'x-offers' ),
			'parent_item_colon'  => __( 'Parent Offers:', 'x-offers' ),
			'not_found'          => __( 'No offers found.', 'x-offers' ),
			'not_found_in_trash' => __( 'No offers found in Trash.', 'x-offers' ),
		);

		$supports = array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'custom-fields',
			'revisions',
			'page-attributes',
			'genesis-seo',
		);

		$taxonomies = array(
			'category',
			'post_tag',
			'page-category',
			'offer_type',
		);

		$args = array(
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => true,
			'description'         => __( 'X featured offers.', 'x-offers' ),
			'taxonomies'          => $taxonomies,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-tag',
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => 'offers',
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array(
				'slug'       => 'offer',
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
			),
			'capability_type' => 'page',
		);

		return $args;
	}

	/**
	 * Return post type updated messages.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type updated messages.
	 */
	public function messages() {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Offer updated.', 'x-offers' ),
			2  => __( 'Custom field updated.', 'x-offers' ),
			3  => __( 'Custom field deleted.', 'x-offers' ),
			4  => __( 'Offer updated.', 'x-offers' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Offer restored to revision from %s', 'x-offers' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Offer published.', 'x-offers' ),
			7  => __( 'Offer saved.', 'x-offers' ),
			8  => __( 'Offer submitted.', 'x-offers' ),
			9  => sprintf( __( 'Offer scheduled for: <strong>%1$s</strong>.', 'x-offers' ),
				  // translators: Publish box date format, see http://php.net/date
				  date_i18n( __( 'M j, Y @ G:i', 'x-offers' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Offer draft updated.', 'x-offers' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View offer', 'x-offers' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview offer', 'x-offers' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
