<?php
use Illuminate\Support\Facades\Route;

Route::get('/sales', function () {
    return view("jinyerp::sales");

    
});

use Jiny\Sales\Http\Controllers\Company;
Route::group(['middleware' => 'web'], function () {
    Route::prefix('/sales/company')->group(function () {
        Route::get('/', [Company::class,"index"]);
        Route::delete('/', [Company::class,"delete"]);
        Route::get('/new', [Company::class,"new"]);
    
        Route::get('/fields', function () {
            return view('company-fields');    
        });
    });

    Route::get('/sales/sales-company', function () {
        return view("jinyerp::sales.sales-company");
    });
    Route::get('/sales/sales-company-edit', function () {
        return view("jinyerp::sales.sales-company-edit");
    });
    Route::get('/sales/sales-company-list', function () {
        return view("jinyerp::sales.sales-company-list");
    });
    Route::get('/sales/sales-company-sync', function () {
        return view("jinyerp::sales.sales-company-sync");
    });
    Route::get('/sales/sales-company-syncNew', function () {
        return view("jinyerp::sales.sales-company-syncNew");
    });

});


Route::group(['middleware' => 'web'], function () {

    Route::get('/sales/business', function () {
        return view("jinyerp::sales.business.list");
    });

    Route::get('/sales/business/edit', function () {
        return view("jinyerp::sales.business.edit");
    });
});


Route::get('/sales/sales-goods', function () {
    return view("jinyerp::sales.sales-goods");
});
Route::get('/sales/sales-goods-bom', function () {
    return view("jinyerp::sales.sales-goods-bom");
});
Route::get('/sales/sales-goods-bom-edit', function () {
    return view("jinyerp::sales.sales-goods-bom-edit");
});
Route::get('/sales/sales-goods-edit', function () {
    return view("jinyerp::sales.sales-goods-edit");
});
Route::get('/sales/sales-goods-info', function () {
    return view("jinyerp::sales.sales-goods-info");
});
Route::get('/sales/sales-goods-list', function () {
    return view("jinyerp::sales.sales-goods-list");
});
Route::get('/sales/sales-goods-sync', function () {
    return view("jinyerp::sales.sales-goods-sync");
});
Route::get('/sales/sales-house', function () {
    return view("jinyerp::sales.sales-house");
});
Route::get('/sales/sales-house-edit', function () {
    return view("jinyerp::sales.sales-house-edit");
});
Route::get('/sales/sales-manager', function () {
    return view("jinyerp::sales.sales-manager");
});
Route::get('/sales/sales-manager-edit', function () {
    return view("jinyerp::sales.sales-manager-edit");
});
Route::get('/sales/sales-quotation', function () {
    return view("jinyerp::sales.sales-quotation");
});
Route::get('/sales/sales-quotation-company', function () {
    return view("jinyerp::sales.sales-quotation-company");
});
Route::get('/sales/sales-quotation-edit', function () {
    return view("jinyerp::sales.sales-quotation-edit");
});
Route::get('/sales/sales-report', function () {
    return view("jinyerp::sales.sales-report");
});
Route::get('/sales/sales-report-company', function () {
    return view("jinyerp::sales.sales-report-company");
});
Route::get('/sales/sales-trans', function () {
    return view("jinyerp::sales.sales-trans");
});
Route::get('/sales/sales-trans-company', function () {
    return view("jinyerp::sales.sales-trans-company");
});
Route::get('/sales/sales-trans-edit', function () {
    return view("jinyerp::sales.sales-trans-edit");
});
Route::get('/sales/sales-trans-export', function () {
    return view("jinyerp::sales.sales-trans-export");
});
Route::get('/sales/sales-trans-pay', function () {
    return view("jinyerp::sales.sales-trans-pay");
});
Route::get('/sales/sales-trans-sync', function () {
    return view("jinyerp::sales.sales-trans-sync");
});


/* ===== Site ===== */