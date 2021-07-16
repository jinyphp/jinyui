<?

	function _is_service($email){
		$query = "select * from `service_host` where email='$email'";
        if( $rows = _mysqli_query_rows($query) ){
        	return true;
        } else {
        	return false;
        }	
	}

?>