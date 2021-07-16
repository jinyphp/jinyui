<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*

	//* 사이트 환경 설정 및 도메인
	//* 복수의 도메인으로 사이트를 운영할 수 있음

	// update : 2016.01.11 = 코드정리 

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");


	if(isset($_COOKIE['cookie_email'])){ // 로그인 접속 확인
		// include "./sales.php";

		$body = _theme_emptybody();
		$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

		$mode = _formmode();
		$uid = _formdata("uid");

		$ajaxkey = $_SESSION['ajaxkey'];
		//$javascript = "<script>"._javascript_ajax_html("#mainbody","/ajax_site_env_edit.php?ajaxkey=$ajaxkey&mode=$mode&uid=$uid")."</script>";	
		$javascript  = "<form id=\"data\" name='hosting' method='post' enctype='multipart/form-data'>";
		$javascript .= "<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>";
		$javascript .= "<input type='hidden' name='mode' value='".$mode."'>";
		$javascript .= "<input type='hidden' name='uid' value='".$uid."'>";
		$javascript .= "<script>"._javascript_ajax_html("#mainbody","ajax_site_env_edit.php")."</script>";			
		$javascript .= "</form>";
		$body = str_replace("<!--{skin_emptybody}-->",$javascript,$body);
		echo $body;


		/*
		$body = _skin_body($skin_name,"site_env");
		
		
		$script = "
				<script>
				function site_edit(mode,uid){
                  	var url = \"/ajax_site_env_edit.php?uid=\"+uid+\"&mode=\"+mode;	
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
					var url = \"/ajax_site_env_editup.php?mode=\"+mode+\"&uid=\"+uid;
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
				</script>";

		
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		

		// 최대 사이트 운영 갯수를 지정
		$body = str_replace("{site_num}",$sales_db->site,$body);

		// Form and Ajax Process
		$body = str_replace("{site_list}","
					<span id=\"site_list\">

					<script>
						$.ajax({
            				url:'/ajax_site_env.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#site_list').html(data);
            				}
        				});
    				</script>

					</span>",$body);
		
		$query = "select * from `site_env` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){
			$rows = $rowss[0];
			$body = str_replace("{edit}","<span id=\"site_edit\">
					<script>
					var url = \"/ajax_site_env_edit.php?uid=".$rows->Id."&mode=edit\";	
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
		
		echo $body;
		*/
	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php")."</script>";	
		$body =  _theme_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

		


?>