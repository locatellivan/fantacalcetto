<?php

	include_once("connessione.php");

	// Seleziono tutti i campionati da concludere
	$sql="SELECT NomeCamp FROM campionato
				WHERE DataFine<=CURDATE()";
	$campConclusi=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
  // Inserisco i vincitori nell'apposita tabella
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
		// controllo se è gia stato inserito
		$sql="SELECT Campionato,Campione FROM vince
		      WHERE Campionato='$campConc[0]' AND Campione='$vinc[0]'";

		$giaInserito=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		// Effettuo l'inserimento nel DB
		if($giaInserito->num_rows==0) {
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
