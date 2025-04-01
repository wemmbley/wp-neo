<?php

namespace Neo\Framework\Roles;

abstract class UserRole
{
	public string $name = 'DefaultRole';
	public string $slug = 'default_role';

	// --------------------------------------------------
	// POSTS SECTION.
	// --------------------------------------------------
	public const CAN_READ = 'read';
	public const CAN_DELETE_POSTS = 'delete_posts';
	public const CAN_EDIT_POSTS = 'edit_posts';
	public const CAN_DELETE_PUBLISHED_POSTS = 'delete_published_posts';
	public const CAN_EDIT_PUBLISHED_POSTS = 'edit_published_posts';
	public const CAN_PUBLISH_POSTS = 'publish_posts';
	public const CAN_DELETE_OTHERS_POSTS = 'delete_others_posts';
	public const CAN_EDIT_OTHERS_POSTS = 'edit_others_posts';
	public const CAN_DELETE_PRIVATE_POSTS = 'delete_private_posts';
	public const CAN_EDIT_PRIVATE_POSTS = 'delete_private_posts';
	public const CAN_READ_PRIVATE_POSTS = 'read_private_posts';

	// --------------------------------------------------
	// PAGES SECTION.
	// --------------------------------------------------
	public const CAN_PUBLISH_PAGES = 'publish_pages';
	public const CAN_DELETE_OTHERS_PAGES = 'delete_others_pages';
	public const CAN_DELETE_PUBLISHED_PAGES = 'delete_published_pages';
	public const CAN_DELETE_PRIVATE_PAGES = 'delete_private_pages';
	public const CAN_DELETE_PAGES = 'delete_pages';
	public const CAN_EDIT_PAGES = 'edit_pages';
	public const CAN_EDIT_OTHERS_PAGES = 'edit_others_pages';
	public const CAN_EDIT_PRIVATE_PAGES = 'edit_private_pages';
	public const CAN_EDIT_PUBLISHED_PAGES = 'edit_published_pages';
	public const CAN_READ_PRIVATE_PAGES = 'read_private_pages';


	// --------------------------------------------------
	// PLUGINS SECTION.
	// --------------------------------------------------
	public const CAN_ACTIVATE_PLUGINS = 'activate_plugins';
	public const CAN_DEACTIVATE_PLUGINS = 'deactivate_plugins';
	public const CAN_DELETE_PLUGINS = 'delete_plugins';
	public const CAN_UPDATE_PLUGINS = 'update_plugins';
	public const CAN_INSTALL_PLUGINS = 'install_plugins';
	public const CAN_EDIT_PLUGINS = 'edit_plugins';

	// --------------------------------------------------
	// USERS SECTION.
	// --------------------------------------------------
	public const CAN_LIST_USERS = 'list_users';
	public const CAN_DELETE_USERS = 'remove_users';
	public const CAN_PROMOTE_USERS = 'promote_users';
	public const CAN_CREATE_USERS = 'create_users';
	public const CAN_EDIT_USERS = 'edit_users';

	// --------------------------------------------------
	// IMPORT/EXPORT.
	// --------------------------------------------------
	public const CAN_EXPORT = 'export';
	public const CAN_IMPORT = 'import';

	// --------------------------------------------------
	// ETC.
	// --------------------------------------------------
	public const CAN_UPLOAD_FILES = 'upload_files';
	public const CAN_EDIT_THEMES = 'edit_themes';
	public const CAN_MANAGE_OPTIONS = 'manage_options';
	public const CAN_MANAGE_CATEGORIES = 'manage_categories';
	public const CAN_MANAGE_LINKS = 'manage_links';
	public const CAN_MODERATE_COMMENTS = 'moderate_comments';
	public const CAN_UNFILTERED_HTML = 'unfiltered_html';

	abstract public function access(): array;
}