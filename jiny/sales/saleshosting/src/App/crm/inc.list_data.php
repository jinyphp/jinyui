<?php


		if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
		for($i=0;$i<$count;$i++){
			$rows = $rowss[$i];
				
			$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";		

			if($title_rowss){
				$list .= "<table id=\"dataTitleHreader\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
				$list .= "<tr>";
				$list .= "<td width='20'>$tid</td>";

				for($k=0;$k<count($title_rowss);$k++){
					$rows1 = $title_rowss[$k];
					if($rows1->list_width>0) $td_width = " width='".$rows1->list_width."' "; else $td_width = "";
						
					if($rows1->list_type == "field") {
						$fieldname = $rows1->field_name;
						$value = $rows->$fieldname;

					} else if($rows1->list_type == "link") {
						$link_url = $rows1->list_value;
						// ++ [] 변수값 추출
						if($keyword_count = _keyword_count($link_url, "{")){
							$krows = _keyword_rows($link_url, "{", $keyword_count);
							for($p=0;$p<count($krows);$p++){
								$_log_history .= "key= ".$krows[$p]."<br>";
								$link_url = str_replace("{".$krows[$p]."}",$rows->$krows[$p],$link_url);
							}
						}

						$value = "<a href='".$link_url."'>".$rows1->list_name."</a>";

					} else if($rows1->list_type == "string") {
						$value = $rows1->list_value;
					
					} else $value = NULL;

					if($rows1->editlink){
						if($rows->enable) {
							$editHref = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\">".$value."</a>";
						} else $editHref = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\">
									<span style=\"text-decoration:line-through;\">".$value."</span></a>";

					} else $editHref = $value;

					$list .= "<td $td_width valign='top'>".$editHref."</td>";
				}

				$list .= "</tr>";
				$list .= "</table>";
			}
		}	





			
?>