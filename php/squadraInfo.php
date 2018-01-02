<div class="well">
	<h2 align="center">INFORMAZIONI SQUADRA</h2>
	<p align="center">____________________________________</p><br/><br/>

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
		unset($res);               //Rilascio le risorse

	?>
	<br/><br/><br/>
</div>
