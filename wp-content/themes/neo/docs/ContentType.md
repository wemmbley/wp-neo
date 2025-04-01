# ContentType

We use Drupal-like ContentType instead of default WordPress CustomPostType (it's only naming, don't worry - under hood we using default WP features).

Default path for custom content type: `app/ContentStructure/ContentTypes`.

Example:
```php 
<?php

namespace Neo\App\ContentStructure\ContentTypes;

use Neo\Framework\ContentType;
use Neo\Framework\Fields\Group;
use Neo\Framework\Fields\Image;
use Neo\Framework\Fields\Text;
use Neo\Framework\Fields\Textarea;

class FilmContentType extends ContentType
{
    public string $name = 'films';
    public string $label = 'Фильмы';
    public string $labelSingle = 'Фильм';
    public string $icon = 'dashicons-editor-video';
	public bool $disableDefaultFields = true;

    public function fields(): Group
    {
		return Group::make('films', function() {
			return [
				Text::make('title')
				    ->label('Заголовок')
				    ->placeholder('Введите название фильмы')
				    ->required(),
				Textarea::make('description')
				        ->label('Описание')
				        ->placeholder('Введите описание кинофильма...'),
				Image::make('film_image')
				     ->label('Превью фильма'),
			];
		})->title('Фильмы');
    }
}
```

This file will create custom post type `Films`, and add custom fields into it via ACF.

All aviable fields you can find in `framework/fields`

## WARNING

Every custom content type should be registered in a ServiceProvider!!!

See `docs/ServiceProvider.md`