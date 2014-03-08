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
 * Featured Offer display.
 *
 * @package X_Offers
 * @author  Gary Jones <me@example.com>
 */
class X_Offer_Renderer {
	/**
	 * Attach hooks.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		if ( ! function_exists( 'get_field' ) ) {
			return;
		}
		add_action( 'genesis_entry_content', array( $this, 'news_offers' ), 13 );
		add_action( 'genesis_entry_content', array( $this, 'blog_offers' ), 13 );
	}

	/**
	 * Show offers for News category single posts.
	 *
	 * @since 1.0.0
	 *
	 * @return null Return early if not a single post in the news category.
	 */
	public function news_offers() {
		if ( ! in_category( 'news' ) || ! is_single() ) {
			return;
		}

		if ( $featured_offers = get_field( 'featured_offers' ) ) {
			foreach ( $featured_offers as $featured_offer ) {
				$this->show_offer( $featured_offer );
			}
		} else {
			// Display hard coded offer below if one is not selected
			$featured_offer = get_post( 1234 ); // The Guide to Foo
			$link_text = __( 'Free Download', 'x-offers' );
			$this->show_offer( $featured_offer, $link_text );
		}
	}

	/**
	 * Show offers for single entries not in the new category, or newsletter entries.
	 *
	 * @since 1.0.0
	 *
	 * @return null Return early if single newsletter, or single post in news category or not single entry.
	 */
	public function blog_offers() {

		if ( is_singular( 'newsletter') || in_category( 'news' ) || ! is_single() ) {
			return;
		}

		if ( ! $featured_offers = get_field( 'featured_offers' ) ) {
			return;
		}

		foreach ( $featured_offers as $featured_offer ){
			$this->show_offer( $featured_offer, $link_text );
		}
	}

	/**
	 * Echo markup for an offer.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post $featured_offer Offer post object.
	 * @param string  $link_text      Link text.
	 */
	protected function show_offer( $featured_offer, $link_text = null ) {
		if ( is_null( $link_text ) ) {
			$link_text = $this->get_link_text( $featured_offer->ID );
		}

		echo '<div class="offer"><a href="'. esc_url( get_permalink( $featured_offer->ID ) ) . '">' . get_the_post_thumbnail( $featured_offer->ID, 'offer_medium' ) . '</a></div>';
		echo '<h2>' . $featured_offer->post_title . '</h2>';
		echo '<p>' . $featured_offer->post_excerpt . '</p>';
		echo '<p><a class="button" href="'. esc_url( get_permalink( $featured_offer->ID ) ) . '">' . $link_text . '</a>';
	}

	/**
	 * Check and get link text from a featured offer meta data.
	 *
	 * @since  1.0.0
	 *
	 * @param  int    $featured_offer_id Featured offer ID.
	 *
	 * @return string                    Link text.
	 */
	protected function get_link_text( $featured_offer_id ) {
		if ( $link_text = get_field( 'registration_form_link_text' , $featured_offer_id ) ) {
			return $link_text;
		}
		return __( 'Register Now', 'x-offers' );
	}
}
