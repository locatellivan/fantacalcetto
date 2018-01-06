<div class="well">

	<h2 align="center"><b>SELEZIONARE CAMPIONATO E UNA GIORNATA PER LA CLASSIFICA GIORNALIERA</b></h3>
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
    $query = "SELECT NumGior, DataPartite
              FROM giornata";

    $numeroGiornata= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
                                    . "<p>Codice errore " . $cid->errno
                                    . ": " . $cid->error) . "</p>";


    if($numeroGiornata) {
			if($numeroGiornata->num_rows>=1) {
				echo "<form role='form' method='POST' action='php/ClassificaGiornataCampionato-exe.php'>
							<table align='center' border=1>
							<tr><th><center>Numero Giornata</center></th><th><center>Data</center></th><th><center> ✓</center></th></tr>";
							while($giornata=$numeroGiornata->fetch_row()) {
								echo "<tr><td><center>$giornata[0]</center></td>
										<td><center>$giornata[1]</center></td>
                    <td><center><input type='checkbox' name='camp[]' value='".$giornata[0]."'/></center></td></tr>
										";
							}
              }
              }


		$query = "SELECT NomeCamp, DataInizio, DataFine, Creatore
			        FROM campionato";

		$camp= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";
		if($camp) {
			if($camp->num_rows>=1) {
				echo "<form role='form' method='POST' action='php/ClassificaGiornataCampionato-exe.php'>
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
							echo "<tr><td colspan='5'><center>----&nbsp;&nbsp;&nbsp;<input type='submit' class='btn btn-danger' value='CERCA'></input>&nbsp;&nbsp;&nbsp;----</center></td>
										</tr></form></table><br/><br/>";
			}
			else {
				echo "<p align='center'>NON E' PRESENTE NESSUN CAMPIONATO</p>";
			}
		} else {
			echo "<p align='center'>ERRORE.</p>";
		}
		unset($camp);
?>
