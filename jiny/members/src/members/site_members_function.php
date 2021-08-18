<?

	function _site_memberRows_Id($uid){
		$query = "select * from `site_members` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}		
	}

	function _site_memberRows($email){
		$query = "select * from `site_members` where email='$email'";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}		
	}

	function _site_memberEmoneyRows_Id($uid){
		$query = "select * from `site_members_emoney` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}		
	}

	function _site_memberEmoneyRows($email){
		$query = "select * from `site_members_emoney` where email='$email'";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}		
	}

	function _site_memberPointRows_Id($uid){
		$query = "select * from `site_members_point` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}		
	}

	function _site_memberPointRows($email){
		$query = "select * from `site_members_point` where email='$email'";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}		
	}


	function _site_memberReservedRows_Id($uid){
		$query = "select * from `site_members_reserved` where Id =$uid";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}		
	}

		


?>