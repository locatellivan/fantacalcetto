<?php

	session_start();
	include_once("connessione.php");

	$nick=$_SESSION['nick'];

	$mail=$_POST['mail'];
	$nome=$_POST['nome'];
	$cognome=$_POST['cognome'];
	$sesso=$_POST['sesso'];
	$dataN=$_POST['dataN'];
	$luogoN=$_POST['luogoN'];
	$cittaAtt=$_POST['cittaAtt'];
	$squadraTifata=$_POST['squadraTifata'];

	if(!empty($mail)) {
		$query="UPDATE utente SET Mail='$mail' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	if(!empty($nome)) {
		$query="UPDATE utente SET Nome='$nome' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	if(!empty($cognome)) {
		$query="UPDATE utente SET CognomeU='$cognome' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	if(!empty($sesso)) {
		$query="UPDATE utente SET Sesso='$sesso' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	if(!empty($dataN)) {
		$query="UPDATE utente SET DataN='$dataN' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	if(!empty($luogoN)) {
		$query="UPDATE utente SET LuogoN='$luogoN' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	if(!empty($cittaAtt)) {
		$query="UPDATE utente SET CittaAtt='$cittaAtt' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	if(!empty($squadraTifata)) {
		$query="UPDATE utente SET SquadraTifata='$squadraTifata' WHERE Nickname='$nick'";
		$cid->query($query);
	}
	/*$query="UPDATE utente
			 SET SquadraTifata='$squadraTifata', Nome='$nome', CognomeU='$cognome',
	     DataN='$dataN', LuogoN='$luogoN', Sesso='$sesso', CittaAtt='$cittaAtt'
			 WHERE Nickname='$nick'";

	$utente=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>Codice di errore ".$cid->errno
															 .":".$cid->error."</p>"); */

	header("Location:../main.php?op=profiloInfo");

?>
