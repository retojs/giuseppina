<?php
// connect to DB
function getDB() {
 	$link = mysql_connect("localhost", "web119", "calopterix");
  if (!$link) die ("Couldnt connect to MySQL server");
  mysql_select_db("usr_web119_2") or die ("Couldnt open database");
	return $link;
}
$link = getDB();

// update
if (isset($woche)) {
$result = mysql_query ("UPDATE giusiwochen SET text='$text', naechte='$naechte' WHERE woche='$woche' AND jahr='$jahr'", $link);
if (!$result) {
		print mysql_error();
	}
}

if (!isset($jahr)) {
	$jahr=2006;
}
// select
$result = mysql_query ("SELECT woche, datum, berechtigt, text, naechte FROM giusiwochen WHERE jahr='$jahr' ORDER BY woche", $link);
if (!$result) {
		print mysql_error();
	}

// calculate current week of year
// 0. first weekday for next 20 years, starting from 2005
$allFirstWeekdays = array(6, 7, 1, 2, 4, 5, 6, 7, 2, 3, 4, 5, 7, 1, 2, 3, 5, 6, 7, 1);
// 1. first weekday for this year
$firstWeekday = $allFirstWeekdays[($jahr - 2005)];
// 2. find number of first Sa
$startSA = 6 - $firstWeekday;
if ($startSA < 0) {
	$startSA = 7;
}
// 3. get current day of year
$my_array = localtime(time(), 1);
$dayofyear = $my_array["tm_yday"];

// 4. calc days passed from first SA till now
$daysPassed = $dayofyear - $startSA;
if ($daysPassed < 0) {
	$daysPassed = 0;
}
// 5. divide by 7
$weekofyear = floor(($daysPassed / 7) + 1);

?>
<html>
<head>
<title>Giusi Kalender</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: normal;
}
-->
</style>
<style type="text/css">
<!--
.bold {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: bold;
}
-->
</style>
</head>
<body bgcolor="#ffff99">
<p><b><font face="Arial Narrow" size=5>Belegungsplan fürs Jahr 2005<br>
  </font><font face="Arial Narrow"> (Kalenderwochen; gilt jeweils Sa-Sa)</font></b></p>
<ul>
  <li><span lang=de-ch><font face="Arial Narrow" color=#0000ff size=3><strong>Hanspi,
    Ueli, Lotte und Ruedi: tragt unten alle Eure Dispositionen (vermutliche und
    sichere) mit den Namen oder Initialen des Schreibenden (z.B. HP) ein!</strong></font></span></li>
  <li><strong><font size="3" face="Arial Narrow"><font color=#0000ff>Alle definitiven
    Abmachungen in Perioden, die nicht Euch zugeteilt sind, müssen zusätzlich
    direkt zwischen den Geschwistern mit Telefon/E-mails bestätigt werden. E-mail-Adressen:
    <a href="mailto:kellerhp@tele-net.ch?subject=Giuseppina">kellerhp@tele-net.ch</a> (HP &amp; Vrene),
    <a href="mailto:ukeller@uhbs.ch?subject=Giuseppina">ukeller@uhbs.ch</a> (Ueli &amp; Reta), <a href="mailto:l.lamprecht@bluewin.ch?subject=Giuseppina">l.lamprecht@bluewin.ch</a>
    (Lotte &amp; Edi), <a href="mailto:lorimar@bluewin.ch?subject=Giuseppina">lorimar@bluewin.ch</a>
    (Ruedi &amp; Christine). </font></font></strong></li>
  <li><strong><font size="3"><span
lang=de-ch><font color="#0000FF" face="Arial Narrow">Die Anzahl aller erfolgten
    Übernachtungen bitte im Nachhinein eintragen!</font></span></font></strong></li>
  <li><strong><font size="3"><span
lang=de-ch><font color="#CC0000" face="Arial Narrow">Bei &Auml;nderungen jede
    Zeile separat speichern!</font><font color="#0000FF" face="Arial Narrow">
    Wenn ihr mehrere Zeilen &auml;ndert und erst dann speichern dr&uuml;ckt, wird
    nur die eine Zeile gespeichert und alle &uuml;brigen &Auml;nderungen gehen
    verloren.</font></span></font></strong></li>
  <li><strong><font size="3"><span
lang=de-ch><font color="#0000FF" face="Arial Narrow">F&uuml;r Kommentare und Fragen:
    Email an <a href="mailto:reto.lamprecht@gmx.ch?subject=Giuseppina">reto.lamprecht@web.de</a>
    schicken.</font></span></font></strong></li>
</ul>
<table width="1%" border="0" cellspacing="0" cellpadding="4" bgcolor="#FFFFFF">
  <thead bgcolor="#CCCCCC">
  <td nowrap class="bold">Woche</td>
  <td nowrap class="bold">von - bis</td>
  <td nowrap class="bold">berechtigt</td>
    <td nowrap class="bold">Dispositionen</td>
  <td colspan="2" nowrap class="bold">erfolgte Übernachtungen</td></thead>
  <tbody>
    <?php
	while (list ($woche, $datum, $berechtigt, $text, $naechte) = mysql_fetch_row ($result)) {
		$fontColorOpen = "";
		$fontColorClose = "";
		if ($woche < $weekofyear) {
			$fontColorOpen = "<font color=#999999>";
			$fontColorClose = "</font>";
		}
?>
    <tr>
      <form method="post" action="http://www.paradox.ch/giusi/giusi.php">
        <input type="hidden" name="jahr" value="<?php print $jahr; ?>">
        <input type="hidden" name="woche" value="<?php print $woche; ?>">
        <td nowrap class="bold"><?php print $fontColorOpen . $woche . $fontColorClose; ?></td>
        <td nowrap class="bold"><?php print $fontColorOpen . $datum . $fontColorClose; ?></td>
        <td nowrap class="bold"><?php print $fontColorOpen . $berechtigt . $fontColorClose; ?></td>
        <td nowrap><input type="text" name="text" size="70" value="<?php print $text; ?>">
        </td>
        <td nowrap><input type="text" size="12" name="naechte" value="<?php print $naechte; ?>"></td>
        <td nowrap><input type="submit" name="Submit" value="speichern"></td>
      </form>
    </tr>
    <?php
}
?>
  </tbody>
</table>
<p>&nbsp;</p>



<!-- folgendes Jahr (2006) -->
<p><b><font face="Arial Narrow" size=5>Belegungsplan fürs Jahr 2006<br>
  </font><font face="Arial Narrow"> (Kalenderwochen; gilt jeweils Sa-Sa)</font></b></p>


<?php

// select
$jahr = 2006;
$result = mysql_query ("SELECT woche, datum, berechtigt, text, naechte FROM giusiwochen WHERE jahr='$jahr' ORDER BY woche", $link);
if (!$result) {
		print mysql_error();
}

?>

<table width="5%" border="0" cellspacing="0" cellpadding="4" bgcolor="#FFFFFF">
  <thead bgcolor="#CCCCCC">
	  <td nowrap class="bold">Woche</td>
	  <td nowrap class="bold">von - bis</td>
	  <td nowrap class="bold">berechtigt</td>
    <td nowrap class="bold">Dispositionen</td>
  	<td colspan="2" nowrap class="bold">erfolgte Übernachtungen</td>
  </thead>
  <tbody>
    <?php
			while (list ($woche, $datum, $berechtigt, $text, $naechte) = mysql_fetch_row ($result)) {
				$fontColorOpen = "";
				$fontColorClose = "";
				if ($woche < $weekofyear) {
					$fontColorOpen = "<font color=#999999>";
					$fontColorClose = "</font>";
				}
				?>
		    <tr>
		      <form method="post" action="http://www.paradox.ch/giusi/giusi.php">
		        <input type="hidden" name="jahr" value="<?php print $jahr; ?>">
		        <input type="hidden" name="woche" value="<?php print $woche; ?>">
		        <td nowrap class="bold"><?php print $fontColorOpen . $woche . $fontColorClose; ?></td>
		        <td nowrap class="bold"><?php print $fontColorOpen . $datum . $fontColorClose; ?></td>
		        <td nowrap class="bold"><?php print $fontColorOpen . $berechtigt . $fontColorClose; ?></td>
		        <td nowrap>
		        	<input type="text" name="text" size="70" value="<?php print $text; ?>">
		        </td>
		        <td nowrap>
		        	<input type="text" size="12" name="naechte" value="<?php print $naechte; ?>">
		        	</td>
		        <td nowrap>
		        	<input type="submit" name="Submit" value="speichern">
		        </td>
		      </form>
		    </tr>
		    <?php
			}
		?>
  </tbody>
</table>

</body>
</html>
