<?php include "start.php"; ?>

<h3>Slett student</h3>

<form method="post" id="velgStudentSkjema" name="velgStudentSkjema" onsubmit="return bekreft();">
	<select id="brukernavn" name="brukernavn">
		<?php listeboksBrukernavn(); ?>
	</select><br>
	<input type="submit" name="submit" id="submit">
</form>

<?php

if (isset($_POST["submit"])) 
	{
		include("dbtilkobling.php");
		$valgtBrukernavn=$_POST["brukernavn"];
		$sqlSetning = "SELECT * FROM student WHERE brukernavn='$valgtBrukernavn';";
		$sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");
		$rad=mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
		$fornavn=$rad[1];
		$etternavn=$rad[2];

		$sqlSetning	= "DELETE FROM student WHERE brukernavn='$valgtBrukernavn';";
		mysqli_query($db,$sqlSetning) or die("ikke mulig å slette fra database-server");
		print("$fornavn $etternavn er nå slettet fra databasen");
		
		include "slutt.html";
	
	}

?>