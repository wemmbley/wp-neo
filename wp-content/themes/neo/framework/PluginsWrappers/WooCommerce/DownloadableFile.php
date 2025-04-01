<?php

namespace Neo\Framework\PluginsWrappers\WooCommerce;

class DownloadableFile
{
	private string $path;
	private int $downloadLimit;
	private int $downloadExpireDays;

	public function setPath(string $path): self
	{
		$this->path = $path;

		return $this;
	}

	public function setDownloadLimit(int $quantity): self
	{
		$this->downloadLimit = $quantity;

		return $this;
	}

	public function setDownloadExpireDays(int $days): self
	{
		$this->downloadExpireDays = $days;

		return $this;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function getDownloadLimit(): int
	{
		return $this->downloadLimit;
	}

	public function getDownloadExpireDays(): int
	{
		return $this->downloadExpireDays;
	}
}