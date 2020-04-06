<?php
namespace Dataview\IOProvider\Console;
use Dataview\IntranetOne\Console\IOServiceInstallCmd;
use Dataview\IOProvider\IOProviderServiceProvider;
use Dataview\IOProvider\ProviderSeeder;

class Install extends IOServiceInstallCmd
{
  public function __construct(){
    parent::__construct([
      "service"=>"provider",
      "provider"=> IOProviderServiceProvider::class,
      "seeder"=>ProviderSeeder::class,
    ]);
  }

  public function handle(){
    parent::handle();
  }
}
