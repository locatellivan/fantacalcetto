<?php

session_start();
include_once("connessione.php");

$nick=$_SESSION['nick'];

$nomeCamp=$_POST['camp'];

$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='$nick'";
$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
$nomeSq=$squadra->fetch_row();    // Salvo in una variabile il nome della squadra loggata

$query="DELETE FROM partecipa
        WHERE Squadra=$nomeSq[0] AND Campionato=$nomeCamp";
$cid->query($query);

header("Location:../main.php?op=listaCampionati");
