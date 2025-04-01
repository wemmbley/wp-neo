<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

class Stock
{
	private int $quantity;
	private bool $allowBackorders = false;
	private bool $notifyCustomerBackorder = false;

	public function quantity(int $quantity): self
	{
		$this->quantity = $quantity;

		return $this;
	}

	public function allowBackorders(): self
	{
		$this->allowBackorders = true;

		return $this;
	}

	public function enableBackordersCustomerNotification(): self
	{
		$this->notifyCustomerBackorder = true;

		return $this;
	}
}