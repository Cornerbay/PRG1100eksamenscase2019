<?php include "start.php"; ?>

<h3> Slett klasse </h3>
<form method="post" id="velgKlassekodeSkjema" name="velgKlassekodeSkjema" onsubmit="return bekreft();">
	<select id="klassekode" name="klassekode">
		<?php listeboksKlassekode(); ?>
	</select><br>
	<input type="submit" name="submit" id="submit">
</form>

<?php

if (isset($_POST["submit"])) 
	{
		include("dbtilkobling.php");
		$valgtKlassekode=$_POST["klassekode"];
		$sqlSetning		= "SELECT * FROM student;";
		$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

		$antallRader	= mysqli_num_rows($sqlResultat);
		$error=0;
		for ($r=1;$r<=$antallRader;$r++) 
			{ 
				$rad=mysqli_fetch_array($sqlResultat,MYSQLI_NUM);
				$klassekode=$rad[3];

				if ($valgtKlassekode==$klassekode) 
				{
					$error=1;
					die ("Kan ikke slette klasse fra database grunnet at det er en eller flere studenter registrert i klassen.");
				}

			}
		if ($error==0) 
			{
				$sqlSetning	= "DELETE FROM klasse WHERE klassekode='$valgtKlassekode';";
				mysqli_query($db,$sqlSetning) or die("ikke mulig å slette fra database-server");
				print("$valgtKlassekode er nå slettet fra databasen");

			}
		
		include "slutt.html";
	
	}

?>