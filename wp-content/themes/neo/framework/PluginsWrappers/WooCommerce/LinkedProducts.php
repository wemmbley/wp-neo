<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

class LinkedProducts
{
	private array $upsellsProductIds;
	private array $crossSellsProductIds;

	public function setUpsells(array $productIds): self
	{
		$this->upsellsProductIds = $productIds;

		return $this;
	}

	public function setCrossSells(array $productIds): self
	{
		$this->crossSellsProductIds = $productIds;

		return $this;
	}

	public function getUpsellsProductIds(): array
	{
		return $this->upsellsProductIds;
	}

	public function getCrossSellsProductIds(): array
	{
		return $this->crossSellsProductIds;
	}
}