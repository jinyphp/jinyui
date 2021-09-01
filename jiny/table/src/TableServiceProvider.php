<?php

namespace Jiny\Table;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

//use Jiny\UI\Http\Livewire\DataField;
use Jiny\Table\Http\Livewire\TableDataList;
use Jiny\Table\Http\Livewire\TableDataEdit;
use Jiny\Table\Http\Livewire\DataField;
use Livewire\Livewire;

class TableServiceProvider extends ServiceProvider
{
    private $package = "jinytable";
    public function boot()
    {

        /*
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        */

        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);
        $this->configureComponents();

        Blade::component('jinytable::components.'.'data-table', 'data-table');
        Blade::component('jinytable::components.'.'data-select-delete', 'data-select-delete');
        Blade::component('jinytable::components.'.'data-filter', 'data-filter');

        //Blade::component(\Jiny\Table\View\Components\DataTableBody::class, "data-table-body");

    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {

            Livewire::component('tabledata-list', TableDataList::class);
            Livewire::component('tabledata-edit', TableDataEdit::class);

            Livewire::component('tabledata-field', DataField::class);

            /*
            Livewire::component('data-field', DataField::class);
            
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
