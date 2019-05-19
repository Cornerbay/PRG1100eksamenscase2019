<?php include "start.php"; ?>

<h3> Sjekk ledige rom på </h3>
<form method="post" name="finnHotellRomSkjema" id="finnHotellRomSkjema">
	Hotell:<select name="hotellnavn" id="hotellnavn">
		<?php listeboksHotellromnavn();?>
	</select><br>
	Dato fra:<input type="date" name="datoFra" id="datoFra"><br>
	Dato til:<input type="date" name="datoTil" id="datoTil"><br>
	<input type="submit" name="finnHotellRomKnapp" id="finnHotellRomKnapp" value="Finn ledige rom">	
</form>


<?php

if (isset($_POST['finnHotellRomKnapp'])) {

	$hotellnavn = $_POST['hotellnavn'];
	$datoFra 	= $_POST['datoFra'];
	$datoTil 	= $_POST['datoTil'];
	
	$sqlSetning		= "	SELECT hotellnavn, romtype, romnr
						FROM rom
						WHERE
							hotellnavn='$hotellnavn'
							AND romnr NOT IN
									(
										SELECT romnr 
										FROM bestilling 
										WHERE 	
											hotellnavn='grand hotel oslo'
											AND
											dato_fra BETWEEN '$datoFra' AND '$datoTil'
											AND
											dato_til BETWEEN '$datoFra' AND '$datoTil'
									);";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Ledige rom på $hotellnavn </h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Hotellnavn</th> <th align=left>Romtype</th><th align=left>Romnr</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
			$hotellnavn = $rad['hotellnavn']; 
			$romtype 	= $rad['romtype'];
			$romnr 		= $rad['romnr'];

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $hotellnavn </td> <td> $romtype </td><td> $romnr </td></tr>");
		}
		print("</table>");


	
}



?>

<?php include "slutt.html"; ?>