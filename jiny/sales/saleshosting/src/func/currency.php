<?php

	//* ////////////////////////////////////////////////////////////
	//* OpenShopping V2.0 
	//* 2015.06.19
	//* Program By : hojin lee 
	//*

	

	// 통화에 따른 가격출력 포맷...
	function _currency_format($currency,$prices){
		if($currency == "KRW") return number_format($prices,0,'.',',')."원";
		else if($currency == "USD") return "$".number_format($prices,2,'.',',');
		else return $prices;

	}

	function _currencyRows_selelct($currency){
		global $css_textbox;

		$query = "select * from `shop_currency`";
		if($rowss = _sales_query_rowss($query)){
			$form_currency = "<select name='currency' style=\"$css_textbox\" >";
		
			for($ii=0;$ii<count($rowss);$ii++){
				$rows1=$rowss[$ii];
				if($currency == $rows1->currency) {
					$form_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$form_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}
			}

			$form_currency .= "</select>";		
		}
		return $form_currency;
	}




















	function _currency_info($currency){
		// 환율 정보를 읽엄옴...	
		/*
		$query = "select * from `shop_currency` WHERE `currency`='$currency'";
		return _mysqli_query_rows($query);
		*/

	}


	function _prices_format($currency,$prices){
		switch($currency){
			case 'KRW':
				$format = "KRW ".number_format($prices,0,'.',',')."원";
				break;
			case 'USD':
				$format = "USD $".number_format($prices,2,'.',',');
				break;
			default: $format = $prices;
		}
		return $format;
	}


	function _prices_USD($currency,$prices){
		$query = "select * from `shop_currency` WHERE `currency`='$currency'";	
		$rows = _mysqli_query_rows($query);

		$usd['currency'] = "USD";
		$usd['prices'] = $prices / $rows->currency_rate;
		$usd['format'] = "$".number_format( $usd['prices'] , 2, '.', ',');

		return $usd;
	}




	function _prices_currency($currency,$prices,$dst){

		$usd = _prices_USD($currency,$prices);

		$query = "select * from `shop_currency` WHERE `currency`='$dst'";	
		$rows = _mysqli_query_rows($query);


		$prices_cur['currency'] = "$dst";
		$prices_cur['prices'] = $usd['prices'] * $rows->currency_rate;


		return $prices_cur;




		/*
		global $slave_dbconnect, $slave_mysql;
		
		
		// 환율 정보를 읽엄옴...	
		$query = "select * from `shop_currency` WHERE `currency`='$currency'";	
		$result=mysql_db_query($slave_mysql[dbname],$query,$slave_dbconnect);
		
		if(mysql_num_rows($result)) {
			$rows=mysql_fetch_array($result);
		
			$usd = $value / $rows[currency_rate];
		} else $usd = 0;
			
		// 		
		$query = "select * from `shop_country` WHERE `code`='".$_SESSION['country']."'";
		// echo $query."<br>";
		$result=mysql_db_query($slave_mysql[dbname],$query,$slave_dbconnect);
		if(mysql_num_rows($result)) {
			$rows = mysql_fetch_array($result);
					
			$query1 = "select * from `shop_currency` WHERE `currency`='$rows[currency]'";
			//echo $query1."<br>";
			$result1=mysql_db_query($slave_mysql[dbname],$query1,$slave_dbconnect);
			if(mysql_num_rows($result)) {
				$rows1=mysql_fetch_array($result1);
				
				$current_prices[currency] = $rows[currency];
				$current_prices[prices] = $usd * $rows1[currency_rate];

				$prices = number_format( $current_prices[prices] , $rows1[dec_point], '.', ',');
				if($rows1[currency_align] == "right") $current_prices[format] =  $prices.$rows1[currency_mark]; 
				else $current_prices[format] = $rows1[currency_mark].$prices;

				$current_prices[mark] = $rows1[currency_mark];
				$current_prices[dec_point] = $rows1[dec_point];
				$current_prices[currency_align] = $rows1[currency_align];

			}
			

			return $current_prices;
		}	

		*/


	}





?>