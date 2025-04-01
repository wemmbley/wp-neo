<?php

namespace Neo\App\ContentStructures\ContentTypes;

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