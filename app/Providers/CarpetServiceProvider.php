<?php
/**
 * Carpet is Blade Extension of JinyPHP
 */
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class CarpetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        Blade::directive('routeis', function ($expression) {
            return "<?php if (fnmatch({$expression}, Route::currentRouteName())) : ?>";
        });

        Blade::directive('endrouteis', function ($expression) {
            return '<?php endif; ?>';
        });

        Blade::directive('routeisnot', function ($expression) {
            return "<?php if (! fnmatch({$expression}, Route::currentRouteName())) : ?>";
        });

        Blade::directive('endrouteisnot', function ($expression) {
            return '<?php endif; ?>';
        });

        Blade::directive('uppercase', function () {
            return '<?php ob_start(); ?>';
        });
        
        Blade::directive('enduppercase', function () {
            return '<?php echo strtoupper(ob_get_clean()); ?>';
        });
        */


        //
        /*
        Blade::directive('markdown', function () {
            return ' <div class="markdown-body"> <?php ob_start(); ?>';
        });
        
        Blade::directive('endmarkdown', function () {
            return '<?php echo (new \Parsedown())->text(ob_get_clean()); ?> </div>';
        });
        */

        Blade::directive('hello', function ($expression) {
            //return $matches;
            return "&lt;?php echo 'Hello '.{$expression}; ?&gt;";
        });
    }
}
