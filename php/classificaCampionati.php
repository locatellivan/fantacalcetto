<div class="well">

	<h2 align="center"><b>CAMPIONATI</b></h3>
	<br/>


  <?php

  //  $nick=$_SESSION['nick'];

    include_once("connessione.php");

    //creo classifica campionato GENERALE
    $sql="SELECT Nickname, Mail, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente
    JOIN partecipa on Squadra=NomeSq  WHERE Campionato='GENERALE' ORDER BY PuntiTot DESC";

    $res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
                                   ."<p>codice di errore ".$cid->errno
                                   .":".$cid->error."</p>");

                                   echo "<table border=1 align='center'>
                                         <tr><th colspan='4'><center><h4><b>- CAMPIONATO GENERALE -</b></h4></center></th></tr>
                                         <tr><th><center> Nickname</center></th>
                                         <th><center>Mail</center></th>
                                         <th><center>Nome Squadra</center></th>
                                         <th><center>Punti Totali</center></th></tr>";
																				 while($nomeCamp=$res->fetch_row()) {
														 			 				echo "<tr><td><center>$nomeCamp[0]</center></td>
														 			 							<td><center>$nomeCamp[1]</center></td>
														 			 							<td><center>$nomeCamp[2]</center></td>
														 			 							<td><center>$nomeCamp[3]</center></td>";
}


//tutti gli altri capionati per nome
    $query = "SELECT NomeCamp
			        FROM campionato WHERE NomeCamp!='GENERALE' ORDER BY NomeCamp";

		$camp= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";
			if($camp) {
				if($camp->num_rows>=1) {
          while ($campionato=$camp->fetch_row()) {

          $sql="SELECT Nickname, Mail, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente
          JOIN partecipa on Squadra=NomeSq  ORDER BY PuntiTot DESC";

          $res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
                                         ."<p>codice di errore ".$cid->errno
                                         .":".$cid->error."</p>");
						 echo "<table align='center' border=1>
						 <tr><th colspan='4'><center><h4><b>$campionato[0]</b></h4></center></th></tr>

			 												<tr><th><center>Nickname</center></th>
															<th><center>Mail</th>
															<th><center>Nome Squadra</th>
															<th><center>Punti totali</center>";
			 			while($nomeCamp=$res->fetch_row()) {
			 				echo "<tr><td><center>$nomeCamp[0]</center></td>
			 															<td><center>$nomeCamp[1]</center></td>
			 															<td><center>$nomeCamp[2]</center></td>
			 															<td><center>$nomeCamp[3]</center></td>";

}}}}
							  else {
			 						echo "<p align='center'>NON C'E' NESSUN CAMPIONATO IN CORSO.</p>";
			 				 }

			 		  unset($res);

?>



</div>
