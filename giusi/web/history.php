<?php

include "update.php";

?>
<html>
	<head>
		<title>Giusi Belegungskalender (<?php echo $jahr; ?>)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" type="text/css" href="css/css.css">
	</head>
	<body bgcolor="#ffff99" style="padding-top:0px">
		<a href="giusi.php">zurück</a> 
		
		<?php 
			// make future editable
			$my_array = localtime(time(), 1);	
			$year = $my_array["tm_year"];

			printYear($jahr, false, $jahr > 1900 + $year, "history.php"); 
		?>
	
	</body>
</html>
