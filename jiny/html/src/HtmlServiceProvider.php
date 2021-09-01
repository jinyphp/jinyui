<?php

namespace Jiny\Html;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;


use Livewire\Livewire;

class HtmlServiceProvider extends ServiceProvider
{
    private $package = "jinyhtml";
    public function boot()
    {

        /*
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        */

        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);
        $this->configureComponents();
    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */

    }

    protected function configureComponents()
    {
        /* 컴포넌트 클래스 등록 */


        /* 패키지::컴포넌트 => 페키지-컴포넌트 재지정*/
        $this->callAfterResolving(BladeCompiler::class, function () {
            //$this->registerComponent('modal');
            //$this->registerComponent('modal-form');
            //$this->registerComponent('modal-list');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('jinyhtml"::components.'.$component, 'jiny-'.$component);
    }


}
