<?php

// defaults

$zoom = $_REQUEST["zoom"];
$style = $_REQUEST["style"];

if (!isset($zoom)) {
	$zoom = 0;
}
if (!isset($style)) {
	$style = "Foto";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Giusi Lageplan</title>
	<meta http-equiv=Content-Language content=de>
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
<div style="width:980px; font-family:Arial; font-size:12pt">
	
	<div style="float:left; width:300px">
	<!-- 
			<table width="20%" border="0" cellspacing="0" cellpadding="5">
				<tr> 
				   	<td>
					   	<div align="right">
			    		<?php
			  				if ($zoom > 0) {
			  					?>
			  					<a href="map.php?zoom=<?php echo $zoom - 1; ?>&style=<?php echo $style ?>">vergrössern</a>
			  					<?php
			 				} else {
			 					echo "vergrössern";
			 				}
			 			?>
			 			</div>
		 			</td>
		    		<td>
			    		<div align="left">
			    		<?php
			  				if ($zoom < 4) {
			  					?>
			    				<a href="map.php?zoom=<?php echo $zoom + 1; ?>&style=<?php echo $style ?>">verkleinern</a>
			    				<?php
			 				} else {
			 					echo "verkleinern";
			 				}
			 			?>
			 			</div>
		 			</td>
					<?php 
						$imgExtension = "gif";
						if ($style == 'Foto') {
							$imgExtension = "jpg";
							?>
							<td><div align="right">Luftbild</div></td>
							<td><div align="left"><a href="map.php?zoom=<? echo $zoom; ?>&style=Road">Strassenkarte</a></div></td>
							<?php
						} else {
							?>
							<td><div align="right"><a href="map.php?zoom=<? echo $zoom; ?>&style=Foto">Luftbild</a></div></td>
							<td><div align="left">Strassenkarte</div></td>
							<?php
						}
					?>	
		  		<tr>
		    		<td colspan="4"><img src="map/map<? echo $style; ?><? echo $zoom; ?>.<? echo $imgExtension; ?>" width="656" height="592"></td>
		  		</tr>
			</table>
			-->
			
			<iframe width="640" height="640" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.ch/maps?q=Moresio+7,+Contra+6646+Tenero-Contra,+Locarno,+Tessin&amp;ie=UTF8&amp;hl=de&amp;cd=1&amp;geocode=Fa21wAIdUP6GAA&amp;split=0&amp;sll=46.362093,9.036255&amp;sspn=3.08187,6.432495&amp;ll=46.191121,8.85129&amp;spn=0.010741,0.021715&amp;t=h&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.ch/maps?q=Moresio+7,+Contra+6646+Tenero-Contra,+Locarno,+Tessin&amp;ie=UTF8&amp;hl=de&amp;cd=1&amp;geocode=Fa21wAIdUP6GAA&amp;split=0&amp;sll=46.362093,9.036255&amp;sspn=3.08187,6.432495&amp;ll=46.191121,8.85129&amp;spn=0.010741,0.021715&amp;t=h&amp;z=14&amp;iwloc=A&amp;source=embed" style="color:#0000FF;text-align:left">Größere Kartenansicht</a></small>
			
		</div>
	
		<div style="float:right; width:300px">
			<p>&nbsp;</p>
			<p>
				Adresse: <br/>
				<br/>
				Moresio 7<br/>
				6646 Tenero-Contra/TI</br/>
			</p>
			<br/>
			<p>
				Weg (Auto): <br/>
				<br/>
				von Tenero nach Contra fahren und beim Wegweiser &quot;La Fraccia&quot; geradeaus &uuml;ber die kleine Br&uuml;cke.	
			</p>
			<p>
			<br/>
			<br/>
			</p>
			<p>
				<form action="http://cmd.hyperfinder.ch/do.php" method="post" target="_blank" id="sbb.find.form">
					<input type="hidden" name="find" id="sbb.find" />
					SBB-Fahrplan von <br/>
					<input type="text" value="Zürich" id="sbb.from" />
					nach
					<input type="text" value="Tenero" id="sbb.to" /> 
					<input type="button" type="submit" value="Anzeigen" id="sbb.find.button" />
				</form>
			</p>
			<p>
				<form action="http://cmd.hyperfinder.ch/do.php" method="post" target="_blank" id="route.find.form">
					<input type="hidden" name="find" id="route.find" />
					Auto-Route von <br/>
					<input type="text" value="Zürich" id="route.from" />
					nach
					<input type="text" value="Tenero" id="route.from" />
					<input type="button" type="submit" value="Anzeigen" id="route.find.button" />
				</form>
			</p>
			<p>
			<br/>
			<br/>
			</p>
			<p>
				<a target="_blank" href="http://maps.google.ch/maps?q=Moresio+7,+Contra+6646+Tenero-Contra,+Locarno,+Tessin&ie=UTF8&hl=de&cd=1&geocode=Fa21wAIdUP6GAA&split=0&sll=46.362093,9.036255&sspn=3.08187,6.432495&z=16&iwloc=A">www.maps.google.ch</a>
			</p>
			<p>
				<a target="_blank" href="http://map.search.ch/contra/moresio-7" >www.map.search.ch</a>
			</p>
			
		</div>
		
	</div>
	
	
</body>
<script type="text/javascript">
	document.getElementById('sbb.find.button').onclick = function() 
	{
		document.getElementById('sbb.find').value = 'sbb ' + document.getElementById('sbb.from').value + ', Tenero'; 
		document.getElementById('sbb.find.form').submit();
	}
	
	document.getElementById('route.find.button').onclick = function() 
	{
		document.getElementById('route.find').value = 'route ' + document.getElementById('route.from').value + ', Tenero'; 
		document.getElementById('route.find.form').submit();
	}
</script>
</html>
