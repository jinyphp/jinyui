<?php

	// 호스팅 사용자 관련 함수

	

	// 호스팅 사용자 
	function _hosting_rows_byId($uid){
		$query = "select * from `service_host` WHERE Id = $uid";
		return _mysqli_query_rows($query);
	}

	function _hosting_rows($email){
		$query = "select * from `service_host` WHERE email = '$email'";
		return _mysqli_query_rows($query);
	}

	// 호스팅 사용자 비활성화
	function _hosting_enable_byId($uid){
		$query = "UPDATE `service_host` SET `enable`='on' WHERE Id =$uid";
		_mysqli_query($query);
	}

	function _hosting_enable($email){
		$query = "UPDATE `service_host` SET `enable`='on' WHERE email ='$email'";
		_mysqli_query($query);
	}

	// 호스팅 사용자 비활성화
	function _hosting_disable_byId($uid){
		$query = "UPDATE `service_host` SET `enable`='' WHERE Id =$uid";
		_mysqli_query($query);
	}

	function _hosting_disable($email){
		$query = "UPDATE `service_host` SET `enable`='' WHERE Id = '$email'";
		_mysqli_query($query);
	} 

	

	function _hosting_delete_byId($uid){
		$query = "DELETE FROM `service_host` WHERE `Id`='$uid'";
		echo $query;
		_mysqli_query($query);
	}

	function _hosting_delete($email){
		$query = "DELETE FROM `service_host` WHERE `Id`='$email'";
		_mysqli_query($query);
	}



	// Plan

	// 호스팅 Plan
	function _hosting_plan_rows_byId($uid){
		$query = "select * from `service_products` WHERE Id = $uid";
		return _mysqli_query_rows($query);
	}

	function _hosting_plan_rows($email){
		$query = "select * from `service_products` WHERE email = '$email'";
		return _mysqli_query_rows($query);
	}

	// 호스팅 _plan 활성화
	function _hosting_plan_enable_byId($uid){
		$query = "UPDATE `service_products` SET `enable`='on' WHERE Id =$uid";
		_mysqli_query($query);
	}

	function _hosting_plan_enable($email){
		$query = "UPDATE `service_products` SET `enable`='on' WHERE email ='$email'";
		_mysqli_query($query);
	}

	// 호스팅 _plan 비활성화
	function _hosting_plan_disable_byId($uid){
		$query = "UPDATE `service_products` SET `enable`='' WHERE Id =$uid";
		_mysqli_query($query);
	}

	function _hosting_plan_disable($email){
		$query = "UPDATE `service_products` SET `enable`='' WHERE Id = '$email'";
		_mysqli_query($query);
	}



	function _hosting_plan_delete_byId($uid){
		$query = "DELETE FROM `service_products` WHERE `Id`='$uid'";
		_mysqli_query($query);
	}

	function _hosting_plan_delete($email){
		$query = "DELETE FROM `service_products` WHERE `email`='$email'";
		_mysqli_query($query);
	}

	

?>