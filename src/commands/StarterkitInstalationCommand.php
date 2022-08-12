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
        $this->call('migrate');
        if (! class_exists('Laililmahfud\Starterkit\Database\Seeders\StarterkitSeeder')) {
            require_once __DIR__.'/../database/seeders/StarterkitSeeder.php';
        }
        $this->call('db:seed', ['--class' => 'Laililmahfud\Starterkit\Database\Seeders\StarterkitSeeder']);
        $this->info('Login infromation');
        $this->info('username : admin@starterkit.com');
        $this->info('password : 12345678');
        $this->info('Instalation success...');
    }
}
