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

	include "./func/error.php";
	
	include "./func/members.php";

	
	$body = _skin_page($skin_name,"sales_myinfo");

	$members = _members_rows($_COOKIE['cookie_email']);

	$body = str_replace("{member_name}",$members->username." ".$members->firstname,$body);
	$body = str_replace("{member_email}",$members->email,$body);

	$body = str_replace("{members_emoney}",$members->emoney,$body);
	$body = str_replace("{members_point}",$members->point,$body);

	$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 	
		$body = str_replace("{order_list}","
					<form name='order' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>
					   <input type='hidden' name='mode' >
					<span id=\"order_list\">
					
					<script>
						$.ajax({
            				url:'/ajax_orderlist.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#order_list').html(data);
            				}
        				});
    				</script>

					</span>
					</form>",$body);


	echo $body;

?>