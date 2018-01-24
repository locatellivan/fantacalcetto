<?php

	session_start();
	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	$str.='<?xml version="1" encoding="ISO-8859-1">'; $str.="\n";
	$str.='<!DOCTYPE CLASSIFICA SYSTEM "clasGen.dtd">'; $str.="\n";
	$str.='<CLASSIFICA tipo="generale">'; $str.="\n";
	// Seleziono i campionati  a cui si partecipa per i quali mostro la classifica GENERALE
	$sql="SELECT DISTINCT Campionato, DataInizio, DataFine
				FROM partecipa JOIN campionato ON Campionato=NomeCamp
				WHERE Squadra='$nomeSq[0]' AND DataInizio<=CURDATE() AND DataFine>CURDATE()
				ORDER BY Campionato";
  $campionati=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	."<p>codice di errore ".$cid->errno
																	.":".$cid->error."</p>");

	while($camp=$campionati->fetch_row()) {
		$str.="\t"; $str.='<CAMPIONATO NomeCamp="'.$camp[0].'" DataInizio="'.$camp[1].'" DataFine="'.$camp[2].'">'; $str.="\n";
		// Seleziono squadre nel campionato
		$sql="SELECT NomeSq, Nickname, PuntiTot FROM utente JOIN squadra on Mail=utente JOIN partecipa on Squadra=NomeSq
					WHERE Campionato='$camp[0]'
					ORDER BY PuntiTot DESC";
		$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");

		while($ut=$utente->fetch_row()) {
			$str.="\t\t"; $str.='<SQUADRA NomeSquadra="'.$ut[0].'" Allenatore="'.$ut[1].'">'; $str.="\n";
			$str.="\t\t\t"; $str.='<PUNTI>'.$ut[2].'</PUNTI>'; $str.="\n";
			$str.="\t\t"; $str.='</SQUADRA>'; $str.="\n";
		}
		$str.="\t"; $str.='</CAMPIONATO>'; $str.="\n";
	}

	$str.='</CLASSIFICA>';

	// Apro in scrittura il file
	$fp=fopen("../XML/clasGenerale.xml", "w");
	// Sostituisco tutto ciò che c'era scritto prima sul file con le nuove informazioni
	fwrite($fp, $str);
	// Chiudo il file che abbiamo appena scritto
	fclose($fp);

	header("Location:../index.php?op=classificheXML");

?>
