<?php
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";
	
	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";


	//$skin_name = "default";
	//$body = _skin_body("default","category");
	$body = _theme_page($site_env->theme,"category",$site_language,$site_mobile);
		
		$query = "select * from `shop_cate` where enable='on' order by pos desc";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$cate_cols = 4;
			$k=1;
			$width = 100 / $cate_cols;
			$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td width='$width%' valign='top' style='border-right:1px solid #E9E9E9;'>";
			$level=0;
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				if($i>0 && $rows->level == 0) {
					$list .= "</td>";
					
					if($k%$cate_cols  == 0) {
						$list .= "</tr>";
						for($j=0;$j<$cate_cols;$j++) $list .= "<td style='border-bottom:1px solid #E9E9E9;' height='5'></td>";
						$list .= "<tr>";
					}
						
					$k++;
					$list .= "<td width='$width%' valign='top' style='border-right:1px solid #E9E9E9;'>";
				}
				for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";

				$name = json_decode($rows->title);
			
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
							<tr><td style='font-size:12px;padding:5px;'>$LevelSpace";

				if($rows->level == 0 ) $list .= "<b>>> <a href='goodlist.php?cate=".$rows->Id."'>".$name->$site_language."</a></b>"; 
				else $list .= "<a href='goodlist.php?cate=".$rows->Id."'>".$name->$site_language."</a>";

				$list .= "</td></tr>
						  </table>";
			}

			$count = $cate_cols  - $k/$cate_cols ;
			$k++;
			for($a=0;$a<($count+1);$a++,$k++){
				$list .= "</td><td width='$width%' valign='top' style='border-right:1px solid #E9E9E9;'>";
			}

			// echo $list;
			$list .= "</td></tr></table>";
			$body = str_replace("{category_list}",$list,$body);

		} else {
			$msg = "카테고리가 없습니다.";
			$body = str_replace("{category}",$msg,$body);
		}
	

	echo $body;	

?>