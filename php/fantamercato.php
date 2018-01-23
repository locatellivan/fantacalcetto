
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
        		     	<tr>
                  <th style='background-color:ivory;'><h3>&nbsp;&nbsp;Fantamilioni&nbsp;&nbsp;</h3></th>
                  <th style='background-color:ivory;'><center><h3 id='soldi'>$soldiRestanti[0]</h3></center></th>
                  <form role='form' method='POST' action='php/compravendi-exe.php'>
                  <th style='background-color:ivory;'><center><input type='submit' class='btn btn-success' onClick='Fantacontrollo()' value='COMPRAVENDI \n GIOCATORI'>
                  </input></center></th>
                  </table>";

  		$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
  		$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
  																	 ."<p>codice di errore ".$cid->errno
  																	 .":".$cid->error."</p>");
  		$nomeSq=$squadra->fetch_row();    // Salvo in una variabile il nome della squadra loggata
  		?>

  		<br/><h2 align="center"><b>VENDI GIOCATORI</b></h2><br/>

      <?php

//salvo i giocatoriche ho in rosa e se non è vuota creo una tabella
      		$sql="SELECT Cognome, Ruolo, Prezzo
      					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
      					WHERE SquadraGioc='$nomeSq[0]'
                ORDER BY Ruolo DESC, Cognome ASC";

      		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
      																	 ."<p>codice di errore ".$cid->errno
      																	 .":".$cid->error."</p>");
      		if($res->num_rows>=1) {
      			echo "<table  align='center' border=1>
      						<tr><th><center>COGNOME</center></th>
                  <th><center>RUOLO</center></th>
                  <th><center>PREZZO</center>
                  </th><th><center>✓</center></th></tr>";
///portirei
            $sql="SELECT Cognome, Ruolo, Prezzo
        					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
        					WHERE SquadraGioc='$nomeSq[0]'
                  AND Ruolo='P'
                  ORDER BY Ruolo DESC, Cognome ASC";

        		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
        																	 ."<p>codice di errore ".$cid->errno
        																	 .":".$cid->error."</p>");

      			while ($por=$res->fetch_row()){

                echo "<tr><td><center>$por[0]</center></td>
                          <td><center>$por[1]</center></td>
                          <td><center>$por[2]</center></td>
                         <td><center><input type='checkbox'  name='vendiPortieri[]' value='".$por[0]."'/></center></td>
                          </tr>";
                        }
//difensori
             $sql="SELECT Cognome, Ruolo, Prezzo
         					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
         					WHERE SquadraGioc='$nomeSq[0]'
                  AND Ruolo='D'
                  ORDER BY Ruolo DESC, Cognome ASC";

         		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
         																	 ."<p>codice di errore ".$cid->errno
         																	 .":".$cid->error."</p>");



            while ($dif=$res->fetch_row()) {


              echo "<tr><td><center>$dif[0]</center></td>
                        <td><center>$dif[1]</center></td>
                        <td><center>$dif[2]</center></td>
      				          <td><center><input type='checkbox'  name='vendiDifensori[]' value='".$dif[0]."'/></center></td>
                        </tr>";

      			}
//centrocampisti
             $sql="SELECT Cognome, Ruolo, Prezzo
         					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
         					WHERE SquadraGioc='$nomeSq[0]'
                  AND Ruolo='C'
                  ORDER BY Ruolo DESC, Cognome ASC";

         		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
         																	 ."<p>codice di errore ".$cid->errno
         																	 .":".$cid->error."</p>");



            while ($cent=$res->fetch_row()) {


              echo "<tr><td><center>$cent[0]</center></td>
                        <td><center>$cent[1]</center></td>
                        <td><center>$cent[2]</center></td>
      				          <td><center><input type='checkbox'  name='vendiCentrocampisti[]' value='".$cent[0]."'/></center></td>
                        </tr>";

      			}

//attacanti
             $sql="SELECT Cognome, Ruolo, Prezzo
         					FROM possiede JOIN giocatore ON (Giocatore=Cognome)
         					WHERE SquadraGioc='$nomeSq[0]'
                  AND Ruolo='A'
                  ORDER BY Ruolo DESC, Cognome ASC";

         		$res=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
         																	 ."<p>codice di errore ".$cid->errno
         																	 .":".$cid->error."</p>");



            while ($att=$res->fetch_row()) {


              echo "<tr><td><center>$att[0]</center></td>
                        <td><center>$att[1]</center></td>
                        <td><center>$att[2]</center></td>
      				          <td><center><input type='checkbox'  name='vendiAttaccanti[]' value='".$att[0]."'/></center></td>
                        </tr>";

      			}

            echo"</table><br/>";
          }
           else {
      			echo "<p align='center'>NESSUN GIOCATORE ANCORA PRESENTE. COMPRALI NELLA SEZIONE APPOSITA!</p><br/>";
      		}
          unset($res);
      ?>

 <h2 align="center"><b>COMPRA GIOCATORI</b></h2><br/><br/>

<?php



echo "<table border='1' align='center' class='table table-striped'>
      <tr><th style='background-color:black;'>";



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
						<tr><th style='background-color:#7fffd4;' colspan='4'><center><h4><b>- PORTIERI -</b></h4></center></th></tr>
						<tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th><center>✓</center></th></tr>";
            $y=4;
						while($gioc=$listaPortiere->fetch_row()) {
							echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
							<td><center><input type='checkbox' id='$y' onClick='controllod()' name='compraPortieri[]' value='".$gioc[0]."'/>
							</center></td></tr>";
              $y++;
						}

            echo"</table>";
            echo"<h3></h3></th><th style='background-color:black;'>";

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
            <tr><th style='background-color:#8fbc8f;' colspan='4'><center><h4><b>- DIFENSORI -</b></h4></center></th></tr>
            <tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th><center>✓</center></th></tr>";
            while($gioc=$listaDifensori->fetch_row()) {
              echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
              <td><center><input type='checkbox' onclick='loadDocBuy()' name='compraDifensori[]' value='".$gioc[0]."'/>
              </center></td></tr>";

            }echo"</table>";
    }
    echo"</th><th style='background-color:black;'>";
  }

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
                <tr><th style='background-color:#e9967a;' colspan='4'><center><h4><b>- CENTROCAMPISTI -</b></h4></center></th></tr>
                <tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th id='spunta'><center>✓</center></th></tr>";
                while($gioc=$listaCentrocampisti->fetch_row()) {
                  echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
                  <td><center><input type='checkbox' onclick='loadDocBuy()' name='compraCentrocampisti[]' value='".$gioc[0]."'/>
                  </center></td></tr>";

                }echo"</table>";
        }
        echo"</th><th style='background-color:black;'>";


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
                    <tr><th style='background-color:#dda0dd;' colspan='4'><center><h4><b>- ATTACCANTI -</b></h4></center></th></tr>
                    <tr><th><center>Cognome</center></th><th>Squadra</th><th>Prezzo</th><th id='spunta'><center>✓</center></th></tr>";
                    while($gioc=$listaAttaccanti->fetch_row()) {
                      echo "<tr><td><center>$gioc[0]</center></td><td><center>$gioc[2]</center></td><td><center>$gioc[1]</center></td>
                      <td><center><input type='checkbox' onclick='loadDocBuy()' name='compraAttaccanti[]' value='".$gioc[0]."'/>
                      </center></td></tr>";

                    }echo"</table>";
            }
    echo"</th></tr></table>";
?>
<!-- <td style="border: 1; align: center" -->
</div>
