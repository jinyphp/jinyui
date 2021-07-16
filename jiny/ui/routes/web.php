<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::prefix('jinyui')->group(function () {
    Route::get('/', function () {
        return view("jinyui::demo.index");
    });
});


// ui 컴포넌트
Route::prefix('jinyui/ui')->group(function () {
    Route::get('/collapse', function(){
        return view("jinyui::demo.ui.collapse.bootstrap");
    });

});    


Route::get('jinyui/ui/cards', function(){
    return view("jinyui::demo.ui.cards");
});
Route::get('jinyui/ui/alerts', function(){
    return view("jinyui::demo.ui.alerts");
});
Route::get('jinyui/ui/buttons', function(){
    return view("jinyui::demo.ui.buttons");
});
Route::get('jinyui/ui/general', function(){
    return view("jinyui::demo.ui.general");
});

Route::get('jinyui/ui/grid', function(){
    return view("jinyui::demo.ui.grid");
});
Route::get('jinyui/ui/modals', function(){
    return view("jinyui::demo.ui.modals");
});
Route::get('jinyui/ui/offcanvas', function(){
    return view("jinyui::demo.ui.offcanvas");
});
Route::get('jinyui/ui/tabs', function(){
    return view("jinyui::demo.ui.tabs");
});
Route::get('jinyui/ui/tabview', function(){
    return view("jinyui::demo.ui.tabview");
});
Route::get('jinyui/ui/typography', function(){
    return view("jinyui::demo.ui.typography");
});


Route::prefix('jinyui/forms')->group(function () {

    Route::get('/', function(){
        return view("jinyui::demo.forms.index");
    });
    
    Route::get('/basic', function(){
        return view("jinyui::demo.forms.basic");
    });

    Route::get('/layout', function(){
        return view("jinyui::demo.forms.layout");
    });

    Route::get('/inputs', function(){
        return view("jinyui::demo.forms.inputs");
    });
    
    

});


/**
 * Demo Tables
 */
Route::prefix('jinyui/tables')->group(function () {
    Route::get('/ctable', function(){
        return view("jinyui::demo.tables.ctable");
    });
});



Route::get('jinyui/tables/table', function(){
    return view("jinyui::demo.tables.table");
});
Route::get('jinyui/tables/table/basic', function(){
    return view("jinyui::demo.tables.basic.index");
});

Route::get('jinyui/plugin/datatable/response', function(){
    return view("jinyui::demo.plugin.datatable.response");
});
Route::get('jinyui/plugin/datatable/button', function(){
    return view("jinyui::demo.plugin.datatable.button");
});
Route::get('jinyui/plugin/datatable/search', function(){
    return view("jinyui::demo.plugin.datatable.search");
});
Route::get('jinyui/plugin/datatable/fixed', function(){
    return view("jinyui::demo.plugin.datatable.fixed");
});
Route::get('jinyui/plugin/datatable/multi', function(){
    return view("jinyui::demo.plugin.datatable.multi");
});
Route::get('jinyui/plugin/datatable/ajax', function(){
    return view("jinyui::demo.plugin.datatable.ajax");
});




Route::get('jinyui/pages/page/settings', function(){
    return view("jinyui::demo.pages.page.settings");
});

Route::get('jinyui/pages/page/projects', function(){
    return view("jinyui::demo.pages.page.projects");
});
Route::get('jinyui/pages/page/clients', function(){
    return view("jinyui::demo.pages.page.clients");
});
Route::get('jinyui/pages/page/price', function(){
    return view("jinyui::demo.pages.page.price");
});
Route::get('jinyui/pages/page/chat', function(){
    return view("jinyui::demo.pages.page.chat");
});
Route::get('jinyui/pages/page/bank', function(){
    return view("jinyui::demo.pages.page.bank");
});

Route::get('jinyui/pages/profile', function(){
    return view("jinyui::demo.pages.profile");
});
Route::get('jinyui/pages/invoice', function(){
    return view("jinyui::demo.pages.invoice");
});
Route::get('jinyui/pages/task', function(){
    return view("jinyui::demo.pages.task");
});
Route::get('jinyui/pages/calendar', function(){
    return view("jinyui::demo.pages.calendar");
});

Route::get('jinyui/pages/auth/signin', function(){
    return view("jinyui::demo.pages.auth.signin");
});
Route::get('jinyui/pages/auth/singout', function(){
    return view("jinyui::demo.pages.auth.singout");
});
Route::get('jinyui/pages/auth/reset', function(){
    return view("jinyui::demo.pages.auth.reset");
});
Route::get('jinyui/pages/auth/404', function(){
    return view("jinyui::demo.pages.auth.404");
});
Route::get('jinyui/pages/auth/500', function(){
    return view("jinyui::demo.pages.auth.500");
});

Route::get('jinyui/plugin/forms/input', function(){
    return view("jinyui::demo.plugin.forms.input");
});
Route::get('jinyui/plugin/forms/editor', function(){
    return view("jinyui::demo.plugin.forms.editor");
});
Route::get('jinyui/plugin/forms/validate', function(){
    return view("jinyui::demo.plugin.forms.validate");
});



Route::get('jinyui/plugin/notice', function(){
    return view("jinyui::demo.plugin.notice");
});

Route::get('jinyui/plugin/map/google', function(){
    return view("jinyui::demo.plugin.map/google");
});
Route::get('jinyui/plugin/map/vector', function(){
    return view("jinyui::demo.plugin.map.vector");
});

Route::get('jinyui/plugin/chart/chartjs', function(){
    return view("jinyui::demo.plugin.chart.chartjs");
});


/**
 * Demo : timeline
 */
Route::get('jinyui/timeline/vertical', function(){
    return view("jinyui::demo.timeline.vertical");
});