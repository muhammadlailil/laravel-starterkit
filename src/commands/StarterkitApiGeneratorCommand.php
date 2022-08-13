<?php

namespace laililmahfud\starterkit\commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class StarterkitApiGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starterkit:api {--path=*} {--controller=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starterkit create base api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating api controller...');
        
        $controller = $this->option('controller');
        $path = $this->option('path');
        if(!$controller){
            $this->error('Controller name not found');
            return 1;
        }
        if(!$path){
            $this->error('Path not found');
            return 1;
        }
        $controller = $controller[0];
        $path = $path[0];
        
        $controllerPath = app_path('Http/Controllers/Api');
        if (!file_exists($controllerPath)) {
            @mkdir($controllerPath, 0755);
        }
        $controllerTemplate = file_get_contents(__DIR__ . '/../stubs/apicontroller.blade.php.stub');
        $controllerTemplate = str_replace('[controller_name]',$controller,$controllerTemplate);
        if (!file_exists($controllerPath . '/'.$controller.'.php')) {
            file_put_contents($controllerPath .  '/'.$controller.'.php', $controllerTemplate);
        }
        $apiTemplate = file_get_contents(base_path('routes/starterkit_api.php'));

        $routing = "'".$path."' => ['controller' => '".$controller."','role' => 'all'],
    // [starterkit_api_config]";
        $apiTemplate = str_replace('// [starterkit_api_config]', $routing, $apiTemplate);
        file_put_contents(base_path('routes/starterkit_api.php') , $apiTemplate);
        
        
        $this->info('Create api controller success ...');
    }

    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['path', null, InputOption::VALUE_REQUIRED, 'The path of api route'],
            ['controller', null, InputOption::VALUE_REQUIRED, 'The controller name of api route'],
        ];
    }
}
