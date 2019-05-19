<?php include "start.php"; ?>

<?php //Sjekk hvilken rolle bruker har
  @$innloggetBruker=$_SESSION; //@ for å slippe unødig warning
  if ($innloggetBruker['rolle']!="admin") {
    print("Denne siden krever innlogging!<br>");

    print("Du vil bli sendt til innlogging om 2 sekunder");

    include "slutt.html";

    die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");
  }
?>

<h3>Registrer Hotell</h3>

<form method="post" name="registrerHotellSkjema" id="registrerHotellSkjema">
Hotellnavn <input type="text" name="hotellnavn" id="hotellnavn"><br>
Sted <input type="text" name="sted" id="sted"><br>
<input type="submit" name="registrerHotellKnapp" id="registrerHotellKnapp" value="Registrer">
<input type="reset" name="nullstillHotellKnapp" id="nullstillHotellKnapp" value="Nullstill">
</form>


<?php 
  if (isset($_POST ["registrerHotellKnapp"]))
    {
      
      $hotellnavn=$_POST["hotellnavn"];
      $sted=$_POST["sted"];

      

      if (!$hotellnavn || !$sted)
        {
          print ("Alle felt må fylles ut");

        }
      else
        {

            $sqlSetning   = "SELECT * FROM hotell WHERE hotellnavn='$hotellnavn';";
            $sqlResultat  = mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");
            $antallRader  = mysqli_num_rows($sqlResultat);


          if ($antallRader!=0)  /* klassenavnet er registrert fra før */
            {
              print ("Hotellnavn er registrert fra f&oslashr");
            }
          else
            {

              $sqlSetning   = "INSERT INTO hotell VALUES('$hotellnavn','$sted');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

              print ("Følgende hotell er nå registrert: <br>Hotellnavn: $hotellnavn <br>Sted: $sted"); 
            }
        }
    }
?> 

<h3>Registrer Romtype</h3>

<form method="post" name="registrerRomtypeSkjema" id="registrerRomtypeSkjema">
Romtype <input type="text" name="romtype" id="romtype"><br>
<input type="submit" name="registrerRomtypeKnapp" id="registrerRomtypeKnapp" value="Registrer">
<input type="reset" name="nullstillRomtypeKnapp" id="nullstillRomtypeKnapp" value="Nullstill">
</form>

<?php 
  if (isset($_POST ["registrerRomtypeKnapp"]))
    {
      
      $romtype=$_POST["romtype"];

      
      if (!$romtype)
        {
          print ("Alle felt må fylles ut");

        }
      else
        {

            $sqlSetning   = "SELECT * FROM romtype WHERE romtype='$romtype';";
            $sqlResultat  = mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");
            $antallRader  = mysqli_num_rows($sqlResultat);


          if ($antallRader!=0)  /* klassenavnet er registrert fra før */
            {
              print ("Romtype er registrert fra f&oslashr");
            }
          else
            {

              $sqlSetning   = "INSERT INTO romtype VALUES('$romtype');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

              print ("Følgende romtype er nå registrert: <br>Romtype: $romtype"); 
            }
        }
    }
?> 

<h3>Registrer antall type hotellrom på hotell</h3>

<form method="post" name="registrerHotellRomtypeSkjema" id="registrerHotellRomtypeSkjema">
Hotellnavn <select name="hotellRomtypeNavn" id="hotellRomtypeNavn">
  <?php listeBoksHotellnavn();?>
</select><br>
Hotellromtype <select name="hotellRomtype" id="hotellRomtype">
  <?php listeBoksHotellromtype();?>
</select><br>
Antall rom <input type="text" name="antallRom" id="antallRom"><br>
<input type="submit" name="registrerHotellRomtypeKnapp" id="registrerHotellRomtypeKnapp" value="Registrer">
<input type="reset" name="nullstillHotellRomtypeKnapp" id="nullstillHotellRomtypeKnapp" value="Nullstill">
</form>

<?php 
  if (isset($_POST ["registrerHotellRomtypeKnapp"]))
    {
      
      $hotellRomtypeNavn  = utf8_decode($_POST["hotellRomtypeNavn"]);
      $hotellRomtype      = utf8_decode($_POST["hotellRomtype"]);
      $antallRom          = $_POST["antallRom"];
     
      if (!$antallRom || !$hotellRomtypeNavn || !$hotellRomtype)
        {
          print ("Alle felt må fylles ut");

        }
      else
        {

            $sqlSetning   = " SELECT * FROM hotellromtype WHERE hotellnavn='$hotellRomtypeNavn' AND romtype='$hotellRomtype';";

            $sqlResultat  = mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");
            $antallRader  = mysqli_num_rows($sqlResultat);


          if ($antallRader!=0)  /* klassenavnet er registrert fra før */
            {
              print ("Romtype på dette hotellet er registrert fra f&oslashr");
            }
          else
            {

              $sqlSetning   = "INSERT INTO hotellromtype VALUES('$hotellRomtypeNavn','$hotellRomtype','$antallRom');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

              print ("Følgende romtype er nå registrert: <br>Hotell: $hotellRomtypeNavn <br>Romtype: $hotellRomtype<br>Antall rom:
                $antallRom"); 
            }
        }
    }
?> 

<h3>Registrer Hotellromnr på hotell</h3>

<form method="post" name="registrerHotellromSkjema" id="registrerHotellromSkjema">
Hotellnavn <select name="hotellromNavn" id="hotellromNavn">
  <?php listeBoksHotellnavn();?>
</select><br>
Hotellromtype <select name="hotellromRomtype" id="hotellromRomtype">
  <?php listeBoksHotellromtype();?>
</select><br>
Romnr <input type="text" name="romnr" id="romnr"><br>
<input type="submit" name="registrerHotellromKnapp" id="registrerHotellromKnapp" value="Registrer">
<input type="reset" name="nullstillHotellromKnapp" id="nullstillHotellromKnapp" value="Nullstill">
</form>


<?php 
  if (isset($_POST ["registrerHotellromKnapp"]))
    {
      
      $hotellromNavn    = $_POST["hotellromNavn"];
      $hotellromRomtype = $_POST["hotellromRomtype"];
      $romnr            = $_POST["romnr"];
     
      if (!$hotellromNavn || !$hotellromRomtype || !$romnr)
        {
          print ("Alle felt må fylles ut");

        }
      else
        {

            $sqlSetning   = " SELECT * FROM rom WHERE hotellnavn='$hotellromNavn' AND romnr='$romnr';";

            $sqlResultat  = mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");
            $antallRader  = mysqli_num_rows($sqlResultat);


          if ($antallRader!=0)  /* klassenavnet er registrert fra før */
            {
              print ("Romnr på dette hotellet er registrert fra f&oslashr");
            }
          else
            {

              $sqlSetning   = "INSERT INTO rom VALUES('$hotellromNavn','$hotellromRomtype','$romnr');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

              print ("Følgende romnr er nå registrert: <br>Hotell: $hotellromNavn <br>Romtype: $hotellromRomtype<br>Romnr:
                $romnr"); 
            }
        }
    }
?>


<?php include "slutt.html"; ?>