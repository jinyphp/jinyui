<?php
	// ++ 타이틀 이미지 출력
	$query1 = "select * from admin_tableslist where table_name = '$_tableName' order by pos asc";
	$_log_history .= $query1."<br>";
		
	if($title_rowss = _sales_query_rowss($query1)){
		$list = "<table id=\"dataTitleHreader\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
		$list .= "<tr>";
			$list .= "<td width='20'><input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" ></td>";

			$title_desc = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";

			for($i=0;$i<count($title_rowss);$i++){
				$rows1 = $title_rowss[$i];
				if($rows1->list_width>0) $td_width = " width='".$rows1->list_width."' "; else $td_width = "";
				$list .= "<td $td_width valign='top'>".$title_desc." ".$rows1->list_name."</td>";
			}

			$list .= "</tr>";
			$list .= "</table>";
	}
?>