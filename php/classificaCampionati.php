<div class="well">

	<h1 align="center"><b>CLASSIFICHE</b></h1><br/>

  <?php

    include_once("connessione.php");
		$nick=$_SESSION['nick'];

		// Salvo in una variabile il nome della squadra loggata
		$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
		$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nomeSq=$squadra->fetch_row();

		// Variabile per i campionati in corso a cui partecipa l'utente loggato
		$sql="SELECT DISTINCT Campionato
					FROM partecipa JOIN campionato ON Campionato=NomeCamp
		      WHERE Squadra='$nomeSq[0]' AND CURDATE() BETWEEN DataInizio AND DataFine
					ORDER BY Campionato";
		$campionati=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
																		  	 ."<p>codice di errore ".$cid->errno
																				 .":".$cid->error."</p>");

		// Inizializzo variabile per la Posizione
		$pos=0;

		// Se esistono classifiche da mostrare
		if($campionati->num_rows>=1) {
        while ($campionato=$campionati->fetch_row()) {
					echo "<table align='center' border=1>
						    <tr><th colspan='4'><center><h4><b>$campionato[0]</b></h4></center></th></tr>
			 					<tr><th><center>Posizione</center></th>
								<th><center>Nickname</center></th>
								<th><center>Nome Squadra</center></th>
								<th><center>Punti totali</center></th></tr>";

					$sql="SELECT Nickname, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente JOIN partecipa on Squadra=NomeSq
							  WHERE Campionato='$campionato[0]'
							  ORDER BY PuntiTot DESC";
					$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																					."<p>codice di errore ".$cid->errno
																				  .":".$cid->error."</p>");
			 		while($ut=$utente->fetch_row()) {
							$pos++;
			 				echo "<tr><td><center>$pos</center></td>
												<td><center>$ut[0]</center></td>
			 								  <td><center>$ut[1]</center></td>
			 									<td><center>$ut[2]</center></td></tr>";
					}
			 		echo "</table><br/><br/>";
					$pos=0;
				}
		} else {
			 echo "<p align='center'>NON C'E' NESSUN CAMPIONATO IN CORSO.</p>";
		}

?>

	<br/><br/>
	<h2 align="center"><b>CAMPIONATI CONCLUSI</b></h2><br/>

<?php

	$sql="SELECT DISTINCT Campionato
				FROM partecipa JOIN campionato ON NomeCamp=Campionato
				WHERE CURDATE()>DataFine AND Squadra='$nomeSq[0]'";
	$campionatiConc=$cid->query($sql);

	// Se esistono classifiche da mostrare
	if($campionatiConc->num_rows>=1) {
			while ($campConc=$campionatiConc->fetch_row()) {
				echo "<table align='center' border=1>
							<tr><th colspan='4'><center><h4><b>$campConc[0]</b></h4></center></th></tr>
							<tr><th><center>Posizione</center></th>
							<th><center>Nickname</center></th>
							<th><center>Nome Squadra</center></th>
							<th><center>Punti totali</center></th></tr>";

				$sql="SELECT Nickname, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente JOIN partecipa on Squadra=NomeSq
							WHERE Campionato='$campConc[0]'
							ORDER BY PuntiTot DESC";
				$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																				."<p>codice di errore ".$cid->errno
																				.":".$cid->error."</p>");
				while($ut=$utente->fetch_row()) {
					  $pos++;
						echo "<tr><td><center>$pos</center></td>
											<td><center>$ut[0]</center></td>
											<td><center>$ut[1]</center></td>
											<td><center>$ut[2]</center></td></tr>";
				}
				echo "</table><br/><br/>";
				$pos=0;
			}
	} else {
		 echo "<p align='center'>NON SI E' CONCLUSO ALCUN CAMPIONATO A CUI SI PARTECIPA.</p>";
	}

?>

</div>
