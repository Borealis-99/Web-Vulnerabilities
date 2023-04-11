<?php
	session_start();
	if ($_SESSION['login'] == null)
	{
		header("Location: admin.php");
		exit;
	}
	if (!isset($_COOKIE['admin'])) {
	   setcookie('admin', 'false');
	   $_COOKIE['admin'] = 'false';
	   echo '
<html>
<head><title>404 Not Found</title></head>
<body bgcolor="white">
<center><h1>404 Not Found</h1><p>Have you played <a href="http://34.172.25.117/" target="_blank">Eval Homer yet?</a></p></center>
<hr><center>nginx/1.14.12</center>
</body>
</html>
<!-- Hmmm, the plot thickens... key{84899047fe18310deb29c826bf4ff00c2c37b6533bacd1f8e5078ad475790738}-->';
     }
     elseif (isset($_COOKIE['admin']) && strcmp($_COOKIE['admin'], 'true') == 0) {
     	    echo "<!DOCTYPE html><html><head><title>Main</title></head><body><p>Congratulations! Here you go: key{a1591d1210b06e2c24e75b3f0ff6e568707b51f108a697126e112e654bc48267}</p></body></html>";
     }
     else {
                echo '
<html>
<head><title>404 Not Found</title></head>
<body bgcolor="white">
<center><h1>404 Not Found</h1><p>Have you played <a href="http://34.172.25.117/" target="_blank">Eval Homer yet?</a></p></center>
<hr><center>nginx/1.14.12</center>
</body>
</html>
<!-- Hmmm, the plot thickens... key{84899047fe18310deb29c826bf4ff00c2c37b6533bacd1f8e5078ad475790738}-->';}
?>
