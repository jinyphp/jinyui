<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

use App\Http\Livewire\Admin\AdminMain;
Route::get('/admin',AdminMain::class);

/*
Route::get('/admin/country',App\Http\Livewire\Admin\BasicCountry::class);
Route::get('/admin/language',App\Http\Livewire\Admin\BasicLanguage::class);
Route::get('/admin/menu',App\Http\Livewire\Admin\BasicMenu::class);
Route::get('/admin/popup',App\Http\Livewire\Popup::class);
*/



use Jiny\Sales\Http\Controllers\Company;
Route::get('/company', [Company::class,"index"]);
Route::delete('/company', [Company::class,"delete"]);
Route::get('/company/new', [Company::class,"new"]);

Route::get('/company/fields', function () {
    return view('company-fields');    
});


use App\Http\Controllers\SiteMenu;
Route::get('/menu', [SiteMenu::class,"index"]);

Route::get('/drag',App\Http\Livewire\Drag::class);


// 테이블에서 라우트 uri 정보를 조회
/*
use Illuminate\Support\Facades\DB;
$r = DB::table('routings')->where('uri', "=", "/company")->first();
if ($r) {
    // 동적 라우트 설정
    Route::get($r->uri, function () use ($r) {
        $table = [
            'name'=>$r->table, //"site_menus",
            'rules'=>"jiny/menu.json"
        ];
        
        return view('sales.company', ['table'=>$table]);
    });
}
*/



Route::get('jinyui', function(){
    return view("jinyui.index");
});
Route::get('jinyui/ui/cards', function(){
    return view("jinyui.ui.cards");
});
Route::get('jinyui/ui/alert', function(){
    return view("jinyui.ui.alert");
});
Route::get('jinyui/ui/button', function(){
    return view("jinyui.ui.button");
});
Route::get('jinyui/ui/general', function(){
    return view("jinyui.ui.general");
});

Route::get('jinyui/ui/grid', function(){
    return view("jinyui.ui.grid");
});
Route::get('jinyui/ui/modals', function(){
    return view("jinyui.ui.modals");
});
Route::get('jinyui/ui/offcanvas', function(){
    return view("jinyui.ui.offcanvas");
});
Route::get('jinyui/ui/tabs', function(){
    return view("jinyui.ui.tabs");
});
Route::get('jinyui/ui/typography', function(){
    return view("jinyui.ui.typography");
});


Route::get('jinyui/forms/basic', function(){
    return view("jinyui.forms.basic");
});
Route::get('jinyui/forms/layout', function(){
    return view("jinyui.forms.layout");
});
Route::get('jinyui/forms/inputs', function(){
    return view("jinyui.forms.inputs");
});
Route::get('jinyui/forms/tables', function(){
    return view("jinyui.forms.tables");
});

Route::get('jinyui/pages/page/settings', function(){
    return view("jinyui.pages.page.settings");
});

Route::get('jinyui/pages/page/projects', function(){
    return view("jinyui.pages.page.projects");
});
Route::get('jinyui/pages/page/clients', function(){
    return view("jinyui.pages.page.clients");
});
Route::get('jinyui/pages/page/price', function(){
    return view("jinyui.pages.page.price");
});
Route::get('jinyui/pages/page/chat', function(){
    return view("jinyui.pages.page.chat");
});
Route::get('jinyui/pages/page/bank', function(){
    return view("jinyui.pages.page.bank");
});

Route::get('jinyui/pages/profile', function(){
    return view("jinyui.pages.profile");
});
Route::get('jinyui/pages/invoice', function(){
    return view("jinyui.pages.invoice");
});
Route::get('jinyui/pages/task', function(){
    return view("jinyui.pages.task");
});
Route::get('jinyui/pages/calendar', function(){
    return view("jinyui.pages.calendar");
});

Route::get('jinyui/pages/auth/signin', function(){
    return view("jinyui.pages.auth.signin");
});
Route::get('jinyui/pages/auth/singout', function(){
    return view("jinyui.pages.auth.singout");
});
Route::get('jinyui/pages/auth/reset', function(){
    return view("jinyui.pages.auth.reset");
});
Route::get('jinyui/pages/auth/404', function(){
    return view("jinyui.pages.auth.404");
});
Route::get('jinyui/pages/auth/500', function(){
    return view("jinyui.pages.auth.500");
});