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

	/* Salvo in una variabile l'ultima giornata giocata,
	per la quale si mostra la classifica per ogni campionato a cui si partecipa */
	$sql="SELECT MAX(NumGior) FROM giornata WHERE Stato='GC'";
	$ultimaGior=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$gior=$ultimaGior->fetch_row();

	$str.='<?xml version="1" encoding="ISO-8859-1">'; $str.="\n";
	$str.='<!DOCTYPE CLASSIFICA SYSTEM "clasGior.dtd">'; $str.="\n";
	$str.='<CLASSIFICA tipo="giornaliera" giornata="'.$gior[0].'">'; $str.="\n";

	// Variabile per i campionati per i quali si è giocata l'ultima giornata
	$sql="SELECT DISTINCT Campionato, DataInizio, DataFine
				FROM iscritta JOIN campionato ON Campionato=NomeCamp
				WHERE Giornata='$gior[0]' ORDER BY Campionato";
	$campionatiIscr=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	while ($camp=$campionatiIscr->fetch_row()) {
		$str.="\t"; $str.='<CAMPIONATO NomeCamp="'.$camp[0].'" DataInizio="'.$camp[1].'" DataFine="'.$camp[2].'">'; $str.="\n";
		// Seleziono le formazioni ancora presenti che hanno giocato l'ultima partita
		$sql="SELECT NomeSq, Nickname, Formazione, PuntiGiornata
					FROM utente JOIN squadra on Mail=utente JOIN formazione on Squadra=NomeSq
					JOIN iscritta ON Formazione=IdForm
					WHERE Campionato='$camp[0]' AND Giornata='$gior[0]'
					ORDER BY PuntiGiornata DESC";
		$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
    while($ut=$utente->fetch_row()) {
			$str.="\t\t"; $str.='<SQUADRA NomeSquadra="'.$ut[0].'" Allenatore="'.$ut[1].'">'; $str.="\n";
			$str.="\t\t\t"; $str.='<FORMAZIONE NomeForm="'.$ut[2].'" PuntiGiornata="'.$ut[3].'">'; $str.="\n";

			// Seleziono i titolari di ogni formazione
			$sql="SELECT sta.Giocatore, Ruolo, Punteggio
						FROM sta JOIN giocatore ON sta.Giocatore=Cognome JOIN gioca ON gioca.Giocatore=Cognome
						WHERE gioca.Giornata='$gior[0]' AND Formazione='$ut[2]' AND NumIngresso BETWEEN 1 AND 5
						ORDER BY Ruolo DESC";
			$titolari=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																			."<p>codice di errore ".$cid->errno
																			.":".$cid->error."</p>");
			while($tit=$titolari->fetch_row()) {
				$str.="\t\t\t\t"; $str.='<GIOCATORE NomeGiocatore="'.$tit[0].'" Ruolo="'.$tit[1].'" Stato="titolare">'; $str.="\n";
				$str.="\t\t\t\t\t"; $str.='<VOTO>'.$tit[2].'</VOTO>'; $str.="\n";
				$str.="\t\t\t\t"; $str.='</GIOCATORE>'; $str.="\n";
			}

			// Seleziono le riserve di ogni formazione
			$sql="SELECT sta.Giocatore, Ruolo, Punteggio
						FROM sta JOIN giocatore ON sta.Giocatore=Cognome JOIN gioca ON gioca.Giocatore=Cognome
						WHERE gioca.Giornata='$gior[0]' AND Formazione='$ut[2]' AND NumIngresso BETWEEN 6 AND 11
						ORDER BY Ruolo DESC";
			$riserve=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																			."<p>codice di errore ".$cid->errno
																			.":".$cid->error."</p>");
			while($ris=$riserve->fetch_row()) {
				$str.="\t\t\t\t"; $str.='<GIOCATORE NomeGiocatore="'.$ris[0].'" Ruolo="'.$ris[1].'" Stato="riserva">'; $str.="\n";
				$str.="\t\t\t\t\t"; $str.='<VOTO>'.$ris[2].'</VOTO>'; $str.="\n";
				$str.="\t\t\t\t"; $str.='</GIOCATORE>'; $str.="\n";
			}


			$str.="\t\t\t"; $str.='<FORMAZIONE>'; $str.="\n";
			$str.="\t\t"; $str.='<SQUADRA>'; $str.="\n";
		}
		$str.="\t"; $str.='</CAMPIONATO>'; $str.="\n";
	}
	$str.='</CLASSIFICA>';

	// Apro in scrittura il file
	$fp=fopen("../XML/clasGiornaliera.xml", "w");
	// Sostituisco tutto ciò che c'era scritto prima sul file con le nuove informazioni
	fwrite($fp, $str);
	// Chiudo il file che abbiamo appena scritto
	fclose($fp);

	header("Location:../index.php?op=classificheXML");


?>
