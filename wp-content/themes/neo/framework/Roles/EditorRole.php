<?php

namespace Neo\Framework\Roles;

class EditorRole extends UserRole
{
	public string $name = 'Editor';
	public string $slug = 'editor';

	public function access(): array
	{
		return [
			self::CAN_READ,
			self::CAN_DELETE_POSTS,
			self::CAN_EDIT_POSTS,
			self::CAN_DELETE_PUBLISHED_POSTS,
			self::CAN_EDIT_PUBLISHED_POSTS,
			self::CAN_PUBLISH_POSTS,
			self::CAN_UPLOAD_FILES,
			self::CAN_DELETE_OTHERS_PAGES,
			self::CAN_DELETE_OTHERS_POSTS,
			self::CAN_DELETE_PAGES,
			self::CAN_DELETE_PRIVATE_PAGES,
			self::CAN_DELETE_PRIVATE_POSTS,
			self::CAN_DELETE_PUBLISHED_PAGES,
			self::CAN_EDIT_OTHERS_PAGES,
			self::CAN_EDIT_OTHERS_POSTS,
			self::CAN_EDIT_PAGES,
			self::CAN_EDIT_PRIVATE_PAGES,
			self::CAN_EDIT_PRIVATE_POSTS,
			self::CAN_EDIT_PUBLISHED_PAGES,
			self::CAN_MANAGE_CATEGORIES,
			self::CAN_MANAGE_LINKS,
			self::CAN_MODERATE_COMMENTS,
			self::CAN_PUBLISH_PAGES,
			self::CAN_READ_PRIVATE_PAGES,
			self::CAN_READ_PRIVATE_POSTS,
			self::CAN_UNFILTERED_HTML,
		];
	}
}