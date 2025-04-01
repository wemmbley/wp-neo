<?php

namespace Neo\Framework;

use Neo\Framework\Fields\Field;
use Neo\Framework\Roles\UserRole;

abstract class ServiceProvider
{
	abstract function boot(): void;
	abstract function register(): void;

	public function registerCustomPostType(string $className): void
	{
		/** @var ContentType $contentType */
		$contentType = new $className;
		$contentType->register();

		$this->acfRegisterFields($contentType);
	}

	public function registerNewRole(string $className): void
	{
		/** @var UserRole $userRole */
		$userRole = new $className;

		$rolesFilename = 'registered_roles.json';
		$registeredRolesConfigFile = get_theme_file_path($rolesFilename);

		if(!file_exists($registeredRolesConfigFile)) {
			file_put_contents($registeredRolesConfigFile, '');
		}

		$configFileContent = file_get_contents($registeredRolesConfigFile);
		$jsonDecoded = json_decode($configFileContent, true);

		if(isset($jsonDecoded['registeredRoles'])) {
			foreach ($jsonDecoded['registeredRoles'] as $roleName) {
				if($userRole->name === $roleName) {
					// exit, if we had our role in registered_roles.json
					// that mean that our role already registered in db
					return;
				}
			}
		}

		$jsonDecoded['registeredRoles'][] = $userRole->name;

		file_put_contents($registeredRolesConfigFile, json_encode($jsonDecoded));


		/** @var \WP_Role $newWPRole */
		$newWPRole = add_role($userRole->slug, $userRole->name, $userRole->access());

		if(!$newWPRole instanceof \WP_Role) {
			throw new \Exception('Cant create role for some reason.');
		}
	}

	public function removeRole(string $roleName): void
	{
		// todo: dummy
	}

	private  function acfRegisterFields(ContentType $contentType): void
	{
		$group = $contentType->fields();
		$groupFields = $group::getFields();
		$fieldset = [];

		/** @var Field $field */
		foreach ($groupFields as $field) {
			$fieldset[] = $field->getStructure();
		}

		acf_add_local_field_group([
			'key' => $group::getGroupName(),
			'title' => $group::getTitle(),
			'fields' => $fieldset,
			'location' => [
				[
					[
						'param' => 'post_type',
						'operator' => '==',
						'value' => $contentType->getName(),
					],
				],
			],
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
		]);
	}

	public function removeDefaultWordPressWidgets(array $except)
	{

	}

	public function removeDefaultWordPressWelcomeMessage()
	{

	}

	public function registerCustomDashboardWidget()
	{
		// return self
	}

	public function registerCustomDashboard(string $template)
	{

	}
}