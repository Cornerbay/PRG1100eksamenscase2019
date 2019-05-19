<?php include "start.php" ?>

<?php //Sjekk hvilken rolle bruker har
  @$innloggetBruker=$_SESSION; //@ for å slippe unødig warning
  if ($innloggetBruker['rolle']!="admin") {
    print("Denne siden krever innlogging!<br>");

    print("Du vil bli sendt til innlogging om 2 sekunder");

    include "slutt.html";

    die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");
  }
?>

<h3>Slett fra tabell av hotell</h3>
<!-- Hotell -->
<form method="post" name="finnHotellSkjema" id="finnHotellSkjema">
	Hotell: <select name="hotellnavn" id="hotellnavn">
		<?php listeboksHotellnavn(); ?>	
	</select>
	<input type="submit" name="slettHotellKnapp" id="slettHotellKnapp" value="Slett hotell">
</form>
<?php 
	if (isset($_POST['slettHotellKnapp'])) {
		$hotellnavn = $_POST['hotellnavn'];

		$sqlSetning = "DELETE FROM hotell WHERE hotellnavn='$hotellnavn';";
		mysqli_query($db,$sqlSetning) or die ("ikke mulig å slette romtype fordi den finnes i en annen tabell");

		print("$hotellnavn er nå slettet");
	}
?>

<h3>Slett fra tabell av romtyper</h3>
<!-- romtype -->
<form method="post" name="finnRomtypeSkjema" id="finnRomtypeSkjema">
	Romtype: <select name="romtype" id="romtype">
		<?php listeboksRomtype(); ?>
	</select>
	<input type="submit" name="slettRomtypeKnapp" id="slettRomtypeKnapp" value="Slett romtype">
</form>

<?php 
	if (isset($_POST['slettRomtypeKnapp'])) {
		$romtype = $_POST['romtype'];

		$sqlSetning = "DELETE FROM romtype WHERE romtype='$romtype';";
		mysqli_query($db,$sqlSetning) or die ("ikke mulig å slette romtype fordi den finnes i en annen tabell");

		print("$romtype er nå slettet fra listen over romtyper");
	}
?>


<h3>Slett fra tabell av hotell med romtyper </h3>
<!-- hotell og romtype -->
<form method="post" name="finnHotellromtypeSkjema" id="finnHotellromtypeSkjema">
	Hotell: <select name="hotellromtypenavn" id="hotellromtypenavn">
		<?php listeboksHotellromtypnavn(); ?>
	</select>
	<input type="submit" name="finnHotellromtypeKnapp" id="finnHotellromtypeKnapp" value="Finn romtype å slette">
</form>
<?php

	if (isset($_POST['finnHotellromtypeKnapp'])) {
		$hotellnavn = $_POST['hotellromtypenavn'];

		?>
		<form method="post" name="slettHotellromtypeSkjema" id="slettHotellromtypeSkjema">
			<input type="hotellromtypenavn" name="hotellromtypenavn" value="<?php echo $hotellnavn ?>" readonly>
			Romtype:<select name="hotellromtype" id="hotellromtype">
				<?php listeboksHotellromtypeRomtype($hotellnavn); ?>
			</select>
			<input type="submit" name="slettHotellromtypeKnapp" id="slettHotellromtypeKnapp" value="Slett fra tabell">
		</form>
		<?php
	}

	if (isset($_POST['slettHotellromtypeKnapp'])) {
		
		$hotellnavn = $_POST['hotellromtypenavn'];
		$romtype 	= $_POST['hotellromtype'];

		$sqlSetning = "DELETE FROM hotellromtype WHERE hotellnavn='$hotellnavn' AND romtype='$romtype';";
		mysqli_query($db,$sqlSetning) or die ("ikke mulig å slette romtype fordi den finnes i en annen tabell");

		print("Romtype $romtype er nå slettet fra $hotellnavn");
	}
?>


<h3>Slett fra tabell av hotell med romnr</h3>
<!-- hotell og romnr -->

<form method="post" name="finnHotellromnrSkjema" id="finnHotellromnrSkjema">
	Hotell: <select name="hotellromnrnavn" id="hotellromnrnavn">
		<?php listeboksHotellromnavn(); ?>
	</select>
	<input type="submit" name="finnHotellromnrKnapp" id="finnHotellromnrKnapp" value="Finn romnr å slette">
</form>
<?php

	if (isset($_POST['finnHotellromnrKnapp'])) {
		$hotellnavn = $_POST['hotellromnrnavn'];

		?>
		<form method="post" name="slettHotellromnrSkjema" id="slettHotellromnrSkjema">
			<input type="hotellromnrnavn" name="hotellromnrnavn" value="<?php echo $hotellnavn ?>" readonly>
			Romnr:<select name="hotellromnr" id="hotellromnr">
				<?php listeboksHotellromnr($hotellnavn); ?>
			</select>
			<input type="submit" name="slettHotellromnrKnapp" id="slettHotellromnrKnapp" value="Slett fra tabell">
		</form>
		<?php
	}

	if (isset($_POST['slettHotellromnrKnapp'])) {
		
		$hotellnavn = $_POST['hotellromnrnavn'];
		$romnr 	= $_POST['hotellromnr'];

		$sqlSetning = "DELETE FROM rom WHERE hotellnavn='$hotellnavn' AND romnr='$romnr';";
		mysqli_query($db,$sqlSetning) or die ("ikke mulig å slette romnr fordi den finnes i en annen tabell");

		print("Romnr $romnr er nå slettet fra $hotellnavn");
	}
?>


<?php include "slutt.html"?>