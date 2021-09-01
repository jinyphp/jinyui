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

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";


		$javascript = "<script>
			function edit(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_sales_house_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
                
            function list(limit){
                	var search = document.house.searchkey.value;
                  	$.ajax({
                        url:'/ajax_sales_house.php?limit='+limit+'&search='+search,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
        </script>";


		$body = $javascript._skin_page($skin_name,"sales_house");

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='house' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);



		$query = "select * from `sales_company_house` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >창고/지점명</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>담당자</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>국가</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>전화</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>팩스</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
								$comtype  <a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->name."</a> </td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->manager."</td>";				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->country."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> ".$rows->phone."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> ".$rows->fax."</td>";
				$list .= "</tr></table>";

				
			}
			$body = str_replace("{list}", $list, $body);
		} else {
			$msg = "창고/지점 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	

/*
	@session_start();
	
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; //# 사이트 언어, 지역 설정
	include "mobile.php";
	
	include "./func_skin.php"; //# 스킨 레이아웃 함수들...
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	
	if(!isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
		$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";   
	} else { //////////////////////////////////////////

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(  mysql_num_rows($result)  ){ 
			$MEM=mysql_fetch_array($result);
			
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(  mysql_num_rows($result)  )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}

		
			//////////////////////////////////////////////////////////////////
			// 테이블 확인 및 생성...
			$query = "show tables like 'sales_warehouse_$MEM[Id]'";
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
			if(  !mysql_num_rows($result)  ) {
				$query = "CREATE TABLE `sales_warehouse_$MEM[Id]` (
  							`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  							`regdate` date DEFAULT NULL,
  							`enable` varchar(10) DEFAULT NULL,
  							`housename` varchar(255) DEFAULT NULL,
  							`manager` varchar(255) DEFAULT NULL,
  							`phone` varchar(20) DEFAULT NULL,
  							`fax` varchar(20) DEFAULT NULL,
  							`address` varchar(255) DEFAULT NULL,
  							`memo` varchar(255) DEFAULT NULL,
  							PRIMARY KEY (`Id`)
						) ENGINE=InnoDB";
				mysql_db_query($server[dbname],$query,$dbconnect);
				
				$query = "CREATE TABLE `sales_goodstock_$MEM[Id]` (
  							`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  							`warehouse` varchar(10) DEFAULT NULL,
  							`GID` varchar(10) DEFAULT NULL,
  							`stock` varchar(10) DEFAULT NULL,
  							PRIMARY KEY (`Id`)
						 ) ENGINE=InnoDB ";
				mysql_db_query($server[dbname],$query,$dbconnect);		 
				
			
			} else {
				
       		
			}
			
			//////////////////////////////////////////////////////////////////
			
			$body = shopskin("sales_warehouse");
			$body = str_replace("{new}",_button_blue("창고추가","sales_warehouse_new.php"),$body);
			
			$body=str_replace("{formstart}","<form name='warehouse' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    					 <input type='hidden' name='mode' value='search'>",$body);
			$body = str_replace("{formend}","</form>",$body);
			$body = str_replace("{submit}","<input type='submit' name='reg' $cssFormStyle value='검색' >",$body);
			
			$query = "SELECT * FROM `sales_warehouse_$MEM[Id]` ";
			// echo $query."<br>";	
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    		
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 				
	    		
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_warehouse_list",$_SESSION['mobile'],$_SESSION['language']);
					// echo "$rows[housename] $listform <br>";
					$listform = str_replace("{regdate}","$rows[regdate]",$listform);
					
					$listform = str_replace("{housename}","<a href='sales_warehouse_edit.php?mode=edit&UID=$rows[Id]'>$rows[housename]</a>",$listform);	
					
					$query1 = "select * from sales_manager where Id = '$rows[manager]'";
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if( $total1=mysql_num_rows($result1) ) {
						$rows1=mysql_fetch_array($result1);
						$listform = str_replace("{manager}","$rows1[name]",$listform);
					} else $listform = str_replace("{manager}","",$listform);
					
					$listform = str_replace("{phone}","$rows[phone]",$listform);
					$list .= $listform;	
	    			
			
	    		}
	    	
				$body=str_replace("{databody}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","등록된 창고/지점이 없습니다.",$listform);
	    		$body=str_replace("{databody}",$listform,$body);
	    	}
    		

		
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	mysql_close($connect);
	mysql_close($dbconnect);
	*/
?>
