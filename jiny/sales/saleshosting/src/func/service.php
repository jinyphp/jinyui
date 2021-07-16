<?php

	function _service(){
		$query = "select * from `service`";
		if($rows = _mysqli_query_rows($query)) return $rows;
	}

	$service_rows = _service();

	function _is_sales($service){
		if($service->sales){
			if($service->sales_expire >= date("Y-m-d H:i:s",time())) return "true"; else return "expire";
		} else return false;
	}

	function _is_shop($service){
		if($service->shop){
			if($service->shop_expire >= date("Y-m-d H:i:s",time())) return "true"; else return "expire";
		} else return false;
	}
?>