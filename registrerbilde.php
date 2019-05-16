<?php  /* registrer-bilde */
/*
/*    Programmet lager et html-skjema for å registrere et data om et bilde og laste opp et bilde
/*    Programmet registrerer data om bilde i databasen og laster opp et bilde til serveren
*/
include 'start.php';
?> 

<h3>Registrer bilde </h3>

<form method="post" action="" enctype="multipart/form-data" id="registrerBildeSkjema" name="registrerBildeSkjema">
  Bildenr <input type="text" id="bildenr" name="bildenr" required /> <br/>
  Beskrivelse <input type="text" id="beskrivelse" name="beskrivelse" required /> <br/>
  Bilde <input type="file" id="fil" name="fil" size="60"/> <br />
  <input type="submit" value="Registrer bilde" id="registrerBildeKnapp" name="registrerBildeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerBildeKnapp"]))
    {
      $bildenr=$_POST ["bildenr"];
      $beskrivelse=$_POST ["beskrivelse"]; 
      $filnavn=$_FILES["fil"]["name"]; //todimensjonalt array, fil angitt i input file name "fil"
      $filtype=$_FILES["fil"]["type"];
      $filstorrelse=$_FILES["fil"]["size"];
      $tmpnavn=$_FILES["fil"]["tmp_name"];
      $nyttnavn="bilder/".$filnavn; // . er tekstsammenskjøting. 


      if (!$bildenr || !$beskrivelse || !$filnavn)
        {
          print ("Alle felt m&aring; fylles ut og bilde m&aring; velges"); 
        }
      else
        {
            if ($filtype!="image/gif" && $filtype!="image/jpeg" && $filtype!="image/png" && $filtype!="image/jpg") 
                {
                    print("$filtype <br>");
                    print("$filstorrelse <br>");
                    print ("Det kun tillat å laste opp bilder");

                }
            else if ($filstorrelse > 100000000) //max 10MB 
                {
                  print("bilde er for stort til og lastes opp");
                }
            else
                {
                    include "dbtilkobling.php";
                    $sqlSetning="SELECT * FROM bilde WHERE bildenr='bildenr';";
                    $sqlresultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database");
                    $antallRader=mysqli_num_rows($sqlresultat);

                    if ($antallRader!=0) 
                        {
                          print("bildenummeret er registrert fra før!");
                        }
                    else
                        {
                          

                            //lager mappe
                            $mappe = "bilder"; 
                            if(!is_dir($mappe)) mkdir($mappe);

                            $currentDate=date("Y-m-d");

                            move_uploaded_file($tmpnavn, $nyttnavn) or die ("ikke mulig å laste opp fil");

                            $sqlSetning="INSERT INTO bilde VALUES('$bildenr','$currentDate','$filnavn','$beskrivelse');";
                            if (mysqli_query($db,$sqlSetning)) 
                                {
                                  print("følgende bilde er nå registrert:<br>
                                  Bildenr: $bildenr<br>
                                  filnavn: $filnavn<br>
                                  beskrivelse: $beskrivelse<br>
                                  opplastingsdato: $currentDate");
                                }
                            else //tilsvarer egentlig or die funksjonen brukt tidligere, men her vil vi gjøre flere ting
                                {
                                    print("ikke mulig å registrere i databasen");
                                    unlink($nyttnavn) or die ("<br>ikke mulig å slette bildet på serveren");
                                }
                        }
                  }
        }
    }

include 'slutt.html';
?> 
