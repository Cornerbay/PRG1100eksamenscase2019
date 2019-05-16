
<?php
  session_start();
  @$innloggetBruker=$_SESSION["brukernavn"]; //@ for å slippe unødig warning

if (!$innloggetBruker) {
  print("Denne siden krever innlogging!<br>");

  print("Du vil bli sendt til innlogging om 2 sekunder");

  die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");


}


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
      <h3>Klasse</h3>
      <a href="regklasse.php"><li><p>Registrer Klasse</p></li></a>
      <a href="endreklasse.php"><li><p>Endre Klasse</p></li></a>
      <a href="visklasse.php"><li><p>Vis Klasse</p></li></a>
      <a href="slettklasse.php"><li><p>Slett Klasse</p></li></a>
      <a href="visklasseliste.php"><li><p>Vis Klasseliste</p></li></a>
      <h3>Student</h3>   
      <a href="regstudent.php"><li><p>Registrer Student</p></li></a>
      <a href="endrestudent.php"><li><p>Endre Student</p></li></a>
      <a href="visstudent.php"><li><p>Vis Student</p></li></a>
      <a href="slettstudent.php"><li><p>Slett Student</p></li></a>
      <h3>Bilde</h3>
      <a href="registrerbilde.php"><li><p>Registrer Bilde</p></li></a>
      <a href="visallebilder.php"><li><p>Vis Bilder</p></li></a>
      <a href="endrebildebeskrivelse.php"><li><p>Endre Bildebeskrivelse</p></li></a>
      <a href="slettbilde.php"><li><p>Slett Bilde</p></li></a>
      <h3>Søk</h3>   
      <a href="sokidatabase.php"><li><p>Søk i databasen</p></li></a>
      <br>
      <a href="utlogging.php"><li><p>Logg ut</p></li></a>
      </ul>
    </nav>
    
    <article>



     