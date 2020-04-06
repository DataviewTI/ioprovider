<?php
namespace Dataview\IOProvider\Console;
use Dataview\IntranetOne\Console\IOServiceRemoveCmd;
use Dataview\IOProvider\IOProviderServiceProvider;
use Dataview\IntranetOne\IntranetOne;


class Remove extends IOServiceRemoveCmd
{
  public function __construct(){
    parent::__construct([
      "service"=>"provider",
      "tables" =>['provider'], //''
    ]);
  }

  public function handle(){
    parent::handle();
  }
}
