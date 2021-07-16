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

use Illuminate\Support\Facades\View;

class JinyUIServiceProvider extends ServiceProvider
{
    private $package = "jinyui";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        $this->configureComponents();

        //View::share('jiny', '0.0.1');

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
            \Jiny\UI\View\Components\ThemeLayout::class,
            \Jiny\UI\View\Components\ThemeSidebar::class,

            \Jiny\UI\View\Components\Icon::class,

            \Jiny\UI\View\Components\Sidebar::class,
            \Jiny\UI\View\Components\SidebarLayout::class,
            \Jiny\UI\View\Components\SidebarContent::class,
            \Jiny\UI\View\Components\SidebarLogo::class,
            // \Jiny\UI\View\Components\SidebarNav::class,
            // \Jiny\UI\View\Components\SidebarMenu::class,
            \Jiny\UI\View\Components\SidebarHeader::class,
            \Jiny\UI\View\Components\SidebarItem::class,
            \Jiny\UI\View\Components\SidebarSubmenu::class,
            \Jiny\UI\View\Components\SidebarLink::class,
            \Jiny\UI\View\Components\SidebarBadge::class,

            \Jiny\UI\View\Components\Hello::class,
        ]);
        

        




        /* 패키지::컴포넌트 => 페키지-컴포넌트 재지정*/

        Blade::component('jinyui::components.'.'modal', 'ui-'.'modal');
        Blade::component('jinyui::components.'.'modal-form', 'ui-'.'modal-form');

        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('collapse');
            $this->registerComponent('scroll-bar');

            $this->registerComponent('app');
            $this->registerComponent('theme');
            $this->registerComponent('layout');

            // 사이드바
            
            $this->registerComponent('sidebar-button');
            //$this->registerComponent('sidebar-header');
            //$this->registerComponent('sidebar-item');
            //$this->registerComponent('sidebar-sub');

            $this->registerComponent('select-box');

            
        });



        // 레이아웃
        Blade::component('jinyui::components.'.'app', 'app');
        Blade::component('jinyui::components.'.'layout', 'layout');
        Blade::component('jinyui::components.'.'theme', 'theme');
        Blade::component('jinyui::components.'.'bootstrap', 'bootstrap'); //부트스트랩 랩퍼
        Blade::component('jinyui::components.'.'layouts.main', 'main');
        Blade::component('jinyui::components.'.'layouts.content', 'main-content');
        Blade::component('jinyui::components.'.'layouts.row', 'row');
        Blade::component('jinyui::components.'.'layouts.col', 'col');

        // 사이드바
        //Blade::component('jinyui::components.sidebar.layout', 'jiny-sidebar');
        //Blade::component('jinyui::components.sidebar.item', 'jiny-sidebar-item');
        //Blade::component('jinyui::components.sidebar.submenu', 'jiny-sidebar-submenu');
        //Blade::component('jinyui::components.sidebar.link', 'jiny-sidebar-link');

        // CardBox
        Blade::component('jinyui::components.'.'card.layout', 'jiny-card');
        Blade::component('jinyui::components.'.'card.header', 'jiny-card-header');
        Blade::component('jinyui::components.'.'card.title', 'jiny-card-title');
        Blade::component('jinyui::components.'.'card.subtitle', 'jiny-card-subtitle');
        Blade::component('jinyui::components.'.'card.body', 'jiny-card-body');
        Blade::component('jinyui::components.'.'card.footer', 'jiny-card-footer');

        // Box model
        Blade::component('jinyui::components.'.'box.layout', 'jiny-box');

        // Tab
        Blade::component('jinyui::components.'.'tab.header', 'jiny-tab-header');
        Blade::component('jinyui::components.'.'tab.link', 'jiny-tab-link');
        Blade::component('jinyui::components.'.'tab.body', 'jiny-tab-body');
        Blade::component('jinyui::components.'.'tab.content', 'jiny-tab-content');

        //button
        Blade::component('jinyui::components.'.'button.default', 'jiny-button');

    }

    protected function registerComponent(string $component)
    {
        Blade::component('jinyui::components.'.$component, 'jiny-'.$component);
    }


}
