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

	$sql="SELECT * FROM bestilling;";
	$resultat=mysqli_query($db, $sql);
			echo "<h2>Tabell hotell:</h2><br/>";
						echo "<table style='width:20%' border='1'>";
						echo "<tr><th>Bestillingsnr</th><th>hotellnavn</th><th>romtype</th><th>Romnr</th><th>brukernavn</th><th>Dato fra</th><th>Dato til</th></tr>";
							while ($myrow=mysqli_fetch_assoc($resultat)){
						
						echo "<tr><th>" . $myrow['bestillings_id'] . "</th><th>" . $myrow['hotellnavn'] . "</th><th>" . $myrow['romtype'] . "</th><th>" . $myrow['romnr'] . "</th><th>" . $myrow['brukernavn'] . "</th><th>" . $myrow['dato_fra'] . "</th><th>" . $myrow['dato_til'] . "</th></tr>";
								}
						echo "</table><br/>";
?>

<?php include "slutt.html" ?>