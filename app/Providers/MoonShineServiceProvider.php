<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\AuthorResource;
use App\MoonShine\Resources\BookResource;
use App\MoonShine\Resources\GenreResource;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\UserResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                AuthorResource::class,
                BookResource::class,
                GenreResource::class,
                OrderResource::class,
                UserResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
