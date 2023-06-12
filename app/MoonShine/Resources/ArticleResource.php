<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Decorations\Block;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Image;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Date;

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

        Text::make('Title', 'title')
          ->required(),

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
