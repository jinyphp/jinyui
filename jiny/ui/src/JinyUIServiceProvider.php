<?php

namespace Jiny\UI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

use Jiny\UI\Http\Livewire\DataField;
use Jiny\UI\Http\Livewire\DataList;
use Jiny\UI\Http\Livewire\DataForm;
use Jiny\UI\Http\Livewire\DataFormSetting;
use Livewire\Livewire;

class JinyUIServiceProvider extends ServiceProvider
{
    private $package = "jinyui";
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
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('data-field', DataField::class);
            Livewire::component('data-list', DataList::class);
            Livewire::component('data-form', DataForm::class);
            Livewire::component('data-form-setting', DataFormSetting::class);
        });
    }

    protected function configureComponents()
    {
        /* 컴포넌트 클래스 등록 */
        $this->loadViewComponentsAs('jinyui', [
            \Jiny\UI\View\Components\ModalList::class,
            \Jiny\UI\View\Components\Collapse::class,
            \Jiny\UI\View\Components\ScrollBar::class,
            \Jiny\UI\View\Components\Layout::class,
            \Jiny\UI\View\Components\Theme::class,

            // \Jiny\UI\View\Components\Sidebar::class,
        ]);
        
        Blade::component('jiny-sidebar', \Jiny\UI\View\Components\Sidebar::class);        
        Blade::component('jiny-sidebar-menu', \Jiny\UI\View\Components\SidebarMenu::class);
        Blade::component('jiny-sidebar-item', \Jiny\UI\View\Components\SidebarItem::class);
        

        /* 패키지::컴포넌트 => 페키지-컴포넌트 재지정*/

        Blade::component('jinyui::components.'.'modal', 'ui-'.'modal');
        Blade::component('jinyui::components.'.'modal-form', 'ui-'.'modal-form');

        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('collapse');
            $this->registerComponent('scroll-bar');

            $this->registerComponent('app');
            $this->registerComponent('theme');
            $this->registerComponent('layout');

            //$this->registerComponent('sidebar');
            $this->registerComponent('sidebar-button');
            $this->registerComponent('sidebar-header');
            //$this->registerComponent('sidebar-item');
            $this->registerComponent('sidebar-sub');

            $this->registerComponent('select-box');

            $this->registerComponent('card');

        });


    }

    protected function registerComponent(string $component)
    {
        Blade::component('jinyui::components.'.$component, 'jiny-'.$component);
    }


}
