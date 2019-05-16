<?php
include "start.php";

print("<h3>Oversikt over alle registrerte klasser</h3>");

include("dbtilkobling.php");
$sqlSetning		= "SELECT * FROM klasse;";
$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

$antallRader	= mysqli_num_rows($sqlResultat);


  print ("<h3>Registrerte klasser</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>Klasskode</th> <th align=left>Klassenavn</th></tr>"); 


for ($r=1;$r<=$antallRader;$r++) 
	{ 
		$rad=mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
		$klassekode=$rad[0]; 
		$klassenavn=$rad[1]; 

		//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
		print("<tr> <td> $klassekode </td> <td> $klassenavn </td></tr>");
	}
	print("</table>");

include "slutt.html";
?>