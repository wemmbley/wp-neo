<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

class Attributes
{
	private array $attributes;

	public function add(string $name, string $attributes): self
	{
		$this->attributes[$name] = $attributes;

		return $this;
	}
}