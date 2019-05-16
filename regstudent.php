<?php include "start.php"; ?>

<h3>Registrer student</h3>

<form method="post" name="registrerStudentSkjema" id="registrerStudentSkjema">
Brukernavn <input type="text" name="brukernavn" id="brukernavn"><br>
Fornavn <input type="text" name="fornavn" id="fornavn"><br>
Etternavn <input type="text" name="etternavn" id="etternavn"><br>
Klassekode <select name="klassekode" id="klassekode">

<?php listeboksKlassekode(); ?>

</select><br>
Neste leveringsfrist <input type="date" name="leveringsfrist" id="leveringsfrist"><br>
Bildenr <select name="bildenr" id="bildenr">
  
<?php listeboksBildenr(); ?>

</select><br>
<input type="submit" name="registrerStudentKnapp" id="registrerStudentKnapp" value="Registrer">
<input type="reset" name="nullstillKnapp" id="nullstillKnapp" value="Nullstill">
</form>


<?php 
  if (isset($_POST ["registrerStudentKnapp"]))
    {
      
      $brukernavn=$_POST["brukernavn"];
      $fornavn=$_POST["fornavn"];
      $etternavn=$_POST["etternavn"];
      $klassekode=$_POST ["klassekode"];
      $leveringsfrist=$_POST["leveringsfrist"];
      $bildenr=$_POST["bildenr"];
      

      if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode || !$leveringsfrist || !$bildenr)
        {
          print ("Alle felt må fylles ut");

        }
      else
        {

            $sqlSetning   = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
            $sqlResultat  = mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");
            $antallRader  = mysqli_num_rows($sqlResultat);


          if ($antallRader!=0)  /* klassenavnet er registrert fra før */
            {
              print ("Student er registrert fra f&oslashr");
            }
          else
            {

              $sqlSetning   = "INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode','$leveringsfrist','$bildenr');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig å registrere i database-server"); /*trenger ikke å sette denne inn i en variabel som ovenfor fordi resultatet er ikke nødvendig fordi man ikke bruker det videre*/

              print ("Følgende Student er nå registrert: <br>Brukernavn: $brukernavn <br>Fornavn: $fornavn <br>Etternavn: $etternavn<br>Klassekode: $klassekode<br> innleveringsfrist: $leveringsfrist<br> bildenummer: $bildenr"); 
            }
        }
    }
?> 

<?php include "slutt.html"; ?>