<?php

namespace Neo\Framework\Dashboard;

use Neo\Framework\Facade;

class Dashboard
{
	private WidgetManager $widgetManager;

	public function __construct(WidgetManager $widgetManager)
	{
		$this->widgetManager = $widgetManager;
	}

	public function removeAllWidgets()
	{

	}

	public function hideWordPressDefaultWidgets()
	{

	}

	public function hideWordPressWelcomeMessage()
	{

	}

	public function registerWidget()
	{

	}

	/**
	 * Warning! Custom template disabling all WordPress widgets by default!
	 * This function replacing all Dashboard page html-structure!
	 *
	 * @example
	 * <code>
	 *      $dashboard->customTemplate('dashboard') // filepath: templates/dashboard.blade.php
	 * </code>
	 *
	 * @param string $template
	 *
	 * @return void
	 */
	public function customTemplate(string $template)
	{

	}
}