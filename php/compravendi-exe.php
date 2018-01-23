<?php

session_start();
include_once("connessione.php");



$nick=$_SESSION['nick'];

$vecchioPort=$_POST['vendiPortieri'];
$vecchioDif =$_POST['vendiDifensori'];
$vecchioCent=$_POST['vendiCentrocampisti'];
$vecchioAtt =$_POST['vendiAttaccanti'];

$nuoviPort=$_POST['compraPortieri'];
$nuoviDif =$_POST['compraDifensori'];
$nuoviCent=$_POST['compraCentrocampisti'];
$nuoviAtt =$_POST['compraAttaccanti'];

$mod="NO";

//CANCELLO FORMAZIONI SE CAMBIO QUALCOSA
if($vecchioPort!=0 || $vecchioDif!=0 ||$vecchioCent!=0 ||$vecchioAtt!=0||
		$nuoviPort!=0 || $nuoviDif!=0 ||$nuoviCent!=0 ||$nuoviAtt!=0){
	$query="DELETE FROM formazione
					WHERE Squadra='$nomeSq[0]'";
	$cid->query($query);
	$mod="SI";

}

 // Salvo in una variabile il nome della squadra loggata
$sql="SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='".$nick."'";
$squadra=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															 ."<p>codice di errore ".$cid->errno
															 .":".$cid->error."</p>");
$nomeSq=$squadra->fetch_row();

//CANCELLO FORMAZIONI SE CAMBIO QUALCOSA
if($vecchioPort!=0 || $vecchioDif!=0 ||$vecchioCent!=0 ||$vecchioAtt!=0){
	$query="DELETE FROM formazione
					WHERE Squadra='$nomeSq[0]'";
	$cid->query($query);
}

//calcolo il numero portieri (e poi tutti i ruoli) che ho in rosa
$sql="SELECT COUNT(*)
				FROM possiede JOIN giocatore ON (Giocatore=Cognome)
				WHERE Ruolo='P' AND SquadraGioc='$nomeSq[0]'";
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


//conteggio i fantaMilioni
// guardo i milioni che mi rimangono
$sql="SELECT SUM(Prezzo) FROM giocatore JOIN possiede ON giocatore=cognome
					WHERE SquadraGioc= (SELECT nomeSq FROM squadra JOIN utente ON Mail=Utente WHERE Nickname='$nick')";
$fantamilioniSpesi=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
															."<p>codice di errore ".$cid->errno
															.":".$cid->error."</p>");
$fantasoldi=$fantamilioniSpesi->fetch_row();

$fantamilioni=300-$fantasoldi[0];
$soldiVenditaPortieri=0;
foreach($vecchioPort as $VP) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$VP' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiVenditaPortieri=$soldiVenditaPortieri+$soldi[0];
}
$soldiAquistoPortieri=0;
foreach($nuoviPort as $NP) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$NP' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiAquistoPortieri=$soldiAquistoPortieri+$soldi[0];
}
$soldiVenditaDifensori=0;
foreach($vecchioDif as $VD) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$VD' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiVenditaDifensori=$soldiVenditaDifensori+$soldi[0];
}
$soldiAquistoDifensori=0;
foreach($nuoviDif as $ND) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$ND' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiAquistoDifensori=$soldiAquistoDifensori+$soldi[0];
}
$soldiVenditaCentrocampisti=0;
foreach($vecchioCent as $VC) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$VC' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiVenditaCentrocampisti=$soldiVenditaCentrocampisti+$soldi[0];
}
$soldiAquistoCentrocampisti=0;
foreach($nuoviCent as $NC) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$NC' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiAquistoCentrocampisti=$soldiAquistoCentrocampisti+$soldi[0];
}
$soldiVenditaAttaccanti=0;
foreach($vecchioAtt as $VA) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$VA' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiVenditaAttaccanti=$soldiVenditaAttaccanti+$soldi[0];
}
$soldiAquistoAttaccanti=0;
foreach($nuoviAtt as $NA) {
	$sql="SELECT Prezzo FROM Giocatore
					WHERE Cognome='$NA' ";
		$denaro=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
																	 ."<p>codice di errore ".$cid->errno
																	 .":".$cid->error."</p>");
	$soldi=$denaro->fetch_row();
	$soldiAquistoAttaccanti=$soldiAquistoAttaccanti+$soldi[0];

}


					if((300
							-$fantasoldi[0]
							-$soldiAquistoPortieri
							-$soldiAquistoDifensori
							-$soldiAquistoCentrocampisti
							-$soldiAquistoAttaccanti
							+$soldiVenditaPortieri
							+$soldiVenditaDifensori
							+$soldiVenditaCentrocampisti
							+$soldiVenditaAttaccanti)>0){

					if(($nPor[0]+$nDif[0]+$nAtt[0]+$nCen[0]
							- count($vecchioPort) + count($nuoviPort)
							- count($vecchioDif) + count($nuoviDif)
							- count($vecchioCent) + count($nuoviCent)
							- count($vecchioAtt) + count($nuoviAtt))<12){
					//se rispetta le condizioni di numero c'è un ingresso da parte di ogni ruolo
					//portieri max 2
								if(($nPor[0] - count($vecchioPort) + count($nuoviPort))<3){

										foreach($vecchioPort as $VP) {
											$query="DELETE FROM possiede
										          WHERE Giocatore='$VP' AND SquadraGioc='$nomeSq[0]'";
											$cid->query($query);
										}
											$fantamilioni=$fantamilioni+$soldiVenditaPortieri;

										foreach($nuoviPort as $NP) {
											$query="INSERT INTO possiede (Giocatore,	SquadraGioc)
															VALUES ('$NP','$nomeSq[0]')";
											$cid->query($query);
										}
											$fantamilioni=$fantamilioni-$soldiAquistoPortieri;
											$msgPortieri="OK";
								}
								else {
										$msgPortieri="over_P";
								}

								if(($nDif[0] - count($vecchioDif) + count($nuoviDif))<4){

										foreach($vecchioDif as $VD) {
											$query="DELETE FROM possiede
										          WHERE Giocatore='$VD' AND SquadraGioc='$nomeSq[0]'";
											$cid->query($query);
										}
											$fantamilioni=$fantamilioni+$soldiVenditaDifensori;


										foreach($nuoviDif as $ND) {
											$query="INSERT INTO possiede (Giocatore,	SquadraGioc)
															VALUES ('$ND','$nomeSq[0]')";
											$cid->query($query);
										}
    									$fantamilioni=$fantamilioni-$soldiAquistoDifensori;
											$msgDifensori="OK";
								}
								else {
										$msgDifensori="over_D";
								}

								if(($nCen[0] - count($vecchioCent) + count($nuoviCent))<4){

										foreach($vecchioCent as $VC) {
											$query="DELETE FROM possiede
										          WHERE Giocatore='$VC' AND SquadraGioc='$nomeSq[0]'";
											$cid->query($query);
										}
											$fantamilioni=$fantamilioni+$soldiVenditaCentrocampisti;

										foreach($nuoviCent as $NC) {
											$query="INSERT INTO possiede (Giocatore,	SquadraGioc)
															VALUES ('$NC','$nomeSq[0]')";
											$cid->query($query);
										}
											$fantamilioni=$fantamilioni-$soldiAquistoCentrocampisti;
											$msgCentrocampisti="OK";
							   }
						  	else{
								  	$msgCentrocampisti="over_C";
						  	}

						  	if(($nAtt[0] - count($vecchioAtt) + count($nuoviAtt))<4){
										foreach($vecchioAtt as $VA) {
											$query="DELETE FROM possiede
										          WHERE Giocatore='$VA' AND SquadraGioc='$nomeSq[0]'";
											$cid->query($query);
										}
  										$fantamilioni=$fantamilioni+$soldiVenditaAttaccanti;


										foreach($nuoviAtt as $NA) {
											$query="INSERT INTO possiede (Giocatore,	SquadraGioc)
															VALUES ('$NA','$nomeSq[0]')";
											$cid->query($query);
										}
											$fantamilioni=$fantamilioni-$soldiAquistoAttaccanti;
											$msgAttaccanti="OK";
								}
								else {
										$msgAttaccanti="over_A";
								}

								$query="UPDATE Squadra SET FantaMilioni='$fantamilioni'
												WHERE nomeSq='$nomeSq[0]'";
								$cid->query($query);

					$cid->close();

					$msgEccesso="OK";
					}

					else {
						$msgEccesso="over_N";
					}
	$msgFineSoldi="OK";
	}

	else {
		$msgFineSoldi="over_B";
	}





header("Location:../main.php?op=fantamercato&mod=$mod&msgP=$msgPortieri&msgD=$msgDifensori&msgC=$msgCentrocampisti&msgA=$msgAttaccanti&msgN=$msgEccesso&msgB=$msgFineSoldi");


 ?>
