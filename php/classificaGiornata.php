<div class="well">

	<h3 align="center"><b>CLASSIFICA RELATIVA ALL'ULTIMA GIORNATA GIOCATA.</b></h3><br/>

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
				WHERE Squadra='$nomeSq[0]' AND Giornata='$gior[0]'";
	$campionatiIscr=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	echo "<h4 align='center'>Giornata:&nbsp;&nbsp;$gior[0]</h4><br/><br/>";

	// Mostro le classifiche relative all'ultima giornata
	if($campionatiIscr->num_rows>=1) {
			while ($camp=$campionatiIscr->fetch_row()) {
				echo "<table align='center' border=1>
							<tr><th colspan='3'><center><h4><b>$camp[0]</b></h4></center></th></tr>
							<tr><th><center>Nickname</center></th>
							<th><center>Nome Squadra</center></th>
							<th><center>Punti giornata</center></th></tr>";

				$sql="SELECT Nickname, NomeSq, PuntiGiornata
							FROM utente JOIN squadra on Mail=utente JOIN formazione on Squadra=NomeSq
							JOIN iscritta ON Formazione=IdForm
							WHERE Campionato='$camp[0]'
							ORDER BY PuntiGiornata DESC";
				$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				."<p>codice di errore ".$cid->errno
																				.":".$cid->error."</p>");
				while($ut=$utente->fetch_row()) {
						echo "<tr><td><center>$ut[0]</center></td>
											<td><center>$ut[1]</center></td>
											<td><center>$ut[2]</center></td></tr>";
				}
				echo "</table><br/><br/>";
			}
	} else {
		 echo "<p align='center'>NON CI SONO CAMPIONATI DA MOSTRARE.</p>";
	}

?>
