<?


	// 계시판 목록 select
	function _shop_boardRows_select($baord){
		global $css_textbox;	
			
		$query = "select * from `site_boardlist` ";
		$query .= "order by regdate desc";	

		$form_board = "<select name='board' style='$css_textbox'>";
		if($rowss = _sales_query_rowss($query)){

			if($baord){
				$form_board .= "<option value=''>계시판 선택</option>";
			} else {
				$form_board .= "<option value='' selected>계시판 선택</option>";
			}
			
			for($i=0;$i<count($rowss);$i++){
						
				$rows= $rowss[$i];
				$form_board .= "<option value='".$rows->Id."' ";						
				if($baord == $rows->Id) $form_board .= "selected";
				$form_board .= ">".$rows->Id." ".$rows->title."</option>";
			}
									
		}	
		$form_board .= "</select>";			
		return $form_board;
	} 



	
?>