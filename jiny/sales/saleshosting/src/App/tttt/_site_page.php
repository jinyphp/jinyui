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
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
	
		$body = _skin_body($skin_name,"site_pages");
		//$body = str_replace("</head>","<script src=\"//cdn.ckeditor.com/4.5.6/standard/ckeditor.js\"></script>"."</head>",$body);

 
		$body .= "<script>

				function page_edit(mode,uid){
                  	$.ajax({
                        url:'/ajax_site_pages_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
                }
                
                function pagelist(limit){
                	// var search = document.pages.searchkey.value;
                	var url = \"/ajax_site_pages.php?limit=\"+limit;
                	// +\"&search=\"+search;
                  	alert(url);

                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
                  }
                  </script>";
  

		
		// $body = str_replace("</head>","<script src=\"/js/wish.js?cashing=".microtime()."\"></script></head>",$body); 
		// $body_skin = "<script src=\"/js/wish.js\"></script>".$body_skin; 

		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 	
		$body = str_replace("{page_list}","
					<form name='pages' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>
					<span id=\"page_list\">
					
					<script>
						$.ajax({
            				url:'/ajax_site_pages.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('.mainbody').html(data);
            				}
        				});
    				</script>

					</span>
					</form>",$body);

		echo $body;

	
	} else {
		// ????????? ???????????? ????????? ?????? ??????, AJAX??? ????????? ?????? ??????
		$skin_name = "default";
		$body = _skin_body("default","login");
		
		$login_script = "<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
		</script>";  



		echo $body.$login_script;
	}

		


?>