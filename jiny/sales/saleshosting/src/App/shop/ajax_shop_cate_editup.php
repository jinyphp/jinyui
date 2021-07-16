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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
	
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";		

		switch($mode){
			case 'disable':
				_cate_enable($uid);
				$url = "shop_cate.php";    		
				echo "<script> location.replace('$url'); </script>";
				break;
			case 'enable':
				_cate_disable($uid);
				$url = "shop_cate.php";    		
				echo "<script> location.replace('$url'); </script>";
				break;
			case 'down':
				_cate_down($uid);
				$url = "shop_cate.php";    		
				echo "<script> location.replace('$url'); </script>";
				break;
			case 'up':
				_cate_up($uid);
				$url = "shop_cate.php";    		
				echo "<script> location.replace('$url'); </script>";
				break;
			case 'delete':		
				_cate_delete($uid);
				$url = "shop_cate.php";    		
				echo "<script> location.replace('$url'); </script>";
				break;	
		}				


		if($mode == "edit"){
			//echo "카테고리 수정 <br>";
			
			//카테고리 언어별 이름 설정
    		$query = "select * from `site_language` ";	
			if( $rowss = _sales_query_rowss($query) ){ 
				$title = "{";
				$flag = false;
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					$name = _formdata($rows->code);
					if(isset($name) && $name != "") $flag = true;
					$title .= "\"".$rows->code."\":\"".$name."\"";
					if($i<(count($rowss)-1)) $title .= ",";
				}
					$title .= "}"; 
			}

			if($flag == false ){
				//echo "카테고리 이름이 없습니다.";
			} else {
				
				$query = new query;
				$query->table_name = "shop_cate";
				$query->where = " Id ='$uid'";

				$query->update("check_members",_formdata("check_members"));
				$query->update("check_goodname",_formdata("check_goodname"));
				$query->update("check_images",_formdata("check_images"));
				$query->update("check_subtitle",_formdata("check_subtitle"));
				$query->update("check_spec",_formdata("check_spec"));
				$query->update("check_prices",_formdata("check_prices"));
				$query->update("check_usd",_formdata("check_usd"));
				$query->update("check_memprices",_formdata("check_memprices"));

				$query->update("cate_type",_formdata("cate_type"));
				$query->update("cols",_formdata("cols"));
				$query->update("rows",_formdata("rows"));
				$query->update("cate_imgsize",_formdata("cate_imgsize"));

				$query->update("mobile_type",_formdata("mobile_type"));
				$query->update("mobile_cols",_formdata("mobile_cols"));
				$query->update("mobile_rows",_formdata("mobile_rows"));
				$query->update("mobile_imgsize",_formdata("mobile_imgsize"));

				$query->update("apply_html",_formdata("apply_html"));				
				$query->update("html", addslashes( _formdata("html") ) );
				$query->update("name",_formdata($site_language));

				$query->update("title",$title);
				$query->update("url",_formdata("url"));
				$query->update("alt",_formdata("alt"));
				$query->update("enable",_formdata("enable"));

				$query->update("sort",_formdata("sort"));

				$query->update("cell_bgcolor",_formdata("cell_bgcolor"));
				$query->update("cell_outline_width",_formdata("cell_outline_width"));
				$query->update("cell_outline_color",_formdata("cell_outline_color"));
				$query->update("cell_outline_hovercolor",_formdata("cell_outline_hovercolor"));
				$query->update("cell_discount_bgcolor",_formdata("cell_discount_bgcolor"));
				$query->update("cell_discount_color",_formdata("cell_discount_color"));
				$query->update("cell_freeshipping_color",_formdata("cell_freeshipping_color"));
				$query->update("cell_freeshipping_bgcolor",_formdata("cell_freeshipping_bgcolor"));

				$_query = $query->update_query();
				_sales_query($_query);
				//echo $_query;
			

			}

			$url = "shop_cate.php";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "new"){
			//echo "카테고리 추가 <br>";

			$query = "select * from `site_language` ";	
			if( $rowss = _sales_query_rowss($query) ){ 
				$title = "{";
				$flag = false;
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					$name = _formdata($rows->code);
					if(isset($name) && $name != "") $flag = true;
					$title .= "\"".$rows->code."\":\"".$name."\"";
					if($i<(count($rowss)-1)) $title .= ",";
				}
				$title .= "}"; 
			}

			if($flag == false ){
				//echo $title;
				//echo "이름이 없습니다.";
			} else {

				// 최상위 Level 0 메뉴 추가   
    			$query = "select * from `shop_cate` order by pos desc";
    			if( $rows = _sales_query_rows($query) ){
					$pos = $rows->pos+1;
    			} else $pos = 1;

    		
    			$query = new query;
				$query->table_name = "shop_cate";
				
				$query->insert("regdate",$TODAYTIME);
				$query->insert("enable",_formdata("enable"));
				$query->insert("title",$title);
				$query->insert("name",_formdata($site_language));
				$query->insert("url",_formdata("url"));
				$query->insert("alt",_formdata("alt"));
				$query->insert("check_members",_formdata("check_members"));
				$query->insert("check_goodname",_formdata("check_goodname"));
				$query->insert("check_images",_formdata("check_images"));
				$query->insert("check_subtitle",_formdata("check_subtitle"));
				$query->insert("check_spec",_formdata("check_spec"));
				$query->insert("check_prices",_formdata("check_prices"));
				$query->insert("check_usd",_formdata("check_usd"));
				$query->insert("check_memprices",_formdata("check_memprices"));

				$query->insert("cate_type",_formdata("cate_type"));
				$query->insert("cols",_formdata("cols"));
				$query->insert("rows",_formdata("rows"));
				$query->insert("cate_imgsize",_formdata("cate_imgsize"));

				$query->insert("mobile_type",_formdata("mobile_type"));
				$query->insert("mobile_cols",_formdata("mobile_cols"));
				$query->insert("mobile_rows",_formdata("mobile_rows"));
				$query->insert("mobile_imgsize",_formdata("mobile_imgsize"));

				$query->insert("apply_html",_formdata("apply_html"));
				$query->insert("html",addslashes(_formdata("html")));

				$query->update("sort",_formdata("sort"));

				$query->insert("level","0");
				$query->insert("pos",$pos);
				$query->insert("ref","0");

				$query->insert("cell_bgcolor",_formdata("cell_bgcolor"));
				$query->insert("cell_outline_width",_formdata("cell_outline_width"));
				$query->insert("cell_outline_color",_formdata("cell_outline_color"));
				$query->insert("cell_outline_hovercolor",_formdata("cell_outline_hovercolor"));
				

				$query->insert("cell_discount_color",_formdata("cell_discount_color"));
				$query->insert("cell_discount_bgcolor",_formdata("cell_discount_bgcolor"));
				$query->insert("cell_freeshipping_bgcolor",_formdata("cell_freeshipping_bgcolor"));
				$query->insert("cell_freeshipping_color",_formdata("cell_freeshipping_color"));
			

				$_query = $query->insert_query();			
				_sales_query($_query);
				//echo $_query;
			

				/*
    			//% Id 번호 추출 및 Tree 추가...
				$query = "select * from `shop_cate` where pos='$pos'";
    			if( $rows = _sales_query_rows($query) ){
					$tree = "0>".$rows->Id.";";
					$query = "UPDATE `shop_cate` SET `tree`='$tree' WHERE `Id`=".$rows->Id;
    				//echo $query."<br>";
    				_sales_query($query);
    			}
    			*/

    			$query = "select * from `shop_cate` where pos='$pos'";
    			///echo $query."<br>";
    			if( $rows = _sales_query_rows($query) ){
					$tree = "0>".$rows->Id.";";
					$query = "UPDATE `shop_cate` SET `tree`='$tree' WHERE `Id`=".$rows->Id;
    				//echo $query."<br>";
    				_sales_query($query);
    			}

    			$msg = "신규등록";
    			//echo $msg;
			}

			$url = "shop_cate.php";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "sub"){
			$query = "select * from `site_language` ";	
			if( $rowss = _sales_query_rowss($query) ){ 
				$title = "{";
				$flag = false;
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					$name = _formdata($rows->code);
					if(isset($name) && $name != "") $flag = true;
					$title .= "\"".$rows->code."\":\"".$name."\"";
					if($i<(count($rowss)-1)) $title .= ",";
				}
					$title .= "}"; 
			}

			if($flag == false ){
				//echo $title;
				//echo "이름이 없습니다.";
			} else {

				// 삽입위치, pos값 전체 +1 씩 증가
    			$query = "select * from `shop_cate` where `Id`=".$uid."";	
				//echo $query."<br>";	
				if( $cate = _sales_query_rows($query) ){

					//$POS = $cate->pos + 1;
    				$LEVEL = $cate->level + 1;

					$query = "select * from `shop_cate` where pos >= '".$cate->pos."' order by pos desc";
    				//echo $query."<br>";	
    				if( $rowss = _sales_query_rowss($query) ){
						for($i=0;$i<count($rowss);$i++){
							$rows1=$rowss[$i];
							$position = $rows1->pos+1;
    						$queryUp = "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows1->Id;
    						_sales_query($queryUp);
    						//echo "++ ".$queryUp."<br>";
    					}
    				}	

    			
    				$query = new query;
					$query->table_name = "shop_cate";
				
					$query->insert("regdate",$TODAYTIME);
					$query->insert("enable",_formdata("enable"));
					$query->insert("title",$title);
					$query->insert("name",_formdata($site_language));
					$query->insert("url",_formdata("url"));
					$query->insert("alt",_formdata("alt"));
					$query->insert("check_members",_formdata("check_members"));
					$query->insert("check_goodname",_formdata("check_goodname"));
					$query->insert("check_images",_formdata("check_images"));
					$query->insert("check_subtitle",_formdata("check_subtitle"));
					$query->insert("check_spec",_formdata("check_spec"));
					$query->insert("check_prices",_formdata("check_prices"));
					$query->insert("check_usd",_formdata("check_usd"));
					$query->insert("check_memprices",_formdata("check_memprices"));

					$query->insert("cate_type",_formdata("cate_type"));
					$query->insert("cols",_formdata("cols"));
					$query->insert("rows",_formdata("rows"));
					$query->insert("cate_imgsize",_formdata("cate_imgsize"));

					$query->insert("mobile_type",_formdata("mobile_type"));
					$query->insert("mobile_cols",_formdata("mobile_cols"));
					$query->insert("mobile_rows",_formdata("mobile_rows"));
					$query->insert("mobile_imgsize",_formdata("mobile_imgsize"));

					$query->insert("apply_html",_formdata("apply_html"));
					$query->insert("html",addslashes(_formdata("html")));

					$query->update("sort",_formdata("sort"));

					$query->insert("level",$LEVEL);
					$query->insert("pos",$cate->pos);
					$query->insert("ref",$uid);
					$query->insert("hassub","hassub");

					$query->insert("cell_bgcolor",_formdata("cell_bgcolor"));
					$query->insert("cell_outline_width",_formdata("cell_outline_width"));
					$query->insert("cell_outline_color",_formdata("cell_outline_color"));
					$query->insert("cell_outline_hovercolor",_formdata("cell_outline_hovercolor"));
				

					$query->insert("cell_discount_color",_formdata("cell_discount_color"));
					$query->insert("cell_discount_bgcolor",_formdata("cell_discount_bgcolor"));
					$query->insert("cell_freeshipping_bgcolor",_formdata("cell_freeshipping_bgcolor"));
					$query->insert("cell_freeshipping_color",_formdata("cell_freeshipping_color"));
				
					$_query = $query->insert_query();			
					_sales_query($_query);
					//echo $_query;
					

					/*
					//Tree값 분석 및 생성, 갱신
					$query = "select * from `shop_cate` where pos='".$cate->pos."'";
					if( $rows = _sales_query_rows($query) ){
						$tree = $cate->tree.">".$rows->Id.";";
						$queryUp = "UPDATE `shop_cate` SET `tree`='$tree' WHERE pos=".$cate->pos."";
    					_sales_query($queryUp);
					}
					*/
					$query = "select * from `shop_cate` where pos='".$cate->pos."'";
					if( $rows = _sales_query_rows($query) ){
						$tree = $cate->tree.">".$rows->Id.";";
						$queryUp = "UPDATE `shop_cate` SET `tree`='$tree' WHERE pos=".$cate->pos."";
    					_sales_query($queryUp);
					}


					$msg = "서브등록";
    				//echo $msg;

				} else echo "상품을 찾을 수 없습니다.";


			}	

			$url = "shop_cate.php";    		
			echo "<script> location.replace('$url'); </script>";

		} 

   	
    			

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}



function _cate_enable($uid){
			$query = "UPDATE `shop_cate` SET `enable` = '' WHERE `Id` like '$uid'";
			// echo $query;
			_sales_query($query);

			$msg = "카테고리 비활성";
			echo $msg;
			//echo "<script> $('#cate_edit').html('$msg'); <script>";
		}

		function _cate_disable($uid){
			$query = "UPDATE `shop_cate` SET `enable` = 'on' WHERE `Id` like '$uid'";
			// echo $query;
			_sales_query($query);

			$msg = "카테고리 활성";
			echo $msg;
			//echo "<script> $('#cate_edit').html('$msg'); <script>";
		}

		function _cate_down($uid){

			//% 해당 카테고리를 읽어옴.
			$query = "select * from `shop_cate` where Id = '$uid'"; 
			//echo $query."<br>";
			if( $cate = _sales_query_rows($query) ){ 
		    	
		    	// 현재 카테고리와 동일한 레벨의 상위 카테고리를 찾음.	
		    	$query1 = "select * from `shop_cate` where level = '".$cate->level."' and pos < ".$cate->pos." and ref = ".$cate->ref." order by pos desc "; 
				//echo $query1."<br>";
				if( $rows_down = _sales_query_rows($query1) ){  
		    		
		    		//echo "하위 카테고리 ".$rows_down->Id."<br>";

		    		// 현재 카테고리의 deth,크기를 구함.
		    		$query = "select * from `shop_cate` where tree like '%>$uid;%' order by pos desc";
					$caterowss = _sales_query_rowss($query);


					// 상위 카테고리의 deth,크기를 구함.
					$query = "select * from `shop_cate` where tree like '%>".$rows_down->Id.";%' order by pos desc";
					$downrowss = _sales_query_rowss($query);  

					$j=0;

					for($i=0;$i<count($caterowss);$i++){
						$rows3 = $caterowss[$i];
		    			$position = $rows3->pos - count($downrowss); // 하위 카테고리 사이트 크기많큼 pos를 모두 감소. 
		    			$queryUp[$j++] = "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
					}

					for($i=0;$i<count($downrowss);$i++){
						$rows3 = $downrowss[$i];
		    			$position = $rows3->pos + count($caterowss); // 하위  카테고리 사이트 크기많큼 pos를 모두 증가. 
		    			$queryUp[$j++] = "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
					}	

					// 저장한 커리를 모두 실행
					for($j=0;$j<count($queryUp);$j++){
		    			//echo "ex.. ".$queryUp[$j]."<br>";
		    			// mysql_db_query($master_mysql[dbname],$queryUp[$j],$master_dbconnect);
		    			_sales_query($queryUp[$j]);
		    		}

		    		$msg = "하위이동";
    				echo $msg;

				} else {
		    		$msg = "최상의 카테고리 입니다.";
		    		echo $msg;
		    	}
			} else {
		    	$msg = "이동할 카테고리를 선택해 주세요.";
		    	echo $msg;
		    }
		}

		function _cate_up($uid){
			//% 해당 카테고리를 읽어옴.
			$query = "select * from `shop_cate` where Id = '$uid'"; 
			echo $query."<br>";
			if( $cate = _sales_query_rows($query) ){ 
		    	
		    	// 현재 카테고리와 동일한 레벨의 상위 카테고리를 찾음.	
		    	$query1 = "select * from `shop_cate` where level = '".$cate->level."' and pos > ".$cate->pos." and ref = ".$cate->ref." order by pos asc "; 
				//echo $query1."<br>";
				if( $rows_up = _sales_query_rows($query1) ){  
		    		
		    		//echo "상위 카테고리 ".$rows_up->Id."<br>";

		    		// 현재 카테고리의 deth,크기를 구함.
		    		$query = "select * from `shop_cate` where tree like '%>$uid;%' order by pos desc";
					$caterowss = _sales_query_rowss($query);


					// 상위 카테고리의 deth,크기를 구함.
					$query = "select * from `shop_cate` where tree like '%>".$rows_up->Id.";%' order by pos desc";
					$uprowss = _sales_query_rowss($query);  

					$j=0;

					for($i=0;$i<count($caterowss);$i++){
						$rows3 = $caterowss[$i];
		    			$position = $rows3->pos + count($uprowss); // 상위 카테고리 사이트 크기많큼 pos를 모두 증가. 
		    			$queryUp[$j++] = "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
					}

					for($i=0;$i<count($uprowss);$i++){
						$rows3 = $uprowss[$i];
		    			$position = $rows3->pos - count($caterowss); // 상위 카테고리 사이트 크기많큼 pos를 모두 감소. 
		    			$queryUp[$j++] = "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `shop_cate` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
					}	

					// 저장한 커리를 모두 실행
					for($j=0;$j<count($queryUp);$j++){
		    			//echo "ex.. ".$queryUp[$j]."<br>";
		    			// mysql_db_query($master_mysql[dbname],$queryUp[$j],$master_dbconnect);
		    			_sales_query($queryUp[$j]);
		    		}

		    		$msg = "상위이동";
    				echo $msg;

				} else {
		    		$msg = "최상의 카테고리 입니다.";
		    		echo $msg;
		    	}
			} else {
		    	$msg = "이동할 카테고리를 선택해 주세요.";
		    	echo $msg;
		    }
		}

		function _cate_delete($uid){
			$query = "select * from `shop_cate` where ref = '$uid'";
			// echo $query."<br>";
			if( $rows = _sales_query_rows($query) ){ 
				//echo "오류! 하위 카테고리가 있어 삭제가 되지 않습니다.";
			} else {
				$query = "DELETE FROM `shop_cate` WHERE `Id`='$uid'";
				// echo $query."<br>";
				_sales_query($query);
				// echo "삭제";

				// POS 값 재정럴
				$query = "select * from `shop_cate` order by pos asc";
				if( $rowss = _sales_query_rowss($query) ){ 
					for($i=0,$j=1;$i<count($rowss);$i++,$j++){
						$rows = $rowss[$i];
						$query = "UPDATE `shop_cate` SET `pos`=$j WHERE `Id`=".$rows->Id;
						_sales_query($query);
					}
				}

				$msg = "삭제";
    			echo $msg;	

			}
		}
	
?>