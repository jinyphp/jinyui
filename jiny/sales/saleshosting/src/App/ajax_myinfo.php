<?php
    //*  WebLib V1.5
    //*  Program by : hojin lee
    //*  
    //*
    // update : 2016.01.13 = 코드정리 

    @session_start();
    
    include "./conf/dbinfo.php";
    include "./func/mysql.php";

    include "./func/datetime.php";
    include "./func/file.php";
    include "./func/form.php";
    include "./func/string.php";
    include "./func/javascript.php";
    
    include "./func/mobile.php";
    include "./func/language.php";
    include "./func/country.php";

    include "./func/site.php";  // 사이트 환경 설정

    include "./func/layout.php";
    include "./func/header.php";
    include "./func/footer.php";
    include "./func/menu.php";
    include "./func/category.php";
    include "./func/skin.php";


	include "./func/members.php";
	include "./func/css.php";

	
	$javascript = "<script>
		function edit(mode,uid){
            $.ajax({
                url:'/ajax_members_edit.php',
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 	
        }

        function emoney(ajaxkey){
            // alert(\"emoney\");

            $.ajax({
                url:'/ajax_emoney.php?ajaxkey='+ajaxkey,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });

        }
                
    </script>";

	$body = $javascript._theme_page($site_env->theme,"myinfo",$site_language,$site_mobile); //_skin_page($skin_name,"myinfo");

	// 로그인 회원정보 읽어오기
	if(isset($_COOKIE['cookie_email']))	{
		$email = $_COOKIE['cookie_email'];	
		$members = _members_rows($email);
	}

	$body = str_replace("{member_name}",$members->username." ".$members->firstname,$body);
	$body = str_replace("{member_email}",$members->email,$body);

	$ajaxkey = $_SESSION['ajaxkey'];
	$body = str_replace("{members_emoney}","<a href='#' onclick=\"javascript:emoney('$ajaxkey')\">".$members->emoney."</a>",$body);
	$body = str_replace("{members_point}",$members->point,$body);


	$button ="<input type='button' value='정보수정' onclick=\"javascript:edit('edit','0')\" style=\"".$css_btn_gray."\" >";          
	$body = str_replace("{edit}",$button,$body);




	$body = str_replace("{order_list}","주문내역",$body);

	

	
	// 계시물 전처리기 코드를 처리하여, 계시판 내용 표시
	// 보드리스트 출력, Body {board_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "board_";
	if($keyword_count = _keyword_count($body, "{".$keyword)){
		$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
			$class = $keyword.$rows[$i];
			$body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_boardlist.php?board=$rows[$i]")."</script>
					</article>\n",$body);
		}
	}



	// 블럭코드 전처리기 코드를 처리하여, 상품을 진열함
	// 블럭리스트 출력, Body {blocklist_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "block_";
	if($keyword_count = _keyword_count($body, "{".$keyword)){
		$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
			$class = $keyword.$rows[$i];
			$body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
				<script>"._javascript_ajax_html(".".$class,"/ajax_index_blocklist.php?code=$rows[$i]")."</script>
				</article>\n",$body);
		}
	}

	echo $body;

?>