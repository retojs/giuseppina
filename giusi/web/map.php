<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Giusi Plan</title>
	<meta http-equiv=Content-Language content=de>
</head>
<body bgcolor=#ffff99>

<div style="width:980px; font-family:Arial; font-size:12pt">
	
	<div style="float:left; width:300px">
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
		    		<td colspan="4"><img src="map<? echo $style; ?><? echo $zoom; ?>.<? echo $imgExtension; ?>" width="656" height="592"></td>
		  		</tr>
		  		<tr> 
		    		<td colspan="3">&nbsp;</td>
		    		<td><div align="right"><a href="http://map.search.ch/contra/moresio-7">www.map.search.ch</a></div></td>
		  		</tr>
			</table>
		</div>
	
		<div style="float:right; width:300px">
			<p>&nbsp;</p>
			<p>
				Adresse: Moresio 7, 6646 Contra/TI
			</p>
			<p>
				Weg (Auto): von Tenero nach Contra fahren und beim Wegweiser &quot;La Fraccia&quot; geradeaus &uuml;ber die kleine Br&uuml;cke.	
			</p>
			<p>
				<a href="http://www.yellowcities.ch/mainframe/main.asp?kapitel=5160&sprache=D&style=MB">Zeitungsabo umleiten / unterbrechen</a>
			</p>
		</div>
		
	</div>
</body>
</html>
