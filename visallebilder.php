<?php     /* vis-alle-bilder */
/*
/*    Programmet skriver ut alle registrerte bilder
*/include 'start.php';
  include("dbtilkobling.php"); 

  $sqlSetning="SELECT * FROM bilde;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 

  print ("<h3>Registrerte bilder </h3>"); 

  print ("<table border=1 class='table'>");
  print ("<tr><th align=left>bildenr</th> <th align=left>opplastingsdato</th> <th align=left>filnavn</th> <th align=left>beskrivelse</th></tr>");

  $antallRader=mysqli_num_rows($sqlResultat);  

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat); 
      $bildenr=$rad["bildenr"]; 
      $opplastingsdato=$rad["opplastingsdato"];      
      $filnavn=$rad["filnavn"];   
      $beskrivelse=$rad["beskrivelse"];
	  
      print ("<tr> <td> $bildenr </td> <td> $opplastingsdato </td> <td> <a href='bilder/$filnavn' target='_blank'>$filnavn </a> </td> <td> $beskrivelse </td>  </tr>");  
    }
  print ("</table>"); 
  include 'slutt.html';
?>