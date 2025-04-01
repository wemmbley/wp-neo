<?php

namespace Neo\Framework\Fields;

use ReflectionFunction;

class Group
{
	private static string $groupName = '';
	private static array $fields = [];
	private static string $title = '';

	public static function make(string $name, callable $fields): static
	{
		static::$groupName = $name;

		// call anonymous function and write array of user fields.
		static::$fields = $fields();

		return new static;
	}

	public static function title(string $title): static
	{
		static::$title = $title;

		return new static;
	}

	public static function getFields(): array
	{
		return static::$fields;
	}

	public static function getGroupName(): string
	{
		return static::$groupName;
	}

	public static function getTitle(): string
	{
		return static::$title;
	}
}