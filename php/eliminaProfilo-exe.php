<?php

	session_start();
	include_once("connessione.php");

	$nick=$_SESSION['nick'];

	// Cancello le infomrazioni sui campionati vinti dall'utente che si vuole eliminare
	$sql="SELECT Campionato FROM vince
	      WHERE Campione=(SELECT Mail FROM utente WHERE Nickname='$nick')";
	$campDaEliminare=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	// Se ci sono campionati da eliminare li elimino
	if($campDaEliminare->num_rows>0) {
		while($campEl=$campDaEliminare->fetch_row()) {
			$sql="DELETE FROM campionato WHERE NomeCamp='$campEl[0]'";
			$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
		}
	}

	// Cancello utente dal DB
	$query="DELETE FROM utente WHERE Nickname='$nick'";
	$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	session_destroy();
	header("Location:../index.php");

?>
