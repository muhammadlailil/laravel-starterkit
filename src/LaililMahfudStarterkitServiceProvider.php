<?php

namespace Laililmahfud\Starterkit;

use Illuminate\Support\ServiceProvider;
use Laililmahfud\Starterkit\Components\AdminLayout;
use Laililmahfud\Starterkit\Components\BlankLayout;
use Laililmahfud\Starterkit\Commands\StarterkitInstalationCommand;

class LaililMahfudStarterkitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__ . '/helpers/Helper.php';
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Starterkit', 'Laililmahfud\Starterkit\Helpers\Starterkit');
        $loader->alias('JsonResponse', 'Laililmahfud\Starterkit\Helpers\JsonResponse');   
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Http\Kernel $kernel)
    {
        // $kernel->appendMiddleware(\Illuminate\Session\Middleware\StartSession::class); 

        $this->loadViewsFrom(__DIR__ . '/views', 'starterkit');
        $this->publishes([__DIR__ . '/config/starterkit.php' => config_path('starterkit.php')], 'starterkit_config');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->commands([
            StarterkitInstalationCommand::class,
        ]);

        $this->loadViewComponentsAs('starterkit', [
            AdminLayout::class,
            BlankLayout::class,
        ]);
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/starterkit'),
        ], 'starterkit_asset');
        
    }
}
