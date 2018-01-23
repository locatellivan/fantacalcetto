<?php

	session_start();
	include_once("connessione.php");

	$nick=$_SESSION['nick'];

	// Salvo variabili da creaFormazione.php
	$nomeForm=addslashes(htmlspecialchars($_POST['formazione']));
	$schema=$_POST['schema'];
	$por1=$_POST['por1'];
	$por2=$_POST['por2'];
	$dif1=$_POST['dif1'];
	$dif2=$_POST['dif2'];
	$dif3=$_POST['dif3'];
	$cen1=$_POST['cen1'];
	$cen2=$_POST['cen2'];
	$cen3=$_POST['cen3'];
	$att1=$_POST['att1'];
	$att2=$_POST['att2'];
	$att3=$_POST['att3'];

	// Salvo in una variabile il nome della squadra loggata
	$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
	$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																 ."<p>codice di errore ".$cid->errno
																 .":".$cid->error."</p>");
	$nomeSq=$squadra->fetch_row();


	// Eseguo i controlli sugli input
	if(strlen($nomeForm)<=20 && strlen($nomeForm)!=0 && $por1!=$por2 && $dif1!=$dif2
     && $dif2!=$dif3 && $dif1!=$dif3 && $cen1!=$cen2 && $cen2!=$cen3 && $cen1!=$cen3
	   && $att1!=$att2 && $att2!=$att3 && $att1!=$att3) {

			 $nomeFormSquadra=$nomeForm."_".$nomeSq[0];

			$query="INSERT INTO formazione(IdForm, Squadra)
		   				VALUES ('$nomeFormSquadra', '$nomeSq[0]')";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");

			/* Il primo portiere avrà sempre numero d'ingresso 1 e il secondo 6
			Stessa cosa per il primo difensore (2), il primo centrocampista (3)
			e il primo attaccante (4), il terzo attaccante (11), il terzo centrocampista (10)
			e il terzo difensore (9) */
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
							VALUES ('$nomeFormSquadra','$por1',1)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		 ."<p>codice di errore ".$cid->errno
																		 .":".$cid->error."</p>");
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
				   		VALUES ('$nomeFormSquadra','$por2',6)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
							VALUES ('$nomeFormSquadra','$dif1',2)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
							VALUES ('$nomeFormSquadra','$cen1',3)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
							VALUES ('$nomeFormSquadra','$att1',4)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
							VALUES ('$nomeFormSquadra','$att3',11)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
							VALUES ('$nomeFormSquadra','$cen3',10)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");
			$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
							VALUES ('$nomeFormSquadra','$dif3',9)";
			$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																."<p>codice di errore ".$cid->errno
																.":".$cid->error."</p>");


			// In base allo schema scelto inserisco diversi titolari in squadra.
			switch ($schema) {

				case '1':
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$dif2',5)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$cen2',7)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$att2',8)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
				break;
				case '2':
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$dif2',7)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$cen2',5)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$att2',8)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
				break;
				case '3':
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$dif2',7)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$cen2',8)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
					$query="INSERT INTO sta(Formazione,Giocatore,NumIngresso)
									VALUES ('$nomeFormSquadra','$att2',5)";
					$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
																		."<p>codice di errore ".$cid->errno
																		.":".$cid->error."</p>");
				break;
			}
		}


		header("Location:../main.php?op=creaFormazione");
		$cid->close();
 ?>
