<div class="well">

		<h1 align="center"><b>STORICO CAMPIONI FANTACALCETTO</b></h1><br/>

	<?php

		include_once("connessione.php");

		// Seleziono i nickname e i campionati vinti dagli utenti ancora registrati al sito
		$sql="SELECT Nickname, Campionato
					FROM vince JOIN utente ON Campione=Mail
					ORDER BY Nickname ASC";
		$tupleVince=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");

		// Controllo se vi sono già dei campioni
		$sql="SELECT COUNT(*)
					FROM vince";
		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
		$nCamp=$res->fetch_row();
		$cid->close();

		if($nCamp[0]==0) {
			echo "<h4 align='center'>NON SONO ANCORA PRESENTI DEI CAMPIONI!</h4>";
		}
		else {
			echo "<table border='3' align='center'>
						<tr><th><center>CAMPIONE</center></th><th><center>CAMPIONATO</center></th></tr>";
				while($campione=$tupleVince->fetch_row()) {
					echo "<tr><td><center>$campione[0]</center></td><td><center>$campione[1]</center></td></tr>";
				}
			echo "</table><br/><br/>";
		}
	?>


</div>
