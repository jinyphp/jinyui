<?php

    //*  자바스크립트 php 관련 함수
    //*  Program by : hojin lee

    // update : 2016.01.04 = 코드정리 

    
    // Meta utf-8로 메세지를 출력
    function msg_alert($msg){

        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
            <script>
                alert(\"$msg\");
            </script>";     
    }

    function msg_alert_go1($msg){

        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
            <script>
                alert(\"$msg\");
                history.go(-1);
            </script>";     
    }

    function msg_alert_go2($msg){

        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
            <script>
                alert(\"$msg\");
                history.go(-2);
            </script>";     
    }






















    function _javascript_ajax_html($target,$url){
        $script = "
					
        		

        			$.ajax({
                        url:'".$url."',
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                        	

                            $('".$target."').html(data);
                         

                        }
                    });";
        return $script;
    }


    function _javascript_ajax_login($ajaxkey){
        $script = "$.ajax({
            url:'/ajax_login.php?ajaxkey=$ajaxkey',
            type:'post',
            data:$('form').serialize(),
            success:function(data){
                $('#mainbody').html(data);
            }
        });";
        return $script;
    }












    


    function msg_popup($width,$height,$msg){
        echo "
    <script>
        var popupleft = ($(window).width() - \"$width\")/2;
        var popuptop = ($(window).height() - \"$height\")/2; 

        $('#popup_body').css({'width':width,'height':height,'left':popupleft,'top':popuptop});
        $('#popup_body').html(\"$msg\"); 
  
    </script>";
    }


    function msg_popup_close(){
        echo "<script>
            $('#popup_body').hide();
            $('#popup_mask').hide();
            </script>";
    }


    function _mainbody_ajax($ajax_url){
        echo "<script>
            $.ajax({
                url:'$ajax_url',
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('.mainbody').html(data);
                }
            });
            </script>";
    }

    function _popup_close(){
        echo "<script>
            $('#popup_body').hide();
            $('#popup_mask').hide();
            </script>";
    }
    
    function _script_dbclick_popup($class,$url){

        $script = "var clickEnvent = 0;

        // 풋터 더블클릭
        $('$class').dblclick(function(){
            
            clickEnvent++;
            if(clickEnvent>2){
                clickEnvent = 0;
                // alert(\"Double clicked\" + clickEnvent);

                var maskHeight = $(document).height();  
                var maskWidth = $(window).width();

                //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
                $('#popup_mask').css({'width':maskWidth,'height':maskHeight});
                
                // 팡법창 크기 계산
                //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
                // popup_size(1000,500);
                var width = 1000;
                var height = 500;
                var left = ($(window).width() - width )/2;
                var top = ( $(window).height() - height )/2;            
                $('#popup_body').css({'width':width,'height':height,'left':left,'top':50});               
    
                //마스크의 투명도 처리
                $('#popup_mask').fadeTo(\"slow\",0.8); 
                $('#popup_body').show();

                // popup: ajax로 페이지 로딩...
                var tagId = $(this).attr('id');
                $.ajax({
                    url:'$url',
                    type:'post',
                    timeout:50000,
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

        });";

        return $script;
    }

?>
