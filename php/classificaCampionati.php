<div class="well">

	<h2 align="center"><b>CAMPIONATI</b></h3>
	<br/>


  <?php

  //  $nick=$_SESSION['nick'];

    include_once("connessione.php");

    $query = "SELECT NomeCamp
			        FROM campionato WHERE NomeCamp!='CAMPIONATO GENERALE' ORDER BY NomeCamp";

		$camp= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";
		$elencoCamp=$camp->fetch_row();

    //creo classifica campionato GENERALE
    $sql="SELECT Nickname, Mail, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente
    JOIN partecipa on Squadra=NomeSq  WHERE Campionato='CAMPIONATO GENERALE' ORDER BY PuntiTot";

    $res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");

                                   echo "<table border=1 align='center'>
                                         <tr><th colspan='4'><center><h4><b>- CAMPIONATO GENERALE -</b></h4></center></th></tr>
                                         <tr><th><center> Nickname</center></th>
                                         <th><center>Mail</center></th>
                                         <th><center>Nome Squadra</center></th>
                                         <th><center>Punti Totali</center></th></tr>";


//tutti gli altri capionati per nome
foreach ($elencoCamp as $CampSingolo) {
    $sql="SELECT Nickname, Mail, NomeSq, PuntiTot FROM utente JOIN squadra on Mail=utente
    JOIN partecipa on Squadra=NomeSq  WHERE Campionato='$CampSingolo' ORDER BY PuntiTot DESC";

    $res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");

             echo "<table border=1 align='center'>
                   <tr><th colspan='4'><center><h4><b>- $CampSingolo -</b></h4></center></th></tr>
                   <tr><th><center> Nickname</center></th>
                   <th><center>Mail</center></th>
                   <th><center>Nome Squadra</center></th>
                   <th><center>Punti Totali</center></th></tr>
                   </table>";
}

?>



</div>
