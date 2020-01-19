<?php

$menu_url = "menu.php";
$content_url = "giusi.php";

if (strtolower($_SERVER["HTTP_HOST"]) == 'localhost') {
	$menu_url = "menu.php";
	$content_url = "giusi.php";
}

if (isset($_GET["jahr"])) {
	$queryString = http_build_query($_GET, '', '&');
	$content_url = "history.php?" . $queryString;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Giuseppina Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
</head>

<frameset rows="100,*" frameborder="NO" border="0" framespacing="0">
	<frame src="<?php print $menu_url; ?>" name="menu" scrolling="NO" noresize />
	<frame src="<?php print $content_url; ?>" name="content" />
</frameset>

<noframes>
<body>
</body>
</noframes>
</html>
