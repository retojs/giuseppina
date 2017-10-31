<?php

// connect to DB
function getDB() {
	$user = "web119";
	$pwd = "calopterix";
	if (strtolower($_SERVER["HTTP_HOST"]) == 'localhost') {
		$user = "web119";
		$pwd = "calopterix";
	}

	$link = mysql_connect("localhost", $user, $pwd);
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
		return 999;
	}

	$startSA = getFirstSa($jahr);
	
	// 3. get current day of year, starting with 1
	$dayofyear = $my_array["tm_yday"] + 1;

	// 4. calc days passed from first SA till now
	$daysPassed = $dayofyear - $startSA;
	if ($daysPassed < 0) {
		$daysPassed = 0;
	}

	// 5. divide by 7, add 1 since first SA started week 2, take ceil since we're interested in the ongoing (not finished) week
	$weekofyear = ceil($daysPassed / 7 );
		
	return $weekofyear;
}


function printRules() {
	?>
<div id="rules">
	<h3>Bedienungshinweise</h2>
	<ul>
		<li><b>Vor dem Aufenthalt</b> bitte die reservierten Tage in die Tabelle eintragen und speichern.<br/>
		    Die Wochen können abgetauscht werden infolge mündlicher Vereinbarung mit dem Wochenzuständigen (HP oder Lotta).</li>	
		<li>Beim Eintragen von Reservationen bitte diese <b>Reihenfolge</b> einhalten:</b>
			<ol>
				<li>HP/Verena und Lotta/Edi</li>
				<li>Keller- und Lamprecht-"Kinder"</li>
				<li>Weitere Familienangehörige</li>
				<li>Freunde, Bekannte</li>
			</ol>
		</li>
		<li><b>Nach erfolgtem Aufenthalt</b> die Anzahl der Übernachtungen bitte innerhalb von 2 Wochen hinten in die Tabelle eintragen und speichern.<br/>
		Preise und Kontoinformationen findet ihr unter dem Menupunkt <a href="preise.php" target="content" onClick="window.parent.menu.selectMenu('mietpreise')"><b>Mietpreise</b></a></li>
	</ul>
</div>
	<?php
}

function printContacts() {
	?>
<div id="contact">
	<h3>Kontaktdaten</h3>
	<blockquote>
		Hanspeter und Verena Keller<br/>
		Säntisstrasse 18<br/>
		8280 Kreuzlingen<br/>
		071 672 33 52<br/>
		<a href="mailto:kellerhp@tele-net.ch?subject=Giuseppina">kellerhp@tele-net.ch</a>
	</blockquote>
	<blockquote>
		Lotte und Edi Lamprecht-Keller<br/>
		Büelweg 7<br/>
		8484 Weisslingen<br/>
		052 384 18 01<br/>
		<a href="mailto:l.lamprecht@bluewin.ch?subject=Giuseppina">l.lamprecht@bluewin.ch</a>
	</blockquote>
	<p>
		Kommentare und Fragen bitte per Email an: <a href="mailto:reto.lamprecht@gmx.ch?subject=Giusi Website">reto.lamprecht@gmx.ch</a>
	</p>
</div>
<hr/>
	<?php
}

/**
 * $result: Eintraege aus giusiwochen
 * $jahr: das gewaehlte Jahr
 * $saveButton: mit save button oder ohne
 *
 */
function printKalender($result, $jahr, $saveButton, $action) {

	$weekofyear = getWeekOfYear($jahr);

	?>
	<div id="plan">
		<h3>Belegungsplan für das Jahr <?php echo $jahr; ?></h2>
		<b>(Jede Zeile gilt jeweils von Samsag bis Samstag)</b>
		<br/>
		<br/>
		<table>
			<thead>
				<td>Woche</td>
				<td>von - bis</td>
				<td>berechtigt</td>
				<td>Dispositionen</td>
				<td>Übernachtungen</td>
			</thead>
			<tbody>
			<?php
			while (list ($woche, $datum, $berechtigt, $text, $naechte) = mysql_fetch_row ($result)) {
				$fontColorClass = '';
				if ($woche < $weekofyear) {
					$fontColorClass = 'passed-week';
				} else if ($woche == $weekofyear) {
					$fontColorClass = 'current-week';
				}
				?>
				<input type="hidden" name="jahr" value="<?php print $jahr; ?>">
				<input type="hidden" name="woche" value="<?php print $woche; ?>">
				<tr>
					<td class="col-week <?php print $fontColorClass ?>"><?php print $woche ?></td>
					<td class="col-date <?php print $fontColorClass ?>"><?php print $datum ?></td>
					<td class="col-who <?php print $fontColorClass ?>"><?php print $berechtigt ?></td>
					<td class="col-text <?php print $fontColorClass ?>"><input type="text" name="text" value="<?php print $text; ?>"></td>
					<td class="col-nights <?php print $fontColorClass ?>"><input type="text" name="naechte" value="<?php print $naechte; ?>"></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	<?php
		if ($saveButton) {
			?>
			<button onClick="submitWeeks()">Speichern</button>
			<?php
		}
	?>
	<br/>
	<br/>
	</div>
	<?php
}


// Lädt alle Einträge für ein Jahr und zeigt sie an.
// Falls $printInfos = true, werden die Regeln auch geschrieben (siehe function printRules())
function printYear($jahr, $printInfos, $saveButton, $action) {

	if ($printInfos) printRules();

	$link = getDB();
	$result = mysql_query ("SELECT woche, datum, berechtigt, text, naechte FROM giusiwochen WHERE jahr='$jahr' ORDER BY woche", $link);
	if (!$result) {
		print mysql_error();
	} else {
		printKalender($result, $jahr, $saveButton, $action);
	}

	if ($printInfos) printContacts();
	
}
?>

<script type="text/javascript">
function submitWeeks() {

	var data = {'weeks' : []},
		week = {};		

	var inputFields = document.getElementsByTagName('input');
	for (var i = 0; i < inputFields.length; i++) {
		var inputField = inputFields[i];
		var name = inputField.name;
		var value = inputField.value;
		if (name && name.trim().toLowerCase() !== 'submit') {
			if (name.trim().toLowerCase() === 'jahr') {
				week = {};
				data.weeks.push(week);
			}
			week[name] = value;			
		}
	}

	var json = JSON.stringify(data, null, 2);
	
	// construct an HTTP request
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'giusi.php', true);
	xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	
	// send the collected data as JSON
	xhr.send(json);
	console.log('posted json:\n' + json);

	xhr.onreadystatechange = function (oEvent) {  
	    if (xhr.readyState === 4) {  
	        if (xhr.status === 200) {  
	        	alert("Die Änderungen am Giusi-Belegungsplan wurden gespeichert.");
	        } else {  
	        	window.parent.content.location.href = 'giusi.php';  // reload the page
	        	alert("Fehler: Änderungen konnten nicht gespeichert werden.");
	        }  
	    }  
	}; 
}
</script>
