<?php

namespace Neo\Framework;

abstract class Facade
{
	private object $instance;

	protected static function getInstance(): static
	{
		return new static();
	}

	public static function __callStatic($method, $args)
	{
		$instance = static::getInstance();

		if (!method_exists($instance, $method)) {
			throw new \Exception("Method {$method} not found.");
		}

		return $instance->$method(...$args);
	}
}