
<?php
/*  session_start();
  @$innloggetBruker=$_SESSION["brukernavn"]; //@ for å slippe unødig warning

if (!$innloggetBruker) {
  print("Denne siden krever innlogging!<br>");

  print("Du vil bli sendt til innlogging om 2 sekunder");

  die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");


}
*/

?>
 <div id='boks'>
  
   <!DOCTYPE html>
      <html>
      <head>
      <title></title>
      <link rel='stylesheet' type='text/css' href='css/style.css'>
      <script type="text/javascript" src="js/java.js"></script>
      <meta charset="utf-8">

      </head>
      <body class="myStyle">

    <header>
      <h1>Obligatorisk oppgave 2 PRG1100</h1>
    </header>
    <?php include "dbtilkobling.php"; ?>
    <?php include "dynamiskefunksjoner.php"; ?>

    <nav class="nav">
      <ul>
      <a href="index.php"><li><h3>Meny</h3></li></a>
      <h3>Hoved</h3>
      <a href="vishotell.php"><li><p>Vis Hotell</p></li></a>
      <a href="visromtype.php"><li><p>Vis romtype</p></li></a>
      <a href=""><li><p>Ledige rom</p></li></a>
      <a href=""><li><p>Registrer</p></li></a>
      <h3>Min Side</h3>   
      <a href=""><li><p>Bestill</p></li></a>
      <a href=""><li><p>Vis Hotellbestilling</p></li></a>
      <a href=""><li><p>Endre Hotellbestilling</p></li></a>
      <a href=""><li><p>Slett Hotellbestilling</p></li></a>
      <h3>Vedlikeholdsapplikasjon</h3>
      <a href="registrer.php"><li><p>Registrer Data</p></li></a>
      <a href=""><li><p>Vis Data</p></li></a>
      <a href=""><li><p>Endre Data</p></li></a>
      <a href=""><li><p>Slette Data</p></li></a>
      <a href=""><li><p>Se registrerte Brukere</p></li></a>
      <a href=""><li><p>Registrerte Hotellbestillinger</p></li></a>    
      <h3>Søk</h3>   
      <a href="sokidatabase.php"><li><p>Søk i databasen</p></li></a>
      <br>
      <a href="utlogging.php"><li><p>Logg ut</p></li></a>
      </ul>
    </nav>
    
    <article>



     