<?php

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	// Sales 사용자 DB 접근.
	include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


	$javascript = "<script>
		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});
    </script>";

	if($site_mobile == "m") $width = "300px"; else $width = "500px"; 		

	$title = "쇼핑몰 DB 업그레이드 V1.0";
	$body = $javascript._popup_body( $title, $width, $msg );
	echo $body;

	// echo "판매재고 DB 업그레이드 V1.0"."<br>";
	// 판매재고 관련 데이터베이스

	$update_tables = array(
		'shop_bank' ,
		'shop_cate' ,
		'shop_country' ,
		'shop_currency' ,
		'shop_delivery' ,
		'shop_download' ,		
		'shop_goods' ,
		'shop_goods_comment' ,
		'shop_goods_files' ,
		'shop_goods_relation' ,
		'shop_orders' ,
		'shop_orders_address' ,
		'shop_orders_detail' ,
		'shop_orders_shipping' ,
		'shop_pg' ,
		'shop_wish' ,

		'site_block' ,
		'site_board' ,
		'site_board_comment' ,
		'site_boardlist' ,
		'site_env' ,
		'site_header' ,
		'site_footer' ,

		'site_plug_board' ,
		'site_index_goods' ,
		'site_index_title' ,
		'site_language' ,
		'site_members' ,
		'site_members_agree' ,
		'site_members_block' ,
		'site_members_emoney' ,
		'site_members_env' ,
		'site_members_grade' ,
		'site_members_password' ,
		'site_members_point' ,
		'site_members_reserved' ,
		'site_menu' ,
		'site_menu_setting' ,
		'site_pages' ,
		'site_pages_files' ,
		'site_pages_html' ,
		'site_skin_html' ,
		'site_sns' ,
		'site_theme' ,
		'site_themefiles' ,
		'site_themefiles_html',

		'site_css',

		'backup'
	);

	// 데이터 베이스 소스 
	$source_database = "saleshosting";
	// $target_database = _formdata("database");
	$target_database = $sales_db->database;

	if($source_database != $target_database){

		// init 모드일 경우, 기존 테이블을 삭제하고 다시 생성함.
		$mode = _formdata("mode");
		if($mode == "init"){
			for($i=0;$i<count($update_tables);$i++){
				$query = "DROP TABLE `".$target_database."`.`".$update_tables[$i] ."`;";
				_sales_query($query);
			}		
		}

	
		if(_mysqli_is_database($source_database)){
			if($target_database){
				if(_mysqli_is_database($database_target)){
   					echo "쇼핑몰 : ".$target_database."를 업그레이드를 진행 합니다...<br>";
   				} else {
   					echo "쇼핑몰 : $database_target 데이터베이스를 신규로 생성후, 업그레이드를 진행합니다."."<br>";
   					_mysqli_database_create($database_target);
   				}

   			
   				for($i=0;$i<count($update_tables);$i++){
					echo "업그레이트 테이블 확인 : ". $update_tables[$i] ."<br>";

					// 대상 Target 데이터베이스 , 테이블 확인 
					if(_sales_is_table($target_database,$update_tables[$i])){
						// echo "<br>"; 	
					} else {
						echo "대상 테이블을 신규로 생성합니다. <br>";
						_sales_table_create($target_database,$update_tables[$i]);
					}


					// 원본 데이터베이스 / 테이블 필트 목록 읽어오기...
					$query1 = "SHOW COLUMNS FROM ".$source_database.".".$update_tables[$i].";";
					echo "비교중... <br>";				
					if($rowss1 = _mysqli_query_rowss($query1)){
						for($j=0;$j<count($rowss1);$j++){
							$rows1 = $rowss1[$j];
							$filed_name = $rows1->Field;
							$filed_type = $rows1->Type;
							echo "* ".$rows1->Field."(".$rows1->Type.")<br>";
							if($filed_name != "Id"){
								// _sales_table_alter(,$rows1->$filedname,$filed_name,$filed_type);
								$query = "ALTER TABLE `".$target_database."`.`".$update_tables[$i]."` ADD COLUMN `$filed_name` $filed_type "; // CHARACTER SET 'utf8' NULL;
    							// echo $query."<br>";
    							_sales_query($query);
							}
						} // field 검사 끝.
					}

				} // end of for

			} else {
				echo "업데이트 동기화 대상의 데이터베이스를 선택해 주세요.";
			}

		} else {
			echo "원본 데이터베이스가 없습니다.";
		}

	} else {
		echo "자기자신 database는 업그레이드 할 수 없습니다.";
	}

	

	


?>