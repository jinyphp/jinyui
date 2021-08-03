<?php

namespace Jiny\UI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

use Jiny\UI\Http\Livewire\DataField;
use Jiny\UI\Http\Livewire\DataList;
use Jiny\UI\Http\Livewire\DataForm;
use Jiny\UI\Http\Livewire\DataFormSetting;
use Jiny\UI\Http\Livewire\DataTable;
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

    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('data-field', DataField::class);
            Livewire::component('data-list', DataList::class);
            Livewire::component('data-form', DataForm::class);
            Livewire::component('data-form-setting', DataFormSetting::class);

            //Livewire::component('counter', \Jiny\UI\Http\Livewire\Counter::class);
            Livewire::component('menu-tree', \Jiny\UI\Http\Livewire\MenuTree::class);

            Livewire::component('datatable', DataTable::class);
        });
    }

    protected function configureComponents()
    {

        /* 컴포넌트 클래스 등록 */
        $this->loadViewComponentsAs('jinyui', [
            \Jiny\UI\View\Components\App::class, 

            // 테마관련 컴포넌트 클래스
            \Jiny\UI\View\Components\Theme::class, // 테마 레이아웃을 읽어 옵니다.
            \Jiny\UI\View\Components\ThemeMain::class, // 메인 레이아웃을 읽어 옵니다.
            \Jiny\UI\View\Components\MainContent::class, // 메인 레이아웃의 컨덴츠를 배치합니다.<main>테그
            \Jiny\UI\View\Components\ThemeLayout::class,
            \Jiny\UI\View\Components\ThemeSidebar::class, // 테마 sidebar.blade.php 로드
            \Jiny\UI\View\Components\Icon::class, //svg아이콘 생성
            \Jiny\UI\View\Components\Menu::class, //메뉴 빌더를 호출


            \Jiny\UI\View\Components\LayoutTile::class, // 타일 격자 배치


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

            \Jiny\UI\View\Components\Card::class,

            //테이블
            \Jiny\UI\View\Components\Table::class,

            //폼
            \Jiny\UI\View\Components\FormRow::class,
            \Jiny\UI\View\Components\FormLabel::class,
            \Jiny\UI\View\Components\FormItem::class,
            \Jiny\UI\View\Components\FormFilter::class,


            \Jiny\UI\View\Components\ModalList::class,
            \Jiny\UI\View\Components\Collapse::class,
            \Jiny\UI\View\Components\ScrollBar::class,
            \Jiny\UI\View\Components\Layout::class,

            \Jiny\UI\View\Components\Markdown::class,


        ]);

        /**
         * 클래스 Alias
         */
        Blade::component(\Jiny\UI\View\Components\FormFilter::class, "filter");
        Blade::component(\Jiny\UI\View\Components\Icon::class, "icon");
        $shot = true;
        if($shot) {
            // 테마
            Blade::component(\Jiny\UI\View\Components\Theme::class, "theme");
            Blade::component(\Jiny\UI\View\Components\ThemeSidebar::class, "theme-sidebar");
            Blade::component(\Jiny\UI\View\Components\ThemeMain::class, "theme-main");
            Blade::component(\Jiny\UI\View\Components\MainContent::class, "main-content");

            // 레이아웃
            Blade::component('jinyui::components.'.'layout.container', 'container');

            //
            Blade::component('jinyui::components.'.'list.list', 'list');
            Blade::component('jinyui::components.'.'list.group', 'list-group');
            Blade::component('jinyui::components.'.'list.item', 'list-item');


            Blade::component(\Jiny\UI\View\Components\FormRow::class, "form-row");
            Blade::component(\Jiny\UI\View\Components\FormHor::class, "form-hor");
            Blade::component(\Jiny\UI\View\Components\FormLabel::class, "form-label");
            Blade::component(\Jiny\UI\View\Components\FormItem::class, "form-item");

            Blade::component(\Jiny\UI\View\Components\Card::class, "card");
            Blade::component('jinyui::components.'.'card.body', 'card-body');
            Blade::component('jinyui::components.'.'card.header', 'card-header');
            Blade::component('jinyui::components.'.'card.footer', 'card-footer');
            Blade::component('jinyui::components.'.'card.title', 'card-title');
            Blade::component('jinyui::components.'.'card.subtitle', 'card-subtitle');

            Blade::component(\Jiny\UI\View\Components\Button\Button::class, "button");
            Blade::component(\Jiny\UI\View\Components\Button\Dropdown::class, "button-dropdown");
            Blade::component(\Jiny\UI\View\Components\Button\Group::class, "button-group");
            Blade::component('jinyui::components.'.'button.close', 'close');


            Blade::component(\Jiny\UI\View\Components\Accordion::class, "dropdown");
            Blade::component('jinyui::components.'.'accordion.accordion', 'accordion');
            Blade::component('jinyui::components.'.'accordion.item', 'accordion-item');
            Blade::component('jinyui::components.'.'accordion.item-open', 'accordion-item-open');
            Blade::component('jinyui::components.'.'accordion.header', 'accordion-header');

            //드롭다운
            Blade::component(\Jiny\UI\View\Components\Dropdown\Dropdown::class, "dropdown");
            Blade::component(\Jiny\UI\View\Components\Dropdown\Menu::class, "dropdown-menu");
            Blade::component(\Jiny\UI\View\Components\Dropdown\Item::class, "dropdown-item");
            Blade::component(\Jiny\UI\View\Components\Dropdown\Link::class, "dropdown-link");

            //breadcrumb
            Blade::component('jinyui::components.'.'nav.breadcrumb', 'breadcrumb');
            Blade::component('jinyui::components.'.'nav.breadcrumb-item', 'breadcrumb-item');

            //Nav
            Blade::component('jinyui::components.'.'nav.nav', 'nav');
            Blade::component('jinyui::components.'.'nav.nav-item', 'nav-item');

            //Modal
            Blade::component('jinyui::components.'.'modal.button', 'modal-button');
            Blade::component('jinyui::components.'.'modal.layout', 'modal-layout');
            Blade::component('jinyui::components.'.'modal.header', 'modal-header');
            Blade::component('jinyui::components.'.'modal.body', 'modal-body');
            Blade::component('jinyui::components.'.'modal.footer', 'modal-footer');

            // Icon
            Blade::component(\Jiny\UI\View\Components\IconFile::class, "icon-file");

            //carousel
            Blade::component('jinyui::components.'.'carousel.inner', 'carousel');
            Blade::component('jinyui::components.'.'carousel.item', 'carousel-item');

        }




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
        //Blade::component('jinyui::components.'.'app', 'app');
        //Blade::component('jinyui::components.'.'layout', 'layout');
        //Blade::component('jinyui::components.'.'theme', 'theme');
        Blade::component('jinyui::components.'.'bootstrap', 'bootstrap'); //부트스트랩 랩퍼
        //Blade::component('jinyui::components.'.'layouts.main', 'main');
        //Blade::component('jinyui::components.'.'layouts.content', 'main-content');
        Blade::component('jinyui::components.'.'layout.row', 'row');
        Blade::component('jinyui::components.'.'layout.col', 'col');
        Blade::component('jinyui::components.'.'layout.col-12', 'col-12');
        Blade::component('jinyui::components.'.'layout.col-6', 'col-6');
        Blade::component('jinyui::components.'.'layout.col-4', 'col-4');

        // 사이드바
        //Blade::component('jinyui::components.sidebar.layout', 'jiny-sidebar');
        //Blade::component('jinyui::components.sidebar.item', 'jiny-sidebar-item');
        //Blade::component('jinyui::components.sidebar.submenu', 'jiny-sidebar-submenu');
        //Blade::component('jinyui::components.sidebar.link', 'jiny-sidebar-link');

        // CardBox
        /*
        Blade::component('jinyui::components.'.'card.layout', 'jiny-card');
        Blade::component('jinyui::components.'.'card.header', 'jiny-card-header');
        Blade::component('jinyui::components.'.'card.title', 'jiny-card-title');
        Blade::component('jinyui::components.'.'card.subtitle', 'jiny-card-subtitle');
        Blade::component('jinyui::components.'.'card.body', 'jiny-card-body');
        Blade::component('jinyui::components.'.'card.footer', 'jiny-card-footer');
        */

        // Box model
        Blade::component('jinyui::components.'.'box.layout', 'jiny-box');

        // Tab
        Blade::component('jinyui::components.'.'tab.header', 'jiny-tab-header');
        Blade::component('jinyui::components.'.'tab.link', 'jiny-tab-link');
        Blade::component('jinyui::components.'.'tab.body', 'jiny-tab-body');
        Blade::component('jinyui::components.'.'tab.content', 'jiny-tab-content');

        // Alert ShortCut
        Blade::component('jinyui::components.alert.primary', 'alert-primary');
        Blade::component('jinyui::components.alert.secondary', 'alert-secondary');
        Blade::component('jinyui::components.alert.success', 'alert-success');
        Blade::component('jinyui::components.alert.danger', 'alert-danger');
        Blade::component('jinyui::components.alert.warning', 'alert-warning');
        Blade::component('jinyui::components.alert.info', 'alert-info');

        Blade::component('jinyui::components.alert.primary-outline', 'alert-primary-outline');
        Blade::component('jinyui::components.alert.secondary-outline', 'alert-secondary-outline');
        Blade::component('jinyui::components.alert.success-outline', 'alert-success-outline');
        Blade::component('jinyui::components.alert.danger-outline', 'alert-danger-outline');
        Blade::component('jinyui::components.alert.warning-outline', 'alert-warning-outline');
        Blade::component('jinyui::components.alert.info-outline', 'alert-info-outline');
        
        Blade::component('jinyui::components.alert.primary-none', 'alert-primary-none');
        Blade::component('jinyui::components.alert.secondary-none', 'alert-secondary-none');
        Blade::component('jinyui::components.alert.success-none', 'alert-success-none');
        Blade::component('jinyui::components.alert.danger-none', 'alert-danger-none');
        Blade::component('jinyui::components.alert.warning-none', 'alert-warning-none');
        Blade::component('jinyui::components.alert.info-none', 'alert-info-none');


        // 마크다운
        Blade::component(\Jiny\UI\Markdown::class,'markdown');

    }

    protected function registerComponent(string $component)
    {
        Blade::component('jinyui::components.'.$component, 'jiny-'.$component);
    }


}
