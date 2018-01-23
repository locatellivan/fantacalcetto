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

	echo "<h2 align='center'><b>FORMAZIONI AVVERSARIE ISCRITTE A:<br/><br/>
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
				echo "<table border=1 align='center'><tr><th colspan='3'><center>$camp[0]</center></th></tr>";
				// Seleziono le formazioni avversarie per quel campionato
				$sql="SELECT Formazione FROM iscritta WHERE Campionato='$camp[0] AND '
							ORDER BY Formazione";
				$formazioni=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																			 ."<p>codice di errore ".$cid->errno
																			 .":".$cid->error."</p>");
				if($formazioni->num_rows>=1) {

				}
				else {
					echo "<tr><td><center>Nessuna formazione ancora presente</center></td></th>";
				}


				echo "</table><br/>";
			}
		}
		else {
			echo "<h3 align='center'>NON SEI ISCRITTO A NESSUN CAMPIONATO</h3>";
		}





	 ?>

</div>
