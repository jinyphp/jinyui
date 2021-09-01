<? header("Content-Type: text/html; charset=UTF-8"); ?>

<a href="?unzip=true">Unzip 실행</a>

<?php
if ($_GET['unzip']) {
	$zip = new ZipArchive;
	if ($zip->open('jinyui.zip') === TRUE) {
		$zip->extractTo('./');
		$zip->close();
		echo '<br><br>배치 성공';
	} else {
		echo '<br><br>배치 실패';
	}
} else {
	phpinfo();
} ?>
