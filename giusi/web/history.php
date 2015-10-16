<?php

include "update.php";

$jahr = $_GET['jahr'];
?>
<html>
	<head>
		<title>Giusi Belegungskalender (<?php echo $jahr; ?>)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/css-2015-09-26.css">
	</head>
	<body>
		<a id="history-back" href="giusi.php">zurück</a> 
		
		<?php 
			// make future editable
			$my_array = localtime(time(), 1);	
			$year = $my_array["tm_year"];

			printYear($jahr, false, false, "history.php"); 
		?>
	
	</body>
</html>
