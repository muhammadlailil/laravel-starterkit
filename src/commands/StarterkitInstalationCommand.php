<?php

namespace Laililmahfud\Starterkit\Commands;

use Illuminate\Console\Command;

class StarterkitInstalationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starterkit:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starterkit instalation command';

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
        $this->info('Migrating database...');
        $rootProject = getcwd().'\\';
        $this->call('migrate',[
            '--path' => str_replace($rootProject,'',__DIR__.'/../database/migrations/2022_06_09_141918_create_cms_privileges_table.php')
        ]);
        $this->call('migrate',[
            '--path' => str_replace($rootProject,'',__DIR__.'/../database/migrations/2022_06_09_142604_create_cms_moduls_table.php')
        ]);
        $this->call('migrate',[
            '--path' => str_replace($rootProject,'',__DIR__.'/../database/migrations/2022_06_09_142732_create_cms_users_table.php')
        ]);
        $this->call('migrate',[
            '--path' => str_replace($rootProject,'',__DIR__.'/../database/migrations/2022_06_09_142946_create_cms_privileges_roles_table.php')
        ]);
        $this->call('migrate',[
            '--path' => str_replace($rootProject,'',__DIR__.'/../database/migrations/2022_06_15_121257_create_cms_notification_table.php')
        ]);

        if (! class_exists('Laililmahfud\Starterkit\Database\Seeders\StarterkitSeeder')) {
            require_once __DIR__.'/../database/seeders/StarterkitSeeder.php';
        }
        $this->call('db:seed', ['--class' => 'Laililmahfud\Starterkit\Database\Seeders\StarterkitSeeder']);
        $this->call('vendor:publish', ['--provider' => 'Laililmahfud\Starterkit\LaililMahfudStarterkitServiceProvider']);
        $this->call('vendor:publish', ['--tag' => 'starterkit_config', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'starterkit_asset', '--force' => true]);
        $this->info('Login infromation');
        $this->info('username : admin@starterkit.com');
        $this->info('password : 12345678');
        $this->info('Instalation success...');
    }
}
