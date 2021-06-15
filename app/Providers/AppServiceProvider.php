<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('theme', function ($expression) {
            $file = resource_path("theme").DIRECTORY_SEPARATOR.trim($expression,"\"").".blade.php";
            if (file_exists($file)) {
                return file_get_contents($file);
            } else {
                return "cannot find theme resource ".$file."<br>";
            }
        });
    }
}
