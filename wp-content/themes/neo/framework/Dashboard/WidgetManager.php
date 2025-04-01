<?php

namespace Neo\Framework\Dashboard;

class WidgetManager
{
	public const WP_WIDGET_SITE_HEALTH = 'dashboard_site_health';
	public const WP_WIDGET_FAST_PUBLICATION = 'dashboard_quick_press';
	// etc.


	public function register(string $id, string $title, string $html): void
	{
		add_action('wp_dashboard_setup', function() use($id, $title, $html) {
			wp_add_dashboard_widget($id, $title,
				function() use($html) {
					echo $html;
				}
			);
		});
	}

	public function removeDefaultWidgets(): void
	{
		add_action('wp_dashboard_setup', function() {
			remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // site statistic
			remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // last actions
			remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // fast publication
			remove_meta_box('dashboard_primary', 'dashboard', 'side'); // wordpress news
			remove_meta_box('dashboard_secondary', 'dashboard', 'side'); // other wp links
			remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // site health status
		});
	}

	public function removeWordPressWelcomeMessage(): void
	{
		add_action('load-index.php', function() {
			$user_id = get_current_user_id();

			if (get_user_meta( $user_id, 'show_welcome_panel', true )) {
				update_user_meta( $user_id, 'show_welcome_panel', 0 );
			}
		});
	}
}