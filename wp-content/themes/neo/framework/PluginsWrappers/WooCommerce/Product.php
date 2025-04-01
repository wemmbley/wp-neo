<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

/**
 * Fluent-API for building WooCommerce Product in OOP-way.
 *
 * Full-example:
 * <code>
 * Product::add('hoodie')
 *          ->setDescription('black hoodie')
 *          ->setSlug('black-hoodie')
 *          ->setShortDescription('hoodie')
 *          ->setPreviewImageUrl('http://url-1')
 *          ->setGalleryImagesUrls(['http://url-1', 'http://url-2'])
 *          ->setTags(['my-tag'])
 *          ->setBrands(['hoodmade'])
 *          ->setCategories(['uncategorized'])
 *          ->makeDownloadable(function(DownloadableFile $file) {
 *                   $file
 *                       ->path('path-to-file')
 *                       ->downloadLimit(5)
 *                       ->downloadExpiryDays(5);
 *                   })
 *          ->setPrice(function(Price $price) {
 *                   $price
 *                       ->regular(120.00)
 *                       ->sales(99.00);
 *                   })
 *          ->setSKU('1234')
 *          ->setUniqueIdentifier('3333')
 *          ->setStockStatus(StockStatus::IN_STOCK)
 *          ->setLimitPerPurchase(1)
 *          ->setStock(function(Stock $stock) {
 *                   $stock
 *                       ->quantity(55)
 *                       ->allowBackorders()
 *                       ->enableBackordersCustomerNotification();
 *                   })
 *          ->setDimensions(function(Dimensions $dimensions) {
 *                   $dimensions
 *                       ->setWeight(122)
 *                       ->setLength('122cm')
 *                       ->setWidth('33cm')
 *                       ->setHeight('122cm');
 *                   })
 *          ->setLinkedProducts(function(LinkedProducts $links) {
 *                   $links
 *                       ->upsells([1,2,3])
 *                       ->crossSells([4,5,6]);
 *                   })
 *          ->addAttributes(function(Attributes $attributes) {
 *                   $attributes->add('size', 'L|XL|SM|S');
 *                   $attributes->add('color', 'RED|WHITE|BLACK');
 *          })
 *          ->enableReviews()
 *          ->makeVirtual();
 * </code>
 */
class Product
{
	private string $title;
	private string $description;
	private string $slug;
	private string $shortDescription;
	private string $previewImageUrl;
	private array $galleryImagesUrls;
	private array $tags;
	private array $brands;
	private array $categories;
	private string $sku;
	private string $uniqueIdentifier; // GTIN, UPC, EAN, or ISBN
	private DownloadableFile $downloadableFile;
	private int $limitPerPurchase;
	private Stock $stock;
	private Dimensions $dimensions;
	private LinkedProducts $linkedProducts;
	private Attributes $attributes;
	private Price $price;
	private bool $reviewsEnabled = false;
	private bool $isVirtual = false;
	private StockStatus $stockStatus;

	private function __construct(string $title)
	{
		$this->title = $title;
	}

	public static function add(string $title): self
	{
		return new self($title);
	}

	/* ---------------------------------------------------------- *\
	 * Setters.
	 * ---------------------------------------------------------- */

	public function setDescription(string $description): self
	{
		$this->description = $description;

		return $this;
	}

	public function setSlug(string $slug): self
	{
		$this->slug = $slug;

		return $this;
	}

	public function setShortDescription(string $shortDescription): self
	{
		$this->shortDescription = $shortDescription;

		return $this;
	}

	public function setPreviewImageUrl(string $url): self
	{
		$this->previewImageUrl = $url;

		return $this;
	}

	public function setGalleryImagesUrls(array $urls): self
	{
		$this->galleryImagesUrls = $urls;

		return $this;
	}

	public function setTags(array $tags): self
	{
		$this->tags = $tags;

		return $this;
	}

	public function setBrands(array $brands): self
	{
		$this->brands = $brands;

		return $this;
	}

	public function setCategories(array $categories): self
	{
		$this->categories = $categories;

		return $this;
	}

	public function makeDownloadable(callable $downloadable): self
	{
		$downloadableFile = new DownloadableFile(); // fuck all SOLID principles, cse I can!
		$downloadable($downloadableFile); // call callback for mutation
		$this->downloadableFile = $downloadableFile; // write mutated object

		return $this;
	}

	public function setPrice(callable $priceable): self
	{
		$price = new Price();
		$priceable($price);
		$this->price = $price;

		return $this;
	}

	public function setSKU(string $sku): self
	{
		$this->sku = $sku;

		return $this;
	}

	public function setStockStatus(StockStatus $status): self
	{
		$this->stockStatus = $status;

		return $this;
	}

	public function setUniqueIdentifier(string $uniqueIdentifier): self
	{
		$this->uniqueIdentifier = $uniqueIdentifier;

		return $this;
	}

	public function setLimitPerPurchase(string $limit): self
	{
		$this->limitPerPurchase = $limit;

		return $this;
	}

	public function setStock(callable $stockable): self
	{
		$stock = new Stock();
		$stockable($stock);
		$this->stock = $stock;

		return $this;
	}

	public function setDimensions(callable $dimensionable): self
	{
		$dimensions = new Dimensions();
		$dimensionable($dimensions);
		$this->dimensions = $dimensions;

		return $this;
	}

	public function setLinkedProducts(callable $linkedProductable): self
	{
		$linkedProducts = new LinkedProducts();
		$linkedProductable($linkedProducts);
		$this->linkedProducts = $linkedProducts;

		return $this;
	}

	public function setAttributes(callable $attributable): self
	{
		$attributes = new Attributes();
		$attributable($attributes);
		$this->attributes = $attributes;

		return $this;
	}

	public function enableReviews(): self
	{
		$this->reviewsEnabled = true;

		return $this;
	}

	public function makeVirtual(): self
	{
		$this->isVirtual = true;

		return $this;
	}

	/* ---------------------------------------------------------- *\
     * Getters.
     * ---------------------------------------------------------- */

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getSlug(): string
	{
		return $this->slug;
	}

	public function getShortDescription(): string
	{
		return $this->shortDescription;
	}

	public function getPreviewImageUrl(): string
	{
		return $this->previewImageUrl;
	}

	public function getGalleryImagesUrls(): array
	{
		return $this->galleryImagesUrls;
	}

	public function getTags(): array
	{
		return $this->tags;
	}

	public function getBrands(): array
	{
		return $this->brands;
	}

	public function getCategories(): array
	{
		return $this->categories;
	}

	public function getSku(): string
	{
		return $this->sku;
	}

	public function getUniqueIdentifier(): string
	{
		return $this->uniqueIdentifier;
	}

	public function getDownloadableFile(): ?DownloadableFile
	{
		return $this->downloadableFile;
	}

	public function getLimitPerPurchase(): int
	{
		return $this->limitPerPurchase;
	}

	public function getStock(): Stock
	{
		return $this->stock;
	}

	public function getDimensions(): ?Dimensions
	{
		return $this->dimensions;
	}

	public function getLinkedProducts(): LinkedProducts
	{
		return $this->linkedProducts;
	}

	public function getAttributes(): Attributes
	{
		return $this->attributes;
	}

	public function getPrice(): Price
	{
		return $this->price;
	}

	public function isReviewsEnabled(): bool
	{
		return $this->reviewsEnabled;
	}

	public function isVirtual(): bool
	{
		return $this->isVirtual;
	}

	public function getStockStatus(): StockStatus
	{
		return $this->stockStatus;
	}
}