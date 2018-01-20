<div class="well">
	<h1 align="center"><b>CREA LE TUE FORMAZIONI</b></h1><br/>


	<?php

	include_once("connessione.php");
	$nick=$_SESSION['nick'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();

	// Salvo gli identificatori delle formzioni dell'utente loggato
	$sql="SELECT DISTINCT Formazione
	      FROM sta JOIN Formazione ON sta.Formazione=formazione.IdForm
				WHERE Squadra='$nomeSq[0]'";
	$formazioni=$cid->query($sql);


	// Salvo il numero di formazioni disponibili
	$cont="SELECT COUNT(IdForm)
				 FROM formazione
				 WHERE Squadra='$nomeSq[0]'";
	$form=$cid->query($cont) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nForm=$form->fetch_row();

	// Salvo il numero di giocatori nella squadra dell'utente loggato
	$sql="SELECT COUNT(Giocatore)
			  FROM possiede
				WHERE SquadraGioc='$nomeSq[0]'";
	$numero=$cid->query($sql)  or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nGioc=$numero->fetch_row();

	// Salvo i portieri della squadra loggata
	$sql="SELECT Giocatore
	      FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='P' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$portieri1=$cid->query($sql);
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='P' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$portieri2=$cid->query($sql);

	// Salvo i difensori della squadra loggata
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='D' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$difensori1=$cid->query($sql);
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='D' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$difensori2=$cid->query($sql);
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='D' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$difensori3=$cid->query($sql);

	// Salvo i centrocampisti della squadra loggata
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='C' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$centr1=$cid->query($sql);
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='C' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$centr2=$cid->query($sql);
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='C' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$centr3=$cid->query($sql);

	// Salvo gli attaccanti della squadra loggata
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='A' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$attaccanti1=$cid->query($sql);
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='A' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$attaccanti2=$cid->query($sql);
	$sql="SELECT Giocatore
				FROM giocatore JOIN possiede ON Giocatore=Cognome
				WHERE Ruolo='A' AND SquadraGioc='$nomeSq[0]'
				ORDER BY Giocatore";
	$attaccanti3=$cid->query($sql);



	if($nForm[0]==3) {
		echo "<p align='center'> HAI RAGGIUNTO IL LIMITE MASSIMO DI FORMAZIONI.<br/>
		      PER CREARNE DI NUOVE E' NECESSARIO <a href='main.php?op=eliminaFormazione'>ELIMINARLE</a>.
		</p><br/><br/>";
	}
	else if ($nGioc[0]<11) {
		$giocMancanti=11-$nGioc[0];
		echo "<p align='center'>PER CREARE UNA FOMRAZIONE E' NECESSARIO AVERE LA SQUADRA AL COMPLETO. VAI AL <a href='main.php?op=fantamercato'>FANTAMERCATO</a></p><br/><br/>";
		echo "<table align='center' border=2><tr><th>GIOCATORI MANCANTI:&nbsp;</th><td>&nbsp;$giocMancanti&nbsp;</td></tr></table><br/><br/>";
	} else {
				echo "<table align='center' border=1>";
				echo "<form role='form' method='POST' action='php/creaFormazione-exe.php' class='form-inline'>";

				// Riga per inserire il nome della formazione
				echo "<tr><th style='background-color:#bdb76b;'><center><b>NOME FORMAZIONE</b></center></th>";
				echo "<td style='background-color:#bdb76b;'><input type='text' id='nomeForm' name='formazione' placeholder='&nbsp;max. 20 caratteri'/></td></tr>";

				// Riga per la scelta dello schema desiderato
				echo "<tr><th style='background-color:#7fffd4;'><center><b>SCHEMA</b></center></th>";
				echo "<td style='background-color:#7fffd4;'><center><select name='schema'>;
					<option value='1'>2 - 1 - 1</option>;
					<option value='2'>1 - 2 - 1</option>;
					<option value='3'>1 - 1 - 2</option>;
					</center></td></tr>";

				//
				echo "<tr><th><center>RUOLO FORMAZIONE</center></th><th><center>GIOCATORE</center></th></tr>";
				echo "<tr><td><center>Portiere 1</center></td><td><center><select id='por1' name='por1'>";
				while($por1=$portieri1->fetch_row()) {
						echo "<option value='$por1[0]'>$por1[0]</option>";
				}

				echo "<tr><td><center>Portiere 2</center></td><td><center><select id='por2' name='por2'>";
				while($por2=$portieri2->fetch_row()) {
						echo "<option value='$por2[0]'>$por2[0]</option>";
				}

				echo "<tr><td><center>Difensore 1</center></td><td><center><select id='dif1' name='dif1'>";
				while($dif1=$difensori1->fetch_row()) {
						echo "<option value='$dif1[0]'>$dif1[0]</option>";
				}

				echo "<tr><td><center>Difensore 2</center></td><td><center><select id='dif2' name='dif2'>";
				while($dif2=$difensori2->fetch_row()) {
						echo "<option value='$dif2[0]'>$dif2[0]</option>";
				}

				echo "<tr><td><center>Difensore 3</center></td><td><center><select id='dif3' name='dif3'>";
				while($dif3=$difensori3->fetch_row()) {
						echo "<option value='$dif3[0]'>$dif3[0]</option>";
				}

				echo "<tr><td><center>Centrocampista 1</center></td><td><center><select id='cen1' name='cen1'>";
				while($cent1=$centr1->fetch_row()) {
						echo "<option value='$cent1[0]'>$cent1[0]</option>";
				}

				echo "<tr><td><center>Centrocampista 2</center></td><td><center><select id='cen2' name='cen2'>";
				while($cent2=$centr2->fetch_row()) {
						echo "<option value='$cent2[0]'>$cent2[0]</option>";
				}

				echo "<tr><td><center>Centrocampista 3</center></td><td><center><select id='cen3' name='cen3'>";
				while($cent3=$centr3->fetch_row()) {
						echo "<option value='$cent3[0]'>$cent3[0]</option>";
				}

				echo "<tr><td><center>Attaccante 1</center></td><td><center><select id='att1' name='att1'>";
				while($att1=$attaccanti1->fetch_row()) {
						echo "<option value='$att1[0]'>$att1[0]</option>";
				}

				echo "<tr><td><center>Attaccante 2</center></td><td><center><select id='att2' name='att2'>";
				while($att2=$attaccanti2->fetch_row()) {
						echo "<option value='$att2[0]'>$att2[0]</option>";
				}

				echo "<tr><td><center>Attaccante 3</center></td><td><center><select id='att3' name='att3'>";
				while($att3=$attaccanti3->fetch_row()) {
						echo "<option value='$att3[0]'>$att3[0]</option>";
				}
				echo "<tr><th style='background-color:#dcdcdc;'colspan='3'><center><input type='submit' class='btn btn-success' onclick='errCreaFormazione()' value='CREA FORMAZIONE'></input></center></th>
							</tr></form></table><br/><br/>";
			}

				echo "<h1 align='center'><b>LE TUE FORMAZIONI</b></h1><br/>";

				if($nForm[0]<1) {
					echo "<h4 align='center'>DEVI ANCORA CREARE UNA FORMAZIONE!</h4>";
				}
				else {
					while($nomeForm=$formazioni->fetch_row()) {
						echo "<table align='center' border=1>";
						echo "<tr><th style='background-color:#bdb76b;' colspan='3'><center><h4><b>$nomeForm[0]</b></h4></center></th></tr>";
						echo "<tr><th colspan='3'><center>____TITOLARI____</center></th></tr>";

						// Salvo i giocatori titolari della formazione
						$sql="SELECT Cognome, Ruolo, Squadra
									FROM sta JOIN giocatore ON Cognome=Giocatore
									WHERE Formazione='$nomeForm[0]' AND NumIngresso<=5
									ORDER BY Ruolo DESC";
						$giocatoriTit=$cid->query($sql)  or die("<p>Impossibile eseguire query.</p>"
																					 ."<p>codice di errore ".$cid->errno
																					 .":".$cid->error."</p>");

						// Salvo i giocatori riserve della formazione
						$sql="SELECT Cognome, Ruolo, Squadra
									FROM sta JOIN giocatore ON Cognome=Giocatore
									WHERE Formazione='$nomeForm[0]' AND NumIngresso>5
									ORDER BY Ruolo DESC";
						$giocatoriRis=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																					 ."<p>codice di errore ".$cid->errno
																					 .":".$cid->error."</p>");

						while ($giocTit=$giocatoriTit->fetch_row()) {

							echo "<tr><td><center>$giocTit[0]</center></td>
							          <td><center>$giocTit[2]</center></td>
												<td><center>$giocTit[1]</center></td>
												</tr>";
						}

						echo "<tr><th COLSPAN='3'><center>____RISERVE____</center></th></tr>";

						while ($giocRis=$giocatoriRis->fetch_row()) {
							echo "<tr><td><center>$giocRis[0]</center></td>
							          <td><center>$giocRis[2]</center></td>
												<td><center>$giocRis[1]</center></td>
												</tr>";
						}

						echo "</table><br/><br/>";
					}
				}


	?>

</div>
