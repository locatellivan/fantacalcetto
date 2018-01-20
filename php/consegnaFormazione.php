<div class="well">
	<h1 align="center"><b>CONSEGNA FORMAZIONE</b></h1><br/>

	<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

  // variabile per le formazioni disponibili
	$sql="SELECT IdForm FROM formazione
	      WHERE Squadra='$nomeSq[0]'
				ORDER BY IdForm";
	$formazione=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	// Variabile per i campionati a cui partecipa l'utente loggato
	$sql="SELECT Campionato FROM partecipa
	      WHERE Squadra='$nomeSq[0]'
				ORDER BY Campionato";

	$campionato=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

  // Variabile per le giornate a cui ci si puo iscrivere a cui partecipa l'utente
	$sql="SELECT NumGior FROM giornata
				WHERE Stato='NGA'
				ORDER BY NumGior";
	$giornateGiocate=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	// Salvo il numero di formazioni disponibili
	$cont="SELECT COUNT(IdForm)
				 FROM formazione
				 WHERE Squadra='$nomeSq[0]'";
	$form=$cid->query($cont) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nForm=$form->fetch_row();

	// Salvo le formazioni gia iscritte nei campionati
	$sql="SELECT Giornata, Campionato, Formazione
	      FROM iscritta JOIN Formazione ON Formazione=IdForm
				WHERE Squadra='$nomeSq[0]'
				ORDER BY Giornata DESC, Campionato";
	$iscr=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	// Se il giocatore non possiede formaioni non puo iscriversi alle giornate di campionato.
	if($nForm[0]>=1) {

		echo "<form role='form' method='POST' action='php/consegnaFormazione-exe.php' class='form-inline'>
					<table border=1 align='center'>";
		echo "<tr><th><center>Formazione:</th><td><center><select name='formazione'>";
		while($formazioni=$formazione->fetch_row()) {
				echo "<option value='$formazioni[0]'>$formazioni[0]</option>";
		}
		echo "</select></center></td></tr>";
		echo "<tr><th><center><b>Campionato</b></center></th>";
		echo "<td><center><select name='campionato'>";

					while($nomeCa=$campionato->fetch_row()) {
							echo "<option value='$nomeCa[0]'>$nomeCa[0]</option>";
					}
		echo "</select></center></td></tr>";
		echo "<tr><th><center><b>Giornata</b></center></th>";
		echo "<td><center><select name='giornata'>";
		while($gior=$giornateGiocate->fetch_row()) {
			echo "<option value='$gior[0]'>$gior[0]</option>";
		}
		echo "</select></center></td></tr>";
		echo "<tr><td colspan='2'><center><input type='submit'
					class='btn btn-success' value='CONSEGNA FORMAZIONE'></input></center></td>
							</tr></form></table><br/><br/>";

		// Storico formazioni consegnate
		echo "<h1 align='center'><b>FORMAZIONI CONSEGNATE</b></h1><br/>";
		echo "<table align='center' border='1'>";
		echo "<tr><th><center>Giornata</center></th><th><center>Campionato</center></th><th><center>Formazione</center></th></tr>";
		while($isc=$iscr->fetch_row()) {
			echo "<tr><td><center><b>$isc[0]</b></center></td><td><center>$isc[1]</center></td><td><center>$isc[2]</center></td></tr>";
		}
		echo "</table><br/><br/>";

	} else {
		echo "<h3 align='center'>PER ISCRIVERE AD UNA GIORNATA LA FORMAZIONE E' NECESSARIO
		       AVERNE CREATA UNA. <br/>LO PUOI FARE NELLA PAGINA DEL <a href='main.php?op=creaFormazione'>CREA FORMAZIONE</a>.</h3><br/>
					 <p align='center'>Per ulteriori informazioni leggi il <a href='main.php?op=regolamento'>regolamento</a>!";
		echo "<br/><br/><br/>";
	}


	 ?>
