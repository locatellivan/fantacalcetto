<?php

	session_start();

	include_once("connessione.php");

	$nick=$_SESSION['nick'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	$campionato=$_POST['campionato'];
	$formazione=$_POST['formazione'];
	$giornata=$_POST['giornata'];

	$query="INSERT INTO iscritta (Formazione, Campionato, Giornata)
	        VALUES ('$formazione','$campionato','$giornata')";
	$cid->query($query);

	$cid->close();

	header("Location:../main.php?op=consegnaFormazione");

 ?>
