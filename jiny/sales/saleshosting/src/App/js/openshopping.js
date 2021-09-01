
$(document).ready(function(){

    // 메인 검색, 상품검색후 엔터키
    $('#main_search_value').on('keydown',function(e){         
        if(e.keyCode == 13){
            e.preventDefault();
            var url = "/ajax_search.php";
            ajax_html_form('#mainbody',url,'#main_search');
        }
    });

    // 메인검색, 삼품검색후 검색키 클릭
    $("#main_search_btm").on("click", function(){
        // alert("test11");
        var search = $('#main_search').val();
        var url = "/ajax_search.php";
        ajax_html_form('#mainbody',url,'#main_search');
    });





 	// 새로고침 , 패이지 이동시 깜빡임 없이 스므스하게 표시 처리 
 	/*
	$('body').css("display","none");
	$('body').fadeIn(200);
	$('a').click(function(e){
		redirect = $(this).attr('href');
		e.preventDefault();
		$('body').fadeOut(200,function(){
			document.location.href = redirect;
		});
	});
	*/




	/* ******************
    	상품설명 :  이미지텝
   	   ****************** */
    $(".images_content").hide();
    $(".images_content:first").show();

    $("ul.images_navtab li").click(function () {
        $("ul.images_navtab li").removeClass("active").css("color", "#333");
        //$(this).addClass("active").css({"color": "darkred","font-weight": "bolder"});
        $(this).addClass("active").css("color", "darkred");
        $(".images_content").hide();
        var activeimages = $(this).attr("rel");
        $("#" + activeimages).fadeIn();
    });



    // 팝업창 닫기
    $("#popup_close").on("click",function(){
        popup_close();
    });

    

    

   // ckeditor
    //ckeditor.replace('ckeditor');
			
});	
	
/*
// Tab BAR 처리       
$(function () {  
    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
        $("ul.tabs li").removeClass("active").css("color", "#333");
        //$(this).addClass("active").css({"color": "darkred","font-weight": "bolder"});
        $(this).addClass("active").css("color", "darkred");
        $(".tab_content").hide();
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn();
    });
});
*/

/* ******************
    Page 이동 
   ****************** */
function url_replace(url){
	location.replace(url);
}


/* ******************
    AJAX 페이지 처리
   ****************** */

function ajax_html_form_alert(id,url,form,msg){
	alert(msg);
	ajax_html_form(id,url,form);
}	

function ajax_html_form(id,url,form){
	var formData = new FormData($(form)[0]);
	$.ajax({
		url:url,
        type: 'POST',
       	data: formData,
        async: false,
        success: function (data) {
        	$(id).html(data);
        },
        cache: false,
       	contentType: false,
        processData: false
    });	
}

function ajax_html_alert(id,url,msg){
	alert(msg);
	ajax_html(id,url);
}

function ajax_html(id,url){
	$.ajax({
        url:url,
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $(id).html(data);
        }
    }); 
}

function ajax_none(url){
    $.ajax({
        url:url,
        type:'post',
        data:$('form').serialize(),
        success:function(data){
        }
    }); 
}


/* ******************
    AJAX 
   ****************** */
function ajax_sync(id,url){
    $.ajax({
        url:url,
        type:'post',
        async: false,
        data:$('form').serialize(),
        success:function(data){
            $(id).html(data);
        }
    }); 
}

function ajax_async(id,url){
    $.ajax({
        url:url,
        type:'post',
        async: true,
        data:$('form').serialize(),
        success:function(data){
            $(id).html(data);
        }
    }); 
}

function ajax_syncData(id,url,formdata){
    $.ajax({
        url:url,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
            $(id).html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function ajax_asyncData(id,url,formdata){
    $.ajax({
        url:url,
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            $(id).html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}



// ==============
// 팝업창 관련 스크립트 
// POPUP

function popup_maskSize(){
    // 팝업창 마스크 생성
    //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
    var maskHeight = $(document).height();  
    var maskWidth = $(window).width();          
    $('#popup_mask').css({'width':maskWidth,'height':maskHeight});        
}

function popup_maskShow(){
    $('#popup_mask').fadeTo("slow",0.8); 
}

function popup_sizeAlign(){
    // 팡법창 크기 계산, 증앙 표시 
    var width = $('#popup_body').width();
    var height = $('#popup_body').height();
    var left = ($(window).width() - width )/2;
    var top = ( $(window).height() - height )/2;            
    
    $('#popup_body').css({
                'width':width,
                'height':height,
                'left':left,
                'top':50
    }); 
     
}

function popup_bodyShow(){
     $('#popup_body').show();
}

function popup_ajax(url){
    popup_maskSize();
    popup_maskShow();

    // 팝업 내용을 Ajax로 읽어옴
    // 팝업창 내용의 크기를 얻기 위해서 데이터를 동기화로 팝업창 실행 
    $.ajax({
        url:url,
        type:'post',
        async: false,
        data:$('form').serialize(),
        success:function(data){

            // 팝업내용 HTML 삽입
            $('#popup_body').html(data);

            $('#popup_body').css('width','auto');
            $('#popup_body').css('height','auto');
            popup_sizeAlign();
            popup_bodyShow();

            // 팝업창 생성으로 늘아난 윈도우 크기, 사이즈 재조정
            popup_maskSize(); 

        }
    }); 

}

function popup_close(){
    // 팝업창 세로크기 가변으로 변경 처리
    // $('#popup_body').css('height','auto');
    // $('#popup_body').css('height', null);

    $('#popup_body').hide();
    $('#popup_body').html("");

    //마스크의 투명도 처리
    $('#popup_mask').fadeTo('fast',0.0,function(){
        $(this).hide();
    }); 

    
}

























function popup(url){
    var maskHeight = $(document).height();  
    var maskWidth = $(window).width();

    //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
    $('#popup_mask').css({'width':maskWidth,'height':maskHeight});
                
    // 팡법창 크기 계산
    //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
    // popup_size(1000,500);
    var width = 800;
    var height = 300;
    var left = ($(window).width() - width )/2;
    var top = ( $(window).height() - height )/2;            
    $('#popup_body').css({'width':width,'height':height,'left':left,'top':50});               
    
    //마스크의 투명도 처리
    $('#popup_mask').fadeTo("slow",0.8);
    $('#popup_body').show(); 

    // 팝업 내용을 Ajax로 읽어옴
    $.ajax({
        url:url,
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $('#popup_body').html(data);

            var maskHeight1 = $(document).height();  
            var maskWidth1 = $(window).width();

            //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
            $('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
        }
    }); 
 }

function popup_replace(url){
    // 팝업 내용을 Ajax로 읽어옴
    $.ajax({
        url:url,
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $('#popup_body').html(data);

            var maskHeight1 = $(document).height();  
            var maskWidth1 = $(window).width();

            //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
            $('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
        }
    }); 
}    


// ++ Android
function showToast(){
    var message = document.getElementById('toast_input').value;
    App.showToast(message);
}
    
function showAlertDialog($title,$message){
    // var title = document.getElementById('alert_title').value;
    // var message = document.getElementById('alert_message').value;
    App.showAlertDialog($title,$message);
}
    
function showProgressDialog(){
    App.showProgressDialog();
}
    
function showBarcode($mode){
    App.callBarcodeReader($mode);
}
    
function saveBarcodeValue($value,$barcodeMode){
    // document.getElementById('barcodeValue').value = "1111111";
    document.getElementById('barcodeValue').value = $value;
    document.getElementById('barcodeMode').value = $barcodeMode;
}

