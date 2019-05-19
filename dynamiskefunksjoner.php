<?php   /*  dynamiske funksjoner */


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

  $sqlSetning="SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
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

function brukerArray($brukernavn)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $brukerArray=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
    }
    return $brukerArray;
}




function listeboksHotellSted()
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM hotell ORDER BY sted;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $hotell=$rad["hotell"]; 
      $sted=$rad["sted"];

      print("<option value='$sted'>$sted</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksHotellnavn()
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM hotell ORDER BY hotellnavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $hotell=$rad["hotellnavn"]; 
      $sted=$rad["sted"];

      print("<option value='$hotell'>$hotell</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksRomtype()
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM romtype ORDER BY romtype;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $romtype=$rad["romtype"]; 

      print("<option value='$romtype'>$romtype</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksHotellromtypnavn()
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT DISTINCT hotellnavn FROM hotellromtype ORDER BY hotellnavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $hotellnavn = $rad["hotellnavn"];

      print("<option value='$hotellnavn'>$hotellnavn</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksHotellromtypeRomtype($hotellnavn)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT romtype FROM hotellromtype WHERE hotellnavn='$hotellnavn' ORDER BY hotellnavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $hotellnavn = $rad["hotellnavn"]; 
      $romtype    = $rad["romtype"];
      $antallrom  = $rad["antallrom"];

      print("<option value='$romtype'>$romtype</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksHotellromtypeAntallrom($hotellnavn,$romtype)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT antallrom FROM hotellromtype WHERE hotellnavn='$hotellnavn' AND romtype='$romtype' ORDER BY hotellnavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $antallrom  = $rad["antallrom"];

      print("$antallrom");  /* ny verdi i listeboksen laget */
    }
}

function valgtListeboksRomtype($romtype)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM romtype ORDER BY romtype;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $nyRomtype=$rad["romtype"]; 
      if ($nyRomtype==$romtype) {
        print("<option value='$nyRomtype' selected>$nyRomtype</option>");
      }else{
        print("<option value='$nyRomtype'>$nyRomtype</option>");  /* ny verdi i listeboksen laget */

      }
    }
}

function listeboksHotellromnavn()
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT DISTINCT hotellnavn FROM rom ORDER BY hotellnavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $hotellnavn = $rad["hotellnavn"];

      print("<option value='$hotellnavn'>$hotellnavn</option>");  /* ny verdi i listeboksen laget */
    }
}


function listeboksHotellromnr($hotellnavn)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT DISTINCT romnr FROM rom WHERE hotellnavn = '$hotellnavn' ORDER BY hotellnavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $romnr = $rad["romnr"];

      print("<option value='$romnr'>$romnr</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksHotellromnrArray($hotellnavn,$romnr)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM rom WHERE hotellnavn = '$hotellnavn' AND romnr = '$romnr';";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++) //her er det bare en rad mest sannsynlig
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      
    }
      return $rad; //returner array med verdier fra alle kolonnnene
}

function sjekkOmRomErLedig($hotellnavn,$romnr,$datoFra,$datoTil)
{
  include "dbtilkobling.php";
  $sqlSetning= "SELECT * FROM bestilling 
                WHERE hotellnavn = '$hotellnavn' AND romnr = '$romnr' AND 
                dato_fra BETWEEN '$datoFra' AND '$datoTil' 
                AND 
                dato_til  BETWEEN '$datoFra' AND '$datoTil';";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  if (!$antallRader) {
    return true;
  }else
  {
    return false;
  }
}

function hotellRomnrArray($hotellnavn,$romtype)
{
  include "dbtilkobling.php";
  $sqlSetning="SELECT romnr FROM rom WHERE hotellnavn='$hotellnavn' AND romtype='$romtype';";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("hotellRomnrArray");

  $antallRader=mysqli_num_rows($sqlResultat);
  $hotellRomnrArray = array();
  for ($i=1; $i <= $antallRader; $i++) { 
    $row = mysqli_fetch_array($sqlResultat);
    $hotellRomnrArray[$i-1] = $row[0];
  }
  return $hotellRomnrArray;
}

function listeboksBestilling($brukernavn)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT * FROM bestilling WHERE brukernavn = '$brukernavn' ORDER BY dato_fra;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen, listeboksBestilling"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $hotellnavn     = $rad["hotellnavn"];
      $romtype        = $rad['romtype'];
      $datoFra        = $rad['dato_fra'];
      $datoTil        = $rad['dato_til'];
      $bestillingsID  = $rad['bestillings_id'];

      print("<option value='$bestillingsID'>Bestilling nr $bestillingsID</option>");  /* ny verdi i listeboksen laget */
      print("<option disabled style='font-style:italic'>&nbsp;&nbsp;&nbsp;Hotell: $hotellnavn</option>");
      print("<option disabled style='font-style:italic'>&nbsp;&nbsp;&nbsp;Romtype: $romtype</option>");
      print("<option disabled style='font-style:italic'>&nbsp;&nbsp;&nbsp;Romnr: $romnr</option>");
      print("<option disabled style='font-style:italic'>&nbsp;&nbsp;&nbsp;Dato: $datoFra - $datoTil</option>");    
    }
}

function hentBestilling($bestillingsID)
{
  include "dbtilkobling.php";
  $sqlSetning="SELECT * FROM bestilling WHERE bestillings_id ='$bestillingsID';";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Databasetrøbbel hentBestilling");

  $antallRader=mysqli_num_rows($sqlResultat);

  for ($i=1; $i <= $antallRader; $i++) { 
    $bestilling = mysqli_fetch_array($sqlResultat);
  }
  return $bestilling;
}

function listeboksHotellromnrRomtype($hotellnavn)
{
  include "dbtilkobling.php";      
  $sqlSetning="SELECT DISTINCT romtype FROM rom WHERE hotellnavn='$hotellnavn' ORDER BY hotellnavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $hotellnavn = $rad["hotellnavn"]; 
      $romtype    = $rad["romtype"];
      $romnr  = $rad["romnr"];

      print("<option value='$romtype'>$romtype</option>");  /* ny verdi i listeboksen laget */
    }
}




?>