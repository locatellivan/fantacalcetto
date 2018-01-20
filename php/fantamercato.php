
  <div class="well">
	<h1 align="center"><b>FANTAMERCATO</b></h1><br/>

  <?php


  		include_once("connessione.php");


  		$nick=$_SESSION['nick'];

  		$sql="SELECT fantaMilioni FROM squadra JOIN utente ON Utente=Mail WHERE Nickname='".$nick."'";

  		$soldi=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
  																 ."<p>codice di errore ".$cid->errno
  																 .":".$cid->error."</p>");
  		$soldiRestanti=$soldi->fetch_row();

            echo "<table border=4 align='center'>
        		     	<tr><th  id='soldi'><h3>&nbsp;&nbsp;Budget:&nbsp;&nbsp;".$soldiRestanti[0]." fantamilioni&nbsp;&nbsp;</h3></th>
                  <form role='form' method='POST' action='php/compravendi-exe.php'>
                  <th colspan='4'><center><input type='submit' class='btn btn-success' value='COMPRAVENDI \n GIOCATORI'>
                  </input></center></th></tr>
          							</tr></table>";

  		$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
  		$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
  																	 ."<p>codice di errore ".$cid->errno
  																	 .":".$cid->error."</p>");
  		$nomeSq=$squadra->fetch_row();    // Salvo in una variabile il nome della squadra loggata
  		?>

  		<h2 align="center"><b>VENDI GIOCATORI</b></h2><br/><br/>

      <?php
      //salvo i giocatoriche ho in rosa
      		$sql="SELECT Cognome, Ruolo, Prezzo
      					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
      					WHERE SquadraGioc='".$nomeSq[0]."' ORDER BY Ruolo DESC, Cognome ASC";

      		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
      																	 ."<p>codice di errore ".$cid->errno
      																	 .":".$cid->error."</p>");
      		if($res->num_rows>=1) {
      			echo "
      				    <table  align='center' border=1>
      						<tr><th><center>COGNOME</center></th><th><center>RUOLO</center></th><th><center>PREZZO</center></th><th><center>✓</center></th></tr>";

      			while ($gioc=$res->fetch_row()) {

      				echo "<tr><td><center>$gioc[0]</center></td>
                        <td><center>$gioc[1]</center></td>
                        <td><center>$gioc[2]</center></td>
      				          <td><center><input type='checkbox'  name='vendi[]' value='".$gioc[0]."'/>
      				              </center></td></tr><br/>";

      			}

            echo"</table>";
           }
           else {
      			echo "<p align='center'>NESSUN GIOCATORE ANCORA PRESENTE. COMPRALI NELLA SEZIONE APPOSITA!</p><br/>";
      		}
          unset($res);
      ?>

 <h2 align="center"><b>COMPRA GIOCATORI</b></h2><br/><br/>

<?php



	//   Salvo in delle variabili il numero di giocatori per ruolo */
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

echo "<table border='1' align='center' class='table table-striped'>
      <tr><th>";



		if(true) {
			$sql="SELECT Cognome, Prezzo, Squadra
            FROM giocatore
						WHERE Ruolo='P'
            AND Cognome NOT IN (SELECT Cognome
             FROM possiede JOIN giocatore ON (Giocatore=Cognome)
             WHERE SquadraGioc='$nomeSq[0]')
            ORDER BY Cognome ASC  ";

			$listaPortiere=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																					."<p>codice di errore ".$cid->errno
																					.":".$cid->error."</p>");

			echo "<table align='center' border='1' class='table table-striped'>
						<tr><th colspan='4'><center><h4><b>- PORTIERI -</b></h4></center></th></tr>
						<tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th id='spunta'><center>✓</center></th></tr>";
            $y=4;
						while($gioc=$listaPortiere->fetch_row()) {
							echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
							<td><center><input type='checkbox' id='$y' onClick='controlloCheck()' name='compra[]' value='".$gioc[0]."'/>
							</center></td></tr>";
              $y++;
						}

            echo"</table>";
echo"</th><th>";
		}

    if(true) {
      $sql="SELECT Cognome, Prezzo, Squadra  FROM giocatore
            WHERE Ruolo='D'
            AND Cognome NOT IN (SELECT Cognome
            FROM possiede JOIN giocatore ON (Giocatore=Cognome)
            WHERE SquadraGioc='$nomeSq[0]')
            ORDER BY Cognome ASC  ";
      $listaDifensori=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
                                          ."<p>codice di errore ".$cid->errno
                                          .":".$cid->error."</p>");

      echo "<table align='center' border='1' class='table table-striped'>
            <tr><th colspan='4'><center><h4><b>- DIFENSORI -</b></h4></center></th></tr>
            <tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th id='spunta'><center>✓</center></th></tr>";
            while($gioc=$listaDifensori->fetch_row()) {
              echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
              <td><center><input type='checkbox' onclick='loadDocBuy()' name='compra[]' value='".$gioc[0]."'/>
              </center></td></tr>";

            }echo"</table>";
    }
    echo"</th><th>";

    //seeziono e visulizzzo centrocampisti
        if(true) {
          $sql="SELECT Cognome, Prezzo, Squadra  FROM giocatore
                WHERE Ruolo='C'
                AND Cognome NOT IN (SELECT Cognome
                FROM possiede JOIN giocatore ON (Giocatore=Cognome)
                WHERE SquadraGioc='$nomeSq[0]')
                ORDER BY Cognome ASC  ";
          $listaCentrocampisti=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
                                              ."<p>codice di errore ".$cid->errno
                                              .":".$cid->error."</p>");

          echo "<form role='form' method='POST' onsumbit='javascript:xmlhttpPost('compra_ajax.php');' class='form-inline'>
                <table align='center' border='1' class='table table-striped'>
                <tr><th colspan='4'><center><h4><b>- DIFENSORI -</b></h4></center></th></tr>
                <tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th id='spunta'><center>✓</center></th></tr>";
                while($gioc=$listaCentrocampisti->fetch_row()) {
                  echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
                  <td><center><input type='checkbox' onclick='loadDocBuy()' name='compra[]' value='".$gioc[0]."'/>
                  </center></td></tr>";

                }echo"</table>";
        }
        echo"</th><th>";


            if(true) {
              $sql="SELECT Cognome, Prezzo, Squadra  FROM giocatore
                    WHERE Ruolo='A'
                    AND Cognome NOT IN (SELECT Cognome
                    FROM possiede JOIN giocatore ON (Giocatore=Cognome)
                    WHERE SquadraGioc='$nomeSq[0]')
                    ORDER BY Cognome ASC  ";
              $listaAttaccanti=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
                                                  ."<p>codice di errore ".$cid->errno
                                                  .":".$cid->error."</p>");

              echo "<form role='form' method='POST' onsumbit='javascript:xmlhttpPost('compra_ajax.php');' class='form-inline'>
                    <table align='center' border='1' class='table table-striped'>
                    <tr><th colspan='4'><center><h4><b>- DIFENSORI -</b></h4></center></th></tr>
                    <tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th id='spunta'><center>✓</center></th></tr>";
                    while($gioc=$listaAttaccanti->fetch_row()) {
                      echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
                      <td><center><input type='checkbox' onclick='loadDocBuy()' name='compra[]' value='".$gioc[0]."'/>
                      </center></td></tr>";

                    }echo"</table>";
            }
    echo"</th></tr></table>";
?>
<!-- <td style="border: 1; align: center" -->
</div>
