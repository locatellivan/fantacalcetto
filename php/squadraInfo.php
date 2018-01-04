<div class="well">
	<h2 align="center">INFORMAZIONI SQUADRA</h2>
	<br/><br/>

	<?php

		$nick=$_SESSION['nick'];

		include_once("connessione.php");

		$query = "SELECT NomeSq, FantaMilioni, Motto, Stelle
			        FROM squadra NATURAL JOIN utente
							WHERE Nickname='$nick'";

		$res= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";
		$row=$res->fetch_row();
		if($res) {
				echo "<table class='centrata' border='1'>";
				echo"<tr><th>Nome Squadra:</th><td>$row[0]</td></tr>
						 <tr><th>FantaMilioni:</th><td>$row[1]</tr>
						 <tr><th>Motto:</th><td>$row[2]</td></tr>
						 <tr><th>Stelle:</th><td>$row[3]</tr>";
				echo "</table>";
		}
		else {
			echo "<p align='center'>ERRORE, SQUADRA NON TROVATO.</p>";
		}
		unset($res);
?>

		<br/><br/>
		<p align="center">____________________________________</p>
		<br/><br/>
		<h2 align="center">GIOCATORI DISPONIBILI</h2>
		<br/><br/>

<?php
			$query = "SELECT Cognome, Ruolo, Squadra
				        FROM utente JOIN squadra ON Mail=utente JOIN possiede ON NomeSq=SquadraGioc JOIN Giocatore ON Giocatore=Cognome
								WHERE Nickname='$nick'";

			$res= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																			. "<p>Codice errore " . $cid->errno
																			. ": " . $cid->error) . "</p>";
			if($res->num_rows>=1) {
					echo "<table border='1' align='center'>";
					echo"<tr><th><center>Cognome</center></th><th><center>Ruolo</center></th><th><center>Squadra</center></th></tr>";
					while($row=$res->fetch_row()) {
						echo "<tr><td><center>$row[0]</center></td><td><center>$row[1]</center></td><td><center>$row[2]</center></td></tr>";
					}
					echo "</table>";
			}
			else {
				echo "<p align='center'>NESSUN GIOCATORE ANCORA PRESENTE. VAI ALLA PAGINA
				DEL FANTAMERCATO PER CREARE LA TUA SQUADRA.</p>";
			}
			unset($res);               //Rilascio le risorse

		?>

	<br/><br/><br/>
</div>
