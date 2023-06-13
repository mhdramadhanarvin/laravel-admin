<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\ArticleResource;

class MoonShineServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    app(MoonShine::class)->menu([
      MenuGroup::make('Users Management', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
        // ArticleResource::class,
      ])->translatable()->icon('users'),

      MenuGroup::make('Blog', [
        // MenuItem::make('Categories', new CategoryResource(), 'heroicons.document'),
        MenuItem::make('Articles', new ArticleResource(), 'heroicons.newspaper'),
        // MenuItem::make('Comments', new CommentResource(), 'heroicons.chat-bubble-left')
        //   ->badge(fn() => Comment::query()->count()),
      ], 'heroicons.newspaper'),

      // MenuItem::make('Documentation', 'https://laravel.com')
      //     ->badge(fn() => 'Check'),
      // MenuItem::make('Admins', new MoonShineUserResource()),
    ]);
  }
}
