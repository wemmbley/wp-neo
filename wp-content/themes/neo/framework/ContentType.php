<?php

namespace Neo\Framework;

use Neo\Framework\Fields\Group;

abstract class ContentType
{
	protected string $name = '';
	protected string $label = '';
	protected string $labelSingle = '';
	protected string $description = '';
	protected bool $isPublic = true;
	protected bool $displayInAdmin = true;
	protected bool $hasArchive = false;
	protected bool $isHierarchical = false;
	protected bool $isSearchable = true;
	protected int $menuPosition = 10;

	/** @see https://developer.wordpress.org/resource/ for more icons. */
	protected string $icon = 'none';
	protected array $taxonomies = [];

	public bool $disableDefaultFields = false;

	// --------------------------------------------
	// CONSTANTS FOR SUPPORTING FIELDS.
	// --------------------------------------------
	public const SUPPORT_THUMBNAIL = 'thumbnail';
	public const SUPPORT_TITLE = 'title';
	public const SUPPORT_EDITOR = 'editor';
	public const SUPPORT_AUTHOR = 'author';
	public const SUPPORT_EXCERPT = 'excerpt';
	public const SUPPORT_TRACKBACKS = 'trackbacks';
	public const SUPPORT_CUSTOM_FIELDS = 'custom-fields';
	public const SUPPORT_COMMENTS = 'comments';
	public const SUPPORT_REVISIONS = 'revisions';
	public const SUPPORT_POST_FORMATS = 'post-formats';
	public const SUPPORT_PAGE_ATTRIBUTES = 'page-attributes';

	abstract public function fields(): Group;

	/**
	 * Register new custom post type with provided data from itself.
	 *
	 * @return void
	 */
	public function register(): void
	{
		register_post_type($this->name, [
			'label' => $this->label,
			'labels' => $this->getLabels(),
			'supports' => $this->defaultFields(),
			'description' => $this->description,
			'public' => $this->isPublic,
			'hierarchical' => $this->isHierarchical,
			'exclude_from_search' => !$this->isSearchable,
			'show_in_ui' => $this->displayInAdmin,
			'menu_position' => $this->menuPosition,
			'menu_icon' => $this->icon,
			'taxonomies' => $this->taxonomies,
			'has_archive' => $this->hasArchive,
		]);

		if($this->disableDefaultFields) {
			add_action('init', function() {
				remove_post_type_support($this->name, 'title');
				remove_post_type_support($this->name, 'editor');
			});
		}
	}

	public function getLabels(): array
	{
		$labelSingle =  mb_strtolower($this->labelSingle);

		return [
			'name'               => $this->label,
			'singular_name'      =>  $this->label,
			'add_new'            => 'Добавить ' . $labelSingle,
			'add_new_item'       => 'Добавить ' . $labelSingle,
			'edit_item'          => 'Редактировать ' . $labelSingle,
			'new_item'           => 'Новый ' . $labelSingle,
			'view_item'          => 'Смотреть ' . $labelSingle,
			'search_items'       => 'Искать ' . $labelSingle,
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => $this->label,
		];
	}

	public function defaultFields(): array
	{
		return [
			static::SUPPORT_TITLE,
			static::SUPPORT_EDITOR,
		];
	}

	public function getName(): string
	{
		return $this->name;
	}
}