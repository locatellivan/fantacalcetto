<?php

	session_start();
	include_once("connessione.php");

	$nick=$_SESSION['nick'];

	$mail=addslashes(htmlspecialchars($_POST['mail']));
	$nome=addslashes(htmlspecialchars($_POST['nome']));
	$cognome=addslashes(htmlspecialchars($_POST['cognome']));
	$sesso=$_POST['sesso'];
	$dataN=$_POST['dataN'];
	$luogoN=addslashes(htmlspecialchars($_POST['luogoN']));
	$cittaAtt=addslashes(htmlspecialchars($_POST['cittaAtt']));
	$squadraTifata=addslashes(htmlspecialchars($_POST['squadraTifata']));

	// Salvo le variabili corrette per il controllo sulla data
	$todays_date=date("Y-m-g");
	$today=strtotime($todays_date);
	$dataN_New=strtotime($dataN);


	if(strlen($mail)<=40 && strlen($nome)<=20 && strlen($cognome)<=20 && $dataN_New<$today
	   && strlen($luogoN)<=20 && strlen($cittaAtt)<=20 && strlen($squadraTifata)<=20) {

			if((!empty($mail)) && strlen($mail)<=40) {
				$query="UPDATE utente SET Mail='$mail' WHERE Nickname='$nick'";
				$cid->query($query);
			}
			if((!empty($nome)) && strlen($nome)<=20) {
				$query="UPDATE utente SET Nome='$nome' WHERE Nickname='$nick'";
				$cid->query($query);
			}
			if((!empty($cognome)) && strlen($cognome)<=20) {
				$query="UPDATE utente SET CognomeU='$cognome' WHERE Nickname='$nick'";
				$cid->query($query);
			}
			if(!empty($sesso)) {
				$query="UPDATE utente SET Sesso='$sesso' WHERE Nickname='$nick'";
				$cid->query($query);
			}
			if((!empty($dataN)) && ($dataN_New<$today)) {
				$query="UPDATE utente SET DataN='$dataN' WHERE Nickname='$nick'";
				$cid->query($query);
			}
			if((!empty($luogoN)) && strlen($luogoN)<=20) {
				$query="UPDATE utente SET LuogoN='$luogoN' WHERE Nickname='$nick'";
				$cid->query($query);
			}
			if((!empty($cittaAtt)) && strlen($cittaAtt)<=20) {
				$query="UPDATE utente SET CittaAtt='$cittaAtt' WHERE Nickname='$nick'";
				$cid->query($query);
			}
			if((!empty($squadraTifata)) && strlen($squadraTifata)<=20) {
				$query="UPDATE utente SET SquadraTifata='$squadraTifata' WHERE Nickname='$nick'";
				$cid->query($query);
			}

			$cid->close();

			header("Location:../index.php?op=profiloInfo");

		} else {
			header("Location:../index.php?op=profiloModifica");
		}

?>
