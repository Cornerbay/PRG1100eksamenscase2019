<!-- visromtype.php -->

<?php
include "start.php";

print("<h3>Oversikt over hotell</h3>");

include("dbtilkobling.php");
?>

<form method="post" name="visHotellRomtypeSkjema" id="visHotellRomtypeSkjema">

Velg et sted du ønsker å finne hotell:
<select name="hotell" id="hotell">

<?php listeboksHotellnavn(); ?>
	
</select><br>
<input type="submit" name="submit" id="submit" value="Finn hotell">
</form>

<?php

if (isset($_POST['submit'])) {

	$hotell=$_POST['hotell'];
	$sqlSetning		= "	SELECT r.romtype
						FROM romtype AS r
							INNER JOIN hotellromtype AS hr
							ON r.romtype = hr.romtype
						WHERE
							hr.hotellnavn='$hotell';";

	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Typer rom på $hotell</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Hotell</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
			$hotellRomtype=$rad[0]; 

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $hotellRomtype </td></tr>");
		}
		print("</table>");
}

include "slutt.html";
?>