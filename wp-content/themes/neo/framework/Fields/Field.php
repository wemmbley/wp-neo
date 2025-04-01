<?php

namespace Neo\Framework\Fields;

abstract class Field
{
	public string $type = '';
	private string $key = ''; // unique ID
	private string $label = '';
	private string $name = '';
	private string $default = '';
	private string $placeholder = '';
	private string $instructions = '';
	private bool $isRequired = false;
	private bool $isReadonly = false;
	private bool $isDisabled = false;

	public static function make(string $name): static
	{
		$instance = new static();
		$instance->key = 'field_' . $name;
		$instance->name = $name;

		return $instance;
	}

	public function label(string $name): static
	{
		$this->label = $name;

		return $this;
	}

	public function placeholder(string $text): static
	{
		$this->placeholder = $text;

		return $this;
	}

	public function required(bool $isRequired = true): static
	{
		$this->isRequired = $isRequired;

		return $this;
	}

	public function readonly(bool $isReadonly = true): static
	{
		$this->isReadonly = $isReadonly;

		return $this;
	}

	public function disabled(bool $isDisabled = true): static
	{
		$this->isDisabled = $isDisabled;

		return $this;
	}

	public function getStructure(): array
	{
		return [
			'key' => $this->key,
			'label' => $this->label,
			'name' => $this->name,
			'type' => $this->type,
			'prefix' => '',
			'instructions' => $this->instructions,
			'required' => $this->isRequired,
			'conditional_logic' => 0,
			'wrapper' => [
				'width' => '',
				'class' => '',
				'id' => '',
			],
			'default_value' => $this->default,
			'placeholder' => $this->placeholder,
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => $this->isReadonly,
			'disabled' => $this->isDisabled,
		];
	}
}