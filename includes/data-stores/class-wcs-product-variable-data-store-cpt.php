<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WCS Variable Product Data Store: Stored in CPT.
 *
 * @version  2.3.0
 * @author   Prospress
 */
class WCS_Product_Variable_Data_Store_CPT extends WC_Product_Variable_Data_Store_CPT {

	/**
	 * Method to read a product from the database.
	 *
	 * @param WC_Product_Variable_Subscription $product Product object.
	 * @throws Exception If invalid product.
	 */
	public function read( &$product ) {
		parent::read( $product );
		$this->read_min_max_variation_data( $product );
	}

	/**
	 * Read min and max variation data from post meta.
	 *
	 * @param WC_Product_Variable_Subscription $product Product object.
	 */
	protected function read_min_max_variation_data( &$product ) {
		if ( ! $product->meta_exists( '_min_max_variation_ids_hash' ) ) {
			$product->set_min_and_max_variation_data();

			update_post_meta( $product->get_id(), '_min_max_variation_data', $product->get_meta( '_min_max_variation_data', true ), true );
			update_post_meta( $product->get_id(), '_min_max_variation_ids_hash', $product->get_meta( '_min_max_variation_ids_hash', true ), true );
		}
	}
}
