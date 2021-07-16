<?php

	function _sales_company_select($company){
		global $css_textbox;
		$query = "select * from `sales_company`";	
		if($rowss = _sales_query_rowss($query)){					
			$company_select = "<select name='company' style=\"$css_textbox\">";
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($company == $rows1->Id){
					$company_select.= "<option value='".$rows1->Id."' selected>".$rows1->company."</option>";
				} else $company_select .= "<option value='".$rows1->Id."'>".$rows1->company."</option>";
			}
					
			$company_select .= "</select>";
		}

		return $company_select; 
	}


?>