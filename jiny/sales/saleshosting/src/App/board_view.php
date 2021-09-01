<?php
      //*  Openshopping V2.1
  //*  Program by : hojin lee
  //*  

  // update : 2016.01.04 = 코드정리 

  @session_start();
  
  include "./conf/dbinfo.php";
  include "./func/mysql.php";

  include "./func/datetime.php";
  include "./func/file.php";
  include "./func/form.php";
  include "./func/string.php";
  include "./func/javascript.php";
  
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
  include "./func/css.php";



  if($uid = _formdata("uid")){
    
    $board = _formdata("board");
    $body =  _skin_emptybody($skin_name);

    // echo "board is $board";
    $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
    $body = str_replace("<!--{skin_emptybody}-->","
      <center><img src='./images/loading.gif' border='0'></center>
      <script>"._javascript_ajax_html(".mainbody","/ajax_board_edit.php?ajaxkey=".$ajaxkey."&board=".$board."&mode=view&uid=".$uid)."</script>",$body);

    echo $body;

  } else {
    $msg = "계시물 번호가 없습니다.";
    $msg_string = _string($msg,$site_language);
    $body_error = _error_page($skin_name,$msg_string);
    echo $body_error;

  }

  $php_end = get_time();
  $php_time = $php_end - $php_start;
  echo "<!-- Second ".$php_time."-->";
?>