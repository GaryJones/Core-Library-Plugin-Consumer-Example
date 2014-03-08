<?php
/**
 * X Offers.
 *
 * @package     X_Offers
 * @author      Gary Jones <me@example.com>
 * @link        http://gamajo.com
 * @copyright   2014 Gary Jones, Gamajo Tech and X
 * @license     GPL-2.0+
 */

/**
 * Offer type taxonomy.
 *
 * @package X_Offers
 * @author  Gary Jones <me@example.com>
 */
class X_Taxonomy_Offer_Type extends Gamajo_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'offer_type';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => _x( 'Offer Types', 'taxonomy general name', 'x-offers' ),
			'singular_name'              => _x( 'Offer Type', 'taxonomy single name', 'x-offers' ),
			'menu_name'                  => __( 'Offer Types', 'x-offers' ),
			'all_items'                  => __( 'All Offer Types', 'x-offers' ),
			'search_items'               => __( 'Search Offer Types', 'x-offers' ),
			'popular_items'              => __( 'Popular Offer Types', 'x-offers' ),
			'add_new_item'               => __( 'Add New Offer Type', 'x-offers' ),
			'edit_item'                  => __( 'Edit Offer Type', 'x-offers' ),
			'update_item'                => __( 'Update Offer Type', 'x-offers' ),
			'new_item_name'              => __( 'New Offer Type Name', 'x-offers' ),
			'parent_item'                => __( 'Parent Offer Type', 'x-offers' ),
			'parent_item_colon'          => __( 'Parent Offer Type:', 'x-offers' ),
			'separate_items_with_commas' => __( 'Separate offer types with commas', 'x-offers' ),
			'add_or_remove_items'        => __( 'Add or remove offer types', 'x-offers' ),
			'choose_from_most_used'      => __( 'Choose from the most used offer types', 'x-offers' ),
			'not_found'                  => __( 'No offer types found.', 'x-offers' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'offer_type' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return $args;
	}
}
