<!DOCTYPE>
<head>
	<head>
		<title>Message Board</title>
		<meta charset="utf-8">
		<link rel="alternate stylesheet" type="text/css" href="site_burichan.css" title="Burichan" />
		<link rel="alternate stylesheet" type="text/css" href="site_futaba.css" title="Futaba" />
		<link rel="stylesheet" type="text/css" href="site_kusabax.css" title="Kusabax" />
	</head>

	<body>

	<?php
		$myUserName = "ctf2023board";
		$myPassword = 'WeLoveToParty';
		$myDatabase = "board";
		$myHost = "localhost";
		$db = mysqli_connect($myHost, $myUserName, $myPassword) or die ('I cannot connect to the database because: ' . mysqli_error($db));		
		mysqli_select_db($db, $myDatabase) or die("Unable to select database");
		$query = "";		

		$id = $_GET["id"];
		if (!empty($_POST)) {
			if (!empty($_POST['title']) && !empty($_POST['post'])) {
				$query = "INSERT INTO posts (title, post, active, updated_at) VALUES ('" . mysqli_real_escape_string($db, $_POST['title']) . "', '" . mysqli_real_escape_string($db, $_POST['post']) . "', 1, NOW())";
			}
			elseif (!empty($_POST['comments']) && !empty($_POST["post_id"])) {
				$query = "INSERT INTO replies (comments, post_id, active, updated_at) VALUES ('" . mysqli_real_escape_string($db, $_POST['comments']) . "', " . $_POST["post_id"] . ", 1, NOW())";
			}
			mysqli_query($db, $query);
		}
		if (empty($id)) {
			echo '<div id="header"><h1><img id="logo" src="/wp-content/uploads/2022/10/logo.jpg" /><br/>Message Board</h1></div>';
			echo '<h3><a href="board.php">Home</a> | <a href="admin.php">Administration</a></h3>';
			echo '<form id="posting" method="post">';
			echo '<h4>New Post</h4>';
			echo '<p>Title: <input type="text" name="title" /></p>';
			echo '<p>Post: <textarea name="post"></textarea></p>';
			echo '<p><input type="submit"></p>';
			echo '</form>';
			$query = "SELECT * FROM posts WHERE active = 1 AND id > 0 ORDER BY id DESC";
			$myResult = mysqli_query($db, $query);
			while ($row = mysqli_fetch_array($myResult)) {
				echo '<h2><a href="board.php?id=' . $row["id"] . '">' . $row["title"] . "</a></h2>\n";
				echo "<p>" . $row["post"] . "</p>\n";
	                }
		}
		else {
			echo '<div id="header"><h1 id="logo">Message Board</h1></div>';
			echo '<form id="reply" method="post">';
			echo '<input type="hidden" name="post_id" value="' . $id . '"/>';
			echo '<h4>Reply</h4>';
			echo '<p>Comments: <textarea name="comments"></textarea></p>';
			echo '<p><input type="submit"></p>';
			echo '</form>';
			$query = "SELECT * FROM posts WHERE active = 1 AND id = $id";
			$myResult = mysqli_query($db, $query);
			while ($row = mysqli_fetch_array($myResult)) {
				echo '<h2><a href="board.php?id=' . $row["id"] . '">' . $row["title"] . "</a></h2>\n";
				echo "<p>" . $row["post"] . "</p>\n";
	                }
			$query = "SELECT * FROM replies WHERE active = 1 AND post_id = $id ORDER BY updated_at";
			$myResult = mysqli_query($db, $query);
			while ($row = mysqli_fetch_array($myResult)) {
				echo "<p>Replied on " . $row["updated_at"] . ": " . $row["comments"] . "</p>\n";
	                }
		}
		mysqli_close($db);
	?>
	<div id="footer">
		<hr/>
		<h3><a href="board.php">Home</a> | <a href="admin.php">Administration</a></h3>
	</div>
	</body>
</head>
