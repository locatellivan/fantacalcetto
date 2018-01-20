<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo in una variabile il nome della squadra dell'utente loggato
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE  Nickname='$nick'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	// Salvo in una variabile il tipo dell'utente loggato
	$query= "SELECT Tipo FROM utente WHERE Nickname='$nick'";
	$star=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$tipo=$star->fetch_row();


	// Salvo in una variabile il numero di stelle della squadra dell'utente loggato
	$query= "SELECT Stelle FROM squadra WHERE NomeSq='$nomeSq[0]'";
	$star=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$stelle=$star->fetch_row();

	// Se non si è commissari o amministratori
	if($stelle[0]<3 && $tipo[0]=='Allenatore') {
		echo "<div class='well'>";
		echo "<h3 align='center'><b>PER CREARE UN CAMPIONATO E' NECESSARIO AVERE IL GRADO
		       DI COMMISSARIO TECNICO. TOTALIZZA 3 O PIU STELLE!</b></h3><br/>";
		echo "<br/><br/><br/>";
		echo "<table align='center' border=5><tr><th><h4><b>&nbsp;STELLE OTTENUTE:&nbsp;&nbsp;&nbsp;</b></h4></th>
		      <td><h4><b>&nbsp;$stelle[0]&nbsp;</b></h4></td></tr></table></div>";
	}
  // Se si è CT o amministratori
	else {
		echo "<div class='well'>";
		echo "<h1 align='center'><b>CREA UN CAMPIONATO</b></h1><br/><br/>";

		echo "<form role='form' method='POST' action='php/creaCampionato-exe.php'>

			<div class='form-group'>
						<label>Nome del Campionato</label>
						<input class='form-control' type='text' id='nomeCamp' name='nomeCamp' placeholder='Nome Campionato (max. 20 caratteri)'/>
			</div>
			<div class='form-group'>
						<label>Data di Inizio del Campionato</label>
						<input class='form-control' type='date' id='dataInizio' name='dataInizio'/>
			</div>
			<div class='form-group'>
						<label>Data di Fine del Campionato</label>
						<input class='form-control' type='date' id='dataFine' name='dataFine'/>
			</div>

			<input type='submit' class='btn btn-success' onclick='errCreaCampionato()' value='CREA CAMPIONATO'></input>
			<input type='reset' class='btn btn-warning' value='Annulla'></input>";


		echo "</div>";
	}


 ?>
