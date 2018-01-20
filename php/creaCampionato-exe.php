<?php

session_start();
include_once("connessione.php");

$nick=$_SESSION['nick'];
$nomeCamp=addslashes(htmlspecialchars($_POST['nomeCamp']));
$dataInizio=$_POST['dataInizio'];
$dataFine=$_POST['dataFine'];

// Rendo le date confrontabili
$dataInizio_New=strtotime($dataInizio);
$dataFine_New=strtotime($dataFine);

$data1=explode("-",$dataInizio);
$data2=explode("-",$dataFine);
$annoIn=$data1[0];
$annoFi=$data2[0];
$diffAnni=$annoFi-$annoIn;
$todays_date=date("Y-m-g");
$today=strtotime($todays_date);


// Salvo la mail dell'utente loggato
$sql="SELECT utente FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='$nick'";
$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
$mailUtente=$utente->fetch_row();

// Controllo degli input
if(strlen($nomeCamp)<=20 && strlen($nomeCamp)!=0 && $dataInizio_New<$dataFine_New && $diffAnni<=1 && $today<=$dataInizio_New) {
	$query="INSERT INTO `campionato`(`NomeCamp`, `DataInizio`, `DataFine`, `Creatore`)
   				VALUES ('$nomeCamp', '$dataInizio', '$dataFine','$mailUtente[0]')";
	$cid->query($query);

	header("Location:../main.php?op=listaCampionati");
}
else {
	header("Location:../main.php?op=creaCampionato");
}

?>
