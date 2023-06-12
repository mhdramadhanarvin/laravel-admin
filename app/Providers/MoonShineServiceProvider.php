<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\ProductResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('Users Management', [
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                ProductResource::class,
            ])->translatable()->icon('users'),

            // MenuItem::make('Documentation', 'https://laravel.com')
            //     ->badge(fn() => 'Check'),
            // MenuItem::make('Admins', new MoonShineUserResource()),
        ]);
    }
}
