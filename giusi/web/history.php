<?php include "global.php" ?>
<?php include "update.php" ?>
<?php
	$jahr = $_GET['jahr'];
	$edit = $_GET['edit'];
	
	$localtime = localtime(time(), 1);
	$currentYear = 1900 + $localtime["tm_year"];
?>
<html>
	<head>
		<title>Giusi Belegungskalender (<?php echo $jahr; ?>)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php print $css_url; ?>">
	</head>
	<body>
		<div id="history">
			<a id="history-back" href="giusi.php">zurück</a> 
		
			<?php 
				printYear($jahr, false, $edit == 'true' || $jahr >= $currentYear ? true : false, "history.php");
			?>
		</div>	
	</body>
</html>
