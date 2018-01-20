<?php

session_start();
include_once("connessione.php");


$nick=$_SESSION['nick'];

$nomeCessione=$_POST['vendi'];
$nomeAcquisto=$_POST['compra'];

$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='$nick'";
$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
$nomeSq=$squadra->fetch_row();    // Salvo in una variabile il nome della squadra loggata


// Per ogni campionato selezionato inserisco una tupla in "partecipa".

foreach($nomeCessione as $nomiCessione) {
	$query="DELETE FROM possiede
          WHERE Giocatore='$nomiCessione' AND SquadraGioc='$nomeSq[0]'";
	$cid->query($query);
}


foreach($nomeAcquisto as $nomiAcquisto) {
	$query="INSERT INTO possiede (Giocatore,	SquadraGioc)
					VALUES ('$nomiAcquisto','$nomeSq[0]')";

	$cid->query($query);
}
$cid->close();

header("Location:../main.php?op=fantamercato");
