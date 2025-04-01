<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

class Price
{
	private float $regular;
	private float $sales;

	public function setRegular(float $regular): self
	{
		$this->regular = $regular;

		return $this;
	}

	public function setSales(float $sales): self
	{
		$this->sales = $sales;

		return $this;
	}

	public function getRegular(): float
	{
		return $this->regular;
	}

	public function getSales(): float
	{
		return $this->sales;
	}
}