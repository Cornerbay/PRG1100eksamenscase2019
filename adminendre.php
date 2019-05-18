<?php include "start.php"; ?>

<h3>Endre Hotellsted</h3>
<form method="post" name="finnHotellSkjema" id="finnHotellSkjema">

Velg et hotell:
<select name="hotell" id="hotell">

<?php listeboksHotellnavn(); ?>
	
</select><br>
<input type="submit" name="finnHotellKnapp" id="finnHotellKnapp" value="Finn hotell">
</form>

<?php

if (isset($_POST["finnHotellKnapp"]))
	{
		$hotellnavn 	= $_POST["hotell"];
		$sqlSetning 	= "SELECT * FROM hotell WHERE hotellnavn='$hotellnavn';";
		$sqlResultat	= mysqli_query($db,$sqlSetning);
		$rad 			= mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
		$hotellnavn 	= $rad['hotellnavn'];
		$sted 			= $rad['sted'];

		?>
		<!-- html-kode for et skjema-->
		<form method='post' name='endreHotellSkjema' id='endreHotellSkjema'>
		Tidligere hotellnavn <input type='text' name='tidligereHotellnavn' id='tidligereHotellnavn' value="<?php print("$hotellnavn"); ?>" readonly><br>
		Hotellnavn: <input type='text' name='hotellnavn' id='hotellnavn' value=""><br>
		Sted: <input type='text' name='sted' id='sted' value="<?php print("$sted"); ?>" ><br>
		<input type='submit' name='endreHotellKnapp' id='endreHotellKnapp' value='Endre Hotellsted'>
		</form>

		<?php
	}
	
if (isset($_POST["endreHotellKnapp"])) 
	{
		$tidligereHotellnavn = $_POST['tidligereHotellnavn'];
		$hotellnavn=$_POST["hotellnavn"];
		$sted=$_POST["sted"];

		if (!trim($sted)|| !trim($hotellnavn)) 
			{
				// echo '<script>console.log("hei2")</script>';
				"Du må fylle ut klassenavn";
			}
		else
			{
				$sqlSetning = "UPDATE hotell SET hotellnavn='$hotellnavn',sted='$sted' WHERE hotellnavn='$tidligereHotellnavn';";
				mysqli_query($db,$sqlSetning) or die ("ikke mulig å endre database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/
     			print "Hotell $tidligereHotellnavn er n&aring endret $hotellnavn $sted"; 
			}
	}




?>

<h3>Endre romtype</h3>

<form method="post" name="visRomtypeSkjema" id="visRomtypeSkjema">
	<select name="velgRomtype" id="velgRomtype">
		<?php listeboksRomtype(); ?>
	</select>
	<input type="submit" name="visRomtypeKnapp" id="visRomtypeKnapp" value="Trykk for å endre romtype">
</form>

<?php

if (isset($_POST['visRomtypeKnapp'])) {
	$romtype = $_POST['velgRomtype'];
	?>
	<form method="post" name="endreRomtypeSkjema" id="endreRomtypeSkjema">
		Gammel romtype: <input type="text" name="romtypeGammel" id="romtypeGammel" value="<?php echo "$romtype"?>" readonly><br>
		Ny romtype: <input type="text" name="romtypeEndring" id="romtypeEndring" ><br>
		<input type="submit" name="endreRomtypeKnapp" id="endreRomtypeKnapp" value="Endre romtype">
	</form>


	<?php
}

if (isset($_POST['endreRomtypeKnapp'])) {
	$romtypeEndret = $_POST['romtypeEndring'];
	$romtype = $_POST['romtypeGammel'];
	
	if (!trim($romtypeEndret)) {
		echo "Du må fylle inn feltet";
	}else{
		$sqlSetning = "UPDATE romtype SET romtype = '$romtypeEndret' WHERE romtype = '$romtype';";
		mysqli_query($db,$sqlSetning) OR die ("Kan ikke endre grunnet at det finnes en annen tabell koblet mot denne verdien");
		print ("Romtype $romtype er nå endret til <b>$romtypeEndret</b>");
	}
}


?>

<h3> Endre hvor mange rom hotellet har</h3>
<form method="post" name="visHotellromtypeSkjema" id="visHotellromtypeSkjema">
	
	<select name="visHotellromtypenavn" id="visHotellromtypenavn">
		<?php listeboksHotellromtypnavn(); ?>
	</select>
	<input type="submit" name="visHotellromtypeKnapp" id="visHotellromtypeKnapp">

</form><br>

<?php

if (isset($_POST['visHotellromtypeKnapp'])) {
	
	$hotellnavn = $_POST['visHotellromtypenavn'];

	?>
	<form method="post" name="visHotellromtypeSkjema2" id="visHotellromtypeSkjema2">
		Hotellnavn <input type="text" name="hotellromtypenavn" id="hotellromtypenavn" value="<?php echo "$hotellnavn" ?>" readonly><br>
		Romtype <select name="visHotellromtype" id="visHotellromtype">
			<?php listeboksHotellromtypeRomtype($hotellnavn)?>
			
		</select>
		<input type="submit" name="visHotellromtypeKnapp2" id="visHotellromtypeKnapp2">
	</form>

<?php
}

if (isset($_POST['visHotellromtypeKnapp2'])) {
	$hotellnavn=$_POST['hotellromtypenavn'];
	$romtype=$_POST['visHotellromtype'];
	?>
	<form method="post" name="endreHotellromtypeSkjema" id="endreHotellromtypeSkjema" >
		<input type="hidden" name="gammelHotellromtypenavn" id="gammelHotellromtypenavn" value="<?php echo "$hotellnavn"; ?>">
		<input type="hidden" name="gammelHotellromtype" id="gammelHotellromtype" value="<?php echo "$romtype" ?>">
		Nytt Hotellnavn <input type="text" name="endreHotellromtypenavn" id="endreHotellromtypenavn" value="<?php echo "$hotellnavn";?>"><br>
		Nytt romtypenavn <select name="endreHotellromtype" id="endreHotellromtype">
			<?php valgtListeboksRomtype($romtype); ?>
			
		</select><br>
		Nytt antall gitt rom <input type="endreHotellromtypeAntallRom" name="endreHotellromtypeAntallRom" value="<?php listeboksHotellromtypeAntallrom($hotellnavn, $romtype);?>"><br>
		<input type="submit" name="endreHotellromtypeKnapp" id="endreHotellromtypeKnapp" value="Endre verdier">
	</form>

<?php
}

if (isset($_POST['endreHotellromtypeKnapp'])) {
	$gammelHotellromtypenavn 	= $_POST['gammelHotellromtypenavn'];
	$gammelHotellromtype 		= $_POST['gammelHotellromtype'];
	$hotellnavn 				= $_POST['endreHotellromtypenavn'];
	$romtype 					= $_POST['endreHotellromtype'];
	$antallrom 					= $_POST['endreHotellromtypeAntallRom'];

	if (!trim($hotellnavn) || !trim($romtype) || !trim($antallrom)) {
		echo "Du må fylle inn alle feltene!";
	}else{

		$sqlSetning = "UPDATE hotellromtype SET hotellnavn='$hotellnavn',romtype = '$romtype',antallrom='$antallrom' WHERE hotellnavn = '$gammelHotellromtypenavn' AND romtype='$gammelHotellromtype';";
		mysqli_query($db,$sqlSetning) OR die ("Kan ikke endre grunnet at det finnes en annen tabell koblet mot denne verdien");
		print ("$gammelHotellromtypenavn med $gammelHotellromtype er nå endret til <b>$hotellnavn, $romtype, $antallrom</b>");

	}
}

?>

<h3>Endre romnavn</h3>

<form method="post" name="visHotellromnavnSkjema" id="visHotellromnavnSkjema">
	<select name="velgHotellromnavn" id="velgHotellromnavn">
		<?php listeboksHotellromnavn(); ?>
	</select>
	<input type="submit" name="visHotellromnavnKnapp" id="visHotellromnavnKnapp" value="Trykk for å vise romnr tilgjengelig for endring">
</form>

<?php 
if (isset($_POST['visHotellromnavnKnapp'])) {
	$hotellnavn = $_POST['velgHotellromnavn'];

	?>
	<form method="post" name="visHotellromnavnSkjema2" id="visHotellromnavnSkjema2">
		<input type="hidden" name="hotellromnavn" id="hotellromnavn" value="<?php echo "$hotellnavn" ?>">
		<select name="velgHotellromnr" id="velgHotellromnr">
			<?php listeboksHotellromnr($hotellnavn); ?>
		</select>
		<input type="submit" name="visHotellromnavnKnapp2" id="visHotellromnavnKnapp2" value="Trykk for å gå videre til endringsskjema">
	</form>

	<?php

}

if (isset($_POST['visHotellromnavnKnapp2'])) {
	$romnrArray = listeboksHotellromnrArray($_POST['hotellromnavn'],$_POST['velgHotellromnr']);
	$hotellnavn = $romnrArray['hotellnavn'];
	$romnr 		= $romnrArray['romnr'];
	$romtype 	= $romnrArray['romtype']

	?>
	<form method="post" name="endreHotellromnrSkjema" id="endreHotellromnrSkjema">
		<input type="hidden" name="gammeltHotellromnrnavn" id="gammeltHotellromnrnavn">
		<input type="hidden" name="gammeltHotellromnr" id="gammeltHotellromnr">
		Nytt hotellnavn <input type="text" name="endreHotellromnrnavn" id="endreHotellromnrnavn" value="<?php echo "$hotellnavn";?>"><br>
		Nytt romtypenavn <select name="endreHotellromtype" id="endreHotellromtype">
			<?php valgtListeboksRomtype($romtype); ?>
		</select><br>
		Nytt Romnr <input type="text" name="endreHotellromnr" id="endreHotellromnr" value="<?php echo "$romnr" ?>"><br>
		<input type="submit" name="endreHotellromnrKnapp" id="endreHotellromnrKnapp" value="Endre hotell romnr">
		

	</form>


	<?php
}

if (isset($_POST['endreHotellromnrKnapp'])) {
	$gammeltHotellromnrnavn 	= $_POST['gammeltHotellromnrnavn'];
	$gammeltHotellromnr 		= $_POST['gammeltHotellromnr'];
	$hotellnavn 				= $_POST['endreHotellromnrnavn'];
	$romtype 					= $_POST['endreHotellromtype'];
	$romnr 						= $_POST['endreHotellromnr'];

	if (!trim($hotellnavn) || !trim($romtype) || !trim($romnr) ) {
		echo "Du må fylle ut alle feltene!";
	}else{

		$sqlSetning = "UPDATE rom SET hotellnavn='$hotellnavn',romtype = '$romtype',romnr='$romnr' WHERE hotellnavn = '$gammeltHotellromnrnavn' AND romnr='$gammeltHotellromnr';";
		mysqli_query($db,$sqlSetning) OR die ("Kan ikke endre grunnet at det finnes en annen tabell koblet mot denne verdien");
		print ("$gammeltHotellromnrnavn med rom nr $gammeltHotellromnr er nå endret til <b>$hotellnavn, $romtype, $romnr</b>");

	}
}
?>

<?php include "slutt.html"; ?>