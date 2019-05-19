<!-- slettbestilling.php -->

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

<h3>Slett bestilling</h3>

<form method="post" name="visBestillingSkjema" id="visBestillingSkjema" onsubmit="return bekreft();">
	<select name="bestillingsID" id="bestillingsID">
		<?php listeboksBestilling($brukernavn); ?>
	</select>
	<input type="submit" name="slettBestillingKnapp" id="slettBestillingKnapp" value="Slett denne bestillingen">
</form>

<?php 

	if (isset($_POST['slettBestillingKnapp'])) {
		$bestillingsID = $_POST['bestillingsID'];

		$sqlSetning = "DELETE FROM bestilling WHERE bestillings_id='$bestillingsID';";
		mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server, siste slett bestilling");

		print("Bestilling nr $bestillingsID er nå slettet fra databasen");
	}


?>


<?php include "slutt.html"; ?>