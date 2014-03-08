<?php
/**
 * X Offers.
 *
 * @package    X_Offers
 * @author     Gary Jones <me@example.com>
 * @license    GPL-2.0+
 * @link       http://gamajo.com/
 *
 * @wordpress-plugin
 * Plugin Name:       X Offers
 * Plugin URI:        http://www.example.com
 * Description:       Register offers post type, offer type taxonomy and shows them.
 * Version:           1.0.0
 * Author:            Gary Jones
 * Text Domain:       x-offers
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! function_exists( 'x_core' ) ) {
	deactivate_plugins( plugin_basename( __FILE__ ), true );
}

add_action( 'init', 'x_featured_offers' );
/**
 * Kickstart this plugin.
 *
 * @since 1.0.0
 */
function x_featured_offers() {
	// Register offer type taxonomy
	require plugin_dir_path( __FILE__ ) . 'includes/class-x-taxonomy-offer-type.php';
	global $dt_taxonomy_offer_type;
	$dt_taxonomy_offer_type = new DT_Taxonomy_Offer_Type;
	$dt_taxonomy_offer_type->register();

	// Register offer post type
	require plugin_dir_path( __FILE__ ) . 'includes/class-x-post-type-offer.php';
	global $dt_post_type_offer;
	$dt_post_type_offer = new DT_Post_Type_Offer;
	$dt_post_type_offer->register();

	// Show offers
	if ( ! is_admin() ) {
		require plugin_dir_path( __FILE__ ) . 'includes/class-x-offer-renderer.php';
		global $dt_offer_renderer;
		$dt_offer_renderer = new DT_Offer_Renderer;
		$dt_offer_renderer->run();
	}

	// Show count on dashboard
	if ( is_admin() ) {
		$glancer = new Gamajo_Dashboard_Glancer;
		$glancer->add( $dt_post_type_offer->get_post_type(), 'publish' );
	}
}
