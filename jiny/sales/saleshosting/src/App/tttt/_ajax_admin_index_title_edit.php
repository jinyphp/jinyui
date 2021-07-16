<?

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	include "./func/skin.php";
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";


	if(isset($_SESSION['language'])){
		$site_language = $_SESSION['language'];
	} else {
		$site_language = "ko";
	}

	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}

	if(isset($_COOKIE['cookie_email'])){
		$cookie_email = $_COOKIE['cookie_email'];
	} else {
		$cookie_email = "";
	}



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		//include "./sales.php";

    	$mode = _formmode();
		echo "mode is $mode <br>";
		$uid = _formdata("uid");
		echo "uid is $uid <br>";
		$ajaxkey = _formdata("ajaxkey");


		$body = _skin_page($skin_name,"site_index_title_edit");

		$eid = _formdata("eid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _mysqli_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);

		//////////////////
		if($uid){
			$query = "select * from `site_index_title` where Id =$uid";
			$rows = _mysqli_query_rows($query);
		}

		$css = "cssFormStyle";
		// 활성화 여부 체크 
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{pos}",_form_text("pos",$rows->pos,$css),$body);
		$body = str_replace("{code}",_form_text("code",$rows->code,$css),$body);

		$body = str_replace("{url}",_form_text("url",$rows->url,$css),$body);
		$body = str_replace("{alt}",_form_text("alt",$rows->alt,$css),$body);

		$body = str_replace("{images}",_form_file("userfile1",$css),$body);
		if($rows->images){
			$body = str_replace("{images_files}",$rows->images,$body);	
		} else $body = str_replace("{images_files}","등록됨 파일이 없습니다.",$body);
		// javascript:form_title_submit(
		// javascript:form_title_submit(
		// site_index.php 파일에 정의됨
		$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_title_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_title_submit('delete','".$uid."')\" id=\"".$btn_style_gray."\" >",$body);

		echo $body;

		
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>