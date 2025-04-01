<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

use WC_Product_Simple;

class WooCommerce
{
	/**
	 * @param Product $product
	 *
	 * @return int Product id
	 */
	public function addProduct(Product $product): int
	{
		// https://rudrastyh.com/woocommerce/create-product-programmatically.html#on-sale-products
		$wooProduct = new WC_Product_Simple();
		$wooProduct->set_name($product->getTitle());
		$wooProduct->set_slug($product->getSlug());
		$wooProduct->set_regular_price($product->getPrice()->getRegular());
		$wooProduct->set_short_description($product->getShortDescription());
		$wooProduct->set_description($product->getDescription());
		$wooProduct->set_cross_sell_ids($product->getLinkedProducts()->getCrossSellsProductIds());
		$wooProduct->set_date_created(time());

		$downloadableFile = $product->getDownloadableFile();

		if($downloadableFile !== null) {
			$wooProduct->set_downloadable(true);
			$wooProduct->set_download_expiry($downloadableFile->getDownloadExpireDays());
			$wooProduct->set_download_limit($downloadableFile->getDownloadLimit());
		}

		$dimensions = $product->getDimensions();

		if($dimensions !== null) {
			$wooProduct->set_height($dimensions->getHeight());
			$wooProduct->set_weight($dimensions->getWeight());
			$wooProduct->set_length($dimensions->getLength());
			$wooProduct->set_width($dimensions->getWidth());
		}



		//$wooProduct->set_image_id( 90 ); // ???

// let's suppose that our 'Accessories' category has ID = 19
		//$wooProduct->set_category_ids( array( 19 ) );

		///$wooProduct->set_tag_ids(); // ???
		// you can also use  for tags, brands etc


		return $wooProduct->save();
	}
}