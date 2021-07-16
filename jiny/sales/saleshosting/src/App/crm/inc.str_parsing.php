<?php
	// ++ {( 특정값 치환처리
	// {( tablename.filed : field = [id] }
	if($keyword_count = _keyword_count($body, "{(")){
		$krows = _keyword_rows($body, "{(", $keyword_count);
		for($p=0;$p<count($krows);$p++){
			$strKey = explode("?", $krows[$p]);
					
			$strTable = explode(".", $strKey[0]);
			$strWhere = explode("=", $strKey[1]);

			$whereKeyValue = _formdata($strWhere[1]); 
			$strQuery = "select * from ".$strTable[0]." where ".$strWhere[0]." = '$whereKeyValue'";
			echo $strQuery."<br>";
			if($dataRows = _sales_query_rows($strQuery)){
				$body = str_replace("{(".$krows[$p]."}",$dataRows->$strTable[1],$body);
			}
			
			// $_log_history .= "key= ".$krows[$p]."<br>";
			// $link_url = str_replace("{".$krows[$p]."}",$rows->$krows[$p],$link_url);
		}
	}

	// ++ {* POST 값으로 치환
	if($keyword_count = _keyword_count($body, "{*")){
		$krows = _keyword_rows($body, "{*", $keyword_count);
		for($p=0;$p<count($krows);$p++){
			$body = str_replace("{*".$krows[$p]."}",_formdata($krows[$p]),$body);
		}
	}

?>