<?php

$menu_Belegungsplan = "http://www.paradox.ch/giusi/giusi.php";
$menu_Mietpreise = "http://www.paradox.ch/giusi/preise.htm";
$menu_Adresse = "http://www.paradox.ch/giusi/map.php?zoom=2&style=Foto";
$menu_Bilder = "http://www.paradox.ch/giusi/bilder.php";

if (strtolower($_SERVER["HTTP_HOST"]) == 'localhost') {
	// $menu_Belegungsplan = "http://www.paradox.ch/giusi/giusi.php";
	$menu_Mietpreise = "http://localhost/giusi/preise.htm";
	$menu_Adresse = "http://localhost/giusi/map.php?zoom=2&style=Foto";
	$menu_Bilder = "http://localhost/giusi/bilder.php";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Die Giuseppina - Webseite</title>
<meta http-equiv=Content-Language content=de>
<style type="text/css">
body {
	font-family: Arial;
}

#menu {
	font-weight: bold;
}
</style>
</head>
<body bgcolor=#ffff99>

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