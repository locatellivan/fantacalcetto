<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	$sql="SELECT nomeSq FROM squadra JOIN utente ON (Utente=Mail) WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	$giocatore=$_POST['vendi'];


 ?>
