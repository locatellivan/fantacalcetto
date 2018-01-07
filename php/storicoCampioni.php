<div class="well">

		<h1 align="center"><b>STORICO CAMPIONI FANTACALCETTO</b></h1><br/>

<?php

include_once("connessione.php");

$sql="SELECT DISTINCT Nickname, vince.Campionato
			FROM vince JOIN utente ON Campione=Mail
			ORDER BY Nickname ASC";
$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");

$cid->close();

echo "<table border='3' align='center'>
			<tr><th><center>CAMPIONE</center></th><th><center>CAMPIONATO</center></th></tr>";
	while($campione=$res->fetch_row()) {
		echo "<tr><td><center>$campione[0]</center></td><td><center>$campione[1]</center></td></tr>";
	}
echo "</table><br/><br/>";

?>


</div>
