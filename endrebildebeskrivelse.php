<?php  /* endre-bilde */
/*
/*  Programmet lager et skjema for å velge et bilde som skal endres  
/*  Programmet endrer beskrivelsen for det valgte bilder*/
include 'start.php';
?> 

<h3>Endre bilde (beskrivelse og filnavn)</h3>

<form method="post" action="" id="finnBildeSkjema" name="finnBildeSkjema">
   Bilde
  <select name="bildenr" id="bildenr">
    <?php listeboksBildenr(); ?> 
  </select>  <br/>
  <input type="submit"  value="Finn bilde" name="finnBildeKnapp" id="finnBildeKnapp"> 
</form>

<?php
  if (isset($_POST ["finnBildeKnapp"]))
    {
      $bildenr=$_POST ["bildenr"]; 

      include("dbtilkobling.php");


      $sqlSetning="SELECT * FROM bilde WHERE bildenr='$bildenr';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

      $rad=mysqli_fetch_array($sqlResultat); 
      $bildenr=$rad["bildenr"];   
      $filnavn=$rad["filnavn"];    
      $beskrivelse=$rad["beskrivelse"]; 

      print ("<form method='post' action='' id='endreBildeSkjema' name='endreBildeSkjema'>");
      print ("Bildenr <input type='text' value='$bildenr' name='bildenr' id='bildenr' readonly /> <br />");
      print ("Beskrivelse <input type='text' value='$beskrivelse' name='beskrivelse' id='beskrivelse' required /> <br />");
      print ("<input type='submit' value='Endre bilde' name='endreBildeKnapp' id='endreBildeKnapp'>");
      print ("</form>");
    }
	
  if (isset($_POST ["endreBildeKnapp"]))
    {
      $bildenr=$_POST ["bildenr"];
      $beskrivelse=$_POST ["beskrivelse"]; 
	  
      if (!$bildenr || !$beskrivelse)
        {
          print ("Alle felt m&aring; fylles ut");  

        }
      else
        {
          include("dbtilkobling.php");

          $sqlSetning="UPDATE bilde SET beskrivelse='$beskrivelse' WHERE bildenr='$bildenr';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");				
          print ("Bildet med bildenr $bildenr er n&aring; endret<br />");
        }
    }

include 'slutt.html';
?>