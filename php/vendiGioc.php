<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	$gioc=$_POST['vendi'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();


	// Salvo in una variabile i fantamilioni dell'utente loggato
	$sql="SELECT FantaMilioni FROM squadra WHERE NomeSq='$nomeSq[0]'";
  $res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
  $soldi=$res->fetch_row();
  echo $soldi[0];

 ?>
