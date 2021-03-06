<?php

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
	
	include "./func/members.php";
	include "./func/orders.php";
	
	include "./func/css.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");
	

	//********** Ajax Process **********
	//echo "Session :".$_SESSION['ajaxkey']."<br>";
	//echo "=== ".$_POST['ajaxkey'];
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		/////////////
		// $skin_name = "default";
		$body = _skin_page($skin_name,"orders_detail");

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$cate = _formdata("cate");		
	
			
		$body=str_replace("{formstart}","<form id='data' name='orders' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$script = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_orders_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					alert(url);
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
					var url = \"/ajax_orders_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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

		// ???????????? ??????
		$submit_button = $script;
		$query = "select * from `shop_orders` where Id='$uid'";
		if($rows = _mysqli_query_rows($query)){

			$order_status = "<select name='status' style=\"$css_textbox\">";
			$order_status .= "<option value='new'>????????????</option>";
			$order_status .= "<option value='banking'>?????????</option>";
			$order_status .= "<option value='bank'>????????????</option>";
			$order_status .= "<option value='banked'>????????????</option>";
			$order_status .= "<option value='paid'>????????????</option>";
			$order_status .= "<option value='fail'>????????????</option>";
			$order_status .= "<option value='prepare'>????????????</option>";
			$order_status .= "<option value='shipping'>?????????</option>";
			$order_status .= "<option value='shipped'>????????????</option>";
			$order_status .= "<option value='finish'>????????????</option>";
			$order_status .= "<option value='canceling'>????????????</option>";
			$order_status .= "<option value='canceled'>????????????</option>";
			$order_status .= "<option value='refunding'>????????????</option>";
			$order_status .= "<option value='refunded'>????????????</option>";
			$order_status .= "<option value='disputing'>?????????</option>";
			$order_status .= "<option value='disputed'>????????????</option>";			
			$order_status .= "</select>";

			$order_status = str_replace($rows->status."'",$rows->status."' checked",$order_status);
			$body = str_replace("{status}",$order_status,$body);

			$submit_button .= "<input type='button' value='????????????' onclick=\"javascript:form_submit('editup','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$submit_button,$body);



			$body = str_replace("{order_name}",$rows->username,$body);
			$body = str_replace("{email}",$rows->email,$body);
			$body = str_replace("{domain}",$rows->domain,$body);
			$body = str_replace("{ordercode}",$rows->ordercode,$body);
			

			
			// ????????? , ???????????? ??????
			$query = "select * from `shop_orders_address` WHERE Id = '".$rows->orders_address."' order by regdate desc";
			$address_rows = _mysqli_query_rows($query);

			$body = str_replace("{receive_country}",$address_rows->country,$body);
			$body = str_replace("{receive_city}",$address_rows->city,$body);
			$body = str_replace("{receive_state}",$address_rows->state,$body);
			$body = str_replace("{receive_firstname}",$address_rows->firstname,$body);
			$body = str_replace("{receive_lastname}",$address_rows->lastname,$body);
			$body = str_replace("{receive_phone}",$address_rows->phone,$body);
			$body = str_replace("{receive_post}",$address_rows->post,$body);
			$body = str_replace("{receive_address}",$address_rows->address,$body);
			
			

			$body = str_replace("{payment}",$rows->payment,$body);
			if($rows->payment == "bank"){
				$bank = explode(":", $rows->bankid);
				$body = str_replace("{payment_info}",$bank[1],$body);

			} else $body = str_replace("{payment_info}","",$body);



			// ?????? ?????? ????????? 
			$query = "select * from `shop_orders_detail` WHERE ordercode = '".$rows->ordercode."' order by regdate desc";
			if($rowss_orders_detail = _mysqli_query_rowss($query)){	
					for($j=0;$j<count($rowss_orders_detail);$j++){
						$rows2 = $rowss_orders_detail[$j];

						$goods = _goods_rows($rows2->GID);

						$numsum = $rows2->prices * $rows2->num;		// ????????? ?????? 
						$numsum += $numsum / 1000 * $rows2->vat;	// ????????? ?????? ?????? 

						$list .="<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>";
						$list .="<tr>
					
						<td style='font-size:12px;padding:10px;' width='20' valign='top'><input type='checkbox' name='TID[]' value='".$rows2->Id."' checked></td>
						<td style='font-size:12px;padding:10px;' valign='top'>".$rows2->goodname."</td>
						<td style='font-size:12px;padding:10px;' width='100' valign='top'>".$rows2->num."</td>
						<td style='font-size:12px;padding:10px;' width='130' valign='top'>".$rows2->currency." : $numsum</td>
						<td style='font-size:12px;padding:10px;' width='70' valign='top'>"._order_status_string($rows2->status,$site_language)."</td>
						</tr>
						<tr>
						<td style='font-size:12px;padding:10px;' width='20' valign='top'>???</td>
						<td style='font-size:12px;padding:10px;' valign='top'>Option: ".$rows2->option."</td>
						<td style='font-size:12px;padding:10px;' width='300' valign='top' colspan='3'>Delivery Shipping: ". $rows2->shipping ."</td>
						</tr>
						<tr>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='20' valign='top'>???</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' valign='top' colspan='4'>".$rows2->ordertext."</td>
						</tr>";
						$list .="</table>";
					}
			
				$body = str_replace("{order_detail_list}",$list,$body);
			} else {
				$body = str_replace("{order_detail_list}","?????? ??????????????? ????????????.",$body);
			}
		}		

		/////
		// ???????????? ??????
	
		$query = "select * from `shop_orders_shipping` WHERE ordercode = '".$rows->ordercode."'";
		$shipping_rows = _mysqli_query_rows($query);
		
		$body = str_replace("{shipping_company}",_form_text("shipping_company",$shipping_rows->company,$css_textbox),$body);
		
		$body = str_replace("{shipping_datetime}",_form_text("shipping_datetime",$shipping_rows->regdate,$css_textbox),$body);
		
		$body = str_replace("{shipping_invoice}",_form_text("shipping_invoice",$shipping_rows->invoice,$css_textbox),$body);
	
		$body = str_replace("{shipping_firstname}",_form_text("shipping_firstname",$shipping_rows->firstname,$css_textbox),$body);
		$body = str_replace("{shipping_lastname}",_form_text("shipping_lastname",$shipping_rows->lastname,$css_textbox),$body);
		$body = str_replace("{shipping_phone}",_form_text("shipping_phone",$shipping_rows->phone,$css_textbox),$body);
		

		echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "??????. ????????? ?????? ??????????????? ???????????? ????????????.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>