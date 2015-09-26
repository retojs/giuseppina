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
	<link rel="stylesheet" type="text/css" href="css/css-2015-09-26.css">
</head>
<body>

<div id="menu">
<h2>Die Giuseppina Webseite</h2>
<a id="belegungsplan" class="selected-menu-item" href="<?php print $menu_Belegungsplan ?>" target="content" onClick="selectMenu('belegungsplan')">Belegungsplan</a>
&nbsp;|&nbsp;
<a id="mietpreise" href="<?php print $menu_Mietpreise ?>" target="content" onClick="selectMenu('mietpreise')">Mietpreise</a>
&nbsp;|&nbsp;
<a id="adresse" href="<?php print $menu_Adresse ?>" target="content" onClick="selectMenu('adresse')">Adresse</a>
&nbsp;|&nbsp;
<a id="bilder" href="<?php print $menu_Bilder ?>" target="content" onClick="selectMenu('bilder')">Bilder</a>
</div>

<script type="text/javascript">

var menuItemIds = ['belegungsplan', 'mietpreise', 'adresse', 'bilder'];

function selectMenu(itemId) {
	for (var i = 0; i < menuItemIds.length; i++) {
		document.getElementById(menuItemIds[i]).className = '';		
	}
	document.getElementById(itemId).className = 'selected-menu-item';
}
</script>
