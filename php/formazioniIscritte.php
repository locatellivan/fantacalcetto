<div class="well">

	<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo il tipo dell'utente loggato
	$sql="SELECT Tipo FROM utente WHERE Nickname='$nick'";
	$tipoUt=$cid->query($sql);
	$t=$tipoUt->fetch_row();

	// Seleziono il numero della giornata che si giocherà
	$sql="SELECT NumGior FROM giornata WHERE Stato='NGA'";
	$numero=$cid->query($sql)  or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$numGior=$numero->fetch_row();

	echo "<h2 align='center'><b>FORMAZIONI ISCRITTE A:<br/><br/>
				GIORNATA&nbsp;$numGior[0]</b></h3><br/><br/>";

		// Salvo in una variabile il nome della squadra loggata
		$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
		$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nomeSq=$squadra->fetch_row();

		// Seleziono i campionati in corso a cui partecipo
		$sql="SELECT Campionato FROM partecipa JOIN campionato ON NomeCamp=Campionato
		      WHERE Squadra='$nomeSq[0]' AND DataInizio<=CURDATE() AND DataFine>CURDATE()
					ORDER BY Campionato";
		$nomeCamp=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		// Se l'utente loggato non è amministratore
		if($t[0]!="Amministratore") {
			if($nomeCamp->num_rows>=1) {
				// per ogni campionato mostro le formazioni iscritte, se presenti
				while($camp=$nomeCamp->fetch_row()) {
					echo "<table border=1 align='center'><tr><th style='background-color:#bdb76b;' colspan='3'><center><h3><b>$camp[0]</b></h3></center></th></tr>";
					// Seleziono le formazioni per quel campionato
					$sql="SELECT Formazione FROM iscritta WHERE Campionato='$camp[0]' AND Giornata='$numGior[0]'
								ORDER BY Formazione";
					$formazioni=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				 ."<p>codice di errore ".$cid->errno
																				 .":".$cid->error."</p>");
					if($formazioni->num_rows>=1) {
						while($form=$formazioni->fetch_row()) {

							echo "<tr><th style='background-color:#7fffd4;'colspan='3'><center><h4><b>$form[0]</b></h4></center></th></tr>";
							echo "<tr><th colspan='3'><center>TITOLARI</center></th></tr>";
							echo "<tr><th><center>Ruolo</center></th>
												<th><center>Giocatore</center></th>
												<th><center>Squadra</center></th></tr>";
							// Seleziono i giocatori titolari della formazione considerata
							$sql="SELECT Ruolo, Giocatore, giocatore.Squadra  FROM sta JOIN giocatore ON Giocatore=Cognome
										WHERE Formazione='$form[0]' AND NumIngresso BETWEEN 1 AND 5
										ORDER BY Ruolo DESC";
							$titolari=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																						 ."<p>codice di errore ".$cid->errno
																						 .":".$cid->error."</p>");
							// Mostro i giocatori titolari per quella formazione
							while($tit=$titolari->fetch_row()) {
								echo "<tr><td><center>$tit[0]</center></td>
													<td><center>$tit[1]</center></td>
													<td><center>$tit[2]</center></td></tr>";
							}
							echo "<tr><th colspan='3'><center>RISERVE</center></th></tr>";

							// Seleziono le riserve della formazione considerata
							$sql="SELECT Ruolo, Giocatore, giocatore.Squadra  FROM sta JOIN giocatore ON Giocatore=Cognome
										WHERE Formazione='$form[0]' AND NumIngresso BETWEEN 6 AND 11
										ORDER BY Ruolo DESC, NumIngresso";
							$riserve=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																						 ."<p>codice di errore ".$cid->errno
																						 .":".$cid->error."</p>");
							// Mostro le riserve della formazione
							while($ris=$riserve->fetch_row()) {
								echo "<tr><td><center>$ris[0]</center></td>
													<td><center>$ris[1]</center></td>
													<td><center>$ris[2]</center></td></tr>";
							}
						}
					}
					else {
						echo "<tr><td colspan='3'><center>Nessuna formazione ancora presente</center></td></th>";
					}
					echo "</table><br/>";
				}
			}
			else {
				echo "<h3 align='center'>NON SEI ISCRITTO A NESSUN CAMPIONATO</h3>";
			}
		}

		// Se l'utente è amministrtore vede tutto
		else {
			// Seleziono tutti i campionati in corso
			$sql="SELECT NomeCamp FROM campionato
			      WHERE DataInizio<=CURDATE() AND DataFine>CURDATE()
						ORDER BY NomeCamp";
			$allCamp=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
			// Se ci sono campionati da mostrare
			if($allCamp->num_rows>=1) {
				// per ogni campionato mostro le formazioni iscritte, se presenti
				while($c=$allCamp->fetch_row()) {
					echo "<table border=1 align='center'><tr><th style='background-color:#bdb76b;' colspan='3'><center><h3><b>$c[0]</b></h3></center></th></tr>";
					// Seleziono le formazioni per quel campionato
					$sql="SELECT Formazione FROM iscritta WHERE Campionato='$c[0]' AND Giornata='$numGior[0]'
								ORDER BY Formazione";
					$form=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				 ."<p>codice di errore ".$cid->errno
																				 .":".$cid->error."</p>");
					if($form->num_rows>=1) {
						while($f=$form->fetch_row()) {

							echo "<tr><th style='background-color:#7fffd4;'colspan='3'><center><h4><b>$f[0]</b></h4></center></th></tr>";
							echo "<tr><th colspan='3'><center>TITOLARI</center></th></tr>";
							echo "<tr><th><center>Ruolo</center></th>
												<th><center>Giocatore</center></th>
												<th><center>Squadra</center></th></tr>";
							// Seleziono i giocatori titolari della formazione considerata
							$sql="SELECT Ruolo, Giocatore, giocatore.Squadra  FROM sta JOIN giocatore ON Giocatore=Cognome
										WHERE Formazione='$f[0]' AND NumIngresso BETWEEN 1 AND 5
										ORDER BY Ruolo DESC";
							$titol=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																						 ."<p>codice di errore ".$cid->errno
																						 .":".$cid->error."</p>");
							// Mostro i giocatori titolari per quella formazione
							while($tito=$titol->fetch_row()) {
								echo "<tr><td><center>$tito[0]</center></td>
													<td><center>$tito[1]</center></td>
													<td><center>$tito[2]</center></td></tr>";
							}
							echo "<tr><th colspan='3'><center>RISERVE</center></th></tr>";

							// Seleziono le riserve della formazione considerata
							$sql="SELECT Ruolo, Giocatore, giocatore.Squadra  FROM sta JOIN giocatore ON Giocatore=Cognome
										WHERE Formazione='$f[0]' AND NumIngresso BETWEEN 6 AND 11
										ORDER BY Ruolo DESC";
							$riser=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																						 ."<p>codice di errore ".$cid->errno
																						 .":".$cid->error."</p>");
							// Mostro le riserve della formazione
							while($ri=$riser->fetch_row()) {
								echo "<tr><td><center>$ri[0]</center></td>
													<td><center>$ri[1]</center></td>
													<td><center>$ri[2]</center></td></tr>";
							}
						}
					}
					else {
						echo "<tr><td colspan='3'><center>Nessuna formazione ancora presente</center></td></th>";
					}
					echo "</table><br/>";
				}
			}
			else {
				echo "<h3 align='center'>NON CI SONO CAMPIONATI DA MOSTRARE.</h3>";
			}
		}

	 ?>

</div>
