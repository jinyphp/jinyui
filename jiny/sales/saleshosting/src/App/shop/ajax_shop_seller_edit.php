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

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";

	include "./func/css.php";
	

	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		// 지정된 상품 하나를 읽어옴
		function _shop_seller_rows($uid){
			$query = "select * from `shop_seller` WHERE `Id`='$uid'";
			//echo $query;
			if($rows = _sales_query_rows($query)){	
				return $rows;
			}	
		}

		/////////////
	
		$body = _skin_page($skin_name,"shop_seller_edit");

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
		
		$body=str_replace("{formstart}","<form id='data' name='seller' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
			$script = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_shop_seller_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('.mainbody').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

				function form_delete(mode,uid){
					var url = \"/ajax_shop_seller_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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
			
			
			
			if($seller_rows = _shop_seller_rows($uid)){
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			
			}

			
		   
	
			if(isset($seller_rows->enable)) $body = str_replace("{enable}",_form_check_enable($seller_rows->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

			$body = str_replace("{seller}",_form_text("seller",$seller_rows->seller,$css_textbox),$body);
			$body = str_replace("{seller_email}",_form_text("seller_email",$seller_rows->email,$css_textbox),$body);
			$body = str_replace("{seller_password}",_form_text("seller_password",$seller_rows->password,$css_textbox),$body);
			$body = str_replace("{seller_site}",_form_text("seller_site",$seller_rows->site,$css_textbox),$body);

			$body = str_replace("{seller_phone}",_form_text("seller_phone",$seller_rows->phone,$css_textbox),$body);
			$body = str_replace("{seller_post}",_form_text("seller_post",$seller_rows->post,$css_textbox),$body);
			$body = str_replace("{seller_address}",_form_text("seller_address",$seller_rows->address,$css_textbox),$body);
			$body = str_replace("{seller_manager}",_form_text("seller_manager",$seller_rows->manager,$css_textbox),$body);


			$body = str_replace("{seller_title}",_form_text("seller_title",$seller_rows->title,$css_textbox),$body);

			$comment = stripslashes($seller_rows->comment);
			$body = str_replace("{seller_comment}",_form_textarea("seller_comment",$comment,"20",$css_textarea),$body);
			
			
			
			echo $body;


	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	
?>