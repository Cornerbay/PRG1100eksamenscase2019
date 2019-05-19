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

<form method="post" name="finnHotellSkjema" id="finnHotellSkjema">
	<select name="hotellnavn" id="hotellnavn">
		<?php listeboksHotellromnavn(); ?>
		<input type="submit" name="finnHotellKnapp" id="finnHotellKnapp" value="Finn rom på hotell">
	</select>
</form>

<?php

if (isset($_POST['finnHotellKnapp'])) {
	$hotellnavn=$_POST['hotellnavn'];
	
	?>
	<form method="post" name="bestillingsSkjema" id="bestillingsSkjema">
		<input type="text" name="hotellnavn" id="hotellnavn" value="<?php echo "$hotellnavn"; ?>" readonly><br>
		<select name="velgRomtype" id="velgRomtype">
			<?php listeboksHotellromtypeRomtype($hotellnavn); ?>
		</select><br>
		<input type="date" name="datofra" id="datofra">
		<input type="date" name="datotil" id="datotil"><br>
		<input type="submit" name="bestillingsKnapp" id="bestillingsKnapp"><br>
	</form>

	<?php
}

if (isset($_POST['bestillingsKnapp'])) {
	$hotellnavn 	= $_POST['hotellnavn'];
	$romtype 		= $_POST['velgRomtype'];
	$datoFra 		= $_POST['datofra'];
	$datoTil 		= $_POST['datotil'];
	$brukernavn 	= $_SESSION['brukernavn'];

	$bestillingSjekk = false;

	$hotellRomnrArray = hotellRomnrArray($hotellnavn,$romtype);
	$arrayStorrelse = count($hotellRomnrArray);

	for ($i=0; $i < $arrayStorrelse ; $i++) { 
		$romnr = $hotellRomnrArray[$i];

		if (sjekkOmRomErLedig($hotellnavn,$romnr,$datoFra,$datoTil)) //returnerer true dersom det ikke er noen bestillinger som er like
		{

          $sqlSetning   = "INSERT INTO bestilling VALUES('','$brukernavn', '$hotellnavn','$romtype','$romnr','$datoFra','$datoTil');";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

          print ("Bestilling utført med følgende opplysninger <br> Hotell: $hotellnavn<br> Romtype: $romtype<br> Romnr: $romnr<br> Periode: $datoFra-$datoTil ");
          $bestillingSjekk = true;
          break; 
		}
	}
	/*Sjekker hvorvidt det er blitt utført en bestiling. Hvis ikke, så printer ut feilmelding*/
	if (!$bestillingSjekk) {
		echo "Ingen ledige $romtype i perioden $datoFra - $datoTil";
	}
}
?>

<?php include "slutt.html";?>