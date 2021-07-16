
<form enctype="multipart/form-data" action="curl_test.php" method="POST">  
    upload: <input name="images" type="file" />  <input type="submit" value="upLoad" /> </form>

<?


	if($_FILES['images']['tmp_name']) {
		
		$url = "http://api.saleshosting.co.kr/curl_upload.php";
		echo "prepare file temp_name : ".$_FILES['images']['tmp_name']."<br>";
		echo "prepare file name : ".$_FILES['images']['name']."<br>";
		echo "prepare file name : ".$_FILES['images']['type']."<br>";

    	//$filename = $_FILES['images']['tmp_name']; 
    	//$handle = fopen($filename, "r"); 
    	//$data = base64_encode(fread($handle, filesize($filename))); 

		// Create a CURLFile object
		$cfile = new CURLFile($_FILES['images']['tmp_name'],$_FILES['images']['type'],$_FILES['images']['name']);



    	$ch = curl_init(); 
    	
		$post = array('myimages' => $cfile);
		
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

		$response = curl_exec($ch);
			
		if($response = true){
			$msg = "file upload";
		} else {
			$msg = "Error: ".curl_error($ch);
		}

		echo $msg;
		curl_close($ch);

	} 


	echo "------------------<br>";
	echo "";


?>    