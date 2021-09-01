<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*

	// update : 2016.01.11 = 코드정리 

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/css.php";

	function _listbar($_list_num,$_block_num,$limit,$total){


	}

	$javascript = "<script>

			$('#btn_search').on('click',function(){
        		block_list(0);
    		});

			$('#goods_search').on('keydown',function(e){         
        		if(e.keyCode == 13){
            		e.preventDefault();
            		blocklist(0);
        		}
    		});

        	function blocklist(limit){
           		var url = \"/ajax_site_block.php?limit=\"+limit;	
            	$.ajax({
                	url:url,
                	type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('.mainbody').html(data);
                	}
           		}); 	
        	}


        	function block_edit(mode,uid){
            	var url = \"/ajax_site_block_edit.php?mode=\"+mode+\"&uid=\"+uid;	
            	// alert(url);
            	$.ajax({
                	url:url,
               		type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('.mainbody').html(data);
                	}
            	}); 	
        	}

  			function form_submit(mode,uid){
				var url = \"/ajax_block_editup.php?uid=\"+uid+\"&board=\"+board;
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
	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////

		$body = $javascript._skin_page($skin_name,"site_block");
		
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 

		//echo "limit : ".$limit;

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='block' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:block_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		/*
		
		*/
		if($site_mobile == "m"){
			$searchkey = _formdata("searchkey");
			// echo "searchkey = $searchkey";
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"block_search\" style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:blocklist('0')\" id=\"btn_search\" style=\"".$css_btn_gray."\" >";           
			// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
			$body = str_replace("{search}",$button_search,$body);

		} else {
			$searchkey = _formdata("searchkey");
			// echo "searchkey = $searchkey";
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"block_search\" style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:blocklist('0')\" id=\"btn_search\" style=\"".$css_btn_gray."\" >";           
			// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
			$body = str_replace("{search}",$button_search,$body);
		}	


		///////////////////
		// 상품 목록을 검색
		$query = "select * from `site_block` ";

		if($searchkey) {
			$query .= " where title like '%".$searchkey."%' ";
		}
		
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){

			$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'></td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>블럭코드</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>설명</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>일자</td>
					</tr>
					</table>";	

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];
	
				if($rows->enable) $enable = "<a href='#' onclick=\"javascript:block_mode('disable','".$rows->Id."')\">▣</a>";
				else $enable = "<a href='#' onclick=\"javascript:block_mode('enable','".$rows->Id."')\">□</a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'>$enable</td>
							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'><a href='#' onclick=\"javascript:block_edit('edit','".$rows->Id."')\">{block_".$rows->code."}</a></td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->title."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							</tr>
						</table>";				


			}


			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{block_list}",$list,$body);
			echo $body;
			//echo $list;
		} else {
			$msg = "디자인 html 블럭 없습니다.";
			$body = str_replace("{block_list}",$msg,$body);
			echo $body;
			// echo $msg;
		}	
		
	} else {
		$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php")."</script>";	
		$body =  _skin_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

	
?>