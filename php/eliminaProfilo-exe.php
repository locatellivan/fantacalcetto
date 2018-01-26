<?php

	session_start();
	include_once("connessione.php");

	$nick=$_SESSION['nick'];
	// Cancello utente dal DB
	$query="DELETE FROM utente WHERE Nickname='$nick'";
	$cid->query($query);


	session_destroy();
	header("Location:../index.php");

?>
