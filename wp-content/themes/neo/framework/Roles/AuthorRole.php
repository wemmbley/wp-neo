<?php

namespace Neo\Framework\Roles;

class AuthorRole extends UserRole
{
	public string $name = 'Author';
	public string $slug = 'author';

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
		];
	}
}