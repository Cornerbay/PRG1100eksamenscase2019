<?php  /* registrer-bruker  */
/*
/*  Programmet registrerer en ny bruker i databasen
*/
?>

<!DOCTYPE html>
<html>
<head>
  <title>Innlogging</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<div class="box">
  <div></div>
  <div class="innlogging">

    <h3 class="rainbow">Registrer bruker </h3>

    <form action="" id="registrerBrukerSkjema" name="registrerBrukerSkjema" method="post">
      Brukernavn <input name="brukernavn" type="text" id="brukernavn" required> <br />
      Passord <input name="passord" type="password" id="passord" required>  <br />
      <input type="submit" name="registrerBrukerKnapp" value="Registrer bruker">
      <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br />
    </form>

    <?php
      if (isset($_POST ["registrerBrukerKnapp"]))
        {
          include("dbtilkobling.php");

          $brukernavn=$_POST ["brukernavn"];
          $passord=$_POST["passord"]; 

          if (!$brukernavn || !$passord) 
            {
              print ("Brukernavn og passord m&aring; fylles ut <br />");
            }
          else
            {
              $sqlSetning="SELECT * FROM innlogging WHERE brukernavn ='$brukernavn';";
              $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

              if (mysqli_num_rows($sqlResultat)!=0)  /* brukernavnet er registrert fra før */
                {
                  print ("Brukernavnet er registrert fra f&oslash;r <br />");
                }
              else
                {
                  $kryptertpassord=password_hash($passord,PASSWORD_DEFAULT);
                  $sqlSetning="INSERT INTO innlogging VALUES('$brukernavn','$kryptertpassord');";
                  mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");

                  print ("F&oslash;lgende bruker er n&aring; registrert: <br /> ");
                  print ("Brukernavn: $brukernavn<br />");
                  print ("<a href='innlogging.php'>G&aring; til innloggingsside </a>");
                }

            }
        }
    ?>
    <p>Allerede en registrert bruker?</p>
    <p><a href="innlogging.php">Tilbake til innlogging</a></p>

  </div>
</div>
</html>