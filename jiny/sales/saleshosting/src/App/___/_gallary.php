<?
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


	$body =  _skin_body($skin_name,"gallary");


	$header_script ="<link rel=\"stylesheet\" href=\"./css/normalize.css\">
		<link rel=\"stylesheet\" href=\"./05/css/colorbox.css\">
		<link rel=\"stylesheet\" href=\"./05/css/main.css\">
		<script src=\"./js/modernizr.custom.min.js\"></script>
		<script src=\"./js/jquery-ui-1.10.3.custom.min.js\"></script>
		<script src=\"./js/jquery.ba-throttle-debounce.min.js\"></script>
		<script src=\"./js/imagesloaded.pkgd.min.js\"></script>
		<script src=\"./js/masonry.pkgd.min.js\"></script>
		<script src=\"./js/jquery.colorbox-min.js\"></script>";

	$body = str_replace("</head>",$header_script."</head>",$body); 

	// 갤러리 스크립트 
	$javascript ="<script src=\"./js/gallery.js\"></script>";
	$body = str_replace("</head>",$javascript."</head>",$body); 

	$gallary_filter ="
	<header class='page-header\" role=\"banner\">
    <div class=\"inner clearfix\">
        <form class=\"filter-form\" id=\"gallery-filter\">
            <span class=\"form-item\">
                <input type=\"radio\" name=\"filter\" id=\"filter-all\" value=\"all\" checked>
                <label for=\"filter-all\">All</label>
            </span>
            <span class=\"form-item\">
                <input type=\"radio\" name=\"filter\" id=\"filter-people\" value=\"people\">
                <label for=\"filter-people\">People</label>
            </span>
            <span class=\"form-item\">
                <input type=\"radio\" name=\"filter\" id=\"filter-animals\" value=\"animals\">
                <label for=\"filter-animals\">Animals</label>
            </span>
            <span class=\"form-item\">
                <input type=\"radio\" name=\"filter\" id=\"filter-nature\" value=\"nature\">
                <label for=\"filter-nature\">Nature</label>
            </span>
            <span class=\"form-item\">
                <input type=\"radio\" name=\"filter\" id=\"filter-plantes\" value=\"plantes\">
                <label for=\"filter-plantes\">Plantes</label>
            </span>
            <span class=\"form-item\">
                <input type=\"radio\" name=\"filter\" id=\"filter-architects\" value=\"architects\">
                <label for=\"filter-architects\">Architects</label>
            </span>
        </form>
    </div>
	</header>";


	$ajaxkey = _formdata("ajaxkey");
	$gallary_code = "./data/content.json";
	$body = str_replace("{formstart}","<form name='gallery' method='post' enctype='multipart/form-data'>
										<input type='hidden' name='gallary_code' value='$gallary_code' id=\"gallary_code\">
										<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
	$body = str_replace("{formend}","</form>",$body);

	$gallary_body = "
	<div class=\"page-main\" role=\"main\">
    	<ul class=\"gallery\" id=\"gallery\"></ul>
    	<button class=\"load-more\" id=\"load-more\">Load more</button>
	</div>";

	$body = str_replace("{gallary}",$gallary_body,$body);


	echo $body;

?>