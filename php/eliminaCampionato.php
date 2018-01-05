<div class="well">

	<h2 align="center"><b>CAMPIONATI CREATI</b></h3>
	<br/>

<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo in una variabile la mail dell'utente loggato
	$sql="SELECT Mail FROM utente WHERE  Nickname='$nick'";
	$nomeU=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$mailU=$nomeU->fetch_row();

	// Salvo in una variabile il nome della squadra dell'utente loggato
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE  Nickname='$nick'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	// Salvo in una variabile il numero di stelle della squadra dell'utente loggato
	$query= "SELECT Stelle FROM squadra WHERE NomeSq='$nomeSq[0]'";
	$star=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$stelle=$star->fetch_row();

	// Salvo in una variabile il tipo dell'utente loggato
	$query= "SELECT Tipo FROM utente WHERE Nickname='$nick'";
	$star=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$tipo=$star->fetch_row();

	if ($mailU[0] == 'admin@admin'){

  $query = "SELECT NomeCamp, DataInizio, DataFine, Creatore
            FROM campionato
            ORDER BY DataInizio";
					}
	else {
		$query = "SELECT NomeCamp, DataInizio, DataFine, Creatore
	            FROM campionato WHERE Creatore='$mailU[0]'
	            ORDER BY DataInizio";
	}

  $camp= $cid->query($query) or die("<p>Impossibile eseguire query.</p>"
                                  . "<p>Codice errore " . $cid->errno
                                  . ": " . $cid->error) . "</p>";
  if($camp) {
    if($camp->num_rows>=1) {
      echo "<form role='form' method='POST' action='php/eliminaCampionato-exe.php'>
            <table align='center' border=1>
            <tr><th><center>Nome Campionato</center></th><th>Data Inizio</th><th>Data Fine</th><th><center>Creatore</center></th><th><center> ✓</center></th></tr>";
            while($nomeCamp=$camp->fetch_row()) {
              echo "<tr><td><center>$nomeCamp[0]</center></td>
                  <td><center>$nomeCamp[1]</center></td>
                  <td><center>$nomeCamp[2]</center></td>
                  <td><center>$nomeCamp[3]</center></td>
                  <td><center><input type='checkbox' name='camp[]' value='".$nomeCamp[0]."'/></center></td></tr>
                  ";
            }
            echo "<tr><td colspan='5'><center>----&nbsp;&nbsp;&nbsp;<input type='submit' class='btn btn-danger' value='ELIMINA'></input>&nbsp;&nbsp;&nbsp;----</center></td>
                  </tr></form></table><br/><br/>";
    }
    else {
      echo "<p align='center'>NON HAI CREATO NESSUN CAMPIONATO.<br/> PER FARLO
			       E' NECESSARIO AVERE IL GRADO DI COMMISSARIO TECNICO.</p>";
    }
  } else {
    echo "<p align='center'>ERRORE.</p>";
  }
  unset($res);



 ?>
</div>
