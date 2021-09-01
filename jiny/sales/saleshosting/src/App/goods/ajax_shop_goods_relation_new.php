<?
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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");


	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		$javascript = "<script>
			function relation_select(uid){
				var goods = $('#relation_goods').val();
				var result = goods + uid + ';';
				$('#relation_goods').val(result);


				$.ajax({
            		url:'ajax_shop_goods_relation.php?relation='+result,
               		type:'post',
	               	data:$('form').serialize(),
	               	success:function(data){
                   		$('#relation_list').html(data);
               		}
            	});

				popup_close();
			}

			$('#goods_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	popup_list(0);
        	}
    		});

			// 팝업바디, 페이지 이동
			function popup_list(limit2){
              	alert(limit2);
              	var goods_search = $('#goods_search').val();
              	goods_search = encodeURI(goods_search,'UTF-8');
              	alert(goods_search);

                $.ajax({
                    url:'ajax_shop_goods_relation_new.php?limit2='+limit2+'&goods_search='+goods_search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#popup_body').html(data);
                    }
                });
            }

            // 팝업창 닫기
    		$('#popup_close').on('click',function(){
        		popup_close();
    		});

    		 

        </script>";

        // 팝업창
         // 팝업창
        function _popup_div($title,$width){
        	$title_width = $width - 42;

        	$popup_header  = _html_div("popup_title","float:left;width:".$title_width."px; height:30px;display:table-cell;vertical-align:middle;padding:5px;",$title);
        	$popup_header .= _html_div("popup_close","width:30px;text-align:center; height:30px;display:table-cell;vertical-align:middle;","X");

        	$width = $width -2;
			return _html_div_clearfix($popup_header,"width:".$width."px;border-bottom:1px solid #E9E9E9;");
        }

        if($site_mobile == "m") $width = "300"; else $width = "800"; 
        
        $title = "관련상품 설정 ";
		$body = $javascript
				._html_div("popup","border:1px solid #5f5f5f;width:".$width."px;height:auto;",
					_popup_div($title,$width).
					_theme_page($site_env->theme,"shop_goods_relation_new",$site_language,$site_mobile));
		

		$goods_search = _formdata("goods_search");

		$body = str_replace("{searchkey}","<input type='text' name='goods_search' value='".$goods_search."' id=\"goods_search\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:popup_list('0')\" style=\"".$css_btn_gray."\" >";
		$body = str_replace("{btn_search}",$button_search,$body);



		$_list_num = 6;
		$_block_num = 10;
		$limit2 = _formdata("limit2");
		//echo "limit2 = ".$limit2."<br>";
		
		
		$query = "select * from `shop_goods` ";
		if($goods_search) $query .= "where goodname like '%$goods_search%'";
		$query .= " order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit2 설정 
		if($limit2) $query .= "LIMIT $limit2 , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;
		if($rowss = _sales_query_rowss($query)){

			if( ($total - $limit2) < $_list_num ) $count = $total - $limit2; else $count = $_list_num;

			//$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			//$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이미지</td>";
			//$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>상품명</td>";
			//$list .= "</tr></table>";
			//echo "count = ".count($rowss);
			for($i=0; $i<$count; $i++){
				$rows = $rowss[$i];	

				$goodname = _goods_name($rows,$site_language);

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;' width='100'>
								<a href='#' onclick=\"javascript:relation_select('".$rows->Id."')\"><img src=\"http://".$sales_db->domain.$rows->images1."\" boarder=0 width=70></a></td>";
				
				
				if($rows->enable){
					$title_name = "<a href='#' onclick=\"javascript:relation_select('".$rows->Id."')\">".$goodname."</a>";
				} else {
					$title_name = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:relation_select('".$rows->Id."')\">".$goodname."</a></span>";
					
				}
				


				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> $title_name  </td>";
				
				$list .= "</tr></table>";

				
			}

			//# 페이지 이동 스크립트 함수를 list() -> popup_list()로 변경 
			$list .= str_replace(":list", ":popup_list", _pagination($_list_num,$_block_num,$limit,$total) );
			$body = str_replace("{list}", $list, $body);
		
		} else {
			$msg = "거래처 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
