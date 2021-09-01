<?php
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/form.php";

	if(isset($_SESSION['country'])){
		$site_country = $_SESSION['country'];
	} else {
		$site_country = "kr";
	}

	// 국가별 : 지정 계좌번호를 읽어옴
	$query = "select * from `shop_bank` WHERE `code`='".$site_country."' and enable='on'";
	if( $rowss = _mysqli_query_rowss($query) ){	
		for($list="",$i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];
			/*	
			if($bankid == $rows[Id]){
				$bank_select = "<input type=radio name=bankid value='bank:$rows[Id]' checked>";
			} else 	
			*/
			$bank_select = "<input type=radio name=bankid value='bank:".$rows->Id."'>";

			$list .= "<table border='0' width='100%'' cellspacing='0' cellpadding='0'  >
						<tr>
						<td width='20' style='font-size:12px;padding:5px;' align='right'>$bank_select</td>
						<td style='font-size:12px;padding:5px;' width='100'>".$rows->swiff."</td>
						<td style='font-size:12px;padding:5px;'>".$rows->bankname."</td>
						</tr>
			
						<tr>
						<td width='20' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:5px;' align='right'>　</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:5px;' width='100'>".$rows->bankuser."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:5px;'>".$rows->banknum."</td>
						</tr>
					  </table>";
		}
	}

	echo $list;

?>