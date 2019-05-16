<?php  /* slett-bilde */
/*
/*  Programmet lager et skjema for å velge et bilde som skal slettes  
/*  Programmet sletter det valgte bildet
*/
include 'start.php';
?> 

<script src="funksjoner.js"> </script>

<h3>Slett bilde</h3>

<form method="post" action="" id="slettBildeSkjema" name="slettBildeSkjema" onSubmit="return bekreft()">
  Bilde
  <select name="bildenr" id="bildenr">
    <?php listeboksBildenr(); ?> 
  </select>  <br/>
  <input type="submit" value="Slett bilde" name="slettBildeKnapp" id="slettBildeKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettBildeKnapp"]))
    {
      $bildenr=$_POST ["bildenr"];

      include("dbtilkobling.php");

      $sqlSetning="SELECT filnavn FROM bilde WHERE bildenr='$bildenr';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die("ikke mulig å hente i database");
      $rad=mysqli_fetch_array($sqlResultat);
      $filnavn=$rad["filnavn"];

      $sqlSetning="DELETE FROM bilde WHERE bildenr='$bildenr';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die("ikke mulig å slette fra database");
      //informasjonen om bildet slettet i database

      $bildefil="bilder/".$filnavn;
      unlink($bildefil) or die ("Ikke mulig å slette bilde fra server");
      //Sletter bilde fra server

      print ("F&oslash;lgende bilde er n&aring; slettet: $bildenr $filnavn <br />");
    }
    include 'slutt.html';
?> 