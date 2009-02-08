<?php

include "kalender.php";

$link = getDB();

// update
if (isset($woche)) {
	$result = mysql_query ("UPDATE giusiwochen SET text='$text', naechte='$naechte' WHERE woche='$woche' AND jahr='$jahr'", $link);
	if (!$result) {
		print mysql_error();
	}
}

?>