<?php

session_start();
include_once("connessione.php");

$nick=$_SESSION['nick'];

$nomeCamp=$_POST['camp'];

$sql="SELECT NomeCamp FROM Campionato, utente WHERE (Nickname='$nick'or Nickname='admin') and NomeCamp='$nomeCamp'";
$campionato=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
$nomeCa=$campionato->fetch_row();    // Salvo in una variabile il nome del campionato da eliminare


// Elimino le tuple in "partecipa" coi campionati selezionati per quella squadra

foreach($nomeCamp as $nomeCa) {
	$query="DELETE FROM campionato
	        WHERE NomeCamp='$nomeCa'";
	$cid->query($query);
}
$cid->close();

header("Location:../main.php?op=eliminaCampionato");
