<!-- startside.php -->
<div> 
		<?php
			if (!$innloggetBruker){
				print("<h3>Velkommen til Bjarum hotels! </h3>");
			}else{
				$brukernavn = $innloggetBruker["brukernavn"];
				print("<h3>Velkommen til Bjarum hotels, $brukernavn! </h3>"); 
			}
		?>

		I menyen til venstre finner du ulike valg som kan utf&oslash;res ved bruk av denne applikasjonen
</div>