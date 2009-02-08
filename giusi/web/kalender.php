<?php

// connect to DB
function getDB() {
	$link = mysql_connect("localhost", "web119", "calopterix");
	if (!$link) die ("Couldnt connect to MySQL server");
	mysql_select_db("usr_web119_2") or die ("Couldnt open database");
	return $link;
}

function getFirstSa($jahr) {
	// 0. first weekday for next 20 years, starting from 2005
	$allFirstWeekdays = array(6, 7, 1, 2, 4, 5, 6, 7, 2, 3, 4, 5, 7, 1, 2, 3, 5, 6, 7, 1);
	
	// 1. first weekday for this year
	$firstWeekday = $allFirstWeekdays[($jahr - 2005)];
	
	// 2. find day number of first Sa
	$startSA = 6 - $firstWeekday;
	
	return $startSA;
}


// calculates current week of year
function getWeekOfYear($jahr) {
	$my_array = localtime(time(), 1);
	
	// if year in the future, return -1, if whole year passed, return 99
	$year = $my_array["tm_year"];
	// value for 2006 is 106
	if ($jahr > (1900 + $year)) {
		return -1;
	} else if ($jahr < (1900 + $year)) {
		return 99;
	}
	
	$startSA = getFirstSa($jahr);
	
	// 3. get current day of year
	$dayofyear = $my_array["tm_yday"];
	
	// 4. calc days passed from first SA till now
	$daysPassed = $dayofyear - $startSA;
	if ($daysPassed < 0) {
		$daysPassed = 0;
	}
	
	// 5. divide by 7
	$weekofyear = floor(($daysPassed / 7) + 1);
	
	return $weekofyear;
}


function printRules() {
	?>
	<ul class="rules">
	  <li>
	  	Hanspi, Ueli, Lotte und Ruedi: tragt unten alle Eure Dispositionen (vermutliche und sichere) mit den Namen oder Initialen des Schreibenden (z.B. HP) ein!
	  </li>
	  <li>
	  	Alle definitiven Abmachungen in Perioden, die nicht Euch zugeteilt sind, müssen zusätzlich
	    direkt zwischen den Geschwistern mit Telefon/E-mails bestätigt werden. 
	    E-mail-Adressen:
	    <br>&nbsp;&nbsp;<a href="mailto:kellerhp@tele-net.ch?subject=Giuseppina">kellerhp@tele-net.ch</a> (HP &amp; Vrene),
	    <br>&nbsp;&nbsp;<a href="mailto:ukeller@uhbs.ch?subject=Giuseppina">ukeller@uhbs.ch</a> (Ueli &amp; Reta), 
	    <br>&nbsp;&nbsp;<a href="mailto:l.lamprecht@bluewin.ch?subject=Giuseppina">l.lamprecht@bluewin.ch</a> (Lotte &amp; Edi), 
	    <br>&nbsp;&nbsp;<a href="mailto:lorimar@bluewin.ch?subject=Giuseppina">lorimar@bluewin.ch</a> (Ruedi &amp; Christine). 
		</li>
	  <li>
	  	Die Anzahl aller erfolgten Übernachtungen bitte im Nachhinein eintragen!
	  </li>
	  <li>
	  	Bei &Auml;nderungen jede Zeile separat speichern!
	    Wenn ihr mehrere Zeilen &auml;ndert und erst dann speichern dr&uuml;ckt, wird nur die eine Zeile gespeichert und alle &uuml;brigen &Auml;nderungen gehen verloren.
	  </li>
	  <li>
	  	F&uuml;r Kommentare und Fragen: Email an <a href="mailto:reto.lamprecht@gmx.ch?subject=Giuseppina">reto.lamprecht@web.de</a> schicken.
		</li>
		<li>
		<b>Kurtaxe: Alle Mieter bezahlen neu ihre Kurtaxe selber, füllen einen Melde-Schein aus und legen den Betrag in die Kasse auf dem Schreibtisch. (Info und Kurtaxe / Nacht sind angegeben auf der Anleitung, die auf dem Schreibtisch liegt.)
		</b>
		</li>
	</ul>
	<?php
}

/** 
 * $result: Einträge aus giusiwochen
 * $jahr: das gewählte Jahr
 * $saveButton: mit save button oder ohne
 * 
 */
function printKalender($result, $jahr, $saveButton, $action) {
	
	$weekofyear = getWeekOfYear($jahr);
				
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
			      <form method="post" action="http://www.paradox.ch/giusi/<?php echo $action ?>">
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
			        <?php 
				        if ($saveButton) {
				        	?>
						        <td nowrap>
						        	<input type="submit" name="Submit" value="speichern">
						        </td>
				        	<?php
				     		}
			      	?>
			      </form>
			    </tr>
			    <?php
				}
			?>
	  </tbody>
	</table>
	
	<?php
}


// Lädt alle Einträge für ein Jahr und zeigt sie an. 
// Falls $printRules = true, werden die Regeln auch geschrieben (siehe function printRules())
function printYear($jahr, $printRules, $saveButton, $action) {
	?>

		<p>
			<b>
				<font size=5>Belegungsplan für das Jahr <?php echo $jahr; ?><br></font>
				(Kalenderwochen; gilt jeweils Sa-Sa)
			</b>
		</p>
		<?php 
			
			if ($printRules) printRules(); 
		
			$link = getDB();
			$result = mysql_query ("SELECT woche, datum, berechtigt, text, naechte FROM giusiwochen WHERE jahr='$jahr' ORDER BY woche", $link);
			if (!$result) {
					print mysql_error();
			} else {
				printKalender($result, $jahr, $saveButton, $action);
			}

}
?>
