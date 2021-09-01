<?php

	// 국가별 은행 계좌정보를 읽어옴. (활성화 된것만)
	function _bank_rowss($country){
		// 국가별 : 지정 계좌번호를 읽어옴
		$query = "select * from `shop_bank` WHERE `code`='".$country."' and enable='on'";
		if( $rowss = _mysqli_query_rowss($query) ){	
			return $rowss;
		}
	}

	// 국가별 모든 계좌번호를 읽어옴
	function _bank_rowss_all($country){
		// 국가별 : 지정 계좌번호를 읽어옴
		$query = "select * from `shop_bank` WHERE `code`='".$country."'";
		if( $rowss = _mysqli_query_rowss($query) ){	
			return $rowss;
		}
	}

	// 국가별 모든 계좌번호를 읽어옴
	function _banklist_rowss_all($country){
		// 국가별 : 지정 계좌번호를 읽어옴
		$query = "select * from `shop_bank`";
		if( $rowss = _mysqli_query_rowss($query) ){	
			return $rowss;
		}
	}


?>