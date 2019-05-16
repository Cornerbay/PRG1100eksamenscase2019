<?php
include "start.php";

print("<h3>Oversikt over alle registrerte studenter</h3>");

include("dbtilkobling.php");
$sqlSetning		= "SELECT * FROM student;";
$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

$antallRader	= mysqli_num_rows($sqlResultat);


  print ("<h3>Registrerte Studenter</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>Brukernavn</th> <th align=left>Fornavn</th><th align=left>Etternavn</th><th align=left>Klassekode</th><th align=left>Innleveringsfrist</th><th align=left>Bildenummer</th></tr>"); 


for ($r=1;$r<=$antallRader;$r++) 
	{ 
		$rad=mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
		$brukernavn=$rad[0]; 
		$fornavn   =$rad[1];
		$etternavn =$rad[2];
		$klassekode=$rad[3];
		$leveringsgrist=$rad[4];
		$bildenr=$rad[5];

		//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
		print("<tr> <td> $brukernavn </td><td> $fornavn </td><td> $etternavn </td><td> $klassekode </td><td> $leveringsgrist </td><td> $bildenr </td></tr>");
	}
	print("</table>");

include "slutt.html";
?>