<?php include "global.php" ?>
<?php

//
// Wie das funktioniert? Siehe README.txt, Punkt A)
//

// connect to DB
function getDB() {
	$user = "web225";
	$pwd = "svenska";
	$link = mysql_connect("localhost", $user, $pwd);
	if (!$link) die ("Couldnt connect to MySQL server");
	mysql_select_db("usr_web225_2") or die ("Couldnt open database");
	return $link;
}

$link = getDB();
mysql_query("SET autocommit=1");

$plan =  $_POST["plan"];
$lines = explode(";", $plan);
foreach ($lines as $line) {
	list ($woche, $datum, $berechtigt) = split(",", $line);
	if ($woche != "") {
		$jahr = trim($jahr);
		$woche = trim($woche);
		$datum = trim($datum);
		$berechtigt = trim($berechtigt);	
		$q = "INSERT INTO giusiwochen SET jahr='$jahr', woche='$woche', datum='$datum', berechtigt='$berechtigt';";
		print "<br>$q";
		$result = mysql_query($q);
		if (!$result) {
			print mysql_error();
		} else {
			print "<br> --- OK! Woche $woche ($datum, $berechtigt) gesetzt";
		}
	}
}
?>

<html>
<head>
	<title>data-import</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<script type="text/javascript">
	
function checkJahr() {
	if (document.getElementById('jahr').value == '') {
		alert("Jahr ist leer!");
		return false;
	} else {
		document.getElementById('form1').submit();
	}
}
	
	</script>

</head>

<body>
	<form id="form1" method="post" action="initjahr.php">
		<p> Jahr:
	    	<input type="text" name="jahr" id="jahr">
	  	</p>
	  	<p>
	  	Belegungsplan eingeben: <br>
	  	Format: <i><strong>Woche, Datum, berechtigt ;</strong></i><br>
	  	also z.B.: <strong>15, 12.5. - 19.5., Ueli ;</strong>
	    </p>
	  	<p>
	    	<textarea rows="20" cols="30" name="plan"></textarea>
	 	</p>
	  	<p>
	    	<input type="button" name="Submit" value="Submit" onclick="checkJahr()">
	  	</p>
</form>
</body>
</html>
