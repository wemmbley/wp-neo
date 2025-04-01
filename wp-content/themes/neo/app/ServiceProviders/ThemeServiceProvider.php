<?php

namespace Neo\App\ServiceProviders;

use Neo\App\ContentStructures\ContentTypes\FilmContentType;
use Neo\Framework\Dashboard\WidgetManager;
use Neo\Framework\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
		$this->removeDefaultWordPressWidgets(except: []);
		$this->removeDefaultWordPressWelcomeMessage();
    }

    public function register(): void
    {
        $this->registerCustomPostType(FilmContentType::class);
		$this->registerCustomDashboard('dashboard');
//	    $this->registerCustomDashboardWidget('neo_welcome_widget')
//	         ->title('Neo framework')
//	         ->template('{themePath}/framework/Templates/welcome-widget');
    }

	private function registerWelcomeWidget(): void
	{
		WidgetManager::register('neo_welcome_widget', 'Neo framework',
			<<<HTML
				<img width="390px" height="220px" 
				src="https://thumbs.dreamstime.com/b/retrowave-synthwave-vaporwave-s-landscape-neon-light-grid-sun-palm-trees-sci-fi-futuristic-illustration-copy-space-170033184.jpg" alt="">
				<br>
				Добро пожаловать в <b>NEO.</b>
				<br>Кастомный фреймворк для WordPress! 
				<br>Автор: <b>Голев Рустам</b> aka Wembley.
			HTML
		);
	}
}