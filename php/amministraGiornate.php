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


		if($tipo[0]!='amministratore') {
			echo "<h3 align='center'>PER ACCEDERE ALLE FUNZIONALITA' DI QUESTA PAGINA E' NECESSARIO ESSERE AMMINISTRATORI.</h3><br/>";

		} else {
				echo "<h3 align='center'>Aggiornando la giornata verranno aggiornati i punteggi di tutti i giocatori,<br/>
							conseguentemente anche le stelle degli utenti e le classifiche giornaliere e totali.<br/><br/>
							<b>QUESTO PROCEDIMENTO NON E' REVERSIBILE.</b></h3><br/><br/>";

				echo "<form role='form' method='POST' action='php/aggiornaGiornata-exe.php'>";
				echo "<h1 align='center'><input type='submit' class='btn-lg btn-success' value='AGGIORNA GIORNATA'></input></h1>";
		}



?>

</div>
