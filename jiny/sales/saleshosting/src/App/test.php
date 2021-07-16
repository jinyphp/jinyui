<?php
	echo "testing...";

	$user = "moon";
	$domain = $user.".dojangshop.com";


	$db_host = "localhost";
	$db_user = "moon";
	$db_password = "1234";
	$db_database = "moon";


	echo "<br>create user directory<br>";
	$command = "sh ./add_sales.sh ".$user;
   	echo $command;
   	exec($command,$output);

   	echo "<br>create db conf <br>";
	$command = "sh ./add_dbconf.sh $db_host $db_database $db_user $db_password > ../$user/conf/dbinfo.php";
   	echo $command;
   	exec($command,$output);

   	echo "<br>create vhost <br>";
   	$command = "sh ./add_vhost.sh $user $domain >> httpd-vhosts.conf";
   	echo $command;
   	exec($command,$output);



?>