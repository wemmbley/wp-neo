<?php

namespace Neo\Framework\Roles;

class DevRole extends UserRole
{
	public string $name = 'Developer';
	public string $slug = 'developer';

	public function access(): array
	{
		$parentClass = get_parent_class($this);
		$reflection = new \ReflectionClass($parentClass);

		return $reflection->getConstants();
	}
}