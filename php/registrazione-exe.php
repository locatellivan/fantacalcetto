<?php

	include_once("connessione.php");

	$nickname=$_POST['nickname'];
	$nomeSq=$_POST['nomeSq'];
	$psw1=$_POST['psw1'];
	$psw2=$_POST['psw2'];
	$email=$_POST['email'];

	if($psw1==$psw2){
		$sql="INSERT INTO utente(Nickname,Mail,Password) VALUES ('$nickname','$email','$psw1')";

		$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

		$sql2="INSERT INTO squadra(NomeSq, Utente) VALUES ('$nomeSq','$email')";
		$cid->query($sql2) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

		$cid->close();

		header("Location:../main.php?status=ok");
	}
	else {
		header("Location:../main.php?status=passworderrate");
	}

?>
