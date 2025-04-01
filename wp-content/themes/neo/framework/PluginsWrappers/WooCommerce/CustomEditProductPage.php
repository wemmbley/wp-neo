<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

class CustomEditProductPage
{
	private function generateProduct(): void
	{
		Product::add('name')
		       ->setDescription('')
		       ->setSlug('')
		       ->setShortDescription('')
		       ->setPreviewImageUrl('')
		       ->setGalleryImagesUrls([])
		       ->setTags([])
		       ->setBrands([])
		       ->setCategories([])
		       ->makeDownloadable(function(DownloadableFile $file) {
			       $file
				       ->setPath('path-to-file')
				       ->setDownloadLimit(5)
				       ->setDownloadExpireDays(5);
		       })
		       ->setPrice(function(Price $price) {
			       $price
				       ->setRegular(120.00)
				       ->setSales(99.00);
		       })
		       ->setSKU('')
		       ->setUniqueIdentifier('')
		       ->setStockStatus(StockStatus::IN_STOCK)
		       ->setLimitPerPurchase(1)
		       ->setStock(function(Stock $stock) {
			       $stock
				       ->quantity(55)
				       ->allowBackorders()
				       ->enableBackordersCustomerNotification();
		       })
		       ->setDimensions(function(Dimensions $dimensions) {
			       $dimensions
				       ->setWeight(122)
				       ->setLength('')
				       ->setWidth('')
				       ->setHeight('');
		       })
		       ->setLinkedProducts(function(LinkedProducts $links) {
			       $links
				       ->setUpsells([])
				       ->setCrossSells([]);
		       })
		       ->setAttributes(function(Attributes $attributes) {
			       $attributes->add('size', 'L|XL|SM|S');
			       $attributes->add('color', 'RED|WHITE|BLACK');
		       })
		       ->enableReviews()
		       ->makeVirtual();
	}
}