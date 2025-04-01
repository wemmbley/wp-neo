<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

class Dimensions
{
	private int $weight;
	private int $length;
	private int $width;
	private int $height;

	public function setWeight(int $weight): self
	{
		$this->weight = $weight;

		return $this;
	}

	public function setLength(int $length): self
	{
		$this->length = $length;

		return $this;
	}

	public function setWidth(int $width): self
	{
		$this->width = $width;

		return $this;
	}

	public function setHeight(int $height): self
	{
		$this->height = $height;

		return $this;
	}

	public function getWeight(): int
	{
		return $this->weight;
	}

	public function getLength(): int
	{
		return $this->length;
	}

	public function getWidth(): int
	{
		return $this->width;
	}

	public function getHeight(): int
	{
		return $this->height;
	}
}