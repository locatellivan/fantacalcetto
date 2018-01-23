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
	$oggi=date("Y/m/d");
	$annoCor=substr($oggi, 0, 4);
	$meseCor=substr($oggi, 5, 2);
	$giornoCor=substr($oggi, 8, 2);
	$annoIn=$data1[0];
	$annoFi=$data2[0];
	$diffAnni=$annoFi-$annoIn;
	$today=strtotime("now");
	$errDB2=0;

	// Salvo una booleana per capire se si è inserita la dataInizio uguale a quella attuale
	if($data1[0]==$annoCor && $data1[1]==$meseCor && $data1[2]==$giornoCor) {
		$dataOdierna=true;
	}
	else {
		$dataOdierna=false;
	}

	// Salvo la mail dell'utente loggato
	$sql="SELECT utente FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='$nick'";
	$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$mailUtente=$utente->fetch_row();

	// Controllo degli input
	$sql="SELECT NomeCamp FROM campionato";
		$elencoCamp=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");


while($elenco=$elencoCamp->fetch_row()){
		if($elenco[0]==$nomeCamp){
		$errDB2++;
	}
}
if($errDB2==0){
	if(strlen($nomeCamp)<=20 && strlen($nomeCamp)!=0 && $dataInizio_New<$dataFine_New && $diffAnni<=1 && ($dataInizio>=$today || $dataOdierna)) {
		$query="INSERT INTO `campionato`(`NomeCamp`, `DataInizio`, `DataFine`, `Creatore`)
	   				VALUES ('$nomeCamp', '$dataInizio', '$dataFine','$mailUtente[0]')";
		$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");

		header("Location:../index.php?op=listaCampionati");
	}
	else {
		header("Location:../index.php?op=creaCampionato");
	}
}
else {
	header("Location:../index.php?op=creaCampionato&err2=ALERT2");
}
?>
