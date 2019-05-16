<?php
include "start.php";

print("<h3>Oversikt over hotell</h3>");

include("dbtilkobling.php");
?>

<form method="post" name="finnHotellSkjema" id="finnHotellSkjema">

Velg et sted du ønsker å finne hotell:
<select name="sted" id="sted">

<?php listeboksHotellSted(); ?>
	
</select><br>
<input type="submit" name="submit" id="submit" value="Finn hotell">
</form>

<?php

if (isset($_POST['submit'])) {

	$sted=utf8_decode($_POST['sted']);
	$sqlSetning		= "SELECT * FROM hotell WHERE sted = '$sted';";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Hotell på dette stedet</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Hotell</th> <th align=left>Sted</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
			$hotell=$rad[0]; 
			$sted=utf8_encode($rad[1]); 

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $hotell </td> <td> $sted </td></tr>");
		}
		print("</table>");
}

include "slutt.html";
?>