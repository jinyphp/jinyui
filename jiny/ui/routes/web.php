<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// DASHBOARD
Route::middleware(['web'])->prefix('jinyui')->group(function () {





});


//PAGES
Route::middleware(['web'])->prefix('jinyui/pages')->group(function () {
    Route::get('/settings', function(){
        return view("jinyui::demo.pages.settings");
    });

    Route::get('/projects', function(){
        return view("jinyui::demo.pages.projects");
    });

    Route::get('/clients', function(){
        return view("jinyui::demo.pages.page.clients");
    });


    Route::get('/pricing', function(){
        return view("jinyui::demo.pages.price");
    });




    Route::get('/chat', function(){
        return view("jinyui::demo.pages.chat");
    });

    Route::get('/blank', function(){
        return view("jinyui::demo.pages.page.blank");
    });



    Route::get('/profile', function(){
        return view("jinyui::demo.pages.profile");
    });

    Route::get('/invoice', function(){
        return view("jinyui::demo.pages.invoice");
    });

    Route::get('/tasks', function(){
        $res = view("jinyui::demo.pages.tasks");
        file_put_contents(base_path()."/docs/pages/task.html", $res);
        return $res;
    });

    Route::get('/calendar', function(){
        return view("jinyui::demo.pages.calendar");
    });

});


// AUTH
Route::middleware(['web'])->prefix('jinyui/auth')->group(function () {

    Route::get('/signin', function(){
        return view("jinyui::demo.auth.signin");
    });

    Route::get('/singout', function(){
        return view("jinyui::demo.pages.auth.singout");
    });
    Route::get('/reset', function(){
        return view("jinyui::demo.pages.auth.reset");
    });
    Route::get('/404', function(){
        return view("jinyui::demo.pages.auth.404");
    });
    Route::get('/500', function(){
        return view("jinyui::demo.pages.auth.500");
    });

}); 


//COMPONENTS
// UI
Route::middleware(['web'])->prefix('jinyui/ui')->group(function () {
    Route::get('/accordion', function(){
        return view("jinyui::demo.ui.accordion");
    });
    Route::get('/collapse', function(){
        return view("jinyui::demo.ui.collapse");
    });
    Route::get('/dropdown', function(){
        return view("jinyui::demo.ui.dropdown");
    });

    Route::get('/alerts', function(){
        return view("jinyui::demo.ui.alerts");
    });

    Route::get('/images', function(){
        return view("jinyui::demo.ui.images");
    });
    Route::get('/spinners', function(){
        return view("jinyui::demo.ui.spinners");
    });
    Route::get('/progress', function(){
        return view("jinyui::demo.ui.progress");
    });
    Route::get('/pagination', function(){
        return view("jinyui::demo.ui.pagination");
    });


    

    Route::get('/grid', function(){
        return view("jinyui::demo.ui.grid");
    });

    

    Route::get('/buttons', function(){
        return view("jinyui::demo.ui.buttons");
    });
    Route::get('/buttons/group', function(){
        return view("jinyui::demo.ui.buttons.group");
    });
    Route::get('/buttons/close', function(){
        return view("jinyui::demo.ui.buttons.close");
    });
    Route::get('/buttons/badges', function(){
        return view("jinyui::demo.ui.buttons.badges");
    });



    Route::get('/modals', function(){
        return view("jinyui::demo.ui.modals");
    });

    Route::get('/list', function(){
        return view("jinyui::demo.ui.list");
    });

    // Notice
    Route::get('/tooltip', function(){
        return view("jinyui::demo.ui.tooltip");
    });
    Route::get('/popovers', function(){
        return view("jinyui::demo.ui.popovers");
    });
    Route::get('/toasts', function(){
        return view("jinyui::demo.ui.toasts");
    });

    Route::get('/scrollspy', function(){
        return view("jinyui::demo.ui.scrollspy");
    });

    Route::get('/box', function(){
        return view("jinyui::demo.ui.box");
    });

    Route::get('/timeline', function(){
        return view("jinyui::demo.ui.timeline");
    });


});

Route::middleware(['web'])->prefix('jinyui')->group(function () {
    Route::get('/carousel', function(){
        return view("jinyui::demo.carousel");
    });
});

Route::middleware(['web'])->prefix('jinyui/nav')->group(function () {
    Route::get('/breadcrumb', function(){
        return view("jinyui::demo.nav.breadcrumb");
    });

    Route::get('/nav', function(){
        return view("jinyui::demo.nav.nav");
    });

    Route::get('/navbar', function(){
        return view("jinyui::demo.nav.navbar");
    });

    Route::get('/tab', function(){
        return view("jinyui::demo.nav.tab");
    });
});

//ICONS
Route::prefix('jinyui/icons')->group(function () {
    Route::get('/feather', function(){
        return view("jinyui::demo.icons.feather");
    });
});

//TABS
Route::prefix('jinyui/tabs')->group(function () {
    Route::get('/card', function(){
        return view("jinyui::demo.tabs.card");
    });
    Route::get('/bar', function(){
        return view("jinyui::demo.tabs.bar");
    });
    Route::get('/virtical', function(){
        return view("jinyui::demo.tabs.virtical");
    });
    Route::get('/virtical2', function(){
        return view("jinyui::demo.tabs.virtical2");
    });
    Route::get('/border', function(){
        return view("jinyui::demo.tabs.border");
    });
});

//FORMS
Route::prefix('jinyui/forms')->group(function () {

    Route::get('/', function(){
        return view("jinyui::demo.forms.index");
    });
    
    Route::get('/inputs', function(){
        return view("jinyui::demo.forms.inputs");
    });

    Route::get('/layouts', function(){
        return view("jinyui::demo.forms.layouts");
    });

    Route::get('/groups', function(){
        return view("jinyui::demo.forms.groups");
    });

    Route::get('/advance', function(){
        return view("jinyui::demo.forms.advance");
    });

    Route::get('/editors', function(){
        return view("jinyui::demo.forms.editors");
    });

    Route::get('/validation', function(){
        return view("jinyui::demo.forms.validation");
    });

});


//TABLE
Route::middleware(['web'])->prefix('jinyui/tables')->group(function () {
    Route::get('/bootstrap', function(){
        return view("jinyui::demo.tables.bootstrap");
    });

    Route::get('/ctable', function(){
        return view("jinyui::demo.tables.ctable");
    });

    Route::get('/livewire', function(){
        return view("jinyui::demo.tables.livewire");
    });


    // DATATABLE    
    Route::get('/response', function(){
        return view("jinyui::demo.tables.response");
    });
    Route::get('/button', function(){
        return view("jinyui::demo.tables.button");
    });
    Route::get('/search', function(){
        return view("jinyui::demo.tables.search");
    });
    Route::get('/fixed', function(){
        return view("jinyui::demo.tables.fixed");
    });
    Route::get('/multi', function(){
        return view("jinyui::demo.tables.multi");
    });
    Route::get('/ajax', function(){
        return view("jinyui::demo.tables.ajax");
    });

});

//CHART
Route::middleware(['web'])->prefix('jinyui/charts')->group(function () {

    Route::get('/', function(){
        return view("jinyui::demo.chartjs");
    });


    Route::get('/chartjs', function(){
        return view("jinyui::demo.charts.chartjs");
    });
    Route::get('/apexcharts', function(){
        return view("jinyui::demo.charts.apexcharts");
    });

});



//NOTICE
Route::get('jinyui/notice', function(){
    return view("jinyui::demo.plugin.notice");
});


//MAP
Route::middleware(['web'])->prefix('jinyui/maps')->group(function () {
    Route::get('/google', function(){
        return view("jinyui::demo..maps.google");
    });
    Route::get('/vector', function(){
        return view("jinyui::demo.maps.vector");
    });


});



//====




Route::group(['middleware' => 'web'], function () {
    


    Route::get('jinyui/ui/cards', function(){
        return view("jinyui::demo.ui.cards");
    });

    Route::get('jinyui/layouts', function(){
        return view("jinyui::demo.layouts.index");
    });

    
    



});




Route::prefix('jinyui')->group(function () {
    Route::get('/', function () {
        return view("jinyui::demo.index");
    });
});


// ui 컴포넌트
Route::prefix('jinyui/ui')->group(function () {
    

    

});





Route::get('jinyui/ui/cards2', function(){
    return view("test.cards2");
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












/**
 * Demo : timeline
 */
Route::get('jinyui/timeline/vertical', function(){
    return view("jinyui::demo.timeline.vertical");
});


Route::get('/bbb', function(){
    return view("jinyui::demo.bbb");
});


Route::get('jinyui/hello', function(){
    return view("jinyui::demo.hello");
});