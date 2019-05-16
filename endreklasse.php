<?php include "start.php"; ?>

<h3>Endre klasse</h3>
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
		$sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
		$sqlResultat = mysqli_query($db,$sqlSetning);
		$rad = mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
		$klassekode = $rad[0];
		$klassenavn = $rad[1];

		?>
		<!-- html-kode for et skjema-->
		<form method='post' name='endreKlasseSkjema' id='endreKlasseSkjema'>
		Klassekode: <input type='text' name='klassekode2' id='klassekode2' value="<?php print("$klassekode"); ?>" readonly><br>
		Klassenavn: <input type='text' name='klassenavn2' id='klassenavn2' value="<?php print("$klassenavn"); ?>" ><br>
		<input type='submit' name='endreKlasseKnapp' id='endreKlasseKnapp' value='Endre klassenavn'>
		</form>

		<?php
	}
	
	if (isset($_POST["endreKlasseKnapp"])) 
		{
			
			$klassekode=$_POST["klassekode2"];
			$klassenavn=$_POST["klassenavn2"];

			if (!trim($klassenavn)) 
				{
					// echo '<script>console.log("hei2")</script>';
					echo utf8_encode("Du må fylle ut klassenavn");
				}
			else
				{
					$sqlSetning = "UPDATE klasse SET klassenavn='$klassenavn' WHERE klassekode='$klassekode';";
					mysqli_query($db,$sqlSetning) or die ("ikke mulig å endre database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/
         			print ("Klassekode $klassekode er nå oppdatert med klassenavn: $klassenavn"); 
				}
		}




?>




<?php include "slutt.html"; ?>