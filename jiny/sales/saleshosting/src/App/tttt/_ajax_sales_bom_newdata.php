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
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$javascript = "<script>
			// 거래처 검색 , 키 엔터 
			$('#goodname').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	var bom_uid = $('#bom_uid').val();
            	if(bom_uid){
            		goods_search();
            	} else alert(\"생산 상품을 선택해 주세요\");
        	}
    		});

			function goods_search(){
				var maskHeight = $(document).height();  
				var maskWidth = $(window).width();

				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
				// 팡법창 크기 계산
				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				// popup_size(1000,500);
				var width = 800;
				var height = 500;
				var left = ($(window).width() - width )/2;
				var top = ( $(window).height() - height )/2;			
				$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 			  
    
    			//마스크의 투명도 처리
    			$('#popup_mask').fadeTo(\"slow\",0.8); 
				$('#popup_body').show();

				// 팝업 내용을 Ajax로 읽어옴
				//var goodname = document.trans.goodname.value;
				//alert(goodname);
				$.ajax({
            		url:'/ajax_sales_goods_bomlist.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
                		$('#popup_body').html(data);

                		var maskHeight1 = $(document).height();  
						var maskWidth1 = $(window).width();

						//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
						$('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
            		}
        		}); 
			}

       		$('#save_newdata').on('click',function(){

       			var bom_uid = $('#bom_uid').val();
       			var goodname = $('input:text[name=goodname]').val();
       			var part_num = $('input:text[name=part_num]').val();

       			if(!goodname){
       				alert(\"생산 부품을 선택해 주세요\");
       			} else if(!part_num){
       				alert(\"부품수량 선택해 주세요\");
       			} else if(bom_uid){
            		$.ajax({
            			url:'/ajax_sales_bom_newdata.php?mode=newdata',
            			type:'post',
            			data:$('form').serialize(),
            			success:function(data){
            				$('#newdata').html(data);
            			}
        			});
            	} else alert(\"생산 상품을 선택해 주세요\");
       		});

			$('#delete_parts').on('click',function(){

       			var bom_uid = $('#bom_uid').val();
            	if(bom_uid){
            		$.ajax({
            			url:'/ajax_sales_bom_list.php?mode=delete',
            			type:'post',
            			data:$('form').serialize(),
            			success:function(data){
            				$('#list').html(data);
            			}
        			});
            	} else alert(\"생산 상품을 선택해 주세요\");
       		});

    			


    	</script>"; 

    	$mode = _formdata("mode");
    	// echo "mode = $mode <br>";
    	if($mode == "newdata"){


    		$insert_filed .= "`regdate`,"; $insert_value .= "'$TODAYTIME',";

    		if($bom = _formdata("bom")) { $insert_filed .= "`bom`,"; $insert_value .= "'$bom',"; }

    		if($gid = _formdata("gid")) { $insert_filed .= "`gid`,"; $insert_value .= "'$gid',"; }
    		if($goodname = _formdata("goodname")) { $insert_filed .= "`goodname`,"; $insert_value .= "'$goodname',"; }
    		if($part_num = _formdata("part_num")) { $insert_filed .= "`num`,"; $insert_value .= "'$part_num',"; }

    		$query = "INSERT INTO `sales_goods_bom` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			// echo $query;
			_sales_query($query);

			echo "<script>
				$.ajax({
            		url:'/ajax_sales_bom_list.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#list').html(data);
            		}
        		});
    		</script>";
			

       	}

       
		


    	$css_btn_save ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";

		$form_goodname = "<input type='hidden' name='gid' id=\"gid\"><input type='text' name='goodname' placeholder='부품명' autofocus style=\"$css_textbox\" id=\"goodname\">";
		$form_num = "<input type='text' name='part_num' placeholder='필요수량' style=\"$css_textbox\" id=\"part_num\">";
		
		$list = "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
				<tr>
					<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' align=\"center\" width=\"100\"></td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\"> 부품명  </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"50\"> 필요수량 </td>
					<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' align=\"center\" width=\"100\">상태</td>
				</tr>
				<tr>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"100\">
						<input type=\"button\" value=\"부품삭제\" style=\"".$css_btn_gray."\" id=\"delete_parts\"/>
					</td>
					<td style='font-size:12px;padding:5px;' align=\"center\"> $form_goodname </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"100\"> $form_num </td>
					<td style='font-size:12px;padding:10px;' width='100'>
						<input type=\"button\" value=\"저장\" style=\"".$css_btn_gray."\" id=\"save_newdata\"/>
					</td>
				</tr>
			</table>";

		echo $javascript.$list;		

	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>