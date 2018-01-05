<div class="well">

	<h2 align="center"><b>CAMPIONATI FANTASMA</b></h3>
	<br/>
	<p align="center"><i>Di seguito, i campionati giocati, conclusi e vinti da utenti che si sono
		                eliminati dal sistema.<br/> Ogni campionato che fù, non viene dimenticato,<br/>
										ma qui ricordato.</i></p><br/><br/>
	<?php

		include_once("connessione.php");

		$query = "SELECT NomeCamp, DataInizio, DataFine, Creatore
			        FROM campionato JOIN vince ON Campionato=NomeCamp
							WHERE Campione IS NULL
							ORDER BY DataInizio";

		$campFant= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";
		if($campFant) {
			if($campFant->num_rows>=1) {
				echo "<form role='form' method='POST' action='php/disiscrivi-exe.php'>
							<table align='center' border=1>
							<tr><th><center>Nome Campionato</center></th><th>Data Inizio</th><th>Data Fine</th><th><center>Creatore</center></tr>";
							while($nomeCamp=$campFant->fetch_row()) {
								echo "<tr><td><center>$nomeCamp[0]</center></td>
										<td><center>$nomeCamp[1]</center></td>
										<td><center>$nomeCamp[2]</center></td>
										<td><center>$nomeCamp[3]</center></td></tr>";
							}
							echo "</table><br/><br/>";
			}
			else {
				echo "<p align='center'>NESSUN VINCITORE SI E' ELIMATO DAL SISTEMA.</p>";
			}
		}
		unset($campFant);


	 ?>


</div>
