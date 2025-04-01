<?php

namespace Neo\Framework;

/**
 * Rest class for registering custom WP endpoints.
 *
 * Example:
 * <code>
 *     Rest::registerEndpoint('neo/post/{id:int}/like') // dynamic param {id} with type :int for validation
 *				->method(Rest::METHOD_POST)
 *
 *              ->unauthorised()   // make route public, without authorization
 *              ->permissions([])  // OR handle needed permission
 *              ->roles([])        // OR set concrete role / roles
 *
 *              ->validate(['likes' => 'int|required'])  // validate request params
 *              ->action(function($request) {});         // default WP action callback
 * </code>
 */
class Rest
{
	private bool $isAuthorised = true;
	private string $method = self::METHOD_GET;
	private array $roles = [];
	private array $permissions = [];

	/*
	 * Available methods (u can add ur own).
	 */
	public const METHOD_GET = 'GET';
	public const METHOD_POST = 'POST';
	public const METHOD_PUT = 'PUT';
	public const METHOD_PATCH = 'PATCH';
	public const METHOD_DELETE = 'DELETE';

	public function registerEndpoint(string $route)
	{

	}

	// 	$post_id = $request['id'];
	//					$current_likes = get_field('likes', $post_id) ?? 0;
	//					update_field('likes', $current_likes + 1, $post_id);
	//					return rest_ensure_response(['likes' => $current_likes + 1]);

	// 	add_action('rest_api_init', function() use($route, $method, $action) {
	//			register_rest_route($route, '/(?P<id>\d+)', [
	//				'methods' => $method,
	//				'callback' => $action,
	//				'permission_callback' => '__return_true',
	//			]);
	//		});
}