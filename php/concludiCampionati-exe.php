<?php

	include_once("connessione.php");

	// Seleziono tutti i campionati da concludere
	$sql="SELECT DISTINCT NomeCamp FROM campionato JOIN vince
				WHERE DataFine<=CURDATE() AND NomeCamp NOT IN (SELECT DISTINCT Campionato
																											 FROM vince)";
	$campConclusi=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	if($campConclusi->num_rows>0) {

		while($campConc=$campConclusi->fetch_row()) {
			//Seleziono il nickname del vincitore del campionato considerato
			$sql="SELECT Mail
						FROM partecipa JOIN Squadra ON partecipa.Squadra=NomeSq
						JOIN utente ON utente=Mail
						WHERE Campionato='$campConc[0]' AND PuntiTot=(SELECT MAX(PuntiTot)
																													FROM partecipa
																													WHERE Campionato='$campConc[0]')";
		  $vincitore=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
			$vinc=$vincitore->fetch_row();

			// Inserisco i vincitori nell'apposita tabella
			$sql="INSERT INTO vince(Campionato,Campione)
						VALUES ('$campConc[0]','$vinc[0]')";
			$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
		}
	}
	$cid->close();
	header("Location:../index.php?op=storicoCampioni");

 ?>
