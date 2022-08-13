<?php

namespace laililmahfud\starterkit;

use Illuminate\Support\ServiceProvider;
use laililmahfud\starterkit\components\AdminLayout;
use laililmahfud\starterkit\components\BlankLayout;
use laililmahfud\starterkit\commands\StarterkitInstalationCommand;
use laililmahfud\starterkit\commands\StarterkitApiGeneratorCommand;

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
        $loader->alias('Starterkit', 'laililmahfud\starterkit\helpers\Starterkit');
        $loader->alias('JsonResponse', 'laililmahfud\starterkit\helpers\JsonResponse');   
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
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->commands([
            StarterkitInstalationCommand::class,
            StarterkitApiGeneratorCommand::class,
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
