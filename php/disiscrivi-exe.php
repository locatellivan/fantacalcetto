<?php

session_start();
include_once("connessione.php");

$nick=$_SESSION['nick'];

$nomeCamp=$_POST['camp'];

// Salvo in una variabile il nome della squadra loggata
$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='$nick'";
$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
$nomeSq=$squadra->fetch_row();


// Elimino le tuple in "partecipa" e in "iscritta" coi campionati selezionati per quella squadra
foreach($nomeCamp as $nomiCamp) {

	$query="DELETE FROM partecipa
	        WHERE Squadra='$nomeSq[0]' AND Campionato='$nomiCamp'";
	$cid->query($query);

	$query="DELETE FROM iscritta
	        WHERE Campionato='$nomiCamp' AND Formazione=(SELECT IdForm FROM formazione WHERE Squadra='$nomeSq[0]')";
	$cid->query($query);
}

$cid->close();

header("Location:../index.php?op=listaCampionati");
