<?php

	session_start();
	include_once("connessione.php");

	$nick=$_SESSION['nick'];

	$query="DELETE FROM utente WHERE Nickname='$nick'";
	$cid->query($query);
  

	session_destroy();
	header("Location:../main.php");

?>
