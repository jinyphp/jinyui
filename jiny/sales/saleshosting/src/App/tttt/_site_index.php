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

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		// $skin_name = "default";
		$body = _skin_body($skin_name,"site_index");
		$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

		$script = "
				<script>
				function index_edit(mode,uid){
                  	var url = \"/ajax_site_index_list.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }

				function form_submit(mode,uid){
					var url = \"/ajax_site_index_editup.php?mode=\"+mode+\"&uid=\"+uid;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});

					
				}
		
				// List update
				function form_list_submit(mode,eid){
					var url = \"/ajax_site_index_list_editup.php?eid=\"+eid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					// alert(url);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

				function form_list_delete(mode,eid){
					var url = \"/ajax_site_index_title_editup.php?eid=\"+eid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);

                        }
                    });
				}



				function form_title_submit(mode,uid){
					var url = \"/ajax_site_index_title_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					// alert(url);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

				function form_title_delete(mode,uid){
					var url = \"/ajax_site_index_title_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);

                        }
                    });
				}

				function form_goods_submit(mode,uid){
					var url = \"/ajax_site_index_goods_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					// alert(url);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

				function form_goods_delete(mode,uid){
					var url = \"/ajax_site_index_goods_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);

                        }
                    });
				}


				function form_board_submit(mode,uid){
					var url = \"/ajax_site_index_board_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					// alert(url);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

				function form_board_delete(mode,uid){
					var url = \"/ajax_site_index_board_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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
		$body=str_replace("{formstart}",$script."<form id='data' name='footer' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='NEW' onclick=\"javascript:site_edit('new','0')\" id=\"".$btn_style_gray."\" >";          
		$body = str_replace("{new}","",$body);


		// Form and Ajax Process
		$body = str_replace("{index_list}","<span id=\"site_list\">

					<script>
						$.ajax({
            				url:'/ajax_site_index.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#site_list').html(data);
            				}
        				});
    				</script>

					</span>",$body);
		$body = str_replace("{edit}","<span id=\"site_edit\">
					초기페이지 구성, 좌측 도메인을 선택해 주세요.<br>
					도메인이 없는 경우 홈페이지 > 설정에서 사이트환경 설정을 미리 해주세요.
					</span>",$body);
	
		echo $body;

	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$skin_name = "default";
		$body = _skin_body("default","login");
		
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
	}

		


?>