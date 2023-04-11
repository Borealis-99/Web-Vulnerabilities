<!DOCTYPE html>

<?php
	if (!empty($_GET["secret"])) {
		$secret = $_GET["secret"];
		if ($secret== 'Homer') {
			$str = '<p><video src="homer.mp4" autoplay></video></p>';
		}
		else {
			$str = "<h1>Invalid secret..." . eval($secret) . "</h1>";
		}
	}
?>
<html>
<head>
<title>Homer</title>
</head>

<body>
	<h1>Homer</h1>
	<div id="results">
		<p>Set the <code>secret</code> parameter in query string to be "Homer" (without the double-quotes)</p>
	<?php
		if (isset($str)) {
			echo "$str";
		}
	?>
	</div>
</body>
</html>
