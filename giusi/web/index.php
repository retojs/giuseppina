<?php

$menu_url = "http://www.paradox.ch/giusi/menu.php";
$content_url = "http://www.paradox.ch/giusi/giusi.php";

if (strtolower($_SERVER["HTTP_HOST"]) == 'localhost') {
	$menu_url = "http://localhost/giusi/menu.php";
	$content_url = "http://localhost/giusi/giusi.php";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Giuseppina Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<frameset rows="95,*" frameborder="NO" border="0" framespacing="0">
	<frame src="<?php print $menu_url; ?>" name="menu" scrolling="NO" noresize />
	<frame src="<?php print $content_url; ?>" name="content" />
</frameset>

<noframes>
<body>
</body>
</noframes>
</html>
