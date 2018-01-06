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



			echo "<tr><td colspan='2'><center><input type='submit' class='btn btn-success' value='CREA FORMAZIONE'></input></center></td>
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
