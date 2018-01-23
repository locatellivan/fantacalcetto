<div class="well">

	<h2 align="center"><b>CAMPIONATI A CUI SI PARTECIPA</b></h3>
	<br/>


	<?php

		$nick=$_SESSION['nick'];

		include_once("connessione.php");

		// Salvo in una variabile il nome della squadra dell'utente loggato
		$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
		$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nomeSq=$squadra->fetch_row();


		// Query che mostra tutti i CAMPIONATI A CUI SI PARTECIPA
		$query = "SELECT NomeCamp, DataInizio, DataFine, Creatore
			        FROM campionato JOIN partecipa ON Campionato=NomeCamp JOIN squadra ON NomeSq=Squadra
							WHERE DataInizio<=CURDATE() AND DataFine>CURDATE() AND NomeSq IN ('$nomeSq[0]')
							ORDER BY DataInizio";

		$camp= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";
		if($camp) {
			if($camp->num_rows>=1) {
				echo "<form role='form' method='POST' action='php/disiscrivi-exe.php'>
							<table align='center' border=1>
							<tr><th><center>Nome Campionato</center></th><th>Data Inizio</th><th>Data Fine</th><th><center>Creatore</center></th><th><center> ✓</center></th></tr>";
							while($nomeCamp=$camp->fetch_row()) {
								echo "<tr><td><center>$nomeCamp[0]</center></td>
										<td><center>$nomeCamp[1]</center></td>
										<td><center>$nomeCamp[2]</center></td>
										<td><center>$nomeCamp[3]</center></td>
										<td><center><input type='checkbox' name='camp[]' value='".$nomeCamp[0]."'/></center></td></tr>
										";
							}
							echo "<tr><td colspan='5'><center>----&nbsp;&nbsp;&nbsp;<input type='submit' class='btn btn-danger' value='DISICRIVITI'></input>&nbsp;&nbsp;&nbsp;----</center></td>
										</tr></form></table><br/><br/>";
			}
			else {
				echo "<p align='center'><b>NON SI E' ISCRITTI A NESSUN CAMPIONATO</b></p>";
			}
		} else {
			echo "<p align='center'>ERRORE.</p>";
		}
		unset($camp);
?>


	<h2 align="center"><b>CAMPIONATI IN CORSO</b></h3>
	<br/>

<?php

	// Query che mostra tutti i CAMPIONATI IN CORSO A CUI NON SI PARTECIPA
	$query = "SELECT NomeCamp, DataInizio, DataFine, Creatore
						FROM campionato
						WHERE CURDATE() BETWEEN DataInizio AND DataFine
						AND NomeCamp NOT IN (SELECT DISTINCT NomeCamp
							        FROM campionato JOIN partecipa ON Campionato=NomeCamp JOIN squadra ON NomeSq=Squadra
											WHERE CURDATE() BETWEEN DataInizio AND DataFine AND NomeSq IN ('$nomeSq[0]')
											ORDER BY DataInizio)
						ORDER BY DataInizio";

	$camp= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																						. "<p>Codice errore " . $cid->errno
																						. ": " . $cid->error) . "</p>";
	if($camp->num_rows>=1) {
		echo "<form role='form' method='POST' action='php/iscriviCamp-exe.php'>
												<table align='center' border=1>
												<tr><th><center>Nome Campionato</center></th><th>Data Inizio</th><th>Data Fine</th><th><center>Creatore</center></th><th><center> ✓</center></th></tr>";
		while($nomeCamp=$camp->fetch_row()) {
			echo "<tr><td><center>$nomeCamp[0]</center></td>
						<td><center>$nomeCamp[1]</center></td>
						<td><center>$nomeCamp[2]</center></td>
						<td><center>$nomeCamp[3]</center></td>
						<td><center><input type='checkbox' name='camp[]' value='".$nomeCamp[0]."'/></center></td></tr>";
			}
		  echo "<tr><td colspan='5'><center>----&nbsp;&nbsp;&nbsp;<input type='submit' class='btn btn-success' value='ISCRIVITI'></input>&nbsp;&nbsp;&nbsp;----</center></td>
						</tr></form></table><br/><br/>";
  } else {
			echo "<p align='center'><b>NON C'E' NESSUN CAMPIONATO IN CORSO A CUI NON SEI ISCRITTO.</b></p>";
	}
  unset($camp);

?>

	<h2 align="center"><b>CAMPIONATI FUTURI</b></h3><br/>

<?php

	// Query che mostra tutti i CAMPIONATI IN CORSO A CUI NON SI PARTECIPA
	$query = "SELECT NomeCamp, DataInizio, DataFine, Creatore
						FROM campionato
						WHERE CURDATE()<DataInizio
						ORDER BY DataInizio";
	$campFut=$cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																						. "<p>Codice errore " . $cid->errno
																						. ": " . $cid->error) . "</p>";

	if($campFut->num_rows>=1) {
		echo "<table border=1 align='center'>
					<tr><th><center>Nome Campionato</center></th>
					<th>Data Inizio</th><th>Data Fine</th>
					<th><center>Creatore</center></th></tr>";
			while($caFut=$campFut->fetch_row()) {
				echo "<tr><td><center>$caFut[0]</center></td>
							<td><center>$caFut[1]</center></td>
							<td><center>$caFut[2]</center></td>
							<td><center>$caFut[3]</center></td></tr>";
			}
		echo "</table>";
	}
	else {
		echo "<p align='center'><b>NON C'E' NESSUN CAMPIONATO IN CORSO A CUI NON SEI ISCRITTO.</b></p>";
	}
?>



<!--   <h2 align="center"><b>CAMPIONATI CONCLUSI</b></h3><br/>

<?php

		// Query che mostra tutti i CAMPIONATI che sono conclusi
		$query = "SELECT DISTINCT NomeCamp, DataInizio, DataFine, Creatore, Nickname
							FROM partecipa JOIN campionato ON partecipa.Campionato=NomeCamp
							JOIN vince ON vince.Campionato=NomeCamp JOIN utente ON Campione=Mail
							WHERE CURDATE() > DataFine
							ORDER BY DataInizio";

		$campConclusi= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";


	   if($campConclusi) {
				if($campConclusi->num_rows>=1) {
						echo "<table align='center' border=1>
									<tr><th><center>Nome Campionato</center></th><th>Data Inizio</th><th><center>Data Fine</center>
									</th><th><center>Creatore</center></th><th><center>Campione</center></th></tr>";
						while($nomeCamp=$campConclusi->fetch_row()) {
							echo "<tr><td><center>$nomeCamp[0]</center></td>
										<td><center>$nomeCamp[1]</center></td>
					  				<td><center>$nomeCamp[2]</center></td>
										<td><center>$nomeCamp[3]</center></td>
										<td><center>$nomeCamp[4]</center></td>
										</tr>";
					  }
						echo "</table><br/><br/>";
				 } else {
							echo "<p align='center'>NESSUN CAMPIONATO E' STATO CONCLUSO.</p>";
																			 }
			}
		  unset($campConclusi);
 ?> -->

</div>
