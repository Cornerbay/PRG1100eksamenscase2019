<?php include "start.php"; ?>

<h3>Registrer klasse</h3>

<form method="post" name="registrerKlasseSkjema" id="registrerKlasseSkjema">
Klassekode <input type="text" name="klassekode" id="klassekode"><br>
Klassenavn <input type="text" name="klassenavn" id="klassenavn"><br>
<input type="submit" name="registrerKlasseKnapp" id="registrerKlasseKnapp" value="Registrer">
<input type="reset" name="nullstillKnapp" id="nullstillKnapp" value="Nullstill">
</form>


<?php 
  if (isset($_POST ["registrerKlasseKnapp"]))
    {
      $klassekode=$_POST ["klassekode"];
      $klassenavn=$_POST ["klassenavn"];

      if (!$klassekode || !$klassenavn)
        {
          print ("B&aring;de klassekode og klassenavn m&aring; fylles ut");

        }
      else
        {

            $sqlSetning   = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
            $sqlResultat  = mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");
            $antallRader  = mysqli_num_rows($sqlResultat);


          if ($antallRader!=0)  /* klassenavnet er registrert fra før */
            {
              print ("Klassen er registrert fra f&oslashr");
            }
          else
            {

              $sqlSetning   = "INSERT INTO klasse VALUES('$klassekode','$klassenavn');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

              print ("Følgende klasse er nå registrert: <br>Klassekode: $klassekode <br>Klassenavn: $klassenavn"); 
            }
        }
    }
?> 

<?php include "slutt.html"; ?>