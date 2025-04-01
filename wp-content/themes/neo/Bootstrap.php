<?php

namespace Neo;

use Neo\Framework\Dashboard\WidgetManager;
use Neo\Framework\Helpers\FileSystem\Path;
use Neo\Framework\PluginsChecker;
use Neo\Framework\Roles\UserRole;
use Neo\Framework\ServiceProvider;

class Bootstrap
{
	public string $templatesFilesPath = 'templates/blocks';

    public function boot(): void
    {
        $this->registerTemplatesFolder();
		$this->registerServiceProviders();
		$this->checkRequiredPluginsInstall();
		$this->replaceDefaultUserRoles();
//		$this->clearDashboardWidgets();
//		$this->registerWelcomeWidget();
    }

	private function replaceDefaultUserRoles()
	{
		// fuck clean code.
		//  =)

		// here we check if this method has been already called before.
		if(get_option('roles_deleted', false)) {
			return;
		}

		$rolesPath = get_template_directory() . '/framework/Roles';
		$files = Path::scanFiles($rolesPath);
		$roles = [];

		foreach ($files as $filePath => $filename) {
			// skip abstract class
			if($filename === 'UserRole.php') {
				continue;
			}

			$className = str_replace('.php', '', $filename);
			$classNamespace = 'Neo\\Framework\\Roles\\' . $className;

			if(! class_exists($classNamespace)) {
				throw new \Exception('Role class not found! ' . $classNamespace);
			}

			$userRole = new $classNamespace;

			if(! method_exists($userRole, 'access')) {
				throw new \Exception('Method access() not found in Role class! ' . $classNamespace);
			}

			$reflectAbstractUserRole = new \ReflectionClass(UserRole::class);
			$abstractRoleProperties = $reflectAbstractUserRole->getDefaultProperties();

			if($userRole->name === $abstractRoleProperties['name']) {
				throw new \Exception('Please, change default Role name! ' . $classNamespace);
			}

			if($userRole->slug === $abstractRoleProperties['slug']) {
				throw new \Exception('Please, change default Role slug! ' . $classNamespace);
			}

			$roles[$userRole->slug] = [
				'name' => $userRole->name,
				'slug' => $userRole->slug,
				'access' => $userRole->access(),
			];
		}

		$this->deleteAllRoles();
		$this->registerCustomRoles($roles);
	}

	private function deleteAllRoles(): void
	{
		add_action('init', function() {
			global $wp_roles;

			if (!isset($wp_roles)) {
				$wp_roles = new \WP_Roles();
			}

			foreach ($wp_roles->roles as $role => $details) {
				remove_role($role);
			}

			// just one time delete, yep.
			update_option('roles_deleted', true);
		});
	}

	private function registerCustomRoles(array $roles): void
	{
		foreach ($roles as $role) {
			if (empty($role['name']) || empty($role['slug']) || !isset($role['access'])) {
				throw new \Exception('Not enough params for registering role! Check this array: ' . $roles);
			}

			// make wp format
			//  ..bruh
			$capabilities = [];
			foreach ($role['access'] as $access) {
				$capabilities[$access] = true;
			}

			add_action('init', function() use($role, $capabilities) {
				add_role($role['slug'], $role['name'], $capabilities);
			});
		}
	}

	private function clearDashboardWidgets(): void
	{
		WidgetManager::removeDefaultWidgets();
		WidgetManager::removeWordPressWelcomeMessage();
	}

	private function registerServiceProviders(): void
	{
		$providersPath = get_theme_file_path('app/ServiceProviders');

		$dirFiles = scandir($providersPath);

		unset($dirFiles[0]);
		unset($dirFiles[1]);

		foreach ($dirFiles as $serviceProviderFile) {
			$serviceProviderName = str_replace('.php', '', $serviceProviderFile);
			$serviceProviderNamespace = 'Neo\\App\\ServiceProviders';
			$serviceProviderClassName = $serviceProviderNamespace . '\\' . $serviceProviderName;

			/** @var ServiceProvider $serviceProvider */
			$serviceProvider = new $serviceProviderClassName;
			$serviceProvider->boot();
			$serviceProvider->register();
		}
	}

	private function checkRequiredPluginsInstall(): void
	{
		(new PluginsChecker())->check();
	}

    private function registerTemplatesFolder(): void
    {
        add_filter('template_include', function(string $template) {
            $themeTemplatePath = get_theme_file_path($this->templatesFilesPath);
            $templateFilename = basename($template);

			if(empty($templateFilename)) {
				return $themeTemplatePath . '/index.php';
			}

			return $template;
        });
    }
}