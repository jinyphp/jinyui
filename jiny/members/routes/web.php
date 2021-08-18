<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use Jiny\Members\Http\Controllers\DBTables;
Route::resource('/admin/db/tables', DBTables::class);


// 회원 dashboard


// 회원목록
use Jiny\Members\Http\Controllers\Members;
Route::resource('/admin/members', Members::class);
// Route::get('/admin/members',[\Jiny\Members\Http\Controllers\Members::class,"index"])->name("admin.members");
//Route::get('/admin/members/new', [\Jiny\Members\Http\Controllers\Members::class,"addNew"])->name("admin.members.new");


// 회원가입 동의서
Route::get('/admin/members/agreement', function () {
    return view("jinymem::members.agreement");
});
Route::get('/admin/members/agreement/edit', function () {
    return view("jinymem::members.agreement-edit");
});

Route::get('/admin/members/agreement/log', function () {
    //회원 동의서 기록
});

// 회원 가입항목 관리



// 블랙리스트
Route::get('/admin/members/blacklist', function () {
    return view("jinymem::members.blacklist");
});
Route::get('/admin/members/blacklist/edit', function () {
    return view("jinymem::members.blacklist-edit");
});


// 예약 회원
Route::get('/admin/members/reserved', function () {
    return view("jinymem::members.reserved");
});
Route::get('/admin/members/reserved/edit', function () {
    return view("jinymem::members.reserved-edit");
});


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

// 회원 레벨

//회원 그룹

// contact
