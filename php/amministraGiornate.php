<div class="well">
		<h1 align="center"><b>GESTISCI GIORNATE</b></h1><br/>

<?php

		include_once("connessione.php");
		$nick=$_SESSION['nick'];

		// Salvo in una variabile il tipo dell'utente
		$sql="SELECT Tipo FROM utente WHERE  Nickname='$nick'";
		$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$tipo=$utente->fetch_row();

		// Seleziono la giornata da giocare
		$sql="SELECT NumGior FROM giornata WHERE Stato='NGA'";
		$giorDaGiocare=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$gior=$giorDaGiocare->fetch_row();

		// Se l'utente loggato è amministratore avrà accesso alla pagina.
		if($tipo[0]!='Amministratore') {
			echo "<h3 align='center'>PER ACCEDERE ALLE FUNZIONALITA' DI QUESTA PAGINA E' NECESSARIO ESSERE AMMINISTRATORI.</h3><br/>";
		}
		else {
				echo "<h3 align='center'>Aggiornando la giornata verranno aggiornati i punteggi di tutti i giocatori,<br/>
							conseguentemente anche le stelle degli utenti e le classifiche giornaliere e totali.<br/><br/>
							<b>QUESTO PROCEDIMENTO NON E' REVERSIBILE.<br/><br/>SI AGGIORNERANNO I PUNTEGGI
							RELATIVI ALLA GIORNATA:&nbsp;$gior[0]</b></h3><br/><br/>";

				echo "<form role='form' method='POST' action='php/aggiornaGiornata-exe.php'>";
				echo "<h1 align='center'><input type='submit' class='btn-lg btn-success' value='AGGIORNA GIORNATA'></input></h1></form>";

		echo "<br/><h2 align='center'>_____________________________________</h2><br/>";
		echo "<h1 align='center'><b>CONCLUDI CAMPIONATI</b></h1><br/>";
		$dataOdierna=date("d/m/Y");
		echo "<h3 align='center'>Cliccando il bottone sottostante verranno conclusi i campionati con data di fine minore o uguale
					alla data corrente. Concludendo il campionato verrà inserito nello storico dei campioni il vincitore.<br/><br/><b>DATA
					CORRENTE:&nbsp;$dataOdierna</b></h3><br/><br/>";
		echo "<form role='form' method='POST' action='php/concludiCampionati-exe.php'>";
		echo "<h1 align='center'><input type='submit' class='btn-lg btn-primary' value='CONCLUDI CAMPIONATI'></input></h1></form>";
		}
?>

</div>
