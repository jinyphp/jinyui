$(function () {

   
 
    // slideshow 클래스를 가진 요소마다 작업을 수행
    $('.slideshow').each(function () {

        var $slides = $(this).find('img'), // 모든 슬라이드
            slideCount = $slides.length,   // 슬라이드 점수
            currentIndex = 0;              // 현재 슬라이드를 나타내는 인덱스

        // 첫번째 슬라이드에 페이드 인으로 표시
        $slides.eq(currentIndex).fadeIn();

        // 7500 밀리 초마다 showNextSlide 함수를 실행
        setInterval(showNextSlide, 7500);

        // 다음 슬라이드를 표시하는 함수
        function showNextSlide () {

            // 다음 표시 할 슬라이드의 인덱스
            // (만약 마지막 슬라이드이라면 처음으로 돌아 가기)
            var nextIndex = (currentIndex + 1) % slideCount;

            // 현재 슬라이드 페이드 아웃
            $slides.eq(currentIndex).fadeOut();

            // 다음 슬라이드를 페이드 인
            $slides.eq(nextIndex).fadeIn();

            // 현재 슬라이드 인덱스를 업데이트
            currentIndex = nextIndex;
        }

    });

               


    // Detail Page Loading...
    $(document).ready(function(){ 
        $.ajax({
            url:'ajax_shop_infoseller.php',
            type:'post',
            data:$('form').serialize(),
            success:function(data){
                $('#reseller_info').html(data);
            }
        });
    }); 


    // 상품 설명페이지에서 장바구니 버튼 클릭시, 오류 체크 / 수량 및 가격 체크하여 장부구니 AJAX 실행
    $('#btn_detail_cart').on('click',function(){
        if(document.detail.shipping.value) {
           
            var option_flag = "false";
            var optionitem_names=document.getElementsByName('_optionitem_name[]');
            var optionitem=document.getElementsByName('optionitem[]');
            for(key=0; key < optionitem_names.length; key++)  {        
                var x = optionitem_names[key].value;
                var option = optionitem[key].value;
                if(x.charAt(0) == "*" && !option && option_flag == "false") {
                    alert("필수 옵션을 선택해 주세요 : " + x);
                    option_flag = "ture";
                }    
            }

            if(option_flag == "false"){

                var url = "ajax_cart.php?&mode=cartup";
                var formData = new FormData($('#data')[0]);
                $.ajax({
                    url:url,
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {
                        $('#mainbody').html(data);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                }); 

            }

        } else {
            alert("배송방법을 선택해 주세요.");
        }    
    }); 


    // ******************
    // 상품설명 : 관심상품 넣기
    // 
    $('#btn_detail_wish').on('click',function(){
        //document.detail.action = "../wish";
        // document.detail.mode.value = "wish";
        // alert(document.detail.mode.value);
        // document.detail.submit();

        $.ajax({
            url:'/ajax_wish.php?mode=wish',
            type:'post',
            data:$('form').serialize(),
            success:function(data){
                $('#mainbody').html(data);
            }
        });


    }); 


    // 바로주문 
    $('#btn_detail_buynow').on('click',function(){
         if(document.detail.shipping.value) {
           
            var option_flag = "false";
            var optionitem_names=document.getElementsByName('_optionitem_name[]');
            var optionitem=document.getElementsByName('optionitem[]');
            for(key=0; key < optionitem_names.length; key++)  {        
                var x = optionitem_names[key].value;
                var option = optionitem[key].value;
                if(x.charAt(0) == "*" && !option && option_flag == "false") {
                    alert("필수 옵션을 선택해 주세요 : " + x);
                    option_flag = "ture";
                }    
            }

            if(option_flag == "false"){
                alert("바로주문");

                var url = "ajax_ordernow.php?mode=buynow";
                var formData = new FormData($('#data')[0]);
                $.ajax({
                    url:url,
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {
                        $('#mainbody').html(data);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });

                
            }

        } else {
            alert("배송방법을 선택해 주세요.");
        }    

        
    }); 



    $('#shipping').on('change',function(){
        prices_check();
    });

    $('#detail_num').on('change',function(){
        prices_check();
    });


    $('#detail_option0').on('change',function(){
        prices_check();
    });

    $('#detail_option1').on('change',function(){
        prices_check();
    });

    $('#detail_option2').on('change',function(){
        prices_check();
    });

    $('#detail_option3').on('change',function(){
        prices_check();
    });

    $('#detail_option4').on('change',function(){
        prices_check();
    });  





    // 옵션 및 배송 / 수량에 대한 가격 계산처리 루틴
    // 
    function prices_check(){

        // option
        var option_prices = 0;
        var optionitem_names=document.getElementsByName('_optionitem_name[]'); // 옵션 갯수 및 옵션명 
        var optionitem=document.getElementsByName('optionitem[]'); // 선택한 옵션값
        for(key=0; key < optionitem_names.length; key++)  {
            var option = optionitem[key].value;
            var optTmp = option.split('=');
            // alert(option);
            if(optTmp[1]) option_prices += Number(optTmp[1]); 
        }
        //alert("option prices" + option_prices);

        var prices = Number(document.detail.prices.value) + Number(option_prices); // 판매가격 = 단가  + 옵션값
        var sum = Number(prices) *  Number(document.detail.num.value); // 합계 = 판매각격 * 수량 
        var tax = Number(sum) / 100 * Number(document.detail.tax.value); // 부가세 계산 
        var total_sum = Number(sum) + Number(tax);

        var tmp = document.detail.shipping.value;
        var cutTmp = tmp.split(':');
        if(cutTmp[1]) total_sum += Number(cutTmp[1]); // 배송비가 선택된 경우

        document.detail.total_prices.value = commaNum(total_sum); // 숫자 콤마 추가 
        $('#total_sum').html(document.detail.total_prices.value);
    }

    function commaNum(num) {  
        var len, point, str;  
  
        num = num + "";  
        point = num.length % 3  
        len = num.length;  
  
        str = num.substring(0, point);  
        while (point < len) {  
            if (str != "") str += ",";  
            str += num.substring(point, point + 3);  
            point += 3;  
        }  
        return str;  
    }  




    

});

function _good_reselling_add(){
    alert("Reseller");

}


