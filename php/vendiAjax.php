<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	$cognome=$_REQUEST['cogn'];


	$sql="SELECT Prezzo FROM giocatore
				WHERE Cognome='$cognome'";
	$price=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$prezzo=$price->fetch_row();


	$sql="SELECT fantaMilioni FROM squadra JOIN utente ON Utente=Mail WHERE Nickname='".$nick."'";

	$soldi=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
	$soldiRestanti=$soldi->fetch_row();


	// Calcolo residuo del budget
	$soldiRestanti=$soldiRestanti[0]-;
	echo $soldiRestanti;


	?>
