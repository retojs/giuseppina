<?php
 
$menu_Belegungsplan = "giusi.php";
$menu_Mietpreise = "preise.php";
$menu_Adresse = "map.php?zoom=2&style=Foto";
$menu_Bilder = "bilder.php";
 
if (strtolower($_SERVER["HTTP_HOST"]) == 'localhost') {
    // $menu_Belegungsplan = "giusi.php";
    $menu_Mietpreise = "preise.php";
    $menu_Adresse = "map.php?zoom=2&style=Foto";
    $menu_Bilder = "bilder.php";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Die Giuseppina - Webseite</title>
	<meta http-equiv=Content-Language content=de>
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
 
<h1>Die Giuseppina - Webseite</h1>
 
<div id="menu">
<a href="<?php print $menu_Belegungsplan ?>" target="content">Belegungsplan</a>
&nbsp;|&nbsp;
<a href="<?php print $menu_Mietpreise ?>" target="content">Mietpreise</a>
&nbsp;|&nbsp;
<a href="<?php print $menu_Adresse ?>" target="content">Adresse</a>
&nbsp;|&nbsp;
<a href="<?php print $menu_Bilder ?>" target="content">Bilder</a>
</div>
