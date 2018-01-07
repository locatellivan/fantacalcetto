<div class="well">
	<h1 align="center"><b>CREA LA TUA FORMAZIONE</b></h1><br/>


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
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='P' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$portieri1=$cid->query($sql);
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='P' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$portieri2=$cid->query($sql);

// Salvo i difensori della squadra loggata
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='D' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$difensori1=$cid->query($sql);
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='D' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$difensori2=$cid->query($sql);
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='D' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$difensori3=$cid->query($sql);

// Salvo i centrocampisti della squadra loggata
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='C' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$centr1=$cid->query($sql);
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='C' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$centr2=$cid->query($sql);
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='C' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$centr3=$cid->query($sql);

// Salvo gli attaccanti della squadra loggata
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='A' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$attaccanti1=$cid->query($sql);
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='A' AND formazione.Squadra='$nomeSq[0]'
			ORDER BY Giocatore";
$attaccanti2=$cid->query($sql);
$sql="SELECT Giocatore
      FROM formazione JOIN sta ON IdForm=Formazione JOIN giocatore ON Giocatore=Cognome
			WHERE Ruolo='A' AND formazione.Squadra='$nomeSq[0]'
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
	echo "<table align='center' border=2><tr><th>GIOCATORI MANCANTI:&nbsp;</th><td>&nbsp;$giocMancanti&nbsp;</td></tr></table>";
} else {
			echo "<table align='center' border=1>";
			echo "<form role='form' method='POST' action='php/creaFormazione-exe.php' class='form-inline'>";
			echo "<tr><th><center><b>NOME FORMAZIONE</b></center></th>";
			echo "<td><input type='text' name='formazione' placeholder='&nbsp;max. 20 caratteri'/></td></tr>";
			echo "</table><br/><table border='1' align='center'>";

			echo "<table align='center' border=1>";
			echo "<form role='form' method='POST' action='php/creaFormazione-exe.php' class='form-inline'>";
			echo "<tr><th><center><b>SCHEMA</b></center></th>";


			echo "<td><center><select name='schema'>;
				<option value='1'>2 - 1 - 1</option>;
				<option value='2'>1 - 2 - 1</option>;
				<option value='3'>1 - 1 - 2</option>;
				</center></td></tr>";

			echo "</table><br/><table border='1' align='center'>";


			echo "<tr><th>RUOLO FORMAZIONE</th><th>GIOCATORE</th></tr>";
			echo "<tr><td><center>Portiere 1</center></td><td><center><select name='por1'>";
			while($por1=$portieri1->fetch_row()) {
					echo "<option value='$por1[0]'>$por1[0]</option>";
			}

			echo "<tr><td><center>Portiere 2</center></td><td><center><select name='por2'>";
			while($por2=$portieri2->fetch_row()) {
					echo "<option value='$por2[0]'>$por2[0]</option>";
			}

			echo "<tr><td><center>Difensore 1</center></td><td><center><select name='dif1'>";
			while($dif1=$difensori1->fetch_row()) {
					echo "<option value='$dif1[0]'>$dif1[0]</option>";
			}

			echo "<tr><td><center>Difensore 2</center></td><td><center><select name='dif2'>";
			while($dif2=$difensori2->fetch_row()) {
					echo "<option value='$dif2[0]'>$dif2[0]</option>";
			}

			echo "<tr><td><center>Difensore 3</center></td><td><center><select name='dif3'>";
			while($dif3=$difensori3->fetch_row()) {
					echo "<option value='$dif3[0]'>$dif3[0]</option>";
			}

			echo "<tr><td><center>Centrocampista 1</center></td><td><center><select name='cent1'>";
			while($cent1=$centr1->fetch_row()) {
					echo "<option value='$cent1[0]'>$cent1[0]</option>";
			}

			echo "<tr><td><center>Centrocampista 2</center></td><td><center><select name='cent2'>";
			while($cent2=$centr2->fetch_row()) {
					echo "<option value='$cent2[0]'>$cent2[0]</option>";
			}

			echo "<tr><td><center>Centrocampista 3</center></td><td><center><select name='cent3'>";
			while($cent3=$centr3->fetch_row()) {
					echo "<option value='$cent3[0]'>$cent3[0]</option>";
			}

			echo "<tr><td><center>Attaccante 1</center></td><td><center><select name='att1'>";
			while($att1=$attaccanti1->fetch_row()) {
					echo "<option value='$att1[0]'>$att1[0]</option>";
			}

			echo "<tr><td><center>Attaccante 2</center></td><td><center><select name='att2'>";
			while($att2=$attaccanti2->fetch_row()) {
					echo "<option value='$att2[0]'>$att2[0]</option>";
			}

			echo "<tr><td><center>Attaccante 3</center></td><td><center><select name='att3'>";
			while($att3=$attaccanti3->fetch_row()) {
					echo "<option value='$att3[0]'>$att3[0]</option>";
			}


			echo "<tr><th colspan='3'><center><input type='submit' class='btn btn-success' value='CREA FORMAZIONE'></input></center></th>
						</tr></form></table><br/><br/>";

			echo "<h1 align='center'><b>LE TUE FORMAZIONI</b></h1><br/>";

			while($nomeForm=$formazioni->fetch_row()) {
				echo "<table align='center' border=1>";
				echo "<tr><th colspan='3'><center>$nomeForm[0]</center></th></tr>";
				echo "<tr><th><center>Giocatore</center></th><th><center>Ruolo</center></th><th><center>Numero Ingresso</center></th></tr>";

				// Salvo i giocatori per le formazioni esistenti dell'utente loggato
				$sql="SELECT Cognome, Ruolo, NumIngresso
							FROM sta JOIN giocatore ON Cognome=Giocatore
							WHERE Formazione='$nomeForm[0]'
							ORDER BY NumIngresso";
				$giocatoriForm=$cid->query($sql)  or die("<p>Impossibile eseguire query.</p>"
																			 ."<p>codice di errore ".$cid->errno
																			 .":".$cid->error."</p>");

				while ($giocForm=$giocatoriForm->fetch_row()) {

					echo "<tr><td><center>$giocForm[0]</center></td>
					          <td><center>$giocForm[1]</center></td>
										<td><center>$giocForm[2]</center></td></tr>";
				}
				echo "</table><br/><br/>";
			}



		}



?>

</div>
