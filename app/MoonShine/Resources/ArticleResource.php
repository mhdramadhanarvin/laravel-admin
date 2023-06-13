<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Collapse;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Heading;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Image;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Date;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Resources\Resource;

class ArticleResource extends Resource
{
  public static string $model = Article::class;

  public static string $title = 'Articles';

  public function fields(): array
  {
    return [
      Block::make('Detail Information', [
        ID::make()->sortable(),

        BelongsTo::make('Author', resource: 'name')
          ->hidden()
          ->default(auth('moonshine')->user()),

        // Text::make('Title', 'title')
        //   ->required(),

        Collapse::make('Title/Slug', [
          Heading::make('Title/Slug'),

          Flex::make('flex-titles', [
            Text::make('Title')
              ->fieldContainer(false)
              ->required(),

            Text::make('Slug')
              ->hideOnIndex()
              ->fieldContainer(false)
              ->required(),
          ])
            ->justifyAlign('start')
            ->itemsAlign('start'),
        ]),

        TinyMce::make('Description', 'description')
          ->hideOnIndex()
          ->required(),

        Image::make('Thumbnail')
          ->removable()
          ->disk('public')
          ->allowedExtensions(['jpg', 'png'])
          ->dir('articles'),

        SwitchBoolean::make('Publish', 'status')
          ->onValue(1) // Active value of a form element
          ->offValue(0), // Inactive value of a form element

        Date::make('Creation date', 'created_at')
          ->format('d.m.Y H:i')
          ->hideOnForm()
          ->sortable(),
      ])
    ];
  }

  public function rules(Model $item): array
  {
    return [];
  }

  public function search(): array
  {
    return ['id', 'title'];
  }

  public function filters(): array
  {
    return [];
  }

  public function actions(): array
  {
    return [
      FiltersAction::make(trans('moonshine::ui.filters')),
    ];
  }
}
