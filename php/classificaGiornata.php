<div class="well">

<?php

	include("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	/* Salvo in una variabile l'ultima giornata giocata,
	per la quale si mostra la classifica per ogni campionato a cui si partecipa */
	$sql="SELECT MAX(NumGior) FROM giornata WHERE Stato='GC'";
	$ultimaGior=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$gior=$ultimaGior->fetch_row();

	// Variabile per i campionati per i quali si è giocata l'ultima giornata
	$sql="SELECT DISTINCT Campionato FROM iscritta JOIN Formazione ON Formazione=IdForm
				WHERE Squadra='$nomeSq[0]' AND Giornata='$gior[0]' ORDER BY Campionato";
	$campionatiIscr=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	// Salvo i giocatori che ho in squadra per mostrare il loro punteggio
	$sql="SELECT Cognome, giocatore.Squadra, Punteggio
				FROM possiede JOIN giocatore ON possiede.Giocatore=Cognome JOIN gioca ON gioca.Giocatore=Cognome
				WHERE SquadraGioc='$nomeSq[0]' AND Giornata='$gior[0]'
				ORDER BY Ruolo DESC";
	$giocatori=$cid->query($sql);

	echo "<h3 align='center'><b>GIORNATA:&nbsp;$gior[0]</b></h3>";
	echo "<center><b>_____________________________________________</b></center><br/>";

	// Tabella coi punteggi della giornata dei giocatori in squadra attualmente.
	echo "<h4 align='center'><b>PUNTEGGI GIOCATORI IN SQUADRA:</b></h4>";
	if($giocatori->num_rows>=1) {
		echo "<table border=1 align='center'><tr>
		      <th><center>Cognome</center></th>
					<th><center>Squadra</center></th>
					<th><center>Punteggio</center></th></tr>";
		while($gioc=$giocatori->fetch_row()) {
			echo "<tr><td><center>$gioc[0]</center></td>
			      <td><center>$gioc[1]</center></td>
						<td><center>$gioc[2]</center></td></tr>";
		}
		echo "</table><br/>";
	}
	else {
		echo "<h4 align='center'>Nessun giocatore in squadra. Comprali dal fantamercato!</h4>";
	}
	echo "<center><b>_____________________________________________</b></center><br/>";
	echo "<h3 align='center'><b>CLASSIFICA GIORNALIERA</b></h3><br/>";
	// Mostro le classifiche relative all'ultima giornata
	if($campionatiIscr->num_rows>=1) {
			while ($camp=$campionatiIscr->fetch_row()) {
				echo "<table align='center' border=1>
							<tr><th colspan='5'><center><h4><b>$camp[0]</b></h4></center></th></tr>
							<tr><th><center>Nickname</center></th>
							<th><center>Nome Squadra</center></th>
							<th><center>Formazione</center></th>
							<th><center>Punti giornata</center></th>
							<th><center>TopCoach<center></th></tr>";

				// Informazioni da stampare nella tabella

				$sql="SELECT Nickname, NomeSq, Formazione, PuntiGiornata, TopCoach
							FROM utente JOIN squadra on Mail=utente JOIN formazione on Squadra=NomeSq
							JOIN iscritta ON Formazione=IdForm
							WHERE Campionato='$camp[0]' AND Giornata='$gior[0]'
							ORDER BY PuntiGiornata DESC";
				$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				."<p>codice di errore ".$cid->errno
																				.":".$cid->error."</p>");
				while($ut=$utente->fetch_row()) {
						if($ut[4]=="1") $top="✓"; else $top="";
						echo "<tr><td><center>$ut[0]</center></td>
											<td><center>$ut[1]</center></td>
											<td><center>$ut[2]</center></td>
											<td><center>$ut[3]</center></td>
											<td><center><b>$top</b><center></td></tr>";
				}
				echo "</table><br/><br/>";
			}
	} else {
		 echo "<p align='center'>NON CI SONO CAMPIONATI DA MOSTRARE.</p>";
	}

?>
