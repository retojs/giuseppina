<?php include "global.php" ?>
<?php

//
// Wie das funktioniert? Siehe README.txt, Punkt A)
// oder öffne http://hyperfinder.ch/giusi/createCalendar.html
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

$jahr =  $_POST["jahr"];

$result = mysql_query ("DELETE FROM giusiwochen WHERE jahr='$jahr'", $link);
if (!$result) {
    print mysql_error();
} else {
    $affectedRowCount = mysql_affected_rows ($link);
    print "<br> --- OK! $affectedRowCount Wochen im Jahr $jahr gelöscht";
}

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

