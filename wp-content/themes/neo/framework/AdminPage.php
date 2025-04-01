<?php

namespace Neo\Framework;

class AdminPage
{
	public function make(string $name)
	{

	}

	public function slug(string $slug)
	{

	}

	public function title(string $title)
	{

	}

	public function html()
	{
		add_action('admin_menu', function() {
			add_menu_page('Формы', 'Формы', 'manage_options', 'form-submissions', 'show_submitted_forms');
		});
	}
}