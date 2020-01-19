<?php
// connect to DB
function getDB() {
 	$link = mysql_connect("localhost", "web119", "uranus");
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

// select
$result = mysql_query ("SELECT woche, datum, berechtigt, text, naechte FROM giusiwochen WHERE jahr='$jahr' ORDER BY woche", $link);
if (!$result) {
		print mysql_error();
	}
?>
<html>
<head>
<title>Untitled Document</title>
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
    Email an <a href="mailto:reto.lamprecht@web.de?subject=Giuseppina">reto.lamprecht@web.de</a> 
    schicken.</font></span></font></strong></li>
</ul>
<table width="80%" border="0" cellspacing="0" cellpadding="4" bgcolor="#FFFFFF">
  <thead bgcolor="#CCCCCC">
  <td nowrap class="bold">Woche</td>
  <td nowrap class="bold">von - bis</td>
  <td nowrap class="bold">berechtigt</td>
    <td nowrap class="bold">Dispositionen</td>
  <td colspan="2" nowrap class="bold">erfolgte Übernachtungen</td></thead>
  <tbody>
    <?php
	while (list ($woche, $datum, $berechtigt, $text, $naechte) = mysql_fetch_row ($result)) {
?>
    <tr> 
      <form method="post" action="http://www.paradox.ch/giusi/giusi.php">
        <input type="hidden" name="jahr" value="<?php print $jahr; ?>">
        <input type="hidden" name="woche" value="<?php print $woche; ?>">
        <td nowrap class="bold"><?php print $woche; ?></td>
        <td nowrap class="bold"><?php print $datum; ?></td>
        <td nowrap class="bold"><?php print $berechtigt; ?></td>
        <td nowrap><input type="text" name="text" size="75" value="<?php print $text; ?>"> 
        </td>
        <td nowrap><input type="text" size="5" name="naechte" value="<?php print $naechte; ?>"></td>
        <td nowrap><input type="submit" name="Submit" value="speichern"></td>
      </form>
    </tr>
    <?php
}
?>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>
