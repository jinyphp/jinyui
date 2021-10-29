<?php

namespace Jiny\UI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

/*
use Jiny\UI\Http\Livewire\DataField;
use Jiny\UI\Http\Livewire\DataList;
use Jiny\UI\Http\Livewire\DataForm;
use Jiny\UI\Http\Livewire\DataFormSetting;
use Jiny\UI\Http\Livewire\DataTable;
*/

use Livewire\Livewire;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class JinyUIServiceProvider extends ServiceProvider
{
    private $package = "jinyui";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        $this->configureComponents();
        $this->Directive();



    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {
            /*
            Livewire::component('data-field', DataField::class);
            Livewire::component('data-list', DataList::class);
            Livewire::component('data-form', DataForm::class);
            Livewire::component('data-form-setting', DataFormSetting::class);

            //Livewire::component('counter', \Jiny\UI\Http\Livewire\Counter::class);
            Livewire::component('menu-tree', \Jiny\UI\Http\Livewire\MenuTree::class);

            Livewire::component('datatable', DataTable::class);
            */
        });
    }

    protected function configureComponents()
    {

        /* 컴포넌트 클래스 등록 */
        $this->loadViewComponentsAs('jinyui', [
            //\Jiny\UI\View\Components\Theme\App::class,

            // 테마관련 컴포넌트 클래스
            \Jiny\UI\View\Components\Theme::class, // 테마 레이아웃을 읽어 옵니다.
            \Jiny\UI\View\Components\ThemeMain::class, // 메인 레이아웃을 읽어 옵니다.
            \Jiny\UI\View\Components\MainContent::class, // 메인 레이아웃의 컨덴츠를 배치합니다.<main>테그
            //\Jiny\UI\View\Components\ThemeLayout::class,
            \Jiny\UI\View\Components\ThemeSidebar::class, // 테마 sidebar.blade.php 로드
            \Jiny\UI\View\Components\Icon::class, //svg아이콘 생성



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

            \Jiny\UI\View\Components\Hello::class,
        ]);

        /**
         * 클래스 Alias
         */


        $shot = true;
        if($shot) {
            Blade::component(\Jiny\UI\View\Components\MainContent::class, "main-content");

            // 레이아웃
            Blade::component(\Jiny\UI\View\Components\Layouts\Layout::class, 'layout');
            Blade::component('jinyui::components.'.'layout.layout-item', 'layout-item');
            Blade::component('jinyui::components.'.'layout.container-fluid', 'container-fluid');
            Blade::component('jinyui::components.'.'layout.container-fluid', 'container-full');
            Blade::component('jinyui::components.'.'layout.container', 'container');


            // 메뉴
            Blade::component(\Jiny\UI\View\Components\Menu\Menu::class, "menu"); //메뉴 빌더를 호출
            Blade::component('jinyui::components.'.'sidebar.header', 'sidebar-header');
            Blade::component('jinyui::components.'.'sidebar.item', 'sidebar-item');
            Blade::component('jinyui::components.'.'sidebar.link', 'sidebar-link');
            Blade::component('jinyui::components.'.'sidebar.nav', 'sidebar-nav');
            Blade::component('jinyui::components.'.'sidebar.sub', 'sidebar-sub');

            //Icon
            Blade::component(\Jiny\UI\View\Components\Icon::class, "icon");



            // 리스트
            Blade::component('jinyui::components.'.'list.list', 'list');
            Blade::component('jinyui::components.'.'list.group', 'list-group');
            Blade::component('jinyui::components.'.'list.group-flush', 'list-group-flush');
            Blade::component('jinyui::components.'.'list.item', 'list-item');


            //Form
            /**
             * 폼 요소
             */
            Blade::component('jinyui::components.'.'forms.form', 'form');
            Blade::component(\Jiny\UI\View\Components\Forms\FormRow::class, "form-row");
            Blade::component('jinyui::components.'.'forms.row', 'form-row');
            Blade::component(\Jiny\UI\View\Components\FormHor::class, "form-hor");
            Blade::component('jinyui::components.'.'forms.inline', 'form-inline');
            Blade::component(\Jiny\UI\View\Components\FormLabel::class, "form-label");
            Blade::component(\Jiny\UI\View\Components\FormItem::class, "form-item");
            //Blade::component('jinyui::components.'.'forms.label', 'form-label');
            //Blade::component('jinyui::components.'.'forms.item', 'form-item');
            Blade::component('jinyui::components.'.'forms.input', 'form-input');
            Blade::component('jinyui::components.'.'forms.text', 'form-text');
            Blade::component('jinyui::components.'.'forms.email', 'form-email');
            Blade::component('jinyui::components.'.'forms.number', 'form-number');
            Blade::component('jinyui::components.'.'forms.radio', 'form-radio');
            Blade::component('jinyui::components.'.'forms.checkbox', 'form-checkbox');
            Blade::component('jinyui::components.'.'forms.checkbox', 'checkbox');
            Blade::component('jinyui::components.'.'forms.input', 'input');
            Blade::component('jinyui::components.'.'forms.select', 'select');
            Blade::component('jinyui::components.'.'forms.option', 'option');
            Blade::component('jinyui::components.'.'forms.textarea', 'textarea');

            Blade::component('jinyui::components.'.'forms.progress', 'progress');

            $this->block();


            Blade::component(\Jiny\UI\View\Components\Cards\Card::class, "card");
            Blade::component('jinyui::components.'.'card.body', 'card-body');
            Blade::component('jinyui::components.'.'card.header', 'card-header');
            Blade::component('jinyui::components.'.'card.footer', 'card-footer');
            Blade::component('jinyui::components.'.'card.title', 'card-title');
            Blade::component('jinyui::components.'.'card.subtitle', 'card-subtitle');
            Blade::component('jinyui::components.'.'card.before', 'card-before');
            Blade::component('jinyui::components.'.'card.group', 'card-group');



            $this->button();



            Blade::component('jinyui::components.'.'button.indicator', 'indicator');

            // 링크
            Blade::component('jinyui::components.'.'link.a', 'link');


            // Collapse
            Blade::component('jinyui::components.'.'collapse.collapse', 'collapse');
            Blade::component('jinyui::components.'.'collapse.button', 'collapse-button');
            Blade::component('jinyui::components.'.'collapse.link', 'collapse-link');
            Blade::component('jinyui::components.'.'collapse.body', 'collapse-body');


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
            Blade::component(\Jiny\UI\View\Components\Breadcrumb::class, 'breadcrumb');
            Blade::component('jinyui::components.'.'nav.breadcrumb-item', 'breadcrumb-item');

            //Nav
            Blade::component('jinyui::components.'.'nav.nav', 'nav');
            Blade::component('jinyui::components.'.'nav.nav-item', 'nav-item');
            Blade::component('jinyui::components.'.'nav.tab', 'navtab');
            Blade::component('jinyui::components.'.'nav.tab-pillbar', 'navtab-pillbar');// pillbar
            Blade::component('jinyui::components.'.'nav.tab-item', 'navtab-item');
            Blade::component('jinyui::components.'.'nav.tab-link', 'navtab-link');

            //Navbar
            Blade::component('jinyui::components.'.'nav.navbar', 'navbar');
            Blade::component('jinyui::components.'.'nav.navbar-nav', 'navbar-nav');


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

            //Images
            Blade::component('jinyui::components.'.'images.img', 'img');
            Blade::component('jinyui::components.'.'images.img-cover', 'img-cover');
            Blade::component('jinyui::components.'.'images.round', 'img-round');
            Blade::component('jinyui::components.'.'images.circle', 'img-circle');
            Blade::component('jinyui::components.'.'images.res', 'img-res');
            Blade::component('jinyui::components.'.'images.thumb', 'img-thumb');
            Blade::component('jinyui::components.'.'figure.figure', 'figure');
            Blade::component('jinyui::components.'.'figure.text', 'figure-text');

            // Tab
            Blade::component('jinyui::components.'.'tab.header', 'tab-header');
            Blade::component('jinyui::components.'.'tab.link', 'tab-link');
            Blade::component('jinyui::components.'.'tab.button', 'tab-button');
            Blade::component('jinyui::components.'.'tab.item', 'tab-item');
            Blade::component('jinyui::components.'.'tab.group', 'tab-group');
            Blade::component('jinyui::components.'.'tab.list', 'tab-list');
            Blade::component('jinyui::components.'.'tab.contents', 'tab-contents');
            Blade::component(\Jiny\UI\View\Components\Tab\HeaderJson::class, "tab-header-json"); // 템 목록을 json으로 변환하여 전달합니다.




            //Table
            Blade::component(\Jiny\UI\View\Components\Tables\Table::class, "table");
            Blade::component(\Jiny\UI\View\Components\Tables\TableHead::class, 'table-head');
            Blade::component(\Jiny\UI\View\Components\Tables\TableHead::class, 'thead');
            Blade::component(\Jiny\UI\View\Components\Tables\TableBody::class, 'table-body');
            Blade::component(\Jiny\UI\View\Components\Tables\TableBody::class, 'tbody');
            Blade::component('jinyui::components.'.'tables.check-all', 'table-check-all');
            Blade::component('jinyui::components.'.'tables.check-all', 'table-allcheck');
            Blade::component('jinyui::components.'.'tables.check', 'table-check');




            // Extension
            // Simplebar
            Blade::component('jinyui::components.'.'extension.simplebar', 'simplebar');

            // 마크다운
            Blade::component(\Jiny\UI\Markdown::class,'markdown');

        }


        Blade::component(\Jiny\UI\View\Components\FormFilter::class, "filter");


        /* 패키지::컴포넌트 => 페키지-컴포넌트 재지정*/

        Blade::component('jinyui::components.'.'modal', 'ui-'.'modal');
        Blade::component('jinyui::components.'.'modal-form', 'ui-'.'modal-form');

        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('collapse');
            $this->registerComponent('scroll-bar');

            //$this->registerComponent('app');
            $this->registerComponent('theme');
            $this->registerComponent('layout');

            // 사이드바



            $this->registerComponent('select-box');


        });













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

        // Utility


        $this->layout(); // 레이아웃



    }

    protected function button()
    {
        Blade::component(\Jiny\UI\View\Components\Button\Button::class, "button");
        Blade::component('jinyui::components.'.'button.button-outline', 'button-outline');
        Blade::component('jinyui::components.'.'button.button-square', 'button-square');


        Blade::component(\Jiny\UI\View\Components\Button\Dropdown::class, "button-dropdown");
        Blade::component(\Jiny\UI\View\Components\Button\Group::class, "button-group");
        Blade::component('jinyui::components.'.'button.close', 'close');
        Blade::component(\Jiny\UI\View\Components\Button\Badge::class, 'badge');
    }

    protected function block()
    {
        // Box model
        Blade::component('jinyui::components.'.'box.box', 'box');
        Blade::component('jinyui::components.'.'box.block', 'block');
        Blade::component('jinyui::components.'.'box.callout-info', 'callout-info');
    }

    protected function layout()
    {
        //Blade::component('jinyui::components.'.'app', 'app');
        //Blade::component('jinyui::components.'.'layout', 'layout');
        //Blade::component('jinyui::components.'.'theme', 'theme');
        Blade::component('jinyui::components.'.'bootstrap', 'bootstrap'); //부트스트랩 랩퍼
        //Blade::component('jinyui::components.'.'layouts.main', 'main');
        //Blade::component('jinyui::components.'.'layouts.content', 'main-content');
        Blade::component('jinyui::components.'.'layout.row', 'row');
        Blade::component('jinyui::components.'.'layout.row-center', 'row-center'); // 가로 가운데 정렬배치
        Blade::component('jinyui::components.'.'layout.col', 'col');
        Blade::component('jinyui::components.'.'layout.col-12', 'col-12');
        Blade::component('jinyui::components.'.'layout.col-6', 'col-6');
        Blade::component('jinyui::components.'.'layout.col-4', 'col-4');
        Blade::component('jinyui::components.'.'layout.col-3', 'col-3');


        ## flex 박스
        Blade::component('jinyui::components.'.'flex.row', 'flex-row');
        Blade::component('jinyui::components.'.'flex.col', 'flex-col'); // 세로배치
        Blade::component('jinyui::components.'.'flex.center', 'flex-center'); //가운데
        Blade::component('jinyui::components.'.'flex.between', 'flex-between'); //양쪽
        Blade::component('jinyui::components.'.'flex.end', 'flex-end'); //양쪽
        Blade::component('jinyui::components.'.'flex.item', 'flex-item');

        ## divide by flex
        Blade::component('jinyui::components.'.'flex.divide', 'divide');
        Blade::component('jinyui::components.'.'flex.divide-y', 'divide-y');
        Blade::component('jinyui::components.'.'flex.divide-item', 'divide-item');

        ## grid
        Blade::component('jinyui::components.'.'flex.grid', 'grid');
    }




    protected function registerComponent(string $component)
    {
        Blade::component('jinyui::components.'.$component, 'jiny-'.$component);
    }

    private function Directive()
    {
        /**
         * Markdown Directive
         */
        Blade::directive('markdownText', function ($args) {
            $body = Blade::stripParentheses($args);
            return (new \Parsedown())->text($body);
        });

        Blade::directive('markdownFile', function ($args) {
            $args = Blade::stripParentheses($args);
            $args = trim($args,'"');
            if($args[0] == ".") {
                $path = str_replace(".", DIRECTORY_SEPARATOR, $args).".md";
                $realPath = dirname(Blade::getPath()).$path;
            }

            if (file_exists($realPath)) {
                $body = file_get_contents($realPath);
                return (new \Parsedown())->text($body);
            } else {
                return "cannot find markdown resource ".$realPath."<br>";
            }
        });

        Blade::directive('codeFile', function ($args) {
            $expression = Blade::stripParentheses($args);
            /*
            $filename = explode("::", $expression)[1];
            $filename = str_replace(".", DIRECTORY_SEPARATOR, $filename);
            $filename = trim($filename,'"').".blade.php";

            $file = "";
            dd($this->app['config']['view.paths'] );
            foreach ($this->app['config']['view.paths'] as $path) {
                dd($path.DIRECTORY_SEPARATOR.$filename);
                if(file_exists($path.DIRECTORY_SEPARATOR.$filename)) {
                    $file = $path.DIRECTORY_SEPARATOR.$filename;
                    break;
                }
            }
            */

            return "<?php echo \$__env->make({$expression}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
        });

        Blade::directive('widget', function ($args) {
            $expression = Blade::stripParentheses($args);
            return "<?php echo \$__env->make({$expression}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
        });


        // 테마설정
        Blade::directive('setTheme', function ($args) {
            $expression = Blade::stripParentheses($args);
            \Jiny\UI\Theme::instance()->setTheme($expression);
        });

        // 테마안에 있는 리소스를 읽어 옵니다.
        Blade::directive('theme', function ($args) {
            $expression = Blade::stripParentheses($args);
            $path = trim($expression,'"');

            // 상대경로 parsing
            if($path[0] == ".") {
                $path = substr($path,1);

                $viewBasePath = Blade::getPath();
                $base = dirname(trim($viewBasePath,'\/'));
                $base = str_replace(['/','\\'], ".", $base);
                $base = array_reverse(explode(".",$base));
                for($i=0; $i<count($base);$i++) {
                    if($base[$i] == "theme") break;
                    $path = $base[$i].".".$path;
                }
            }

            $expression = '"'."theme.".$path.'"';

            return "<?php echo \$__env->make({$expression}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
        });


    }


}
