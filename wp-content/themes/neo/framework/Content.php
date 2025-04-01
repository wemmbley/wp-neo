<?php

namespace Neo\Framework;

class Content
{
	private int $authorId = 0;

	private string $postType = 'posts'; // any, page, post, revision

	// ordering
	private string $order = 'DESC'; // ASC, DESC
	private string $orderBy = 'none'; // none, ID, author, title, etc.

	// pagination
	private bool $isPaginated = true;
	private int $postsPerPage = 5;

	// default taxonomies
	private string $categoryName = '';
	private string $tag = '';

	/** Необходим для сборки параметров. */
	private array $paramsStructure = [];

	public static function select(string $name): static
	{
		$instance = new static();
		$instance->paramsStructure['post_type'] = $name;

		return $instance;
	}

	public function author(int $id): static
	{
		$this->paramsStructure['author_id'] = $id;

		return $this;
	}

	public function orderBy(string $field = 'none', string $type = 'ASC'): static
	{
		$this->paramsStructure['order'] = $type;
		$this->paramsStructure['order_by'] = $field;

		return $this;
	}

	public function paginate(int $perPage): static
	{
		$this->paramsStructure['posts_per_page'] = $perPage;

		return $this;
	}

	public function category(string $categoryName): static
	{
		$this->paramsStructure['category'] = $categoryName;

		return $this;
	}

	public function tag(string $tag): static
	{
		$this->paramsStructure['tag'] = $tag;

		return $this;
	}

	public function get(): \WP_Query
	{
		return new \WP_Query($this->paramsStructure);
	}
}