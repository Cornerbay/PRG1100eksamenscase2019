<?php include "start.php"; ?>
<h3>Endre student</h3>
<form method="post" name="finnStudentSkjema" id="finnStudentSkjema">

Velg en student:
<select name="brukernavn" id="brukernavn">

<?php listeboksBrukernavn(); ?>
	
</select><br>
<input type="submit" name="submit" id="submit" value="Finn student">
</form>

<?php

if (isset($_POST["submit"]))
	{
		$brukernavn=$_POST["brukernavn"];
		$sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
		$sqlResultat = mysqli_query($db,$sqlSetning);
		$rad = mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
		$brukernavn = $rad[0];
		$fornavn    = $rad[1];
		$etternavn	= $rad[2];
		$currentKlassekode = $rad[3];
		$leveringsfrist = $rad[4];
		$currentBildenr = $rad[5];

		?>
		<!-- html-kode for et skjema-->
		<form method='post' name='endreKlasseSkjema' id='endreKlasseSkjema'>
		Brukernavn: <input type='text' name='brukernavn2' id='brukernavn2' value="<?php print("$brukernavn"); ?>" readonly><br>
		Fornavn: <input type='text' name='fornavn2' id='fornavn2' value="<?php print("$fornavn"); ?>" ><br>
		Etternavn: <input type='text' name='etternavn2' id='etternavn2' value="<?php print("$etternavn"); ?>" ><br>
		Klassekode:<select name="klassekode" id="klassekode">

		<?php listeboksValgtKlassekode($currentKlassekode); ?>
			
		</select><br>
		Neste leveringsfrist <input type="date" name="leveringsfrist" id="leveringsfrist" value="<?php print("$leveringsfrist")?>"><br>
		Bildenr <select name="bildenr" id="bildenr">
		  
		<?php listeboksValgtBildenr($currentBildenr); ?>

		</select><br>
		<input type='submit' name='endreStudentKnapp' id='endreStudentKnapp' value='Endre student'>
		</form>

		<?php
	}
	
	if (isset($_POST["endreStudentKnapp"])) 
		{
			$brukernavn=$_POST["brukernavn2"];
			$fornavn=$_POST["fornavn2"];
			$etternavn=$_POST["etternavn2"];
			$klassekode=$_POST["klassekode"];
			$leveringsfrist=$_POST["leveringsfrist"];
			$bildenr=$_POST["bildenr"];

			if (!trim($fornavn) || !trim($etternavn)) 
				{
					print("Du må fylle ut både fornavn og etternavn");
				}
			else
				{
					$sqlSetning = "UPDATE student SET fornavn='$fornavn',etternavn='$etternavn',klassekode='$klassekode',`neste leveringsfrist`='$leveringsfrist',bildenr='$bildenr' WHERE brukernavn='$brukernavn';";
					mysqli_query($db,$sqlSetning) or die ("ikke mulig å endre database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/
         			print ("Student $brukernavn er nå oppdatert"); 
				}
		}




?>




<?php include "slutt.html"; ?>