<?php

	//* ////////////////////////////////////////////////////////////
	//* OpenShopping V2.0 
	//* 2015.06.19
	//* Program By : hojin lee 
	//*
	
	$btn_style_gray ="style='width:80px; 
				font-family:\"맑은고딕\",\"돋움\",\"Arial\";
				font-size:12px; 
				color:#000000; 
				font-weight:bold;
				background-color:#f3f3f3; 
				height:28px;
				font-size:12px;
				border:1px solid #d8d8d8;'";
				
	function _button_gray($name,$url){
		global $btn_style_gray;
		$button ="<input type='button' value='".$name."' onclick=\"javascript:location.href='".$url."'\" $btn_style_gray >";	
		return $button;
	}

	function _button_css($name,$url,$css){
		$button ="<input type='button' value='".$name."' onclick=\"javascript:location.href='".$url."'\" id=\"$css\" >";	
		return $button;
	}





?>	

