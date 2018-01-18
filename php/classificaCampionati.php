<div class="well">

	<h1 align="center"><b>CLASSIFICHE</b></h1><br/>

  <?php

    include_once("connessione.php");
		// $nick=$_SESSION['nick'];

    //creo classifica campionato GENERALE
    $sql="SELECT Nickname, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente
    JOIN partecipa on Squadra=NomeSq  WHERE Campionato='CAMPIONATO GENERALE' ORDER BY PuntiTot DESC";

    $res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
                                   ."<p>codice di errore ".$cid->errno
                                   .":".$cid->error."</p>");

    echo "<table border=1 align='center'>
          <tr><th colspan='3'><center><h3><b>- CAMPIONATO GENERALE -</b></h3></center></th></tr>
          <tr><th><center> Nickname</center></th>
          <th><center>Nome Squadra</center></th>
          <th><center>Punti Totali</center></th></tr>";
		while($nomeCamp=$res->fetch_row()) {
				echo "<tr><td><center>$nomeCamp[0]</center></td>
							<td><center>$nomeCamp[1]</center></td>
						  <td><center>$nomeCamp[2]</center></td></tr>";
		}
		echo "</table><br/><br/>";

		// Salvo i nomi dei campionati presenti in corso
		$sql="SELECT DISTINCT NomeCamp
		      FROM campionato
					WHERE CURDATE() BETWEEN DataInizio AND DataFine AND NomeCamp!='CAMPIONATO GENERALE'";
		$campionati=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");

		// Se esistono classifiche da mostrare
		if($campionati->num_rows>=1) {
        while ($campionato=$campionati->fetch_row()) {
					echo "<table align='center' border=1>
						    <tr><th colspan='3'><center><h4><b>$campionato[0]</b></h4></center></th></tr>
			 					<tr><th><center>Nickname</center></th>
								<th><center>Nome Squadra</center></th>
								<th><center>Punti totali</center></th></tr>";

					$sql="SELECT Nickname, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente JOIN partecipa on Squadra=NomeSq
							  WHERE Campionato='$campionato[0]'
							  ORDER BY PuntiTot DESC";
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
			 echo "<p align='center'>NON C'E' NESSUN CAMPIONATO IN CORSO.</p>";
		}

?>

	<br/><br/>
	<h2 align="center"><b>CAMPIONATI CONCLUSI</b></h2><br/>

<?php

	$sql="SELECT DISTINCT NomeCamp
				FROM campionato
				WHERE CURDATE()>DataFine";
	$campionatiConc=$cid->query($sql);

	// Se esistono classifiche da mostrare
	if($campionatiConc->num_rows>=1) {
			while ($campConc=$campionatiConc->fetch_row()) {
				echo "<table align='center' border=1>
							<tr><th colspan='3'><center><h4><b>$campConc[0]</b></h4></center></th></tr>
							<tr><th><center>Nickname</center></th>
							<th><center>Nome Squadra</center></th>
							<th><center>Punti totali</center></th></tr>";

				$sql="SELECT Nickname, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente JOIN partecipa on Squadra=NomeSq
							WHERE Campionato='$campConc[0]'
							ORDER BY PuntiTot DESC";
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
		 echo "<p align='center'>NON C'E' NESSUN CAMPIONATO CONCLUSO.</p>";
	}

?>

</div>
