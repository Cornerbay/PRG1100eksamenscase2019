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

<form method="post" name="visBestillingSkjema" id="visBestillingSkjema">
	<select name="bestillingsID" id="bestillingsID">
		<?php listeboksBestilling(); ?>
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
		<input type="text" name="romtype" id="romtype" value="<?php echo $bestilling['romtype'] ?>"><br>
		<input type="date" name="datofra" id="datofra" value="<?php echo $bestilling['dato_fra'] ?>"><br>
		<input type="date" name="datotil" id="datotil" value="<?php echo $bestilling['dato_til'] ?>"><br>
		<input type="submit" name="endreBestillingKnapp" id="endreBestillingKnapp"><br>
	</form>

	<?php

}
if (isset($_POST['endreBestillingKnapp'])) {
	
}
?>


<?php include "slutt.html" ?>