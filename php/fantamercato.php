<div class="well">

	<h1 align="center"><b>FANTAMERCATO</b></h1><br/>

	<!-- Uso il metodo post perchè è necessario aggiornare informazioni nel databse-->
	<script>
		function loadDocSell() {
		  var xhttp;
		  if (window.XMLHttpRequest) {
		    // code for modern browsers
		    xhttp = new XMLHttpRequest();
		    } else {
		    // code for IE6, IE5
		    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("").innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("POST", "vendi_ajax.php", true);
		  xhttp.send();
		}
</script>

<script>
	function loadDocBuy() {
	  var xhttp;
	  if (window.XMLHttpRequest) {
	    // code for modern browsers
	    xhttp = new XMLHttpRequest();
	    } else {
	    // code for IE6, IE5
	    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("demo").innerHTML = this.responseText;
	    }
	  };
	  xhttp.open("POST", "compra_ajax.php", true);
	  xhttp.send();
	}
</script>

<?php


		include_once("connessione.php");


		$nick=$_SESSION['nick'];

		$sql="SELECT fantaMilioni FROM squadra JOIN utente ON Utente=Mail WHERE Nickname='".$nick."'";

		$soldi=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
		$soldiRestanti=$soldi->fetch_row();

		echo "<table border=4 align='center'>
		     	<tr><th><h3>Budget:&nbsp;&nbsp;".$soldiRestanti[0]." fantamilioni.</h3></th></tr></table>
		    	<br/><br/><br/>";

		$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
		$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nomeSq=$squadra->fetch_row();    // Salvo in una variabile il nome della squadra loggata
		?>

		<h2 align="center"><b>VENDI GIOCATORI</b></h2><br/><br/>

<?php
		$sql="SELECT Cognome, Ruolo, Prezzo
					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
					WHERE SquadraGioc='".$nomeSq[0]."' ORDER BY Ruolo DESC, Cognome ASC";

		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		if($res->num_rows>=1) {
			echo "<form role='form' method='POST' onchange='javascript:xmlhttpPost('vendi_ajax.php');' class='form-inline'>
				    <table border=1 align='center'>
						<tr><th><center>COGNOME</center></th><th><center>RUOLO</center></th><th><center>PREZZO</center></th><th><center>✓</center></th></tr>";

			while ($gioc=$res->fetch_row()) {
				echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[1]</center></td><td><center>$gioc[2]</center></td>
				<td><center><input type='checkbox' name='vendi[]' value='".$gioc[0]."'/>
				</center></td></tr>";
			}
			echo "<tr><td colspan='4'><center><input type='submit' onclick='loadDocSell()'
			class='btn btn-danger' value='VENDI GIOCATORI'></input></center></td>
					</tr></form></table><br/><br/>";
     } else {
			echo "<p align='center'>NESSUN GIOCATORE ANCORA PRESENTE. COMPRALI NELLA SEZIONE APPOSITA!</p><br/<br/>";
		}
?>

		<h2 align="center"><b>COMPRA GIOCATORI</b></h2><br/><br/>
<?php

	  /* Salvo in delle variabili il numero di giocatori per ruolo */
		$sql="SELECT COUNT(*)
					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
					WHERE Ruolo='P' AND SquadraGioc='".$nomeSq[0]."'  ";
		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nPor=$res->fetch_row();

		$sql="SELECT COUNT(*)
					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
					WHERE Ruolo='D' AND SquadraGioc='".$nomeSq[0]."' ";
		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nDif=$res->fetch_row();

		$sql="SELECT COUNT(*)
					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
					WHERE Ruolo='C' AND SquadraGioc='".$nomeSq[0]."' ";
		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nCen=$res->fetch_row();

		$sql="SELECT COUNT(*)
					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
					WHERE Ruolo='A' AND SquadraGioc='".$nomeSq[0]."' ";
		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
		$nAtt=$res->fetch_row();

		if(true) {
			$sql="SELECT Cognome, Prezzo, Squadra  FROM giocatore
						WHERE Ruolo='P' ORDER BY Cognome ASC ";
			$listaPortiere=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																					."<p>codice di errore ".$cid->errno
																					.":".$cid->error."</p>");

			echo "<form role='form' method='POST' onsumbit='javascript:xmlhttpPost('compra_ajax.php');' class='form-inline'>
						<table align='center' border=1>
						<tr><th colspan='4'><center><h4><b>- PORTIERI -</b></h4></center></th></tr>
						<tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th><center>✓</center></th></tr>";
						while($gioc=$listaPortiere->fetch_row()) {
							echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
							<td><center><input type='checkbox' onclick='loadDocBuy()' name='compra[]' value='".$gioc[0]."'/>
							</center></td></tr>";
						}
					echo "<tr><td colspan='4'><center><input type='submit' class='btn btn-success' value='COMPRA GIOCATORI'></input></center></td>
							</tr></form></table><br/><br/>";
		}




?>
</div>
