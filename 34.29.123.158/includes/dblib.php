<?php
	$myUserName = 'ctf2023board';
	$myPassword = 'WeLoveToParty';
	$myDBName = 'board';
	$myHost = 'localhost';
	$db = mysqli_connect($myHost, $myUserName, $myPassword);
	if (!$db) {
		die('Cannot connect to the database: ' . mysqli_error($db));
	}
	else {
		mysqli_select_db($db, $myDBName) or die("Unable to select database");
	}


	function getDB() {
		global $db;
		return $db;
	}

	function getLogin ($login, $password) {
		global $db;
		$result = mysqli_query($db, "SELECT id FROM users WHERE password = SHA1('" . $password . "') and login = '" . $login . "'");
		if (!$result) {
			$message  = 'Invalid query: ' . mysqli_error($db) . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		else {
			$row = array();
			$row = mysqli_fetch_array($result);
			if (!empty($row)) {
				return $row;
			}
		}
		mysqli_free_result($result);
		return false;
	}
?>
