<?php

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

	$javascript = "<script>
		function check_agree(){
			// alert(\"agree\");

			var chk = document.getElementsByName('agree[]');
       		var agree_all = true;

       		for(var i=0;i<chk.length;i++){
       			if(chk[i].checked == false) agree_all = false;
       		}

       		document.members.chk_all.checked = agree_all;

		}
		

		// 전체동의 버튼
		$('#check_all').on('click',function(){
			agree_chkall();
		});	
       	function agree_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('agree[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.members.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 
	</script>";

	// $body = _skin_page("default","member_agreement");
	$body = _theme_popup($site_env->theme,"members_agreement",$site_language,$site_mobile);

	// 회원약관 및 동의서 부분 출력 처리
	$query = "SELECT * FROM `site_members_agree` WHERE language = '$site_language' and enable = 'on'";
	if($rowss = _mysqli_query_rowss($query)){

		for($i=0;$i<count($rowss); $i++){
			$rows = $rowss[$i];
			$agreement = stripslashes($rows->agreement);
				
			$list .= "<textarea name='agree_$i' rows='10' readonly style='width:100%;margin:-3px;border:2px inset #eee' >$agreement</textarea>";
			$list .= "<br><br>";
			if($rows->require){
				$list .= "동의합니다. <input type='checkbox' name='agree[]' value='".$rows->Id."' onClick=\"javascript:check_agree()\">";
			}
			
			$list .= "<br><br>";
		}

		if(count($rowss)>1){
			$list .= "전체 동의합니다. <input type='checkbox' name='chk_all' value='".$rows->Id."' id=\"check_all\">";
		}
		

		$body = str_replace("{agreement}",$list,$body);

		echo $body.$javascript;

	} else {
		// $body = str_replace("{agreement}",$list,$body);
	}

	
	

?>
