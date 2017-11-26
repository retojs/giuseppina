<?php

include "kalender.php";

$link = getDB();

$data = file_get_contents("php://input");

if ($data != NULL) {
    $decoded = json_decode($data);

    $weeks = $decoded->weeks;
    $jahr = $weeks[0]->jahr;

    $oldJahr = loadJahr($jahr, $link);

    foreach ($weeks as $week) {
        $jahr = $week->jahr;
        $woche = $week->woche;
        $text = $week->text;
        $naechte = $week->naechte;

        if (isset($woche)) {

            $result = mysql_query ("UPDATE giusiwochen SET text='$text', naechte='$naechte' WHERE woche='$woche' AND jahr='$jahr'", $link);
            if (!$result) {
                print mysql_error();
            }
        }
    }

    $newJahr = loadJahr($jahr, $link);

    if (isset($newJahr) && isset($oldJahr)) {
        $diff = "";
        foreach ($newJahr as $week => $data) {
            if ($data["text"] != $oldJahr[$week]["text"] || $data["naechte"] != $oldJahr[$week]["naechte"]) {
                $diff .= implode(" ", array("Woche", $week, "(" . $data["datum"] . $jahr . ")", $data["berechtigt"])) . ":\r\n";
                $diff .= " - neuer Eintrag:\r\n        \"" . $data["text"] . "\", Übernachtungen: " . $data["naechte"] . "\r\n";
                $diff .= " - bisher:\r\n        \"" . $oldJahr[$week]["text"] . "\", Übernachtungen: " . $oldJahr[$week]["naechte"] . "\r\n";
                $diff .= "\r\n";
            }
        }

        $to = "reto.lamprecht@gmx.ch";
        $subject = iconv("UTF-8", "ISO-8859-1", "Giusi Kalender wurde geaendert");
        $headers = "From: giusi@hyperfinder.ch\r\n";

        mail($to, $subject, iconv("UTF-8", "ISO-8859-1", $diff), $headers);
    }
}

function loadJahr($jahr, $link) {
	if (isset($jahr)) {
		$result = mysql_query ("SELECT woche, datum, berechtigt, text, naechte FROM giusiwochen WHERE jahr='$jahr' ORDER BY woche", $link);
		if (!$result) {
			print mysql_error();
		} else {
			while (list ($woche, $datum, $berechtigt, $text, $naechte) = mysql_fetch_row ($result)) {
				if ($woche > 0) {
					$weeks[$woche] = array(
						"datum" => $datum, 
						"berechtigt" => $berechtigt,
						"text" => $text, 
						"naechte" => $naechte
					);
				}
			}
			return $weeks;
		}
	}
}

?>