<?php

	include_once("connessione.php");

	$nickname=$_POST['nickname'];
	$nomeSq=$_POST['nomeSq'];
	$psw1=$_POST['psw1'];
	$psw2=$_POST['psw2'];
	$email=$_POST['email'];

	if($psw1==$psw2){

		// Creo l'utente
		$sql="INSERT INTO utente(Nickname,Mail,Password) VALUES ('$nickname','$email','$psw1')";

		$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
		// Creo la squadra
		$sql2="INSERT INTO squadra(NomeSq, Utente) VALUES ('$nomeSq','$email')";
		$cid->query($sql2) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

		// $cid->close();

		// Inserisco la squadra nel Campionato Generale
		$sql3="INSERT INTO partecipa (Squadra, Campionato, PuntiTot)
		       VALUES ('$nomeSq','CAMPIONATO GENERALE','0')";
		$cid->query($sql3) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

		$cid->close();  

		header("Location:../main.php?status=RegistrazioneAvvenutaConSuccesso");
	}
	else {
		header("Location:../main.php?status=PasswordErrate");
	}

?>
