<?

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/css.php";
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

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		$body = _skin_body($skin_name,"site_menu_setting");
		$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 
		
		$script = "<script>
				function site_edit(mode,uid){
                  	var url = \"/ajax_site_menu_setting_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }

        function setting_mode(mode,uid){
			var url = \"/ajax_site_menu_setting_editup.php?uid=\"+uid+\"&mode=\"+mode;
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#site_edit').html(data);
                }
            });
		}

		</script>";

		
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}",$script."<form id='data' name='menu_setting' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='코드추가' onclick=\"javascript:site_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		// 최대 사이트 운영 갯수를 지정
		$body = str_replace("{site_num}",$sales_db->site,$body);

		// Form and Ajax Process
		$body = str_replace("{site_list}","
					<span id=\"site_list\">

					<script>
						$.ajax({
            				url:'/ajax_site_menu_setting.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#site_list').html(data);
            				}
        				});
    				</script>

					</span>",$body);
		/*
		$query = "select * from `site_menu_setting` where code = 'default' order by regdate desc";
		if($rowss = _sales_query_rowss($query)){
			$rows = $rowss[0];
			$body = str_replace("{edit}","<span id=\"site_edit\">
					<script>
					var url = \"/ajax_site_menu_setting_edit.php?uid=".$rows->Id."&mode=edit\";	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    });
					</script>
				</span>",$body);
		} else {			
			$body = str_replace("{edit}","<span id=\"site_edit\"></span>",$body);		
		}
		*/
		$body = str_replace("{edit}","<span id=\"site_edit\"></span>",$body);

		echo $body;
	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
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
	}

		


?>