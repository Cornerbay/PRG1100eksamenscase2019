<?php include "start.php"; ?>

<h3>Oversikt over alle registrerte studenter i gitt klasse</h3>

<form method="post" name="finnKlasseSkjema" id="finnKlasseSkjema">

Velg en klasse:
<select name="klassekode" id="klassekode">

<?php listeboksKlassekode(); ?>
	
</select><br>
<input type="submit" name="submit" id="submit" value="Finn klasse">
</form>


<?php

if (isset($_POST["submit"])) 
{

	$klassekode=$_POST["klassekode"]; 

	include("dbtilkobling.php");
	$sqlSetning		= "SELECT s.fornavn, s.etternavn, b.filnavn, b.beskrivelse
						FROM student AS s 
						  INNER JOIN bilde AS b
						  ON s.bildenr = b.bildenr 
						WHERE 
						  s.klassekode='$klassekode';";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Registrerte Studenter</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Fornavn</th> <th align=left>Etternavn</th><th align=left>Bilde</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_NUM); 
			$fornavn   =$rad[0];
			$etternavn =$rad[1];
			$bildenavn =$rad[2];
			$bildebeskrivelse= $rad[3];

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $fornavn </td><td> $etternavn </td><td> <img src='bilder/$bildenavn' alt='$bildebeskrivelse'> </td></tr>");
		}
		print("</table>");
}

include "slutt.html";
?>