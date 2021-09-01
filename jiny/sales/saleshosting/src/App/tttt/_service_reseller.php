<?

	@session_start();

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
	include "./func/datetime.php";
	include "./func/butten.php";

	include "./func/css.php";

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){

		// 셀러 DB 및 각종 함수 include
		// include "./sales.php";

		$body =  _skin_emptybody($skin_name);

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("<!--{skin_emptybody}-->","<script>
				$.ajax({
            		url:'/ajax_service_reseller.php?ajaxkey=$ajaxkey',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
		</script>",$body);

		/*
		
		

		// 카테고리 리스트는
        // ajax 형태로 처리함.
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		


		$body = str_replace("{reseller_list}","<span id=\"reseller_list\">
					<script>
						$.ajax({
            				url:'/ajax_service_reseller.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#reseller_list').html(data);
            				}
        				});
    				</script>
					</span>",$body);

		$body = str_replace("{edit}","<span id=\"reseller_edit\"></span>",$body);
		*/

		

		echo $body;

	
	} else {
		$body =  _skin_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->","<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
		</script>",$body);
		echo $body;
		/*
		// 
		// 사이트 로그인이 안되어 있는 경우, 
		// AJAX로 로그인 처리 요청
		$body = _skin_body($skin_name,"login");
		
		$login_script = "<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
		</script>";  

		echo $body.$login_script;
		*/
	}

		


?>