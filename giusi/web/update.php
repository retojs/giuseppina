<?php

include "kalender.php";

$link = getDB();

$data = file_get_contents("php://input");
$decoded = json_decode($data);
$weeks = $decoded->weeks;

foreach ($weeks as $week) {	
	$jahr = $week->jahr;
	$woche = $week->woche;
	$text = $week->text;
	$naechte = $week->naechte;	

	// echo "woche=$woche, text=$text, naechte=$naechte, jahr=$jahr";	

	if (isset($woche)) {
		$result = mysql_query ("UPDATE giusiwochen SET text='$text', naechte='$naechte' WHERE woche='$woche' AND jahr='$jahr'", $link);
		if (!$result) {
			print mysql_error();
		}
	}
}

?>