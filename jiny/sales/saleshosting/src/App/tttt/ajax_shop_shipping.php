<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	// update : 2016.01.18 = 수정편집 

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


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$script = "
				<script>
				function shipping_mode(mode,uid){
                  	var url = \"/ajax_shop_shipping.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#shipping_edit').html(data);
                        }
                    }); 	
                }

				function shipping_edit(mode,uid){
                  	var url = \"/ajax_shop_shipping_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);
                        }
                    }); 	
                }

				function form_submit(mode,uid){
					var url = \"/ajax_shop_shipping_editup.php?mode=\"+mode+\"&uid=\"+uid;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#mainbody').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});

					
				}
				</script>";

		$body = $script._skin_page($skin_name,"shop_shipping");

		$body=str_replace("{formstart}",$script."<form id='data' name='env' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='추가' onclick=\"javascript:shipping_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

	
		
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `shop_delivery` ";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		if($rowss = _sales_query_rowss($query)){

			$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
						<td width='20' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'></td>
						<td width='100' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>물품 발송국가</td>
						<td width='100' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>수령국가</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>배송방식</td>
						<td width='100' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>업체담당자</td>
						<td width='100' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>업체연락처</td>
						<td width='100' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>배송금액</td>
						</tr>
					  </table>";

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];
			
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";

				if($rows->enable) $enable = "<a href='#' onclick=\"javascript:shipping_mode('disable','".$rows->Id."')\">▣</a>";
				else $enable = "<a href='#' onclick=\"javascript:shipping_mode('enable','".$rows->Id."')\">□</a>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'width='20'> $enable </td>";
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->code."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->target."</td>";	

				//$title_name = "<a href='#' onclick=\"javascript:page_edit('edit','".$rows->Id."')\">".$rows->title."</a>";
				$title_name = "<a href='#' onclick=\"javascript:shipping_edit('edit','".$rows->Id."')\">".$rows->name."</a>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->manager."</td>";	
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>";	
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->charge."</td>";	
				$list .= "</tr>
						</table>";				


			}

			//$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{shipping_list}", $list, $body);
		} else {			
			$msg = "배송방식 목록이 없습니다.";
			$body = str_replace("{shipping_list}", $msg, $body);			
		
		}

		/*
		
			// $total = count($rowss);
			
			
			
		*/

	

		echo $body;
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>