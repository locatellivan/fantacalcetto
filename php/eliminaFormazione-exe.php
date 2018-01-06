<?php

	session_start();
	include_once("connessione.php");

	$nick=$_SESSION['nick'];

	$form=$_POST['form'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	// Salvo in una variabile il nome delle formazioni da eliminare
	$sql="SELECT IdForm
				FROM formazione WHERE Squadra='$nomeSq[0]' and IdForm='$form'";
	$formazione=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeForm=$formazione->fetch_row();

	// Elimino le tuple in Formazione che sono uguali alle formazioni selezionate
	foreach($form as $nomeForm) {
		$query="DELETE FROM formazione
		        WHERE IdForm='$nomeForm'";
		$cid->query($query);
	}
	$cid->close();

header("Location:../main.php?op=eliminaFormazione");
?>
