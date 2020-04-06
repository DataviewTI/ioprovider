<?php

namespace Dataview\IOProvider;

use Illuminate\Support\ServiceProvider;

class IOProviderServiceProvider extends ServiceProvider
{
    public static function pkgAddr($addr){
      return __DIR__.'/'.$addr;
    }

    public function boot()
    {

      $this->loadViewsFrom(__DIR__.'/views', 'Provider');
    }

    public function register()
    {
      $this->commands([
        Console\Install::class,
        Console\Remove::class
      ]);

      $this->app['router']->group(['namespace' => 'dataview\ioprovider'], function () {
        include __DIR__.'/routes/web.php';
      });
      //buscar uma forma de não precisar fazer o make de cada classe
  
      $this->app->make('Dataview\IOProvider\ProviderController');
      $this->app->make('Dataview\IOProvider\ProviderRequest');
    }
}