<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];
	$giocatore=$_POST['compra'];


	
	$sql="SELECT nomeSq FROM squadra JOIN utente ON (Utente=Mail) WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	$sql="SELECT Prezzo FROM giocatore WHERE Cognome='".$giocatore"'";
	$price=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
	$prezzo=$price->fetch_row();






 ?>
