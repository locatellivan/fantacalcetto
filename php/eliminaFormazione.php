<div class="well">
	<h1 align="center"><b>ELIMINA UNA FORMAZIONE</b></h1><br/>

	<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	// Salvo il numero di formazioni disponibili
	$cont="SELECT COUNT(IdForm)
				 FROM formazione
				 WHERE Squadra='$nomeSq[0]'";
	$form=$cid->query($cont) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nForm=$form->fetch_row();

	// Salvo i nomi delle formazioni presenti
	$query="SELECT IdForm
				  FROM formazione
				  WHERE Squadra='$nomeSq[0]'";
	$nomiFormazioni=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	// Se l'utente non ha nessuna formazione
	if($nForm[0]<1) {
		echo "<h3 align='center'>PER ELIMINARE UNA FORMAZIONE E' NECESSARIO
		       AVERNE CREATA UNA.<br/> LO PUOI FARE NELLA PAGINA <a href='main.php?op=creaFormazione'>CREA FORMAZIONE</a>.</h3><br/>";
		echo "<br/><br/><br/>";
	}
	else {
		echo "<h3 align='center'><b>ATTENZIONE</b></h3>";
		echo "<h4 align='center'>Eliminando una formazione verranno eliminate anche le informazioni ad essa collegate,<br/>
		      come le iscrizioni alle giornate di campionato e il punteggio nella classifica giornaliera.</h4><br/><br/>";
		echo"<table align='center' border='1'>";
		echo "<form role='form' method='POST' action='php/eliminaFormazione-exe.php'>";
		echo "<tr><th><center>Nome Formazione</center></th><th><center></center><b>✓</b></th>";

		while($form=$nomiFormazioni->fetch_row()) {
			echo "<tr><td><center>$form[0]</center></td>
			<td><center><input type='checkbox' name='form[]' value='".$form[0]."'/></center></td></tr>";
		}
		echo "<tr><td colspan='2'><center><input type='submit' class='btn btn-danger' value='ELIMINA FORMAZIONE'></input></center></td>
					</tr></form></table><br/><br/>";

	}


?>

</div>
