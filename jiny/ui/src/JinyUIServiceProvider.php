<?php

namespace Jiny\UI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

class JinyUIServiceProvider extends ServiceProvider
{
    public function boot()
    {

        /*
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        */

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'jinyui');

        $this->configureComponents();
       
    }

    public function register()
    {

    }

    protected function configureComponents()
    {
        /* 컴포넌트 클래스 등록 */
        $this->loadViewComponentsAs('jinyui', [
            \Jiny\UI\Components\Button3::class
        ]);
        
        
        /* 패키지::컴포넌트 => 페키지-컴포넌트 재지정*/
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('button2');
            $this->registerComponent('button3');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('jinyui::components.'.$component, 'jui-'.$component);
    }


}
