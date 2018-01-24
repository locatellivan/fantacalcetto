<div class="well">

	<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

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

		if($nomeCamp->num_rows>=1) {
			// per ogni campionato mostro le formazioni iscritte, se presenti
			while($camp=$nomeCamp->fetch_row()) {
				echo "<table border=1 align='center'><tr><th style='background-color:#bdb76b;' colspan='3'><center><h3><b>$camp[0]</b></h3></center></th></tr>";
				// Seleziono le formazioni avversarie per quel campionato
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
									ORDER BY Ruolo DESC";
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





	 ?>

</div>
