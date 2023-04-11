<!DOCTYPE html>

<html>
<head>
<title>2023 CTF Scoreboard</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<style>
body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:16px;background-color:#fff}h1,h2,h3,h4,p{text-align:center}.points{color:#f0f}.error{color:red}.success{color:green}table{margin-left:auto;margin-right:auto}tr,td,th{border-style:groove}th{font-style:italic}
</style>
</head>

<body>
<h1>2023 CTF Scoreboard</h1>
<?php
    $deduction = -100;
    $actualtampertoken = "skymanatees";
    // Your team's submission key to the CTF game is: 
    $submitkeys = array('oOsISYEr', 'idiYDwG2', '4a13Zp5Q', 'SaZhTuNU', 'cxDLqbjb', 'At3V3O4B', 'Uxvmx8h4', 'DbiqfTTl', 'ASKICbli', 'HfvFPFRN', 'qp5AMM40', 'vBw9MDAc', '5Vso8nRn', 'ip7kq2aS', 'hW8Gutkq', 'P5SbOjp3', 'h8kioQWu', 'gMiNxUvN', 'GRsg6rAC', 'bHzeqE6U', 'ctoXjFhb', 'vS3o84IJ', 'nEDxOAuM', 'yWawA2kD', 'RWkd4ixn', 'Zv3UMm28', 'jx2cNd72', 'b42UuQaf', 'AL3yfaGP', 'nqSge3yY', 'yellowroseoftexas');
    $error = false;
    $success = false;
    $tamper = false;
    if (!empty($_POST)) {
        $submittampertoken = $_POST["tampertoken"];
        $submitkey = $_POST["submitkey"];
        $submitflag = $_POST["submitflag"];
        
        // Check if the submit key is legitimate
        if (in_array($submitkey, $submitkeys)) {
            $team_id = array_search($submitkey, $submitkeys) + 1;
            $myUserName = "ctf2023scoreboard";
            $myPassword = 'WeLoveToParty';
            $myDatabase = "scoreboard";
            $myHost = "localhost";
            $db = mysqli_connect($myHost, $myUserName, $myPassword) or die ('I cannot connect to the database because: ' . mysqli_error($db));		
            mysqli_select_db($db, $myDatabase) or die("Unable to select database");
            
            // Check if the flag is legitimate
            $query = "SELECT id, points FROM ctf_flags WHERE flag = '" . mysqli_real_escape_string($db, $submitflag) . "'";
            $myResult = mysqli_query($db, $query);
            $row1 = mysqli_fetch_array($myResult);
            if (empty($row1)) {
                $error = true;
            }
            else {
                $flagid = $row1["id"];
                $points = $row1["points"];
                
                // Check that this is not a duplicate submission
                $query = "SELECT id FROM ctf_scoreboard WHERE team_number = $team_id AND flag_id = $flagid";
                $myResult = mysqli_query($db, $query);
                $row2 = mysqli_fetch_array($myResult);
                if (!empty($row2)) {
                    $error = true;
                }
                else {
                
                    // Check for tampering
                    if ($submittampertoken == $actualtampertoken) {
                        $query = "INSERT INTO ctf_scoreboard (team_number, flag_id, points, added_on) VALUES ($team_id, $flagid, $points, NOW())";
                        $myResult = mysqli_query($db, $query);
                        $success = true;
                    }
                    else {
                        $query = "INSERT INTO ctf_scoreboard (team_number, flag_id, points, added_on) VALUES ($team_id, 0, $deduction, NOW())";
                        $myResult = mysqli_query($db, $query);
                        $tamper = true;
                    }
                }
            }
            mysqli_close($db);
        }
        else {
            $error = true;
        }
    }
    
    if ($tamper) {
        echo '<h2 class="error">100 points have been deducted as tamper token was tampered with!</h2>';
    }
    elseif ($error) {
        echo '<h2 class="error">Sorry, your submission was incorrect.</h2>';
    }
    elseif ($success) {
        echo '<h2 class="success">Nice work!</h2>';
    }
?>
<h2>Notes</h2>
<h2>Challenges</h2>
<p>Challenge 1: ROTten to the Core. <span class="points">100 points</span></p>
<p>Challenge 2: I hope I didn't make this too easy: another flag is on the blog. <span class="points">250 points</span></p>
<p>Challenge 3: .git the FLAG. <span class="points">150 points</span></p>
<p>Challenge 4: All your base64 are belong to us. <span class="points">300 points</span></p>
<p>Challenge 5: Don't ask me if something looks wrong.  Look again, pay careful attention. <span class="points">200 points</span></p>
<p>Challenge 6: Don't ask me if something looks wrong.  Look again, pay really careful attention. <span class="points">300 points</span></p>
<p>Challenge 7: The JavaScript Attack Challenge. <span class="points">200 points</span></p>
<p>Challenge 8: That readme is peculiar... <span class="points">100 points</span></p>
<p>Challenge 9: A whole bunch of CS40 homeworks found... <span class="points">200 points</span></p>
<p>Challenge 10: Buried in the dump, redux: needle in the haystack. <span class="points">400 points</span></p>
<p>Challenge 11: About my friend bobo... <span class="points">300 points</span></p>
<p>Challenge 12: XSS gone sinister. <span class="points">300 points</span></p>
<p>Challenge 13: I Am Eval Homer. <span class="points">400 points</span></p>
<h2>Scores</h2>
<table>
<tr>
<th>Team Number</th>
<th>Score</th>
</tr>
<?php
    $myUserName = "ctf2023scoreboard";
    $myPassword = 'WeLoveToParty';
    $myDatabase = "scoreboard";
    $myHost = "localhost";
    $db = mysqli_connect($myHost, $myUserName, $myPassword) or die ('I cannot connect to the database because: ' . mysqli_error($db));
    mysqli_select_db($db, $myDatabase) or die("Unable to select database");
    $query = "SELECT team_number, SUM(points) AS total FROM ctf_scoreboard GROUP BY team_number DESC";
    $myResult = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($myResult)) {
        echo "<tr><td>" . $row["team_number"] . "</td><td>" . $row["total"] . "</td></tr>\n";
    }
?>
</table>

<h2>Flag Submission</h2>
<form method="post">
<input type="hidden" name="tampertoken" value="skymanatees"/>
<p>Submission Key <input type="text" name="submitkey" /> Flag <input type="text" size="30" name="submitflag" /> <input type="submit" /></p>
</form>

</body>
</html>
