<?php include "start.php"; ?>

<?php //Sjekk hvilken rolle bruker har
  @$innloggetBruker=$_SESSION; //@ for å slippe unødig warning
  if (@$innloggetBruker['rolle']!="bruker" && @$innloggetBruker['rolle']!="admin") {
    print("Denne siden krever innlogging!<br>");

    print("Du vil bli sendt til innlogging om 2 sekunder");

    include "slutt.html";

    die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");
  }
?>

<?php 

$sqlSetning		= "SELECT * FROM bestilling ORDER BY dato_fra ASC;";
$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

$antallRader	= mysqli_num_rows($sqlResultat);


  print ("<h3>Registrerte Bestillinger</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>Hotellnavn</th> <th align=left>Romtype</th> <th align=left>Romnr</th><th align=left>Dato fra</th><th align=left>Dato til</th></tr>"); 


for ($r=1;$r<=$antallRader;$r++) 
	{ 
		$rad=mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
		$hotellnavn=$rad['hotellnavn']; 
		$romtype=$rad['romtype'];
		$romnr=$rad['romnr'];
		$datoFra=$rad['dato_fra'];
		$datoTil=$rad['dato_til']; 

		//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
		print("<tr> <td> $hotellnavn </td> <td> $romtype </td><td>$romnr</td><td>$datoFra</td><td>$datoTil</td></tr>");
	}
	print("</table>");

?>

<?php include "slutt.html";?>