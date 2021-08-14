<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;


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
            $theme = "jiny";
            if(isset($theme) && $theme) {
                $file = resource_path("theme").DIRECTORY_SEPARATOR.$theme.DIRECTORY_SEPARATOR.trim($expression,"\"").".blade.php";
            } else {
                $file = resource_path("theme").DIRECTORY_SEPARATOR.trim($expression,"\"").".blade.php";
            }
            
            if (file_exists($file)) {
                return file_get_contents($file);
            } else {
                return "cannot find theme resource ".$file."<br>";
            }
        });

        // 블레이드 컴포넌트
        // 상대경로 include
        Blade::directive('include2', function ($args) {
            $args = Blade::stripParentheses($args);
    
            $viewBasePath = Blade::getPath();
            foreach ($this->app['config']['view.paths'] as $path) {
                if (substr($viewBasePath,0,strlen($path)) === $path) {
                    $viewBasePath = substr($viewBasePath,strlen($path));
                    break;
                }
            }
    
            $viewBasePath = dirname(trim($viewBasePath,'\/'));
            $args = substr_replace($args, $viewBasePath.'.', 1, 0);
            return "<?php echo \$__env->make({$args}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
        });


        

    }
}
