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

	// Variabile per i campionati a cui partecipa l'utente loggato
	$sql="SELECT Campionato FROM partecipa
	      WHERE Squadra='$nomeSq[0]'
				ORDER BY Campionato";

	$campionato=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

  // Variabile per le giornate a cui ci si puo iscrivere a cui partecipa l'utente
	$sql="SELECT NumGior, DataPartite FROM giornata
				ORDER BY NumGior";
	$giornate=$cid->query($sql) or die("<p>Imppossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");

	$cont="SELECT COUNT(Giocatore)
				 FROM possiede JOIN squadra ON SquadraGioc=NomeSq
				 WHERE SquadraGioc='$nomeSq[0]'";
	$gioc=$cid->query($cont) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nGioc=$gioc->fetch_row();

	// Se il giocatore possiede 11 giocatori puo iscriversi alle giornate.
	if($nGioc[0]==11) {


		$sql="SELECT Cognome, Ruolo
					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
					WHERE SquadraGioc='".$nomeSq[0]."' ORDER BY Ruolo DESC, Cognome ASC";

		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");

		echo "<form role='form' method='POST' action='consegnaFormazione-exe.php' class='form-inline'>
					<table border=1 align='center'>
					<tr><th><center>COGNOME</center></th><th><center>RUOLO</center></th><th><center>NUMERO D'INGRESSO</center></th></tr>";

					while ($gioc=$res->fetch_row()) {
						echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[1]</center></td>
						<td><center><select name='numIngr'>
													<option value='1'>1</option>
													<option value='2'>2</option>
													<option value='3'>3</option>
													<option value='4'>4</option>
													<option value='5'>5</option>
													<option value='6'>6</option>
													<option value='7'>7</option>
													<option value='8'>8</option>
													<option value='9'>9</option>
													<option value='10'>10</option>
													<option value='11'>11</option>
						</select></center></td></tr>";
					}
					echo "<tr><td colspan='2'><center><b>CAMPIONATO</b></center></td>";
					echo "<td><center><select name='campionato'>";

								while($nomeCa=$campionato->fetch_row()) {
										echo "<option value='$nomeCa[0]'>$nomeCa[0]</option>";
								}
					echo "</select></center></td></tr>";
					echo "<tr><td colspan='2'><center><b>GIORNATA</b></center></td>";
					echo "<td><center><select name='campionato'>";

								while($gior=$giornate->fetch_row()) {
										echo "<option value='$gior[0]'>$gior[0] - $gior[1]</option>";
								}
					echo "</select></center></td></tr>";
					echo "<tr><td colspan='2'><center><b>NOME FORMAZIONE</b></center></td>";
					echo "<td><input type='text' name='formazione'/></td></tr>";
					echo "<tr><td colspan='3'><center><input type='submit'
					class='btn btn-success' value='CONSEGNA FORMAZIONE'></input></center></td>
							</tr></form></table><br/><br/>";


	}
	else {
		echo "<h3 align='center'><b>PER ISCRIVERE AD UNA GIORNATA LA FORMAZIONE E' NECESSARIO
		       AVERE 11 GIOCATORI. LI PUOI ACQUISTARE NELLA PAGINA DEL  <a href='main.php?op=fantamercato'>FANTAMERCATO</a>.</b></h3><br/>
					 <p align='center'>Per ulteriori informazioni leggi il <a href='main.php?op=regolamento'>regolamento</a>!";
		echo "<br/><br/><br/>";
		echo "<table align='center' border=5><tr><th><h4><b>&nbsp;NUMERO GIOCATORI:&nbsp;&nbsp;&nbsp;</b></h4></th>
		      <td><h4><b>&nbsp;$nGioc[0]&nbsp;</b></h4></td></tr></table></div>";
	}


	 ?>
