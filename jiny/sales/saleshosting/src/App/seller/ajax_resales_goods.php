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
	include "./func/curl.php";
		

	function _listbar($_list_num,$_block_num,$limit,$total){
			$total_list = intval( $total / $_list_num ); // 전페 리스트 수
		$total_block = intval( $total_list / $_block_num ); // 전체 블럭 수
		$pageMenu = "";
		$pre = ""; $next = "";

		$pageMenu = "";
	   
		// 처음 데이터가 아닌경우, 처음으로 이동 버튼 생성.
		if($limit != 0) $pageMenu .= "[<a href='#' onclick=\"javascript:goodlist('0')\">First</a>] "; // 처음 테이터

		// 현재 위치의 list 값 체크
		$current_list = intval( $limit / $_list_num );
		// 현제 위치의 block값 체크
		$current_block = intval( $current_list / $_block_num );

		if( $current_block >0) {
			// $pre = ($current_block - 1) * $_block_num * $_list_num; 
			$pre = $current_block * $_block_num * $_list_num - $_list_num; 
			$pageMenu .= "[<a href='#' onclick=\"javascript:goodlist('".$pre."')\">Pre($pre)</a>] "; // 이전 블럭 
		}

		
		$i = $current_block * $_block_num; //현재 블럭의 시작
		$count = $i + $_block_num; // 블럭 크기많큼 표기 loop
		if($count>$total_list) $count = $total_list; // 만일 제일 마지막 loop가, total보다 적을때, 마지막을 total로 지정 
		for(;$i<$count; $i++){
			$j = $i * $_list_num;
				// if($limit == $j) $pageMenu .= "[<b>$i</b>] "; else $pageMenu .= "[<a href='".$_SERVER['PHP_SELF']."?limit=$j'>$i</a>] ";
				//  
			if($limit == $j){
				$pageMenu .= "[<b>$j</b>] "; 
			} else {
				$pageMenu .= "[<a href='#' onclick=\"javascript:goodlist('".$j."')\">$j</a>] ";
			}
		}


		if( ($j + $_list_num) < $total) {
			$next = $j + $_list_num;
			//$next = $pre + $_block_num * $_list_num * 2; 
			//$next = $current_block + $_list_num*$_block_num;
			$pageMenu .= "[<a href='#' onclick=\"javascript:goodlist('".$next."')\">Next($next)</a>] "; // 다음 블럭 
		}

		$last = $total_list * $_list_num;
		if($limit != $last) $pageMenu .= "[<a href='#' onclick=\"javascript:goodlist('".$last."')\">Last</a>]"; // 마지막 데이터

		return "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				<tr><td style='font-size:12px;padding:10px;' align=center>".$pageMenu."</td></tr></table>";

		

	}

	$javascript = "<script>
			function resales_mode(mode,uid){
                $.ajax({
                	url:'/ajax_resales_goods_editup.php?uid='+uid+'&mode='+mode,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#mainbody').html(data);
                    }
                }); 	
            }

        	$('#search_keyword').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	goodlist(0);
        	}
    		});

			function resales_edit(mode,uid,limit){
				var search = document.goods.searchkey.value;
                $.ajax({
                    url:'/ajax_resales_goods_edit.php?uid='+uid+'&mode='+mode+'&limit='+limit,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#mainbody').html(data);
                    }
                }); 	
            }
                
            function resales_list(limit){
                var search = document.goods.searchkey.value;
                $.ajax({
                    url:'/ajax_resales_goods.php?limit='+limit+'&search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#mainbody').html(data);
                    }
                }); 	
            }
    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		$body = $javascript._skin_page("default","resales_goods");
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);
		
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 


		
		if($mode == "add_goods"){
			echo "add goods <br>";
			// 상품 추가 


			$gid = _formdata("gid");
			$shop = _formdata("shop");
			$email = $_COOKIE['cookie_email'];

			$query = "select * from `site_env`";
			if($site_env_rows = _sales_query_rows($query)){
				$body = str_replace("{domain}",$site_env_rows->domain,$body);
			} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);




			// curl : 상대방에 판매자 등록 신청 
			$curl_domain = "http://www.saleshosting.co.kr";
			$query = "select * from `shop_goods` WHERE Id =$gid";
			echo $query."<br>";
			if($rows = _sales_query_rows($query)){
				
				// 판매자 정보를 바꿈 : 로그인 아이디
				$rows->seller = $email;

				// 상품 이미지 경로 : 판매자 이미지 url
				$rows->images1 = "http://".$site_env_rows->domain.str_replace("./","/",$rows->images1);
				$postfild = $rows;
				
				$curl_response = _curl_post($curl_domain."/resales/curl_resales_goods.php",$postfild);
				echo $curl_response;
				
				/*
				// Curl 방식으로, 로고파일 업로드
				if($site_env->domain){
					echo _curl_filecopy($curl_domain."/curl_filecopy.php","./goods","http://www.saleshosting.co.kr".$rows->images1);
				}
				*/
			}

			$query = "select * from `resales_shop` where Id='$shop'";
			if($resales_shop = _sales_query_rows($query)){
			}
				
			$goodname = addslashes($rows->goodname);
			// 입점상품 : 기록 저장
			$query1 = "select * from `resales_goods` WHERE gid ='$gid' and shop = '$shop'";
			if($rows1 = _sales_query_rows($query1)){

			} else {
				$insert_filed = "";	$insert_value = "";				
				$insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAY."',";
				$insert_filed .= "`shop`,";	$insert_value .= "'".$shop."',";
				$insert_filed .= "`shop_name`,";	$insert_value .= "'".$resales_shop->name."',";
				
				$insert_filed .= "`seller`,";	$insert_value .= "'".$email."',";
				$insert_filed .= "`gid`,";	$insert_value .= "'".$gid."',";
				$insert_filed .= "`goodname`,";	$insert_value .= "'".$goodname."',";

				$query = "INSERT INTO `resales_goods` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);
				echo $query."<br>";
			}




		}




		$body = str_replace("{formstart}","<form name='goods' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='상품입점' onclick=\"javascript:resales_edit('new','0','$limit')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);




		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_keyword\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:goodlist('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);


		//====================================
			// 판매자, 상품등록자 
			function _shop_seller_select($seller){
				global $css_textbox;
				$query = "select * from `resales_seller` ";
				//echo $query;
				if($rowss = _sales_query_rowss($query)){	
					$seller_select = "<select name='seller' style=\"$css_textbox\">";
					$seller_select .= "<option value=''>전체</option>";
					for($i=0;$i<count($rowss);$i++){
						$rows1 = $rowss[$i];
						if($seller == $rows1->email){
							$seller_select .= "<option value='".$rows1->email."' selected>".$rows1->name."</option>";
						} else $seller_select .= "<option value='".$rows1->email."'>".$rows1->name."</option>";
					}
					
					$seller_select .= "</select>";
				
				}
				return $seller_select;
			}
			$seller = _formdata("seller");
			$body = str_replace("{seller}",_shop_seller_select($seller),$body);





		///////////////////
		// 상품 목록을 검색
		$query = "select * from `resales_goods` ";
		
		if($searchkey && $cate){
			$query .= " where cate = '".$cate."' and goodname like '%".$searchkey."%' ";
		} else if($cate) {
			$query .= " where cate = '".$cate."' ";
		} else if($searchkey) {
			$query .= " where goodname like '%".$searchkey."%' ";
		}
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0,$list ="";$i<$count;$i++){
				$rows = $rowss[$i];

				if($site_mobile == "m") $list .= _shop_goods_list_m($rows); else $list .= _shop_goods_list($rows);
				
			}
			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{goods_list}",$list,$body);
			echo $body;
			
		} else {
			$msg = "상품 내역이 없습니다.";
			$body = str_replace("{goods_list}",$msg,$body);
			echo $body;
		}	
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}






	function _shop_goods_list($rows){
		global $site_language;
		global $limit,$searchkey;

		$goodname = _goods_name($rows,$site_language);
		if(!$goodname || $goodname =="") $goodname = "상품영이 없습니다.($site_language)";
		

		$goods_subtitle = _goods_subtitle($rows,$site_language);
		$img_url = $rows->images1;

		if($rows->enable) {
			$enable = "<a href='#' onclick=\"javascript:goods_mode('disable','".$rows->Id."')\">▣</a>";
			$goodname_url = "<a href='#' onclick=\"javascript:goodedit('edit','".$rows->Id."','$limit')\">".$goodname."</a>";
		} else {
			$enable = "<a href='#' onclick=\"javascript:goods_mode('enable','".$rows->Id."')\">□</a>";
			$goodname_url = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:goodedit('edit','".$rows->Id."','$limit')\">".$goodname."</a></span>";
			
		}

		$goodname = json_decode($rows->goodname)->$site_language;

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"200\">".$rows->shop_name."</td>
					<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' >".$goodname."</td>
					</tr>
				</table>";
		return $list;							

	}

	function _shop_goods_list_m($rows){
		global $site_language;

		$goodname = _goods_name($rows,$site_language);
		if(!$goodname || $goodname =="") $goodname = "상품영이 없습니다.";
		$goodname_url = "<a href='#' onclick=\"javascript:gooddetail('edit','".$rows->Id."')\">".$goodname."</a>";

		$goods_subtitle = _goods_subtitle($rows,$site_language);
		$img_url = $rows->images1;

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\" rowspan=\"3\"><img src='$img_url' border=0 width='100'></td>
					<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$goodname_url."</td>
					</tr>
					<tr>
					<td style='font-size:12px;padding:10px;'>".$goods_subtitle."</td>
					</tr>
					<tr>
					<td style='font-size:12px;padding:10px;'>판매가격 ".$rows->sell_currency." : ".$rows->prices_sell." / B2B가격 ".$rows->b2b_currency." : ".$rows->prices_b2b." / 매입가격 ".$rows->buy_currency." : ".$rows->prices_buy."</td>
					</tr>
				</table>";
		return $list;							

	}
?>