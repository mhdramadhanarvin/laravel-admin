<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;

class ProductResource extends Resource
{
	public static string $model = Product::class;

	public static string $title = 'Products';

  public function fields(): array
	{
    return [
      Block::make('Main Information', [
        ID::make()->sortable()->required(),
        Text::make('Name', 'name')->required(),
        Number::make('Price (Rp)', 'price')
          ->min(1)->required(),
        Number::make('Quantity', 'quantity')
          ->min(1)->required(),
      ])
    ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
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
