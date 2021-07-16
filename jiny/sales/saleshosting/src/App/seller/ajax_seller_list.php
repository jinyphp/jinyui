<?
    //*  WebLib V1.5
    //*  Program by : hojin lee
    //*  
    //*
    // update : 2016.01.04 = 코드정리 

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

    include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");   // 사이트 환경 설정
        
    include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

    include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	/////////////
	$javascript = "<script>
		function add_shop(mode,uid,limit){
			/*
			var url = \"ajax_seller_list.php?limit=\"+limit+\"&mode=\"+mode+\"&uid=\"+uid;
			alert(url);

            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 
            */

            var url = \"ajax_seller_list.php\";
			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);  
        
        }
     
	</script>";	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");  

		$body = $javascript._theme_page($site_env->theme,"scm_seller_list",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);


		$mode = _formmode();

		if($mode == "add_shop"){
			//echo "add_shop.... <br>";
			// 입점신청 연결
			$uid = _formdata("uid");
			if(isset($_COOKIE['cookie_email']))	{
				$email = $_COOKIE['cookie_email'];
				$query = "select * from service.seller where email='$email';";
				if($seller_rows = _mysqli_query_rows($query)){
				}

			}

			$query = "select * from service.seller where Id='$uid';";
			if($shop_rows = _mysqli_query_rows($query)){
				$query = "INSERT INTO service.scm_shop (`regdate`,`shop`,`shop_email`,`shop_name`,`shop_country`,`shop_domain`,`shop_business`,
								`seller`,`seller_email`,`seller_name`,`seller_country`,`seller_domain`,`seller_business`) 
					VALUES ('".$TODAYTIME."','".$uid."','".$shop_rows->email."','".$shop_rows->name."','".$shop_rows->country."','".$shop_rows->domain."','".$shop_rows->business."',
					'".$seller_rows->Id."','".$email."','".$seller_rows->name."','".$seller_rows->country."','".$seller_rows->domain."','".$seller_rows->business."')";
				_mysqli_query($query);


				// 거래처 등록
				$query1 = "select * from sales_company where email='".$scm_rows->shop_email."'";
				if($rows1 = _sales_query_rows($query1)){
					echo "이미 가입, 중복된 이메일 입니다.";
				} else {

					$insert_filed .= "`regdate`,";					$insert_value .= "'$TODAYTIME',";
					$insert_filed .= "`enable`,";					$insert_value .= "'on',";			
					$insert_filed .= "`auth`,";						$insert_value .= "'on',";			
    				$insert_filed .= "`business`,";					$insert_value .= "'$business',";					
					$insert_filed .= "`country`,";					$insert_value .= "'".$scm_rows->shop_country."',";					
					$insert_filed .= "`currency`,";					$insert_value .= "'$currency',";				
					$insert_filed .= "`limitation`,";				$insert_value .= "'$limitation',";					
					$insert_filed .= "`inout`,";					$insert_value .= "'sell',";				
					$insert_filed .= "`company`,";					$insert_value .= "'".$scm_rows->shop_name."',";					

    				$biznumber = _sales_CompanyLicense_POST("kr");
    				$insert_filed .= "`biznumber`,";				$insert_value .= "'$biznumber',";    				
	
					$insert_filed .= "`president`,";				$insert_value .= "'$president',";					
					$insert_filed .= "`post`,";						$insert_value .= "'$post',";					
					$insert_filed .= "`address`,";					$insert_value .= "'$address',";					
					$insert_filed .= "`subject`,";					$insert_value .= "'$subject',";			
					$insert_filed .= "`item`,";						$insert_value .= "'$item',";				
					$insert_filed .= "`email`,";					$insert_value .= "'".$scm_rows->shop_email."',";					
					$insert_filed .= "`tel`,";						$insert_value .= "'$tel',";				
					$insert_filed .= "`fax`,";						$insert_value .= "'$fax',";				
					$insert_filed .= "`phone`,";					$insert_value .= "'$phone',";				
					$insert_filed .= "`group`,";					$insert_value .= "'$group',";				
					$insert_filed .= "`manager`,";					$insert_value .= "'$manager',";			
					$insert_filed .= "`discount`,";					$insert_value .= "'$discount',";				

    				$insert_filed .= "`vat`,";
    				if($vat) $insert_value .= "'on',"; else $insert_value .= "'',";
					
					$insert_filed .= "`comment`,";					$insert_value .= "'".addslashes($comment)."',";			

					$query = "INSERT INTO `sales_company` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);
				}


			}

			


			$url = "seller_shop.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";		

		}

		/*
		$body = $javascript._skin_page($skin_name,"resales_shop_list");
		$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"X\" style=\"".$css_btn_gray."\"/>",$body);

		$body = str_replace("{formstart}","<form name='resales' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='입점신청' onclick=\"javascript:resales('0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{resales}",$button,$body);
	

		$goods_search = _formdata("goods_search");
		$body = str_replace("{searchkey}","<input type='text' name='goods_search' value='".$goods_search."' id=\"goods_search\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:popup_list('0')\" style=\"".$css_btn_gray."\" >";
		$body = str_replace("{btn_search}",$button_search,$body);


		$_list_num = 4;
		$_block_num = 10;
		$limit2 = _formdata("limit2");
		//echo "limit2 = ".$limit2."<br>";
		*/


		
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if($_list_num = _formdata("list_num")){
		} else $_list_num = 10;

		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);

		
		$body = str_replace("{formstart}","<form name='sales' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='입점거래처' onclick=\"javascript:location.replace('seller_shop.php')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{shop}",$button,$body);

		$button ="<input type='button' value='입점판매자' onclick=\"javascript:location.replace('seller_company.php')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{seller}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);

		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","국가별 창고위치") ,$body);

		///////////////////
		// 상품 목록을 검색
		$query = "select * from service.seller ";
		if($searchkey) {
			$query .= " where business like '%".$searchkey."%' ";
		}
		
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		/*
		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='200'>이미지</td>
		<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";				
		$list .= " 
		<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>등록일자</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>국가</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> 업채명</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='200'>웹사이트</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>커미션</td>
					  </tr>
					</table>";
		*/

		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;padding:10px;' width=\"200\">업체로고</td>
							<td style='border-bottom:1px solid #E9E9E9;padding:10px;'>";
				
		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
		$list .= "<td style='font-size:12px;padding:10px;' width='20'>"."<input type='checkbox' name='chk_all' id=\"check_all\">"."</td>";
		$list .= "<td style='font-size:12px;padding:10px;' width='120'>등록일자</td>
							<td style='font-size:12px;padding:10px;' width='50'>국가</td>
						  <td style='font-size:12px;padding:10px;'>업채명</td>
							<td style='font-size:12px;padding:10px;' width='200'>웹사이트</td>
						  <td style='font-size:12px;padding:10px;' width='100'>커미션</td>
							</tr>
						</table>";

		$list .= "</td>
							</tr>
						  </table>";	


		if($rowss = _sales_query_rowss($query)){

			

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				// 거래처: 활성화 체크
				if($rows->enable) {
					// $title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\">".$rows->name."</a>";
					$title_name = $rows->name;

				} else {
					// $title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\"><span style=\"text-decoration:line-through;\">".$rows->name."</span></a>";
					$title_name = "<span style=\"text-decoration:line-through;\">".$rows->name."</span>";
				}

				
				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$query1 = "select * from service.scm_shop where shop_email='".$rows->shop_email."' and shop_business ='".$rows->shop_business."';";
				if($shop_rows = _mysqli_query_rows($query1)){
					$button_addshop = "<input type='button' value='입점신청' onclick=\"javascript:add_shop('add_shop','".$rows->Id."','$limit')\" style=\"".$css_btn_gray."\" >"; 
				} else {
					$button_addshop = "입점완료"; 
				}


				 		


				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;padding:10px;' width=\"200\" valign=\"top\"><img src=\"".$rows->logo."\" border=0 width=200 ></td>
							<td style='border-bottom:1px solid #E9E9E9;padding:10px;' valign=\"top\">";
				
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='font-size:12px;padding:10px;' width='20'>".$tid."</td>";
				$list .= "<td style='font-size:12px;padding:10px;' width='120'>".$rows->regdate."</td>
							<td style='font-size:12px;padding:10px;' width='50'>".$rows->country."</td>
						  <td style='font-size:12px;padding:10px;'>".$title_name."</td>
							<td style='font-size:12px;padding:10px;' width='200'>".$rows->domain."</td>
						  <td style='font-size:12px;padding:10px;' width='100'>".$rows->comission."%</td>
							</tr>
						</table>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='font-size:12px;padding:10px;' valign=\"top\">".$rows->description."</td>";
				$list .= "<td style='font-size:12px;padding:10px;' width='100'  valign=\"top\">".$button_addshop."</td>
							</tr>
						</table>";			

				$list .= "</td>
							</tr>
						  </table>";





			}
			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}",$list,$body);
		
		} else {
			$msg = "사업자 목록이 없습니다.";
			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
					  <td style='font-size:12px;padding:10px;' align='center'>"._string($msg,$site_language)."</td>
					  </tr>
					</table>";
			$body = str_replace("{datalist}",$list,$body);
			
		}

		echo $body;		
	
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>