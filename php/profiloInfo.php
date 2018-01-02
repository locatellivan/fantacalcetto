<div class="well">
	<h2 align="center">INFORMAZIONI PERSONALI</h2>
	<p align="center">____________________________________</p><br/><br/>

	<?php

		$nick=$_SESSION['nick'];

		include_once("connessione.php");

		$query = "SELECT Mail, Nome, CognomeU, Sesso, DataN, LuogoN, CittaAtt,
							SquadraTifata, Tipo, Nickname
			        FROM utente
							WHERE Nickname='$nick'";

		$res= $cid->query($query) or die("<p>Inpossibile eseguire query.</p>"
																		. "<p>Codice errore " . $cid->errno
																		. ": " . $cid->error) . "</p>";
		$row=$res->fetch_row();
		if($res) {
				echo "<table class='centrata' border='1'>";
				echo"<tr><th>Mail:</th><td>$row[0]</td></tr>
						 <tr><th>Nickname:</th><td>$row[9]</tr>
						 <tr><th>Nome:</th><td>$row[1]</td></tr>
						 <tr><th>Cognome:</th><td>$row[2]</tr>
						 <tr><th>Sesso:</th><td>$row[3]</td></tr>
						 <tr><th>Data Nascita:</th><td>$row[4]</tr>
						 <tr><th>Luogo Nascita:</th><td>$row[5]</td></tr>
						 <tr><th>Città Attuale:</th><td>$row[6]</tr>
						 <tr><th>Squadra Tifata:</th><td>$row[7]</td></tr>
						 <tr><th>Ruolo:</th><td>$row[8]</tr>";
				echo "</table>";
		}
		else {
			echo "<p align='center'>ERRORE, UTENTE NON TROVATO.</p>";
		}
		unset($res);               //Rilascio le risorse

	?>
	<br/><br/><br/>
</div>
