<?php

	@session_start();

	include "./saleshosting/conf/dbinfo.php";
	include "./saleshosting/func/mysql.php";

	include "./saleshosting/func/file.php";
	include "./saleshosting/func/form.php";

	include "./saleshosting/func/datetime.php";


	$email = _formdata("email");
	$query = "select * from `service_host` WHERE email = '$email'";
	echo $query."<br>";
	if($users = _mysqli_query_rows($query)){

		echo "Create New user"."<br>";
		echo "--- ".$users->database." ----"."<br>";

		if($users->database){
			$user_code = $users->database;

			//
			// 기본 디렉토리 생성
			//
			echo "Creating User directory <br>";
			_is_path("./".$user_code ."/theme");	echo "/theme"."<br>";
			_is_path("./".$user_code ."/data");		echo "/data"."<br>";
			_is_path("./".$user_code ."/images");	echo "/images"."<br>";
			_is_path("./".$user_code ."/goods");	echo "/goods"."<br>";
			_is_path("./".$user_code ."/orders");	echo "/orders"."<br>";
			_is_path("./".$user_code ."/gallary");	echo "/gallary"."<br>";
			_is_path("./".$user_code ."/board");	echo "/board"."<br>";
			_is_path("./".$user_code ."/curl");		echo "/curl"."<br>";
			_is_path("./".$user_code ."/func");		echo "/func"."<br>";
			_is_path("./".$user_code ."/conf");		echo "/conf"."<br>";

			_is_path("./".$user_code ."/resales");	echo "/resales"."<br>";
			_is_path("./".$user_code ."/shop");		echo "/shop"."<br>";
			_is_path("./".$user_code ."/api");		echo "/api"."<br>";



			//
			//
			//
			echo "Creating database files : dbinfo.php<br>";
$dbinfo = "<?\n
	// Openshopping 2.1
	// $user_code : Mysql DB 접속 정보
	// $TODAYTIME

	$"."mysql_host = \"localhost\";\n
	$"."mysql_database = \"$user_code\";\n
	$"."mysql_user = \"vidacar\";\n
	$"."mysql_password = \"hj236889\";\n
	
\n?>";
			_file_save("./".$user_code ."/conf/dbinfo.php",$dbinfo);


			//
			//
			//

			echo "--- file copyes ---"."<br>";
			exec("ln -s /home/wwwhtml/saleshosting/*.php /home/wwwhtml/$user_code/",$output);

			_is_path("./".$user_code ."/func");		echo "/func"."<br>";
			exec("ln -s /home/wwwhtml/saleshosting/func/*.php /home/wwwhtml/$user_code/func/",$output);

			_is_path("./".$user_code ."/css");		echo "/css"."<br>";
			exec("ln -s /home/wwwhtml/saleshosting/css/* /home/wwwhtml/$user_code/css/",$output);

			_is_path("./".$user_code ."/js");		echo "/js"."<br>";
			exec("ln -s /home/wwwhtml/saleshosting/js/* /home/wwwhtml/$user_code/js/",$output);



			$database = "dojangshop";
			$database_target = $users->database;
   			if( $database_target ){
    			echo "--- Checking Database ---"."<br>";
    	
    			if(_mysqli_is_database($database_target)){
   					echo "Database : ".$database_target."<br>";
   				} else {
   					echo "Create : $database_target"."<br>";
   					_mysqli_database_create($database_target);
   				}

   				echo "--- Checking Tables ---"."<br>";

   				$query = "show tables from $database";
				if($rowss = _mysqli_query_rowss($query)){
					for($i=0;$i<count($rowss);$i++){
						$rows = $rowss[$i];
			
						$filedname = "Tables_in_".$database;
						echo "$i : Tables = ".$rows->$filedname;
						$table_name = $rows->$filedname;

						if(_mysqli_is_table($database_target,$table_name)){
							echo "<br>"; 	
						} else {
							echo " >> Creating... <br>";
							_mysqli_table_create($database_target,$table_name);
						}
			
						$query1 = "SHOW COLUMNS FROM ".$table_name;
						if($rowss1 = _mysqli_query_rowss($query1)){
							for($j=0;$j<count($rowss1);$j++){
								$rows1 = $rowss1[$j];
								$filed_name = $rows1->Field;
								$filed_type = $rows1->Type;
								echo "* ".$rows1->Field."(".$rows1->Type.")<br>";
								if($filed_name != "Id") _mysqli_table_alter($database_target,$table_name,$filed_name,$filed_type);
							}
						}
			
						echo "<br>";
					}

				} else {
					echo "--- Error : can't find source database ----"."<br>";
				}

    		} else {
    			echo "--- Error : database is not define ----"."<br>";
    		}



		} else {
			echo "can't find database code.";
		}

	} else {
		echo "can't find $email users.";
	}


	echo "////// Finish /////////";



?>