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
		$hotellnavn 	= utf8_decode($_POST["hotell"]);
		$sqlSetning 	= "SELECT * FROM hotell WHERE hotellnavn='$hotellnavn';";
		$sqlResultat	= mysqli_query($db,$sqlSetning);
		$rad 			= mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
		$hotellnavn 	= utf8_encode($rad['hotellnavn']);
		$sted 			= utf8_encode($rad['sted']);

		?>
		<!-- html-kode for et skjema-->
		<form method='post' name='endreHotellSkjema' id='endreHotellSkjema'>
		Hotellnavn: <input type='text' name='hotellnavn' id='hotellnavn' value="<?php print("$hotellnavn"); ?>" readonly><br>
		Sted: <input type='text' name='sted' id='sted' value="<?php print("$sted"); ?>" ><br>
		<input type='submit' name='endreHotellKnapp' id='endreHotellKnapp' value='Endre Hotellsted'>
		</form>

		<?php
	}
	
if (isset($_POST["endreHotellKnapp"])) 
	{
		
		$hotellnavn=utf8_decode($_POST["hotellnavn"]);
		$sted=utf8_decode($_POST["sted"]);

		if (!trim($sted)) 
			{
				// echo '<script>console.log("hei2")</script>';
				echo utf8_encode("Du må fylle ut klassenavn");
			}
		else
			{
				$sqlSetning = "UPDATE hotell SET sted='$sted' WHERE hotellnavn='$hotellnavn';";
				mysqli_query($db,$sqlSetning) or die ("ikke mulig å endre database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/
     			print utf8_encode("Hotell $hotellnavn er n&aring endret til sted: $sted"); 
			}
	}




?>

<h3>Endre romtype</h3>

<form method="post" name="visRomtypeSkjema" id="visRomtypeSkjema">
	<select name="velgRomtype" id="velgRomtype">
		<?php listeboksHotellromtype(); ?>
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


<?php include "slutt.html"; ?>