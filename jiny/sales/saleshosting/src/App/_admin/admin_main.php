<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	
	include "./func_adminstring.php";
    
	if($_COOKIE[adminemail]){ ///////////////
	
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_main");
		
		$body = str_replace("{adminemail}","<b>".$_COOKIE[adminemail]."</b>",$body);
		
		/*
	 	* Vertical bar chart demonstration
	 	*
	 	*/

		include "./libchart/classes/libchart.php";

		// $chart = new VerticalBarChart();
		$chart = new VerticalBarChart(800, 250);

		$dataSet = new XYDataSet();
		$dataSet->addPoint(new Point("Jan 2005", 273));
		$dataSet->addPoint(new Point("Feb 2005", 421));
		$dataSet->addPoint(new Point("March 2005", 642));
		$dataSet->addPoint(new Point("April 2005", 800));
		$dataSet->addPoint(new Point("May 2005", 1200));
		$dataSet->addPoint(new Point("June 2005", 1500));
		$dataSet->addPoint(new Point("July 2005", 2600));
		$chart->setDataSet($dataSet);

		// $chart->setTitle("Monthly usage for www.example.com");
		$chart->render("access_chart.png");
	
		$body = str_replace("{access_chart}","<img alt='Vertical bars chart' src='access_chart.png' style='border: 1px solid gray;'>",$body);
	
		
		$query = "select * from `shop_member` where regdate >= '$TODAY 00:00:00'";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    	$body = str_replace("{today_new}","$total 명",$body); 
    	$body = str_replace("{yesterday_new}","$total 명",$body);
    	
		$query = "select * from `shop_member` where lastlog >= '$TODAY 00:00:00'";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    	$body = str_replace("{today_visit}","$total 명",$body); 
		$body = str_replace("{yesterday_visit}","$total 명",$body); 
		
		///////////////
		$query = "select * from `shop_log` order by timestamp desc";	
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);

		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			if($total>5) $count = 5; else $count = $total;
			for($i=0;$i<$count;$i++){
				$rows=mysql_fetch_array($result);
				// <td><font size=2>$rows[ref]</font></td>
				$list .= "<table width='100%' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2;'>
				<tr><td width='120' style='border-right:1px solid #D2D2D2; font-size:12px;padding:10px;'>$rows[timestamp]</td>
				<td style='border-right:1px solid #D2D2D2; font-size:12px;padding:10px;'>$rows[addr]</td>
				<td width='20' style='font-size:12px;padding:10px;'>$rows[num]</td></tr>
				</table>";
			}	
			$body = str_replace("{access_log}",$list,$body);
		}


		///////////////
		// 최근본 상품들...
		$query = "select * from `shop_logviews` where regdate = '$TODAY' order by regdate,num desc";	
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);

		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			if($total>5) $count = 10; else $count = $total;
			
			for($i=0,$list="";$i<$count;$i++){
				$rows=mysql_fetch_array($result);
				
				// <td><font size=2>$rows[ref]</font></td>
				
				
				$query1 = "select * from `shop_goods` where Id='$rows[keyword]'";
				$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$rows1=mysql_fetch_array($result1);
				
					//# 언어별 상품정보 읽어옴
					$_language = "goodname_".$_SESSION['language'];
					$_goodname = $rows1[$_language];
				
					$_language = "subtitle_".$_SESSION['language'];
					$_subtitle = $rows1[$_language];
				
					$_language = "spec_".$_SESSION['language'];
					$_spec = $rows1[$_language];
				
					$_language = "optionitem_".$_SESSION['language'];
					$_optionitem = $rows1[$_language];
				}		
				
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2;'>
				<tr><td width='60' style='border-right:1px solid #D2D2D2; font-size:12px;padding:10px;'>$rows[regdate]</td>
				<td style='border-right:1px solid #D2D2D2; font-size:12px;padding:10px;'>$_goodname</td>
				<td width='20' style='font-size:12px;padding:10px;'>$rows[num]</td></tr>
				</table>";
			}	
			$body = str_replace("{access_logviews}",$list,$body);
		}



		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";

?>
