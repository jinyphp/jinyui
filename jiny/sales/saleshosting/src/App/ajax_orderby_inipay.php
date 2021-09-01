<?php

    /* INIsecurepaystart.php
    *
    * 이니페이 웹페이지 위변조 방지기능이 탑재된 결제요청페이지.
    * 코드에 대한 자세한 설명은 매뉴얼을 참조하십시오.
    * <주의> 구매자의 세션을 반드시 체크하도록하여 부정거래를 방지하여 주십시요.
    *
    * http://www.inicis.com
    * Copyright (C) 2006 Inicis Co., Ltd. All rights reserved.
    */

    /* * **************************
    * 0. 세션 시작             *
    * ************************** */
    session_start();      //주의:파일 최상단에 위치시켜주세요!!
    
    include "./conf/dbinfo.php";
    include "./func/mysql.php";

    include "./func/file.php";
    include "./func/form.php";
    
    include "./func/mobile.php";
    include "./func/language.php";
    include "./func/country.php";
    include "./func/site.php";
    include "./func/layout.php";
    include "./func/header.php";
    include "./func/footer.php";
    include "./func/menu.php";
    include "./func/category.php";
    include "./func/skin.php";


    include "./func/string.php";
    include "./func/datetime.php";
    include "./func/error.php";
    include "./func/css.php";
    include "./func/ajax.php";
    include "./func/members.php";
    
    include "./func/orders.php";

    include "./func/goods.php";
    include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

/// 장바구니 섹션 존재 유무를 검사.
    if(isset($_SESSION['cartlog'])){
        $cartlog = $_SESSION['cartlog'];
    } else {
        $cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
        $_SESSION['cartlog'] = $cartlog;            
    }

    $body = _skin_body($skin_name,"orderby_inipay");



    /* * ************************
     * 1. 라이브러리 인클루드 *
     * ************************ */
    require("./INIpay50/libs/INILib.php");

    /* * *************************************
     * 2. INIpay50 클래스의 인스턴스 생성  *
     * ************************************* */
    $inipay = new INIpay50;

    /* * ************************
     * 3. 암호화 대상/값 설정 *
     * ************************ */
    $inipay->SetField("inipayhome", "/home/wwwhtml/saleshosting/INIpay50");       // 이니페이 홈디렉터리(상점수정 필요)
    $inipay->SetField("type", "chkfake");      // 고정 (절대 수정 불가)
    $inipay->SetField("debug", "true");        // 로그모드("true"로 설정하면 상세로그가 생성됨.)
    $inipay->SetField("enctype", "asym");    //asym:비대칭, symm:대칭(현재 asym으로 고정)
    /* * ************************************************************************************************
     * admin 은 키패스워드 변수명입니다. 수정하시면 안됩니다. 1111의 부분만 수정해서 사용하시기 바랍니다.
     * 키패스워드는 상점관리자 페이지(https://iniweb.inicis.com)의 비밀번호가 아닙니다. 주의해 주시기 바랍니다.
     * 키패스워드는 숫자 4자리로만 구성됩니다. 이 값은 키파일 발급시 결정됩니다.
     * 키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오.
     * ************************************************************************************************ */
    $inipay->SetField("admin", "1111");     // 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
    $inipay->SetField("checkopt", "false");   //base64함:false, base64안함:true(현재 false로 고정)
    //필수항목 : mid, price, nointerest, quotabase
    //추가가능 : INIregno, oid
    //*주의* :    추가가능한 항목중 암호화 대상항목에 추가한 필드는 반드시 hidden 필드에선 제거하고 
    //          SESSION이나 DB를 이용해 다음페이지(INIsecureresult.php)로 전달/셋팅되어야 합니다.
    $inipay->SetField("mid", "INIpayTest");            // 상점아이디
    $inipay->SetField("price", "1000");                // 가격
    $inipay->SetField("nointerest", "no");             //무이자여부(no:일반, yes:무이자)
    $inipay->SetField("quotabase", "선택:일시불:2개월:3개월:6개월"); //할부기간

    /* * ******************************
     * 4. 암호화 대상/값을 암호화함 *
     * ****************************** */
    $inipay->startAction();

    /* * *******************
     * 5. 암호화 결과  *
     * ******************* */
    if ($inipay->GetResult("ResultCode") != "00") {
        //echo $inipay->GetResult("ResultMsg");
        exit(0);
    }

    /* * *******************
     * 6. 세션정보 저장  *
     * ******************* */
    $_SESSION['INI_MID'] = "INIpayTest"; //상점ID
    $_SESSION['INI_ADMIN'] = "1111";   // 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
    $_SESSION['INI_PRICE'] = "1000";     //가격 
    $_SESSION['INI_RN'] = $inipay->GetResult("rn"); //고정 (절대 수정 불가)
    $_SESSION['INI_ENCTYPE'] = $inipay->GetResult("enctype"); //고정 (절대 수정 불가)

     $inipay_payment ="<select name=gopaymethod >
        <option value=\"\">[ 결제방법을 선택하세요. ]</option>
        <option value=\"Card\">신용카드 결제</option>
        <option value=\"VCard\">인터넷안전 결제 </option>
        <option value=\"DirectBank\">실시간 은행계좌이체</option>
        <option value=\"HPP\">핸드폰 결제</option>
        <option value=\"PhoneBill\">받는전화결제 </option>
        <option value=\"Ars1588Bill\">1588 전화 결제 </option>
        <option value=\"VBank\">무통장 입금 </option>
        <option value=\"OCBPoint\">OK 캐쉬백포인트 결제</option>
        <option value=\"Culture\">문화상품권 결제</option>
        <option value=\"kmerce\">K-merce 상품권 결제</option>
        <option value=\"TeenCash\">틴캐시 결제</option>
        <option value=\"dgcl\">게임문화 상품권 결제</option>
        <option value=\"BCSH\">도서문화 상품권 결제</option>
        <option value=\"OABK\">미니뱅크 결제</option>
        <option value=\"onlycard\" >신용카드 결제(전용메뉴)</option>
        <option value=\"onlyisp\">인터넷안전 결제 (전용메뉴)</option>
        <option value=\"onlydbank\">실시간 은행계좌이체 (전용메뉴) </option>
        <option value=\"onlycid\"> 신용카드/계좌이체/무통장입금(전용메뉴)</option>
        <option value=\"onlyvbank\">무통장입금(전용메뉴)</option>
        <option value=\"onlyhpp\"> 핸드폰 결제(전용메뉴)</option>
        <option value=\"onlyphone\"> 전화 결제(전용메뉴)</option>
        <option value=\"onlyocb\"> OK 캐쉬백 결제 - 복합결제 불가능(전용메뉴)</option>
        <option value=\"onlyocbplus\"> OK 캐쉬백 결제- 복합결제 가능(전용메뉴)</option>
        <option value=\"onlyculture\"> 문화상품권 결제(전용메뉴) </option>
        <option value=\"onlykmerce\"> K-merce 상품권 결제(전용메뉴)</option>
        <option value=\"onlyteencash\">틴캐시 결제(전용메뉴)</option>
        <option value=\"onlydgcl\">게임문화 상품권 결제(전용메뉴)</option>
        <option value=\"onlypoint\">LGmyPoint</option>
        <option value=\"onlybcsh\">도서문화 상품권 결제(전용메뉴)</option>
        <option value=\"onlyoabk\">미니뱅크 결제(전용메뉴)</option>
        </select>";
    




    // <!-- 아래의 meta tag 4가지 항목을 반드시 추가 하시기 바랍니다. -->
    $meta ="        
        <meta http-equiv=\"Cache-Control\" content=\"no-cache\"/> 
        <meta http-equiv=\"Expires\" content=\"0\"/> 
        <meta http-equiv=\"Pragma\" content=\"no-cache\"/>
        <meta http-equiv=\"X-UA-Compatible\" content=\"requiresActiveX=true\" />";
    $body = str_replace("</head>",$meta."</head>",$body);
    
    //<!-------------------------------------------------------------------------------
    //  * 웹SITE 가 https를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js 사용 
    //  * 웹SITE 가 Unicode(UTF-8)를 이용하면 http://plugin.inicis.com/pay61_secuni_cross.js 사용
    //  * 웹SITE 가 https, unicode를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js 사용  
    //  -------------------------------------------------------------------------------->
    $javascript = "<script language=javascript src=\"http://plugin.inicis.com/pay61_secuni_cross.js\"></script>";   
    $javascript .= "<script language=javascript src=\"./INIpay50/inipay.js\"></script>";    
    $body = str_replace("</head>",$javascript."</head>",$body);

    $body = str_replace("<body ","<body onload=\"javascript:enable_click()\" onFocus=\"javascript:focus_control()\" ",$body);
        
            



    $body = str_replace("{inipay_payment}",$inipay_payment,$body);

    $body = str_replace("{goodname}","<input type=text name=goodname size=20 value=\"축구공\">",$body);

    $body = str_replace("{buyername}","<input type=text name=buyername size=20 value=\"홍길동\">",$body);

    $body = str_replace("{buyeremail}","<input type=text name=buyeremail size=20 value=\"hkd@abcd.com\">",$body);

    $body = str_replace("{parentemail}","<input type=text name=parentemail size=20 value=\"parents@parents.com\">",$body);

    $body = str_replace("{phone}","<input type=text name=buyertel size=20 value=\"011-123-1234\">",$body);



    $form_submit = "<input type='submit' value='결제'>";
    $body = str_replace("{form_submit}",$form_submit,$body);





    // <!-- 기타설정 -->
    $form_end = "<input type=hidden name=currency size=20 value=\"WON\">";

    //<!--
    //SKIN : 플러그인 스킨 칼라 변경 기능 - 6가지 칼라(ORIGINAL, GREEN, ORANGE, BLUE, KAKKI, GRAY)
    //HPP : 컨텐츠 또는 실물 결제 여부에 따라 HPP(1)과 HPP(2)중 선택 적용(HPP(1):컨텐츠, HPP(2):실물).
    // Card(0): 신용카드 지불시에 이니시스 대표 가맹점인 경우에 필수적으로 세팅 필요 ( 자체 가맹점인 경우에는 카드사의 계약에 따라 설정) - 자세한 내용은 메뉴얼  참조.
    //OCB : OK CASH BAG 가맹점으로 신용카드 결제시에 OK CASH BAG 적립을 적용하시기 원하시면 "OCB" 세팅 필요 그 외에 경우에는 삭제해야 정상적인 결제 이루어짐.
    //no_receipt : 은행계좌이체시 현금영수증 발행여부 체크박스 비활성화 (현금영수증 발급 계약이 되어 있어야 사용가능)
    //-->
    $form_end .= "<input type=hidden name=acceptmethod size=20 value=\"HPP(1):Card(0):OCB:receipt:cardpoint\">";

    //<!--
    //상점 주문번호 : 무통장입금 예약(가상계좌 이체),전화결재 관련 필수필드로 반드시 상점의 주문번호를 페이지에 추가해야 합니다.
    //결제수단 중에 은행 계좌이체 이용 시에는 주문 번호가 결제결과를 조회하는 기준 필드가 됩니다.
    //상점 주문번호는 최대 40 BYTE 길이입니다.
    //주의:절대 한글값을 입력하시면 안됩니다.
    //-->
    $form_end .= "<input type=hidden name=oid size=40 value=\"oid_1234567890\">";

    //<!--
    //플러그인 좌측 상단 상점 로고 이미지 사용
    //이미지의 크기 : 90 X 34 pixels
    //플러그인 좌측 상단에 상점 로고 이미지를 사용하실 수 있으며,
    //주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 상단 부분에 상점 이미지를 삽입할수 있습니다.
    //-->
    //<!--input type=hidden name=ini_logoimage_url  value="http://[사용할 이미지주소]"-->

    //<!--
    //좌측 결제메뉴 위치에 이미지 추가
    //이미지의 크기 : 단일 결제 수단 - 91 X 148 pixels, 신용카드/ISP/계좌이체/가상계좌 - 91 X 96 pixels
    //좌측 결제메뉴 위치에 미미지를 추가하시 위해서는 담당 영업대표에게 사용여부 계약을 하신 후
    //주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 좌측 결제메뉴 부분에 이미지를 삽입할수 있습니다.
    //-->
    //<!--input type=hidden name=ini_menuarea_url value="http://[사용할 이미지주소]"-->

    //<!--
    //플러그인에 의해서 값이 채워지거나, 플러그인이 참조하는 필드들
    //삭제/수정 불가
    //uid 필드에 절대로 임의의 값을 넣지 않도록 하시기 바랍니다.
    //-->

    $form_end .= "<input type=hidden name=ini_encfield value=\"".$inipay->GetResult("encfield")."\">
    <input type=hidden name=ini_certid value=\"".$inipay->GetResult("certid")."\">";


    $form_end .= "<input type=hidden name=quotainterest value=\"\">
    <input type=hidden name=paymethod value=\"\">
    <input type=hidden name=cardcode value=\"\">
    <input type=hidden name=cardquota value=\"\">
    <input type=hidden name=rbankcode value=\"\">
    <input type=hidden name=reqsign value=\"DONE\">
    <input type=hidden name=encrypted value=\"\">
    <input type=hidden name=sessionkey value=\"\">
    <input type=hidden name=uid value=\"\"> 
    <input type=hidden name=sid value=\"\">
    <input type=hidden name=version value=4000>
    <input type=hidden name=clickcontrol value=\"\">";

  
    $body = str_replace("{formstart}","<form name=ini method=post action=\"INIsecureresult.php\" onSubmit=\"return pay(this)\">",$body);
    $body = str_replace("{formend}",$form_end."</form>",$body);

    $body = str_replace("{inipay_payment}",$inipay_payment,$body);
    echo $body;

   
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                           
