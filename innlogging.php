<!DOCTYPE html>
<html>
<head>
  <title>Innlogging</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<div class="box">  
  <div></div>
  <div class="innlogging">
    

  <h3 class="rainbow">Innlogging </h3>
  <p>For å bruke denne siden, må du logge deg inn</p>

  <form action="" id="innloggingSkjema" name="innloggingSkjema" method="post">
    Brukernavn <input name="brukernavn" type="text" id="brukernavn"> <br />
    Passord <input name="passord" type="password" id="passord"  >  <br />
    <input type="submit" name="logginnKnapp" value="Logg inn">
    <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br />
  </form>

  Ny bruker ? <br />
  <a href="registrerbruker.php">Registrer deg her</a> <br /> <br />

  <?php
    if (isset($_POST ["logginnKnapp"]))
      {
        include("dynamiskefunksjoner.php");

        $brukernavn=$_POST ["brukernavn"];
        $passord=$_POST["passord"]; 

        if (!sjekkBrukernavnPassord($brukernavn,$passord)) /*Brukernavn/passord er ikke korrekt*/ 
          {
            print("Feil brukernavn/passord");          
          }
        else /* brukernavn/passord er korrekt */
          {
            session_start();
            $_SESSION["brukernavn"]=$brukernavn;
            print("<meta http-equiv='refresh' content='0;url=index.php'>");
          }
      }
  ?>
  </div>
</div>
</html>