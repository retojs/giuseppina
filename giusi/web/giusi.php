<?php

include "update.php";

?>
<html>
	<head>
		<title>Giusi Kalender</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" type="text/css" href="css.css">
	</head>
	<body bgcolor="#ffff99">
		
		<?php printYear(2009, true, true, "giusi.php"); ?>
	
		<p>&nbsp;</p>
		
		<!-- vergangene und zuk�nftige Jahre -->
		<p>
			<b>
				<a href="history.php?jahr=2008">Belegungsplan f�r das Jahr 2008</a>
				<br><br>
				<a href="history.php?jahr=2007">Belegungsplan f�r das Jahr 2007</a>
				<br><br>
				<a href="history.php?jahr=2006">Belegungsplan f�r das Jahr 2006</a>
				<br>
			</b>
		</p>
		
	
	</body>
</html>
