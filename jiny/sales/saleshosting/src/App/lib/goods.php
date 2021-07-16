<?php

	function _sales_goods_select($goods){
		global $css_textbox;
		$query = "select * from `sales_goods`";	
		if($rowss = _sales_query_rowss($query)){					
			$goods_select = "<select name='goodname' style=\"$css_textbox\">";
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($company == $rows1->Id){
					$goods_select.= "<option value='".$rows1->Id."' selected>".$rows1->name."</option>";
				} else $goods_select .= "<option value='".$rows1->Id."'>".$rows1->name."</option>";
			}
					
			$goods_select .= "</select>";
		}

		return $goods_select; 
	}

?>