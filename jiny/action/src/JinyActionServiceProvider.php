<?php

namespace Jiny\Action;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;


class JinyActionServiceProvider extends ServiceProvider
{
    private $package = "jinyaction";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        $this->configureComponents();
        //$this->Directive();

    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('LiveAction', \Jiny\Action\Http\Livewire\LiveAction::class);
            Livewire::component('LiveActionCreate', \Jiny\Action\Http\Livewire\LiveActionCreate::class);

            Livewire::component('LiveField', \Jiny\Action\Http\Livewire\LiveField::class);
            Livewire::component('LiveFieldCreate', \Jiny\Action\Http\Livewire\LiveFieldCreate::class);

            Livewire::component('LiveTable', \Jiny\Action\Http\Livewire\LiveTable::class);
            Livewire::component('LiveForms', \Jiny\Action\Http\Livewire\LiveForms::class);
        });
    }

    protected function configureComponents()
    {
        /* 컴포넌트 클래스 등록 */
        $this->loadViewComponentsAs('jinyaction', [
            //\Jiny\UI\View\Components\Theme\App::class, 
        ]);

        $this->callAfterResolving(BladeCompiler::class, function () {
            
        });        
    }

    private function Directive()
    {
        
        
    }


}
