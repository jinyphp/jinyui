<?	
	include "./func_curl.php";
	
	// echo _curl_get_content("http://www.dojangshop.co.kr/admin/test2.php");
	$body = fetch_page("http://www.dojangshop.co.kr/admin/test2.php","name=hojinlee&password=1234",$cookies,$referer_url);
	
	//echo $body."<br><br>";
	
	$json = explode("\n",$body);

	for($i=0;$i<count($json)-1; $i++) {
		$rows = json_decode($json[$i],true);
		// echo "======================<br>";
	
		echo "$i regdate = $rows[regdate], <img src='$rows[images]' border=0 width='100'> $rows[sell_prices] <br>";
	}
    
?>
