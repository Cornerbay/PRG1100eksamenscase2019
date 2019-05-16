<?php   /*  dynamiske funksjoner */

function listeboksKlassekode()
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $klassekode=$rad["klassekode"]; 
      $klassenavn=$rad["klassenavn"];

      print("<option value='$klassekode'>$klassekode $klassenavn</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksBrukernavn()
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM student ORDER BY brukernavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $brukernavn=$rad["brukernavn"];
      $fornavn=$rad["fornavn"];
      $etternavn=$rad["etternavn"];
      $klassekode=$rad["klassekode"];

      print("<option value='$brukernavn'>$brukernavn $fornavn $etternavn</option>");  /* ny verdi i listeboksen laget */
    }
}


function listeboksValgtKlassekode($currentKlassekode)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $klassekode=$rad["klassekode"]; 
      $klassenavn=$rad["klassenavn"];

      if ($klassekode==$currentKlassekode) 
        {
          print("<option value='$klassekode'selected='selected'>$klassekode</option>");
        }
      else
        {
          print("<option value='$klassekode'>$klassekode</option>");  /* ny verdi i listeboksen laget */
        }
    }
}


function listeboksPostnrPoststed()
{
  include("dbtilkobling.php");  /* tilkobling til database-server og valg av database utført */
      
  $sqlSetning="SELECT * FROM poststed ORDER BY postnr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $postnr=$rad["postnr"];  
      $poststed=$rad["poststed"]; 

      print("<option value='$postnr;$poststed'>$postnr $poststed </option>");  /* ny verdi i listeboksen laget */
    }
}


function listeboksAnsattnr()
{
  include("dbtilkobling.php");  /* tilkobling til database-server og valg av database utført */
      
  $sqlSetning="SELECT * FROM ansatt ORDER BY ansattnr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $ansattnr=$rad["ansattnr"]; 
      $navn=$rad["navn"];
      $adresse=$rad["adresse"];
      $postnr=$rad["postnr"];
      $mndloenn=$rad["mndloenn"];

      print("<option value='$ansattnr'>$ansattnr $navn </option>");  /* ny verdi i listeboksen laget */
    }
}


function listeboksPostnrValgt($valgtPostnr)
{
  include("dbtilkobling.php");
  $sqlSetning="SELECT * FROM ansatt ORDER BY ansattnr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */
  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $postnr=$rad["postnr"]; 
      

      if($postnr==$valgtPostnr)
        {
          print("<option value='$postnr' selected>$postnr</option>");
	       }
      else
        {
          print("<option value='$postnr'>$postnr </option>");
	       }	
    }
}


function sjekkbokserPostnr()
{
  $sqlSetning="SELECT * FROM ansatt ORDER BY ansattnr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */


  for ($r=1;$r<=$antallRader;$r++)
    {

    } 
}


function sjekkbokserPostnrPoststed()
{

  for ($r=1;$r<=$antallRader;$r++)
    {

    }  
}


function listeboksBildenr()
{
  include("dbtilkobling.php");  /* tilkobling til database-server og valg av database utført */
      
  $sqlSetning="SELECT * FROM bilde ORDER BY bildenr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $bildenr=$rad["bildenr"];
      $filnavn=$rad["filnavn"];

      print("<option value='$bildenr'>$bildenr $filnavn</option>");  /* ny verdi i listeboksen laget */
    }
}


function listeboksValgtBildenr($currentBildenr)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM bilde ORDER BY bildenr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $bildenr=$rad["bildenr"]; 
      $filnavn=$rad["filnavn"];

      if ($bildenr==$currentBildenr) 
        {
          print("<option value='$bildenr'selected='selected'>$bildenr $filnavn</option>");
        }
      else
        {
          print("<option value='$bildenr'>$bildenr $filnavn</option>");  /* ny verdi i listeboksen laget */
        }
    }
}

/*  Programmet inneholder en funksjon for å sjekke om brukernavn og passord er korrekt
*/

function sjekkBrukernavnPassord($brukernavn,$passord)
{
/*
/*  Hensikt
/*    Funksjonen sjekker om brukernavn og passord er korrekt
/*  Parametre 
/*    $brukernavn = brukernavnet som skal sjekkes
/*    $passord = passordet som skal sjekkes
/*  Funksjonsverdi/Returverdi
/*    Funksjonen returnerer true hvis brukernavn og passord er korrekt
/*    Funksjonen returnerer false ellers
*/

  include("dbtilkobling.php");  /* tilkobling til database-server og valg av database utfųrt */

  $lovligBruker=true;

  $sqlSetning="SELECT * FROM innlogging WHERE brukernavn='$brukernavn';";
  $sqlResultat=mysqli_query($db,$sqlSetning);  /* SQL-setning sendt til database-serveren */
  if (!$sqlResultat) 
    {
      $lovligBruker=false;
    }
  else
    {
      $rad=mysqli_fetch_array($sqlResultat);
      if (!password_verify($passord,$rad["passord"])) 
        {
          $lovligBruker=false;
        }
    else
      {
        $lovligBruker=true; 
      }
    }

  return $lovligBruker;
}

?>