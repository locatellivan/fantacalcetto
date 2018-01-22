<?php

	session_start();
	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	$campionato=$_POST['campionato'];
	$formazione=$_POST['formazione'];
	$giornata=$_POST['giornata'];
	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	// Salvo i campionati ai quali sono già iscritto per la prossima giornata.
	$sql="SELECT Campionato
				FROM iscritta JOIN formazione ON IdForm=Formazione
				WHERE Campionato='$campionato' AND Giornata='$giornata' AND Squadra='$nomeSq[0]'";
	$campGiaIsc=$cid->query($sql);

	if($campGiaIsc->num_rows==0) {
		$cons=false;
	}
	else {
		$cons=true;
	}


  if($cons) {
		$query="UPDATE iscritta SET Formazione='$formazione'
		        WHERE Giornata='$giornata' AND Campionato='$campionato'
						AND Formazione IN (SELECT IdForm FROM formazione
															 WHERE Squadra='$nomeSq[0]')";
		$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	  $cid->close();
	}
	else {
		$query="INSERT INTO iscritta (Formazione, Campionato, Giornata)
	        	VALUES ('$formazione','$campionato','$giornata')";
		$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$cid->close();
	}

	header("Location:../main.php?op=consegnaFormazione");

 ?>
