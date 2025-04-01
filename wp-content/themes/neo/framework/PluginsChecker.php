<?php

namespace Neo\Framework;

class PluginsChecker
{
	public array $requiredPlugins = ['acf.php'];

	public function check(): void
	{
		$allActivePlugins = wp_get_active_and_valid_plugins();

		foreach($allActivePlugins as $plugin) {
			// todo: check linux, macos - maybe bugs with these fu**ing separators.
			$splittedPluginString = explode(DIRECTORY_SEPARATOR, $plugin);
			$splittedPluginString = explode('/', $splittedPluginString[array_key_last($splittedPluginString)]);
			$pluginFilename = $splittedPluginString[array_key_last($splittedPluginString)];
// fixme: sh!t not working properly
			if(! in_array($pluginFilename, $this->requiredPlugins)) {
//				throw new \Exception(
//					'Required plugin not installed or not activated! ' . $pluginFilename
//				);
			}
		}
	}
}