<!-- endrebestilling.php -->

<?php include "start.php"; ?>

<?php //Sjekk hvilken rolle bruker har
  @$innloggetBruker=$_SESSION; //@ for å slippe unødig warning
  if (@$innloggetBruker['rolle']!="bruker" && @$innloggetBruker['rolle']!="admin") {
    print("Denne siden krever innlogging!<br>");

    print("Du vil bli sendt til innlogging om 2 sekunder");

    include "slutt.html";

    die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");
  }
  $brukernavn = $_SESSION['brukernavn'];
?>

<h3>Endre bestillingen din</h3>

<form method="post" name="visBestillingSkjema" id="visBestillingSkjema">
	<select name="bestillingsID" id="bestillingsID">
		<?php listeboksBestilling($brukernavn); ?>
	</select>
	<input type="submit" name="visBestillingKnapp" id="visBestillingKnapp" value="Endre denne bestillingen">
</form>

<?php
if (isset($_POST['visBestillingKnapp'])) {
	$bestillingsID = $_POST['bestillingsID'];
	$bestilling = hentBestilling($bestillingsID);
	?>

	<h3>Skriv inn opplysninger på endret bestilling</h3>

	<form method="post" name="endreBestillingSkjema" id="endreBestillingSkjema">
		<input type="hidden" name="bestillingsID" id="bestillingsID" value="<?php echo $bestillingsID ?>">
		<input type="text" name="hotellnavn" id="hotellnavn" value="<?php echo $bestilling['hotellnavn'] ?>" readonly><br>
		<select name="romtype" id="romtype">
			<?php listeboksHotellromnrRomtype($bestilling['hotellnavn']); ?>
		</select><br>
		<input type="date" name="datofra" id="datofra" value="<?php echo $bestilling['dato_fra'] ?>"><br>
		<input type="date" name="datotil" id="datotil" value="<?php echo $bestilling['dato_til'] ?>"><br>
		<input type="submit" name="endreBestillingKnapp" id="endreBestillingKnapp"><br>
	</form>

	<?php

}
if (isset($_POST['endreBestillingKnapp'])) {
	$bestillingsID 	= $_POST['bestillingsID'];
	$brukernavn		= $_SESSION['brukernavn'];
	$hotellnavn		= $_POST['hotellnavn'];
	$romtype		= $_POST['romtype'];
	$datoFra 		= $_POST['datofra'];
	$datoTil 		= $_POST['datotil'];

	$bestillingSjekk = false;

	$hotellRomnrArray = hotellRomnrArray($hotellnavn,$romtype);
	$arrayStorrelse = count($hotellRomnrArray);

	for ($i=0; $i < $arrayStorrelse ; $i++) { 
		$romnr = $hotellRomnrArray[$i];

		if (sjekkOmRomErLedig($hotellnavn,$romnr,$datoFra,$datoTil)) //returnerer true dersom det ikke er noen bestillinger som er like
		{

          $sqlSetning   = "UPDATE bestilling 
          					SET brukernavn='$brukernavn',hotellnavn='$hotellnavn',romtype = '$romtype',romnr='$romnr', dato_fra = '$datoFra', dato_til = '$datoTil'
          					WHERE bestillings_id = '$bestillingsID';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

          print ("Endring utført med følgende opplysninger <br> Hotell: $hotellnavn<br> Romtype: $romtype<br> Romnr: $romnr<br> Periode: $datoFra-$datoTil ");
          $bestillingSjekk = true;
          break; 
		}
	}
	if (!$bestillingSjekk) {
		echo "Det ingen rom ledige på dette tidspunktet";
	}
}
?>


<?php include "slutt.html" ?>