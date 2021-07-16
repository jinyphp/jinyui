<?php
	//*  Openshopping V2.1
	//*  Program by : hojin lee
	//*  

	// update : 2016.01.04 = 코드정리 

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

	function _board_rows($code){
		$query = "select * from `site_boardlist` where code='$code'";
		if($rows = _mysqli_query_rows($query)){ 
			// 카테고리 스타일 정보
			return $rows;
		}
	}

	function _board_list($rowss,$plug_rows){
		global $site_mobile;

		for($i=0; $i<count($rowss); $i++,$j++){
			$rows = $rowss[$i];

			$level_tree = "";
			// 답변글 Reply 체크
			if($rows->level>0){
				for($j=0;$j<$rows->level;$j++) $level_tree .= "&nbsp;&nbsp;";
				$level_tree .= "└";
			}

			$writer = explode("@",$rows->email);
			$writer = $writer[0]."@*****";

			// 문자열 길이 
			if($site_mobile == "m"){ 
				$maxstr = $plug_rows->mobile_maxstr;
				if($plug_rows->mobile_label) $label = explode(";", $plug_rows->mobile_label);
			} else {
				$maxstr = $plug_rows->pc_maxstr;
				if($plug_rows->pc_label) $label = explode(";", $plug_rows->pc_label);
			}

			if(strlen($rows->title) > $maxstr) {
				$_title = substr($rows->title,0,$maxstr);
				$_title .= "...";
			} else {
				$_title = $rows->title;
			}

			if($rows->check_secure && $rows->email != $_COOKIE['cookie_email']){				
				$title = "* ".$_title." ";
			} else {
				$title = "<a href='/board_view.php?uid=".$rows->Id."&board=".$rows->board."'>".$_title."</a>";
			}


			if($label){
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" ><tr>";
				for($j=0;$j<count($label);$j++){
					$field = explode("=", $label[$j]);
					if($field[1]){
						$list .= "<td style='font-size:12px;padding:5px;' valign=\"top\" width=\"$field[1]\">";
					} else {	
						$list .= "<td style='font-size:12px;padding:5px;' valign=\"top\">";
					}

					// $list .= "<td style='font-size:12px;padding:5px;' valign=\"top\">$level_tree".$title."</td>";
					if($field[0] == "title"){
						$list .= $level_tree." ".$title."</td>";
					} else $list .= $rows->$field[0]."</td>";
				}
				
				$list .= "</tr></table>";

			} else {
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
				<tr>
				<td style='font-size:12px;padding:5px;' valign=\"top\">$level_tree".$title."</td>
				</tr>
			</table>";
			}
			

		}

		return $list;
			
	}	

	// Plug 계시판 처리
	if($board=_formdata("board")){

		$query = "select * from `site_plug_board` where code='$board'";
		// echo $query."<br>";
		if($plug_rows = _mysqli_query_rows($query)){ 

			$query = "select * from `site_board` where board = '".$plug_rows->code."' ";
			$query .= "order by pos desc ";
			if($site_mobile == "m"){
				$query .= "LIMIT 0 , ".$plug_rows->mobile_rows;// 검색된 데이터 내에서 , limit 설정 
			} else {
				$query .= "LIMIT 0 , ".$plug_rows->pc_rows;// 검색된 데이터 내에서 , limit 설정 
			}
			
			// echo $query."<br>";
			if($rowss = _mysqli_query_rowss($query)){	
				$list = _board_list($rowss,$plug_rows);
				
			} else {
				$msg = "글 목록이 없습니다.";
				$list = $msg;				
			}

			// 계시판 타이틀 

			$board_rows = _board_rows($board);
			$body  = "<div style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;background-color:#ffffff;'>
						<a href='board.php?board=".$board."'>".$board_rows->title."</a></div>";
			// 계시판 목록
			$body .= "<div style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;background-color:#ffffff;'>".$list."</div>";

			echo $body;


		}	

		/*
		if($board_rows = _board_rows($board)){

			$board_rows = _board_rows($board);		

			$_list_num = 5;

			



		} else {
			$msg = "오류. 게시판 정보를 읽어 올 수 없습니다..";
			$msg_string = _string($msg,$site_language);
			echo $msg_string;
		}
		*/


	} else {
		$msg = "오류. 게시판 코드번호가 없습니다..";
		$msg_string = _string($msg,$site_language);
		echo $msg_string;
	}


?>