<?php include "start.php"; ?>
<?php  /* registrer-bruker  */
/*
/*  Programmet registrerer en ny bruker i databasen
*/
?>


<div class="box">
  <div></div>
  <div class="innlogging">

    <h3 class="rainbow">Registrer bruker </h3>

    <form action="" id="registrerBrukerSkjema" name="registrerBrukerSkjema" method="post">
      Brukernavn <input name="brukernavn" type="text" id="brukernavn" required> <br />
      Passord <input name="passord" type="password" id="passord" required>  <br />
      Rolle <select name="brukerrolle" id="brukerrolle">
          <option value="bruker">Bruker</option>
          <option value="admin">Admin</option>
      </select>
      <input type="submit" name="registrerBrukerKnapp" value="Registrer bruker">
      <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br />
    </form>

    <?php
      if (isset($_POST ["registrerBrukerKnapp"]))
        {
          include("dbtilkobling.php");

          $brukernavn = $_POST ["brukernavn"];
          $passord    = $_POST["passord"]; 
          $rolle      = $_POST['brukerrolle'];

          if (!$brukernavn || !$passord || !$rolle) 
            {
              print ("Brukernavn og passord m&aring; fylles ut <br />");
            }
          else
            {
              $sqlSetning="SELECT * FROM bruker WHERE brukernavn ='$brukernavn';";
              $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

              if (mysqli_num_rows($sqlResultat)!=0)  /* brukernavnet er registrert fra før */
                {
                  print ("Brukernavnet er registrert fra f&oslash;r <br />");
                }
              else
                {
                  $kryptertpassord=password_hash($passord,PASSWORD_DEFAULT);
                  $sqlSetning="INSERT INTO bruker VALUES('$brukernavn','$kryptertpassord', '$rolle');";
                  mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");

                  print ("F&oslash;lgende bruker er n&aring; registrert: <br /> ");
                  print ("Brukernavn: $brukernavn<br />");
                }

            }
        }
    ?>

  </div>
</div>

<?php include "slutt.html"; ?>