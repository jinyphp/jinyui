<?php



	function _menu($code){

		$query = "select * from `site_menu` where code='default' and enable = 'on' order by pos asc";
		if($rowss = _sales_query_rowss($query)){
			$menubar = "<div id='cssmenu' class='align-center'>\n";
			$menubar .= "<ul>\n";
			
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];
				
				$menuname = $rows->menu;

				$query1 = "select * from `site_menu` where code='$code' and ref = '".$rows->Id."' and pos > '".$rows->pos."'"; 
				// $result1=mysql_db_query($master_mysql[dbname],$query1,$master_dbconnect);
				if(  _sales_query_rows($query1)  ) $menubar .= "<li class='has-sub'>"; else $menubar .= "<li>";

				$menubar .= "<a href='".$rows->url."'>$menuname</a>"; 

				// 서브메뉴가 있는경우 <UL> 추가...
				$query1 = "select * from `site_menu` where code='$code' and ref = '".$rows->Id."' and pos > '".$rows->pos."'"; 
				// $result1=mysql_db_query($master_mysql[dbname],$query1,$master_dbconnect);
				if(  _sales_query_rows($query1)  )	{
					$menubar .= "\n<ul>\n";
				} else {
					$query1 = "select * from `site_menu` where code='$code' and ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
					// $result1=mysql_db_query($master_mysql[dbname],$query1,$master_dbconnect);
					if( _sales_query_rows($query1) ) $menubar .= "</li>\n";	else $menubar .= "\n</ul>\n </li>\n";
				}
				
			}
			
			$menubar .= "</ul>\n";
			$menubar .= "</div>";

			}
			
			return $menubar;
		}	
	}


	function _menu_css($code){

		$query = "select * from `site_menu_setting` where code = 'default'";	
		if($rowss = _sales_query_rowss($query)){
		
			// 메뉴바 배경색
			if($rows->menu_bgcolor) $menu_bgcolor = $rows->menu_bgcolor; else $menu_bgcolor = "#6d6d6d"; // #141414
			if($rows->menu_border_bgcolor) $menu_border_bgcolor = $rows->menu_border_bgcolor; else $menu_border_bgcolor = "#474747"; // #333333
			if($rows->menu_border_bottom) $menu_border_bottom = $rows->menu_border_bottom; else $menu_border_bottom = "#0fa1e0"; // #0fa1e0
		
			if($rows->menu_radius) $menu_radius = $rows->menu_radius."px"; else $menu_radius = "0px"; // #0fa1e0

			// 메뉴바 선택시 배경색
			if($rows->menu_font_bgcolor) $menu_font_bgcolor = $rows->menu_font_bgcolor; else $menu_font_bgcolor = "#474747"; // #141414
			if($rows->menu_color) $menu_color = $rows->menu_color; else $menu_color = "#ffffff"; // #141414
			if($rows->menu_fontsize) $menu_fontsize = $rows->menu_fontsize; else $menu_fontsize = "12px"; // #141414

			if($rows->menu1_font_bgcolor) $menu1_font_bgcolor = $rows->menu1_font_bgcolor; else $menu1_font_bgcolor = "#31b7f1"; // #141414
			if($rows->menu1_color) $menu1_color = $rows->menu1_color; else $menu1_color = "#ffffff"; // #141414
			if($rows->menu1_font_bgcolor1) $menu1_font_bgcolor1 = $rows->menu1_font_bgcolor1; else $menu1_font_bgcolor1 = "#31b7f1"; // #141414
			if($rows->menu1_color1) $menu1_color1 = $rows->menu1_color1; else $menu1_color1 = "#ffffff"; // #141414

			// 메뉴바 선택시 배경색
			if($rows->menu_font_bgcolor1) $menu_font_bgcolor1 = $rows->menu_font_bgcolor1; else $menu_font_bgcolor1 = "#474747"; // #141414
			if($rows->menu_color1) $menu_color1 = $rows->menu_color1; else $menu_color1 = "#ffffff"; // #141414

		// CSS 메뉴 CSS http://cssmenumaker.com/
		/*
		$menu_css = "
   		<style type=\"text/css\"> 
		<!--";
		*/

		$menu_css .= "
		#cssmenu ul,
		#cssmenu li,
		#cssmenu span,
		#cssmenu a {
			margin: 0;
			padding: 0;
  			position: relative;
		}";
		
		

		$menu_css .= "	
		#cssmenu {
  		line-height: 1;
  		border-radius: $menu_radius $menu_radius 0 0;
  		-moz-border-radius: $menu_radius $menu_radius 0 0;
  		-webkit-border-radius: $menu_radius $menu_radius 0 0;
  		background: $menu_bgcolor;";

  		if($rows->menu_bgcolor_gradient){
  		$menu_css .= "
  		background: -moz-linear-gradient(top, $menu_border_bgcolor 0%, $menu_bgcolor 100%);
  		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, $menu_border_bgcolor), color-stop(100%, $menu_bgcolor));
  		background: -webkit-linear-gradient(top, $menu_border_bgcolor 0%, $menu_bgcolor 100%);
  		background: -o-linear-gradient(top, $menu_border_bgcolor 0%, $menu_bgcolor 100%);
  		background: -ms-linear-gradient(top, $menu_border_bgcolor 0%, $menu_bgcolor 100%);
  		background: linear-gradient(to bottom, $menu_border_bgcolor 0%, $menu_bgcolor 100%);";
  		}

  		// 메뉴 밑줄
  		
  		if($rows->bottom){
  			$menu_css .= "border-bottom: $rows[bottom_px]px solid $rows[bottom_color];";
  		}
		

  		$menu_css .= "
  		width: auto;
		}";
		

		///

		$menu_css .= "	
		#cssmenu:after,
		#cssmenu ul:after {
  		content: '';
  		display: block;
  		clear: both;
		}";




		

		$menu_css .= "
		#cssmenu a {
		background: $menu_font_bgcolor;";

		if($rows->menu_font_bgcolor_gradient){
		$menu_css .= "
		background: -moz-linear-gradient(top, $menu_border_bgcolor 0%, $menu_font_bgcolor 100%);
 		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, $menu_border_bgcolor), color-stop(100%, $menu_font_bgcolor));
		background: -webkit-linear-gradient(top, $menu_border_bgcolor 0%, $menu_font_bgcolor 100%);
		background: -o-linear-gradient(top, $menu_border_bgcolor 0%, $menu_font_bgcolor 100%);
		background: -ms-linear-gradient(top, $menu_border_bgcolor 0%, $menu_font_bgcolor 100%);
		background: linear-gradient(to bottom, $menu_border_bgcolor 0%, $menu_font_bgcolor 100%);";
		}

		$menu_css .= "
		color: $menu_color;
		display: block;
		font-family: Helvetica, Arial, Verdana, sans-serif;
		padding: 14px 14px;
		text-decoration: none;
		}";

		///


		$menu_css .= "
		#cssmenu ul { list-style: none; }
		#cssmenu > ul > li { display: inline-block; float: left; margin: 0; }";


		if($rows->menu_align) 
			$menu_css .="#cssmenu .align-center { text-align: $rows[menu_align]; }"; 
		else $menu_css .="#cssmenu .align-center { text-align: left; }";


			// 서브 메뉴바 선택시 배경색
	



		$menu_css .="
		#cssmenu .align-center > ul > li { float: none; }
		#cssmenu .align-center ul ul { text-align: left; }
		#cssmenu .align-right > ul { loat: right; }
		#cssmenu.align-right ul ul { text-align: right; }

		#cssmenu > ul > li > a {
  			color: $menu_color; /* 비선택시 글자 색상 */
  			font-size: $menu_fontsize;
		}";

		if($rows->bottom){
			if($rows->bottom_mark){
			$menu_css .="
			#cssmenu > ul > li:hover:after {
  			content: '';
  			display: block;
  			width: 0;
  			height: 0;
  			position: absolute;
  			left: 50%;
  			bottom: 0;
  			border-left: 10px solid transparent;
  			border-right: 10px solid transparent;
  			border-bottom: 10px solid $rows[bottom_color];
  			margin-left: -10px;
			}";
			}
		}

		$menu_css .="
		#cssmenu > ul > li:first-child > a {
  			border-radius: 5px 0 0 0;
  			-moz-border-radius: 5px 0 0 0;
  			-webkit-border-radius: 5px 0 0 0;
		}

		#cssmenu .align-right > ul > li:first-child > a,
		#cssmenu .align-center > ul > li:first-child > a {
  			border-radius: 0;
  			-moz-border-radius: 0;
  			-webkit-border-radius: 0;
		}

		#cssmenu .align-right > ul > li:last-child > a {
  			border-radius: 0 5px 0 0;
  			-moz-border-radius: 0 5px 0 0;
  			-webkit-border-radius: 0 5px 0 0;
		}";


		

		$menu_css .="
			#cssmenu > ul > li.active > a,
			#cssmenu > ul > li:hover > a {
  			color: $menu_color1;
  			/*
  			box-shadow: inset 0 0 3px #000000;
  			-moz-box-shadow: inset 0 0 3px #000000;
  			-webkit-box-shadow: inset 0 0 3px #000000;
  			*/
  			background: $menu_font_bgcolor1;
  			/*
  			background: -moz-linear-gradient(top, #262626 0%, $menu_font_bgcolor1 100%);
  			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #262626), color-stop(100%, $menu_font_bgcolor1));
  			background: -webkit-linear-gradient(top, #262626 0%, $menu_font_bgcolor1 100%);
  			background: -o-linear-gradient(top, #262626 0%, $menu_font_bgcolor1 100%);
  			background: -ms-linear-gradient(top, #262626 0%, $menu_font_bgcolor1 100%);
  			background: linear-gradient(to bottom, #262626 0%, $menu_font_bgcolor1 100%);
  			*/
		}

		#cssmenu .has-sub {
  			z-index: 600;
		}

		#cssmenu .has-sub:hover > ul {
  			display: block;
		}

		#cssmenu .has-sub ul {
  			display: none;
  			position: absolute;
  			width: 200px;
  			top: 100%;
  			left: 0;
		}

		#cssmenu .align-right .has-sub ul {
  			left: auto;
  			right: 0;
		}

		#cssmenu .has-sub ul li {
  			*margin-bottom: -1px;
		}

	#cssmenu .has-sub ul li a {
  		background: $menu1_font_bgcolor; /* 서브메뉴 배경색 */
  		border-bottom: 1px dotted #31b7f1;
  		font-size: $menu_fontsize;
  		filter: none;
  		display: block;
  		line-height: 120%;
  		padding: 10px;
  		color: $menu1_color; 
	}";






	$menu_css .="
	#cssmenu .has-sub ul li:hover a {
  		background: $menu1_font_bgcolor1;
	}

	#cssmenu ul ul li:hover > a {
  		color: $menu1_color1;
	}

	#cssmenu .has-sub .has-sub:hover > ul {
  		display: block;
	}

	#cssmenu .has-sub .has-sub ul {
  		display: none;
  		position: absolute;
  		left: 100%;
  		top: 0;
	}

	#cssmenu .align-right .has-sub .has-sub ul,
	#cssmenu .align-right ul ul ul {
  		left: auto;
  		right: 100%;
	}


	#cssmenu .has-sub .has-sub ul li a {
  		background: #0c7fb0;
  		border-bottom: 1px dotted #31b7f1;
	}
	

	#cssmenu .has-sub .has-sub ul li a:hover {
  		background: #0a6d98;
	}

	#cssmenu ul ul li.last > a,
	#cssmenu ul ul li:last-child > a,
	#cssmenu ul ul ul li.last > a,
	#cssmenu ul ul ul li:last-child > a,
	#cssmenu .has-sub ul li:last-child > a,
	#cssmenu .has-sub ul li.last > a {
  	border-bottom: 0;
	}";

	
		return $menu_css;

	}

?>