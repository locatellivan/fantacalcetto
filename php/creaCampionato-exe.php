<?php

session_start();
include_once("connessione.php");

$nick=$_SESSION['nick'];
$nomeCamp=addslashes(htmlspecialchars($_POST['nomeCamp']));
$dataInizio=$_POST['dataInizio'];
$dataFine=$_POST['dataFine'];

$sql="SELECT utente FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='$nick'";
$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
$mailUtente=$utente->fetch_row();


if(strlen($nomeCamp)<=20) {
	$query="INSERT INTO `campionato`(`NomeCamp`, `DataInizio`, `DataFine`, `Creatore`)
   VALUES ('$nomeCamp', '$dataInizio', '$dataFine','$mailUtente[0]')";
	$cid->query($query);

	header("Location:../main.php?op=listaCampionati");
}
else {
	header("Location:../main.php?op=creaCampionato");
}

?>
