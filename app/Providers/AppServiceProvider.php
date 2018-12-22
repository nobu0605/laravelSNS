<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{   

    public function boot()
    {
      Schema::defaultStringLength(191);

      if (\DB::getDriverName() === 'sqlite') {
        \DB::statement(\DB::raw('PRAGMA foreign_keys=1'));
      }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
