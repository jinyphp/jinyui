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

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...

		$body = $javascript._skin_page($skin_name,"service_new_success");

		$service_code = _formdata("service_code");
		
		// 데이터베이스 생성
		if(_mysqli_is_database($service_code)){
			echo "이미 존재하는 데이터베이스 입니다.";
		} else {
			// 데이터 베이스 생성
			_mysqli_database_create($service_code);

			// $sql = _file_load("./sql/shop.sql");
			// _mysqli_query($sql);

			// $r2 = exec("mkdir ../$service_code"); 

			/*
			// 데이터 베이스 복사 
			$database = "joonganginjae";
    		$database_target = $service_code;
		
			$query = "show tables from $database";
			if($rowss = _mysqli_query_rowss($query)){

				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];
					// echo json_encode($rows);
					$filedname = "Tables_in_".$database;
					echo "$i ".$rows->$filedname."<br>";
					$table_name = $rows->$filedname;

					if(_mysqli_is_table($database_target,$table_name)){
						echo "테이블 좀재 <br>"; 	
					} else {
						echo "테이블 업습xxxx <br>";
						_mysqli_table_create($database_target,$table_name);
					}

					$query1 = "SHOW COLUMNS FROM ".$table_name;
					if($rowss1 = _mysqli_query_rowss($query1)){
						for($j=0;$j<count($rowss1);$j++){
							$rows1 = $rowss1[$j];
							$filed_name = $rows1->Field;
							$filed_type = $rows1->Type;
							echo "- ".$rows1->Field."/ ".$rows1->Type." / <br>";
							if($filed_name != "Id") _mysqli_table_alter($database_target,$table_name,$filed_name,$filed_type);
						}
					}
			
				}

			}	
			*/
			
		}
		





		/*
		$javascript = "<script>
			function form_submit(mode){
				var url = \"/ajax_service_new_editup.php?mode=\"+mode;
				var formData = new FormData($('#data')[0]);
				var code = $('#service_code').val();

				if(!code){
					alert(\"서비스 신청 아이디를 입력해 주세요 \");
				} else {
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
			}
		</script>";
		$body = $javascript._skin_page($skin_name,"service_new");

		$ajaxkey = _formdata("ajaxkey");
		$body=str_replace("{formstart}","<form id='data' name='company' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$body = str_replace("{service_code}","<input type='text' name='service_code' value='' style=\"$css_textbox\" id=\"service_code\">",$body);

		$body = str_replace("{form_submit}","<input type='button' value='신청' onclick=\"javascript:form_submit('new')\" style=\"".$css_btn_gray."\" >",$body);
*/

		echo $body;

	}	


	
?>
