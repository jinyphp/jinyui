<?

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	// Sales 사용자 DB 접근.
	include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


	$javascript = "<script>
		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});
    </script>";

	if($site_mobile == "m") $width = "300px"; else $width = "854px"; 		

	$title = "동영상 메뉴얼 ";
	$body = $javascript._popup_body( $title, $width, $msg );
	echo $body;

	$code = _formdata("code");
	$query = "select * from `manual_video` where code = '$code'"; // echo $query."<br>";
    if($rows= _mysqli_query_rows($query)){
    	//echo "<iframe width=\"854\" height=\"480\" src=\"https://www.youtube.com/embed/TTDtC9CKZpQ\" frameborder=\"0\" allowfullscreen></iframe>";
    	echo stripslashes($rows->html);
    }		
	

?>