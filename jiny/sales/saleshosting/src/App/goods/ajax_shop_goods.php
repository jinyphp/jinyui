<?
	//*  OpenShopping V2.1
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

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	
	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	

	$javascript = "<script>

		function goods_mode(mode,uid){
			var url = \"ajax_shop_goods_editup.php\";
			var form = document.goods;
  			form.mode.value = mode;
  			form.uid.value = uid;
            ajax_none(url);
        	ajax_html('#mainbody',\"ajax_shop_goods.php\");

        }

        function check_action(mode){
			var url = \"ajax_shop_goods_editup.php\";
			var form = document.goods;
  			form.mode.value = mode;
            ajax_none(url);
        	ajax_html('#mainbody',\"ajax_shop_goods.php\");
        }

        $('#search_keyword').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	list(0);
        	}
    	});

		function goodedit(mode,uid,limit){
			var url = \"shop_goods_edit.php\";
			
			var form = document.goods;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }
                
        function list(limit){
        	var url = \"ajax_shop_goods.php\";
        	var form = document.goods;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);
        }

        // 카테고리 변경
        $('#category').on('change',function(){
      		var url = \"ajax_shop_goods.php\";
      		var form = document.goods;

      		form.limit.value = 0;
            ajax_html('#mainbody',url); 	
   		});


		// Quick 카테고리 설정 팝업
        function cate_set(){
        	var url = \"ajax_shop_goods_cate_set.php\";

        	var maskHeight = $(document).height();  
			var maskWidth = $(window).width();

			//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
			$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
    		//마스크의 투명도 처리
    		$('#popup_mask').fadeTo(\"slow\",0.8); 
			$('#popup_body').show();

			// 팝업 내용을 Ajax로 읽어옴
			$.ajax({
            	url:url,
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
                	$('#popup_body').html(data);

                	// 팡법창 크기 계산
					var width = $('#popup').width();
					var height = $('#popup').height();
					var left = ($(window).width() - width )/2;
					var top = ( $(window).height() - height )/2;			
					$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 

            	}
        	});

        }

        // Quick 가격 설정 팝업
        function prices_set(){
        	var url = \"ajax_shop_goods_prices_set.php\";

        	var maskHeight = $(document).height();  
			var maskWidth = $(window).width();

			//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
			$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
    		//마스크의 투명도 처리
    		$('#popup_mask').fadeTo(\"slow\",0.8); 
			$('#popup_body').show();

			// 팝업 내용을 Ajax로 읽어옴
			$.ajax({
            	url:url,
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
                	$('#popup_body').html(data);

                	// 팡법창 크기 계산
					var width = $('#popup').width();
					var height = $('#popup').height();
					var left = ($(window).width() - width )/2;
					var top = ( $(window).height() - height )/2;			
					$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 

            	}
        	});

        }

        // 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.goods.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		}

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

		// 활성화 목록 변경
		$('#form_enable').on('change',function(){
        	list(0);
    	});

		// 품절 목록 변경
		$('#form_soldout').on('change',function(){
        	list(0);
    	});



    </script>";




	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"shop_goods",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,170),$body);

		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
	
		$mode = _formmode();
		$limit = _formdata("limit"); 			// echo "limit = $limit <br>";
		$category = _formdata("category");
		$country = _formdata("country");
		$searchkey = _formdata("searchkey");	// echo "search = $searchkey <br>";

		$body = str_replace("{formstart}","<form name='goods' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
	
		$button ="<input type='button' value='상품추가' onclick=\"javascript:goodedit('new','0','$limit')\" id=\"css_btn_gray\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='선택삭제' onclick=\"javascript:check_action('check_delete')\" id=\"css_btn_gray\" >";          
		$body = str_replace("{delete}",$button,$body);
		
		$button ="<input type='button' value='카테고리' onclick=\"javascript:cate_set()\" id=\"css_btn_gray\" >";          
		$body = str_replace("{cate_remove}",$button,$body);

		$button ="<input type='button' value='가격설정' onclick=\"javascript:prices_set()\" id=\"css_btn_gray\" >";          
		$body = str_replace("{cate_add}",$button,$body);

		// Quick 버튼
		$button ="<input type='button' value='판매중단' onclick=\"javascript:check_action('check_disable')\" id=\"css_btn_gray\" >";          
		$body = str_replace("{check_disable}",$button,$body);

		// Quick 버튼
		$button ="<input type='button' value='판매시작' onclick=\"javascript:check_action('check_enable')\" id=\"css_btn_gray\" >";          
		$body = str_replace("{check_enable}",$button,$body);



		
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_keyword\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" id=\"css_btn_gray\" >";
		$body = str_replace("{search}",$button_search,$body);


			//====================================
			// 판매자, 상품등록자 
			function _shop_seller_select($seller){
				global $css_textbox;

				$seller_select = "<select name='seller' style=\"$css_textbox\">";
				$seller_select .= "<option value='".$cookie_email."'>직접등록</option>";
				
				$query = "select * from `resales_seller` ";
				if($rowss = _sales_query_rowss($query)){	
					
					for($i=0;$i<count($rowss);$i++){
						$rows1 = $rowss[$i];
						if($seller == $rows1->email){
							$seller_select .= "<option value='".$rows1->email."' selected>".$rows1->name."</option>";
						} else $seller_select .= "<option value='".$rows1->email."'>".$rows1->name."</option>";
					}					
				
				}

				$seller_select .= "</select>";
				return $seller_select;
			}
			$seller = _formdata("seller");
			$body = str_replace("{seller}",_shop_seller_select($seller),$body);


			

		$query = "select * from `shop_cate` order by pos desc";	
		if($rowss = _sales_query_rowss($query)){
			$body = str_replace("{category}", _html_form_select_json("category",$css_textbox,"category",$rowss,$category,"Id","title","카테고리 분류") ,$body);
		}


		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","판매자국가") ,$body);
		
		$_enable = _formdata("_enable");
		$form_enable = "<select name='_enable' id=\"form_enable\" style=\"$css_textbox\">";
		if($_enable == "all") $form_enable .= "<option value='all' selected>활성/비활성</option>"; else $form_enable .= "<option value='all'>활성/비활성</option>";
		if($_enable == "enable") $form_enable .= "<option value='enable' selected>활성화</option>"; else $form_enable .= "<option value='enable'>활성화</option>";
		if($_enable == "disable") $form_enable .= "<option value='disable' selected>비활성</option>"; else $form_enable .= "<option value='disable'>비활성</option>";
		$form_enable .= "</select>";
		$body = str_replace("{enable}", $form_enable,$body);


		$_soldout = _formdata("_soldout");
		$form_soldout = "<select name='_soldout' id=\"form_soldout\" style=\"$css_textbox\">";
		if($_soldout == "") $form_soldout .= "<option value='' selected>재고상태</option>"; else $form_soldout .= "<option value=''>재고상태</option>";
		if($_soldout == "soldout") $form_soldout .= "<option value='soldout' selected>품절상품</option>"; else $form_soldout .= "<option value='soldout'>품절상품</option>";
		$form_soldout .= "</select>";
		$body = str_replace("{soldout}", $form_soldout,$body);

		
		$body = str_replace("{stock}","<table><tr><td>재고</td><td width=\"80\">"._form_number("stock",$value,$css_textbox)."</td><td>이하</td></tr></table>",$body);


		$body = str_replace("{checkall}","<input type='checkbox' name='chk_all' id=\"check_all\">",$body);



		///////////////////
		// 상품 목록을 검색
		$query = "select * from `shop_goods` ";
		$query_where = NULL;

		if($category) {
			if($category == "NULL") $query_where .= "and (cate is NULL or cate = '') ";
			else $query_where .= "and cate like '%*".$category.";%' ";
		}

		if($searchkey) {
			$query_where .= "and goodname like '%".$searchkey."%' ";
		}

		if($_enable){
			if($_enable == "all"){
			} else if($_enable == "enable"){
				$query_where .= "and enable = 'on' ";
			} else if($_enable == "disable"){
				$query_where .= "and enable = '' ";
			}
		}

		if($_soldout) $query_where .= "and soldout = 'on' ";
		
		if($query_where) $query = str_replace("where and","where ",$query."where ".$query_where);
		$query .= "order by Id desc ";
		
	
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		//echo $query;

		if($rowss = _sales_query_rowss($query)){
		
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0,$list ="";$i<$count;$i++){
				$rows = $rowss[$i];
				if($site_mobile == "m") {
					$list .= _shop_goods_list_m($rows); 
				} else {					
					$list .= _shop_goods_list($rows);
				}
			}
			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);

			$body = str_replace("{goods_list}",$list,$body);
			
		} else {
			$msg = "상품 내역이 없습니다.";
			$body = str_replace("{goods_list}",$msg,$body);			
		}

		echo $body;
		
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}


	// ==============================
	// PC용 리스트 화면
	function _shop_goods_list($rows){
		global $site_language;
		global $limit,$searchkey;
		global $sales_db; // 회원 가입 정보

		$goodname = _goods_name($rows,$site_language);
		if(!$goodname || $goodname =="") $goodname = "상품영이 없습니다.($site_language)";
		
		
		$categories = explode(";", $rows->cate);
		$cate_string = "Category : ";
		for($i=0;$i<count($categories);$i++){
			$catekey = str_replace("*","",$categories[$i]);
			$query = "select * from `shop_cate` where Id='".$catekey."'";
			if($rows1 = _sales_query_rows($query)){
				$title = $rows1->title;
				$cate_string .= json_decode($title)->$site_language."/ ";
			

			}
				
		}


		$goods_subtitle = _goods_subtitle($rows,$site_language);
		// $img_url = "http://".$sales_db->domain."/".$rows->images1;
		$img_url = "http://".$sales_db->domain."/".$rows->images1;
		$_images = "<img src='$img_url' border=0 width='100'>";

		if($rows->enable) {
			$enable = "<a href='#' onclick=\"javascript:goods_mode('disable','".$rows->Id."')\">▣</a>";
			$goodname_url = "<a href='#' onclick=\"javascript:goodedit('edit','".$rows->Id."','$limit')\">".$goodname."</a>";
		} else {
			$enable = "<a href='#' onclick=\"javascript:goods_mode('enable','".$rows->Id."')\">□</a>";
			$goodname_url = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:goodedit('edit','".$rows->Id."','$limit')\">".$goodname."</a></span>";
			
		}

		$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'> <br>".$rows->Id;
		

		

		$_goodname  = "<div style=\"color:#333333\">".$rows->regdate."/ 판매자: ".$rows->seller."</div>";
		$_goodname .= "<div> $cate_string </div>";
		$_goodname .= $enable.$goodname_url."<br>";
		// $_goodname .= $goods_subtitle;

		
		$_report  = "조회건수 :".$rows->click."<br>";
		$_report .= "판매건수 :"."<br>";
		$_report .= "연계상품 :"."<br>";

		$_prices  = "판매가격 ".$rows->sell_currency." : ".$rows->prices_sell."<br>";
		$_prices .= "B2B(도매)가격 ".$rows->b2b_currency." : ".$rows->prices_b2b."<br>";
		$_prices .= "매입가격 ".$rows->buy_currency." : ".$rows->prices_buy."<br>";
		$_prices .= "재고수량 : ".$rows->stock." / ".$rows->safe_stock." <br>";
	

		$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"10\" valign=\"top\"> $tid </td>";
		$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"100\" valign=\"top\"> $_images </td>"; 
		$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' valign=\"top\"> $_goodname </td>"; 
		$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"200\" valign=\"top\"> $_prices </td>"; 
		$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"150\" valign=\"top\"> $_report </td>"; 
		$list .= "</tr></table>";

		return $list;							

	}

	// ================================

	function _shop_goods_list_m($rows){
		global $site_language;
		global $limit,$searchkey;
		global $sales_db; // 회원 가입 정보

	
		$goodname = _goods_name($rows,$site_language);
		if(!$goodname || $goodname =="") $goodname = "상품영이 없습니다.($site_language)";
		

		$goods_subtitle = _goods_subtitle($rows,$site_language);
		$img_url = "http://".$sales_db->domain."/".$rows->images1;

		if($rows->enable) {
			$enable = "<a href='#' onclick=\"javascript:goods_mode('disable','".$rows->Id."')\">▣</a>";
			$goodname_url = "<a href='#' onclick=\"javascript:goodedit('edit','".$rows->Id."','$limit')\"> ".$goodname."</a>";
		} else {
			$enable = "<a href='#' onclick=\"javascript:goods_mode('enable','".$rows->Id."')\">□</a>";
			$goodname_url = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:goodedit('edit','".$rows->Id."','$limit')\"> ".$goodname."</a></span>";
			
		}

		$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'> (".$rows->Id .")/".$rows->regdate;

		$_images = "<img src='$img_url' border=0 width='100'>";

		$_prices  = "판매가격 ".$rows->sell_currency." : ".$rows->prices_sell." / ";
		$_prices .= "B2B(도매)가격 ".$rows->b2b_currency." : ".$rows->prices_b2b."<br>";
		$_prices .= "매입가격 ".$rows->buy_currency." : ".$rows->prices_buy." / ";
		$_prices .= "재고수량 : ".$rows->stock." / ".$rows->safe_stock." <br>";

		$_goodname  = "<div style=\"color:#333333\">"."판매자: ".$rows->seller."</div>";
		$_goodname .= $enable.$goodname_url."<br>";
		$_goodname .= $goods_subtitle;

		$_report  = "조회건수 :".$rows->click." / ";
		$_report .= "판매건수 :"." / ";
		$_report .= "연계상품 :"."<br>";


		$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"100\" valign=\"top\"> $_images </td>"; 
		$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;' valign=\"top\"> $tid <br> $_goodname </td>"; 
		$list .= "</tr></table>";
		$list .= $_prices.$_report;

		return $list;	

		

	}


?>