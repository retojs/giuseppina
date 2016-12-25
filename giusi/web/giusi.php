<?php include "global.php" ?>
<?php include "update.php" ?>
<?php 
function printHistory() {
	$jahrFirst = 2006;
	$jahrLast = 2015;
	for ($jahr = $jahrLast; $jahr >= $jahrFirst; $jahr--) {
		?>
		<a href="history.php?jahr=<?php print $jahr ?>">Belegungsplan f&uuml;r das Jahr <?php print $jahr ?></a>
		<br><br>
		<?php 
	}
}
?>
<html>
	<head>
		<title>Giuseppina Website - Belegungsplan</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/css-2016-12-25.css">
	</head>
	<body>
		
		<?php printYear(2016, true, true, "giusi.php"); ?>
		
		<!-- vergangene und zuk&uuml;nftige Jahre -->
		<div id="history">
		    <b>
		        <p>
		            <a href="history.php?jahr=2017">*** Neuer Belegungsplan für 2017 ***</a>
		        </p>
			    <?php printHistory() ?>
			</b>
		</div>
	</body>
</html>
