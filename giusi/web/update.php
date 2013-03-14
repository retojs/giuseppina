<?php

include "kalender.php";

$link = getDB();

// update

$woche = $_POST['woche'];
$text = $_POST['text'];
$naechte = $_POST['naechte'];
$jahr = $_POST['jahr'];

// echo "woche=$woche, text=$text, naechte=$naechte, jahr=$jahr";

if (isset($woche)) {
	$result = mysql_query ("UPDATE giusiwochen SET text='$text', naechte='$naechte' WHERE woche='$woche' AND jahr='$jahr'", $link);
	if (!$result) {
		print mysql_error();
	}
}

?>