<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



use Jiny\Members\Http\Controllers\Members;
use Jiny\Members\Http\Controllers\Users;
use Jiny\Members\Http\Controllers\Agreements;
use Jiny\Members\Http\Controllers\Blacklist;
use Jiny\Members\Http\Controllers\Reserved;
use Jiny\Members\Http\Controllers\Level;
use Jiny\Members\Http\Controllers\Group;
use Jiny\Members\Http\Controllers\Team;
use Jiny\Members\Http\Controllers\Roles;
Route::middleware(['web'])->prefix('/admin/members')->name("admin-members")->group(function () {
    // 회원목록    
    Route::resource('/list', Members::class);
    Route::resource('/users', Users::class);
    Route::resource('/roles', Roles::class);


    // 회원가입 동의서
    Route::resource('/agreements', Agreements::class);

    // 블랙리스트
    Route::resource('/blacklist', Blacklist::class);

    // 예약 회원
    Route::resource('/reserved', Reserved::class);

    // 회원 레벨
    Route::resource('/level', Level::class);

    //회원 그룹
    Route::resource('/group', Group::class);

    // 팀
    Route::resource('/team', Team::class);

});

// 회원 dashboard







Route::get('/admin/members/agreement/log', function () {
    //회원 동의서 기록
});

// 회원 가입항목 관리



// 회원 적립금 관리
Route::get('/admin/members/emoney', function () {
    return view("jinymem::members.emoney");
});
Route::get('/admin/members/emoney/payin', function () {
    return view("jinymem::members.emoney-payin");
});
Route::get('/admin/members/emoney/payout', function () {
    return view("jinymem::members.emoney-payout");
});


//회원 포인터 관리
Route::get('/admin/members/point', function () {
    return view("jinymem::members.point");
});
Route::get('/admin/members/point/edit', function () {
    return view("jinymem::members.point-edit");
});

// 휴면회원 관리


// 회원 이메일 발송
// 회원 이메일 양식폼

// 회원 설정

// 비빌번호 재설정 메일발송


// 회원 문자메시지 발송

// 회원 로그인기록





// contact




// 권환