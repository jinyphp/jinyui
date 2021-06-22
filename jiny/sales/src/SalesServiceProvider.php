<?php

namespace Jiny\Sales;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

use Jiny\UI\Http\Livewire\DataField;
use Jiny\UI\Http\Livewire\DataList;
use Livewire\Livewire;

class SalesServiceProvider extends ServiceProvider
{
    private $package = "jinysales";
    public function boot()
    {

        
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        

        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);
        $this->configureComponents();
    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {
            //Livewire::component('data-field', DataField::class);
            //Livewire::component('data-list', DataList::class);
        });
    }

    protected function configureComponents()
    {
        /* 컴포넌트 클래스 등록 */
        /*
        $this->loadViewComponentsAs('jinyui', [
            \Jiny\UI\Components\Button3::class
        ]);
        */
        


        /* 패키지::컴포넌트 => 페키지-컴포넌트 재지정*/
        $this->callAfterResolving(BladeCompiler::class, function () {
            //$this->registerComponent('modal');
            //$this->registerComponent('modal-form');
            //$this->registerComponent('modal-list');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('jinyui::components.'.$component, 'ui-'.$component);
    }


}
