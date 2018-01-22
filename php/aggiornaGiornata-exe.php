<?php

	include_once("connessione.php");

	// Salvo la giornata per la quale vengono generati i risultati
	$sql="SELECT NumGior FROM giornata WHERE Stato='NGA'";
	$giornRisultati=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$gior=$giornRisultati->fetch_row();

	// Salvo tutti i giocatori
	$sql="SELECT Cognome FROM giocatore";
	$gente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	// Inserisco la valutazione di tutti i giocatori per quella giornata
	while($cognomi=$gente->fetch_row()) {
		$sql="INSERT INTO gioca (Giocatore, Giornata, Punteggio)
					VALUES ('$cognomi[0]', '$gior[0]', '".(rand(-1,10))."')";
		$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	}
	// ELIMINO I DATI CHE NON SERVIRANNO PIU'


	// Seleziono tutte le formazioni iscritte alla giornata
	$sql="SELECT  DISTINCT Formazione
				FROM iscritta WHERE Giornata='$gior[0]'";
	$formDaAgg=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	// Ciclo per ogni formazione iscritta alla giornata per qualunque campionato
	while($form=$formDaAgg->fetch_row()) {
		// Inizializzo variabile per il conto dei punti giornalieri per ogni formazione
		$puntiGiornalieri=0;
		// Seleziono i giocatori titolari che fanno parte della formazione selezionata
		$sql="SELECT Giocatore FROM sta
					WHERE Formazione='$form[0]' AND NumIngresso BETWEEN 1 AND 5
					ORDER BY NumIngresso";
		$giocatoriInForm=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		// Imposto una variabile di controlo per le sostituzioni
		$ciSonoSostituti=true;
		// Per ogni punteggio del giocatore sommo ai punti giornalieri
		while($titolare=$giocatoriInForm->fetch_row()) {
			// Prendo il voto del giocatore considerato
			$sql="SELECT Punteggio FROM gioca WHERE Giocatore='$titolare[0]' AND Giornata='$gior[0]'";
			$votiGioc=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
			$voto=$votiGioc->fetch_row();

			// Seleziono il ruolo del giocatore considerato
			$sql="SELECT Ruolo FROM giocatore WHERE Cognome='$titolare[0]'";
			$ruoloGiocPerSost=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
			$ruolo=$ruoloGiocPerSost->fetch_row();

			// verifico se ci sono sostituzioni da fare, se il voto è '-1' devo considerare il voto del sostituto
			if($voto[0]!='-1') {
				// Sommo ai punti i punti del giocatore
				$puntiGiornalieri=$puntiGiornalieri+$voto[0];
			}
			else {
				// Creo un array che conterrà le riserve per quel ruolo
				$riserve=array();
				// Seleziono i giocatori che possono sostuire il giocatore in quella formazione
				$sql="SELECT Giocatore FROM sta JOIN giocatore ON Cognome=giocatore
							WHERE Formazione='$form[0]' AND Ruolo='$ruolo[0]' AND NumIngresso BETWEEN 6 AND 11
							ORDER BY NumIngresso";
				$ris=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																			 ."<p>codice di errore ".$cid->errno
																			 .":".$cid->error."</p>");
				while($nomeRis=$ris->fetch_row()) {
					$riserve[]=$nomeRis[0];
				}
				// Nel caso ho un solo sostituto per quel ruolo, se il voto è != da -1 lo sommo
				if(count($riserve)==1) {
					// Salvo il punteggio dell'unico sostituto
					$sql="SELECT Punteggio FROM gioca WHERE Giocatore='$riserve[0]'";
					$ptSost=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				 ."<p>codice di errore ".$cid->errno
																				 .":".$cid->error."</p>");
					$ptSost=$ptSost->fetch_row();
					// Controllo il punteggio, se è uguale a "-1" non faccio nulla
					if($ptTost != -1) {
						$puntiGiornalieri=$puntiGiornalieri+$ptSost[0];
					}
				}
				else {
					for($i=0;$i<2;$i++) {
						$sql="SELECT Punteggio FROM gioca WHERE Giocatore='$riserve[$i]'";
						$ptSost=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																					 ."<p>codice di errore ".$cid->errno
																					 .":".$cid->error."</p>");
						$ptSost=$ptSost->fetch_row();
						if($ptSost!="" && $ptTost!=(-1)) {
							$puntiGiornalieri=$puntiGiornalieri+$ptSost[0];
							break;
						}
					}
				}
			}
		}

		// Aggiorno i punteggi della giornata per ogni formazione iscritta
		$sql="UPDATE iscritta SET PuntiGiornata='$puntiGiornalieri' WHERE Formazione='$form[0]'";
		$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
														 ."<p>codice di errore ".$cid->errno
														 .":".$cid->error."</p>");
		// Salvo nome squadra formazione considerata
		$sql="SELECT Squadra FROM Formazione WHERE IdForm='$form[0]'";
		$nomeSquadraForm=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
		$nomeSqForm=$nomeSquadraForm->fetch_row();
		$nomeSqForm=$nomeSqForm[0];

		if($puntiGiornalieri>=35) {
		  // Salvo il numero corrente di Stelle
			$sql="SELECT Stelle FROM squadra WHERE NomeSq='$nomeSqForm'";
			$numeroStelle=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																			 ."<p>codice di errore ".$cid->errno
																			 .":".$cid->error."</p>");
			$numStelle=$numeroStelle->fetch_row();
			$newStelle=$numStelle[0]+1;


			if($newStelle==3) {
				// Salvo la mail dell'utente che passa di grado
				$sql="SELECT Utente FROM squadra WHERE NomeSq='$nomeSqForm'";
				$mailUt=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				 ."<p>codice di errore ".$cid->errno
																				 .":".$cid->error."</p>");
				$mail=$mailUt->fetch_row();

				// Salvo il tipo dell'utente che dovrebbe passare di grado (nel caso fosse l'admin)
				$sql="SELECT Tipo FROM utente WHERE Mail='$mail[0]'";
				$tipoUt=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				 ."<p>codice di errore ".$cid->errno
																				 .":".$cid->error."</p>");
				$tipo=$tipoUt->fetch_row();

				if($tipo[0]!='Amministratore') {
					// Se non è un amministratore aggiorno il Tipo dell'utente
					$sql="UPDATE utente SET Tipo='CT' WHERE Mail='$mail[0]'";
					$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																					 ."<p>codice di errore ".$cid->errno
																					 .":".$cid->error."</p>");
				}
			}

			// Inserisco una stella alla squadra della formazione considerata
			$sql="UPDATE squadra SET Stelle='$newStelle' WHERE NomeSq='$nomeSqForm'";
			$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																			 ."<p>codice di errore ".$cid->errno
																			 .":".$cid->error."</p>");
		}

		// Seleziono i campionati a cui si partecipa per i quali si è giocata la giornata con formazione considerata
		$sql="SELECT Campionato FROM iscritta WHERE Formazione='$form[0]' AND Giornata='$gior[0]'";
		$campionatiDaAggiornare=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");

		while($campAgg=$campionatiDaAggiornare->fetch_row()) {
			// Inserisco automaticamente le formazioni nei campionati
			$nextGior=$gior[0]+1;
			$sql="INSERT INTO iscritta (Formazione,Campionato,Giornata)
						VALUES ('$form[0]','$campAgg[0]','$nextGior')";
			$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
			// Salvo i vecchi puntiTotali
			$sql="SELECT PuntiTot FROM partecipa WHERE Squadra='$nomeSqForm' AND Campionato='$campAgg[0]'";
			$puntiVecchi=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
			$oldPt=$puntiVecchi->fetch_row();
			// Salvo i nuovi Punti Totali
			$newPt=$oldPt[0]+$puntiGiornalieri;
			// Aggiorno il punteggio della classifica totale
			$sql="UPDATE partecipa SET PuntiTot='$newPt'
						WHERE Squadra='$nomeSqForm' AND Campionato='$campAgg[0]'";
			$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
		}
  }

	// Rinnovo le giornate nel DB
	$oldGior=$gior[0]-1;
	$nextGior=$gior[0]+1;
	$newGior=$nextGior+1;
	$sql="UPDATE giornata SET Stato='GC' WHERE NumGior='$gior[0]'";
	$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
											  	 ."<p>codice di errore ".$cid->errno
													 .":".$cid->error."</p>");
	$sql="UPDATE giornata SET Stato='NGA' WHERE NumGior='$nextGior'";
	$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
										  		 ."<p>codice di errore ".$cid->errno
													 .":".$cid->error."</p>");
	$sql="INSERT INTO giornata(NumGior,Stato) VALUES ('$newGior','NGC')";
	$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
													 ."<p>codice di errore ".$cid->errno
													 .":".$cid->error."</p>");
	// Elimino le vecchie valutazioni dei giocatori per non appesantire il DB
	$sql="DELETE FROM gioca WHERE Giornata='$oldGior'";
	$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
													 ."<p>codice di errore ".$cid->errno
													 .":".$cid->error."</p>");







	header("Location:../main.php?op=classificaGiornata");


?>
