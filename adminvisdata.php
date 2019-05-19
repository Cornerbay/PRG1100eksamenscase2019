<?php include "start.php"; ?>

<?php //Sjekk hvilken rolle bruker har
  @$innloggetBruker=$_SESSION; //@ for å slippe unødig warning
  if ($innloggetBruker['rolle']!="admin") {
    print("Denne siden krever innlogging!<br>");

    print("Du vil bli sendt til innlogging om 2 sekunder");

    include "slutt.html";

    die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");
  }
?>

<?php
print("<h3>Oversikt over alle registrerte hotelltabeller</h3>");

include("dbtilkobling.php");
?>

<form method="post" name="visHotellSkjema" id="visHotellSkjema">
	<input type="submit" name="visHotellKnapp" id="visHotellKnapp" value="Vis registrerte hotell">
</form>

<?php
if (isset($_POST['visHotellKnapp'])) {
	
	$sqlSetning		= "SELECT * FROM hotell ORDER BY hotellnavn ASC;";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Registrerte Hotell</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Hotellnavn</th> <th align=left>Sted</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
			$hotellnavn=$rad['hotellnavn']; 
			$sted=$rad['sted']; 

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $hotellnavn </td> <td> $sted </td></tr>");
		}
		print("</table>");
}

?>

<br>
<form method="post" name="visRomtypeSkjema" id="visRomtypeSkjema">
	<input type="submit" name="visRomtypeKnapp" id="visRomtypeKnapp" value="Vis registrerte romtyper">
</form>

<?php
if (isset($_POST['visRomtypeKnapp'])) {
	
	$sqlSetning		= "SELECT * FROM romtype ORDER BY romtype ASC;";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Registrerte Romtyper</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Hotell</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
			$romtype=$rad['romtype']; 

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $romtype </td></tr>");
		}
		print("</table>");
}

?>




<br>
<form method="post" name="visHotellRomtypeSkjema" id="visHotellRomtypeSkjema">
	<input type="submit" name="visHotellRomtypeKnapp" id="visHotellRomtypeKnapp" value="Vis registrerte romtyper på hotell">
</form>

<?php
if (isset($_POST['visHotellRomtypeKnapp'])) {
	
	$sqlSetning		= "SELECT * FROM hotellromtype ORDER BY hotellnavn ASC;";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Registrerte Romtyper på Hotell</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Hotell</th> <th align=left>Romtype</th><th align=left>Antall Rom</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
			$hotellnavn=$rad['hotellnavn']; 
			$romtype=$rad['romtype']; 
			$antallrom=$rad['antallrom'];

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $hotellnavn </td> <td> $romtype </td><td> $antallrom </td></tr>");
		}
		print("</table>");
}


?>




<br>
<form method="post" name="visHotellRomSkjema" id="visHotellRomSkjema">
	<input type="submit" name="visHotellRomKnapp" id="visHotellRomKnapp" value="Vis registrerte rom på hotell">
</form>

<?php
if (isset($_POST['visHotellRomKnapp'])) {
	
	$sqlSetning		= "SELECT * FROM rom ORDER BY hotellnavn ASC;";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Registrerte Rom på Hotell</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Hotell</th> <th align=left>Romtype</th><th align=left>Romnr</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
			$hotellnavn=$rad['hotellnavn']; 
			$romtype=$rad['romtype']; 
			$romnr=$rad['romnr'];

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $hotellnavn </td> <td> $romtype </td><td> $romnr </td></tr>");
		}
		print("</table>");
}

	include "slutt.html";

?>