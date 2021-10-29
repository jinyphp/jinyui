<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// DASHBOARD
Route::middleware(['web'])->prefix('jinyui')->group(function () {

    Route::prefix('/theme')->group(function () {
        Route::get('/', function(){
            return view("jinyui::demo.theme.theme");
        });
        Route::get('/layout', function(){
            return view("jinyui::demo.theme.layout");
        });
        Route::get('/layout/hor', function(){
            return view("jinyui::demo.theme.layouts.hor");
        });

        Route::get('/grid', function(){
            return view("jinyui::demo.theme.grid");
        });
    });


    // Widgets
    Route::prefix('/widgets')->group(function () {
        Route::get('/', function(){
            return view("jinyui::demo.widgets.widgets");
        });
        Route::get('/stats', function(){
            return view("jinyui::demo.widgets.stats");
        });
    });


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


    Route::get('/pricing1', function(){
        return view("jinyui::demo.pages.price1");
    });
    Route::get('/pricing2', function(){
        return view("jinyui::demo.pages.price2");
    });
    Route::get('/pricing3', function(){
        return view("jinyui::demo.pages.price3");
    });




    Route::get('/chat', function(){
        return view("jinyui::demo.pages.chat");
    });

    Route::get('/bank', function(){
        return view("jinyui::demo.pages.page.bank");
    });



    Route::get('/profile', function(){
        return view("jinyui::demo.pages.profile");
    });
    Route::get('/profile2', function(){
        //https://bootstrapdash.com/demo/azia/v1.0.0/template/page-profile.html
        return view("jinyui::demo.pages.profile2");
    });

    Route::get('/invoice', function(){
        return view("jinyui::demo.pages.invoice");
    });

    Route::get('/tasks', function(){
        $res = view("jinyui::demo.pages.tasks");
        //file_put_contents(base_path()."/docs/pages/task.html", $res);
        return $res;
    });

    Route::get('/newsgrid', function(){
        //https://bootstrapdash.com/demo/azia/v1.0.0/template/page-news-grid.html
        return view("jinyui::demo.pages.newsgrid");
    });

});


// AUTH
Route::middleware(['web'])->prefix('jinyui/auth')->group(function () {

    Route::get('/signout', function(){
        return view("jinyui::demo.auth.signout");
    });
    Route::get('/reset', function(){
        return view("jinyui::demo.auth.reset");
    });
    Route::get('/404', function(){
        return view("jinyui::demo.auth.404");
    });
    Route::get('/500', function(){
        return view("jinyui::demo.auth.500");
    });

    /**
     * Login Form
     */
    Route::get('/signin', function(){
        return view("jinyui::demo.auth.signin");
    });
    Route::get('/login/login1', function(){
        //https://www.bootstrapdash.com/demo/login-template-free-2/
        return view("jinyui::demo.auth.login.login1");
    });
    Route::get('/login/login2', function(){
        //https://www.bootstrapdash.com/demo/login-template-free-1/
        return view("jinyui::demo.auth.login.login2");
    });
    Route::get('/login/login3', function(){
        //https://bootstrapdash.com/demo/azia/v1.0.0/template/page-signin.html
        return view("jinyui::demo.auth.login.login3");
    });

});

Route::get('/jinyui/menu/top', function(){
    return view("jinyui::demo.menu.top");
});
Route::get('/jinyui/menu/top-dash', function(){
    return view("jinyui::demo.menu.top-dash");
});


//COMPONENTS
//Toggle
Route::middleware(['web'])->prefix('jinyui/toggle')->group(function () {
    Route::get('/accordion', function(){
        return view("jinyui::demo.toggle.accordion");
    });
    Route::get('/dropdown', function(){
        return view("jinyui::demo.toggle.dropdown");
    });
    Route::get('/dropdown2', function(){
        return view("jinyui::demo.toggle.dropdown2");
    });

    Route::get('/collapse', function(){
        return view("jinyui::demo.toggle.collapse");
    });
});

// UI
Route::middleware(['web'])->prefix('jinyui/ui')->group(function () {




    Route::get('/alerts', function(){
        return view("jinyui::demo.ui.alerts");
    });

    Route::get('/images', function(){
        return view("jinyui::demo.ui.images");
    });
    Route::get('/avater', function(){
        return view("jinyui::demo.ui.avater");
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

    //Cards
    Route::get('/cards', function(){
        return view("jinyui::demo.ui.cards");
    });
    Route::get('/cards/basic', function(){
        return view("jinyui::demo.ui.cards.basic");
    });
    Route::get('/cards/layouts', function(){
        return view("jinyui::demo.ui.cards.layouts");
    });
    Route::get('/cards/images', function(){
        return view("jinyui::demo.ui.cards.images");
    });
    Route::get('/cards/nav', function(){
        return view("jinyui::demo.ui.cards.nav");
    });
    Route::get('/cards/portlets', function(){
        return view("jinyui::demo.ui.cards.portlets");
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

    Route::get('/hyper', function(){
        return view("jinyui::demo.forms.inputs.hyper");
    });

    Route::get('/', function(){
        return view("jinyui::demo.forms.index");
    });

    Route::get('/inputs', function(){
        return view("jinyui::demo.forms.inputs");
    });
    Route::get('/inputs/input', function(){
        return view("jinyui::demo.forms.inputs.input");
    });
    Route::get('/inputs/text', function(){
        return view("jinyui::demo.forms.inputs.text");
    });
    Route::get('/inputs/textarea', function(){
        return view("jinyui::demo.forms.inputs.textarea");
    });
    Route::get('/inputs/checkbox', function(){
        return view("jinyui::demo.forms.inputs.checkbox");
    });
    Route::get('/inputs/radio', function(){
        return view("jinyui::demo.forms.inputs.radio");
    });
    Route::get('/inputs/select', function(){
        return view("jinyui::demo.forms.inputs.select");
    });
    Route::get('/inputs/select2', function(){
        return view("jinyui::demo.forms.inputs.selects.select2");
    });
    Route::get('/inputs/files', function(){
        return view("jinyui::demo.forms.inputs.files");
    });


    Route::get('/layouts', function(){
        return view("jinyui::demo.forms.layouts");
    });

    Route::get('/groups', function(){
        return view("jinyui::demo.forms.groups");
    });

    /*
    Route::get('/advance', function(){
        return view("jinyui::demo.forms.advance");
    });
    */



    Route::get('/validation', function(){
        return view("jinyui::demo.forms.validation");
    });

    Route::get('/wizard', function(){
        return view("jinyui::demo.forms.wizard");
    });

    Route::get('/editors', function(){
        return view("jinyui::demo.forms.editors");
    });
    // Editors
    Route::get('/quill/snow', function(){
        return view("jinyui::demo.forms.quill.snow");
    });
    Route::get('/quill/bubble', function(){
        return view("jinyui::demo.forms.quill.bubble");
    });

    Route::get('/select2', function(){
        //https://bootstrapdash.com/demo/azia/v1.0.0/template/form-elements.html
        return view("jinyui::demo.forms.select2");
    });

});


//TABLE
Route::middleware(['web'])->prefix('jinyui/tables')->group(function () {
    Route::get('/table', function(){
        return view("jinyui::demo.tables.table");
    });


    Route::get('/basic', function(){
        return view("jinyui::demo.tables.basic");
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
    Route::get('/buttons', function(){
        return view("jinyui::demo.tables.buttons");
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

//Plug-in

//Calenders
Route::get('jinyui/plugin/calendar', function(){
    return view("jinyui::demo.plugin.calendar");
});
Route::get('jinyui/plugin/flatpicker', function(){
    return view("jinyui::demo.plugin.flatpicker.inline");
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



//Theme Demo
Route::get('/theme/azia/landing', function(){
    return view("theme.demo.azia.azia");
});
Route::get('/theme/azia/dash/web', function(){
    return view("theme.demo.azia.dash-web");
});
Route::get('/theme/azia/mail', function(){
    return view("theme.demo.azia.mail");
});




Route::get('boot', function(){
    return view("theme.demo.boot.home");
});
Route::get('boot/docs', function(){
    return view("theme.demo.boot.docs");
});


//====




Route::group(['middleware' => 'web'], function () {





    Route::get('jinyui/layouts', function(){
        return view("jinyui::demo.layouts.index");
    });


});




Route::prefix('jinyui')->group(function () {
    Route::get('/', function () {
        return view("jinyui::demo.index");
    });
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

/**
 * 마크다운 문서 메뉴얼
 */
Route::get('/jinyui/docs/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}', function(){
    return (new \Jiny\Pages\Http\MarkdownController("docs"))->index();
    //[::class,"index"]
});
