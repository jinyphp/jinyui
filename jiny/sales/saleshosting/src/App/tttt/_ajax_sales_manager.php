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
                        url:'/ajax_sales_manager_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
                
            function list(limit){
                	var search = document.manager.searchkey.value;
                  	$.ajax({
                        url:'/ajax_sales_manager.php?limit='+limit+'&search='+search,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
        </script>";


		$body = $javascript._skin_page($skin_name,"sales_manager");

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='manager' method='post' enctype='multipart/form-data'>
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



		$query = "select * from `sales_manager` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이름</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >이메일</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>부서</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>전화</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>팩스</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->lastname.$rows->firstname."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
								$comtype  <a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->email."</a> </td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->part."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_sell.php?company_id=".$rows->Id."'>".$rows->balance_sell."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_buy.php?company_id=".$rows->Id."'>".$rows->balance_buy."</a></td>";
				$list .= "</tr></table>";

				
			}
			$body = str_replace("{list}", $list, $body);
		} else {
			$msg = "담당자 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	
	
	/*
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
			
			$body = shopskin("sales_manager");
			$body = str_replace("{new}",_button_blue("직원추가","sales_manager_new.php"),$body);
		
			//# 좌측 메뉴 트리구조 표시
			$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			$query = "select * from `sales_manager` group by part desc";
			//echo $query."<br>"; 
			$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){
    		
    			while(1){
    				$rows=mysql_fetch_array($result);
    				if($rows[part]) {

    					$query = "select count(*) from `sales_manager` where members_id = '$MEM[Id]' and `part` = '$rows[part]' ";
						//echo $query."<br>"; 
						$result1=mysql_db_query($mysql_dbname,$query,$connect);
    					$total=mysql_result($result1,0,0); 
    					if($total >0){
    						$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_manager.php?part=$rows[part]'>$rows[part]</a> ($total)</font></td></tr>";
    					} else {
    						$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_manager.php?part=$rows[part]'>$rows[part]</a></font></td></tr>";	
						}
    				} else break;
    			}
    						
    		}
			$leftBody .= "</table>";
			$body = str_replace("{manager_parts}","$leftBody ",$body);
			
			$search = $_POST['search']; $company = $_POST['company']; 
			$inout = $_GET['inout']; if(!$inout) $inout = $_POST['inout'];
			
			$body=str_replace("{formstart}","<form name='company' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='inout' value='$inout'>
					    						 <input type='hidden' name='mode' value='search'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$body = str_replace("{manager_name}","<input type='text' name='manager_name' $cssFormStyle placeholder='직원명 검색'>",$body);	
			$body = str_replace("{submit}","<input type='submit' name='reg' $cssFormStyle value='검색' >",$body);
			
			if($_POST['manager_name']){
				$query = "SELECT * FROM `sales_manager` where members_id = '$MEM[Id]' and name like '%".$_POST['manager_name']."%'";	
			} else {
				$query = "SELECT * FROM `sales_manager` where members_id = '$MEM[Id]'";			
			}
			//echo $query;
			$result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total = mysql_result($result,0,0);
    		
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){ 				
	    		
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_manager_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{regdate}","$rows[regdate]",$listform);
					$listform = str_replace("{parts}","$rows[part]",$listform);	
					$listform = str_replace("{manager}","<a href='sales_manager_edit.php?mode=edit&UID=$rows[Id]'>$rows[name]</a>",$listform);	
					$listform = str_replace("{email}","$rows[email]",$listform);
					$listform = str_replace("{mobile}","$rows[mobile]",$listform);
					$list .= $listform;	
	    			
			
	    		}
	    	
				$body=str_replace("{databody}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","등록된 거래처가 없습니다.",$listform);
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
