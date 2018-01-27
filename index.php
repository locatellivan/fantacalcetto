<!-- Faccio partire la sessione per capire quale homepage mostrare -->
<?php session_start();?>

<!DOCTYPE html>
<html>

	<?php include_once "comuni/head.html";
				include_once "php/funzioni.php"
	 ?>

	<body>

		<div class="header">
			<a href="http://www.unimi.it/">
				<img class="logoUnimi" src="img/UnimiLogo.png" alt="Logo Unimi"/>
			</a>
		</div>
		<!-- Includo la barra di navigazione BOOTSTRAP -->
		<?php include_once "comuni/navigation.php"; ?>

		<div class="container">
			<div>
				<?php
				// Mi connetto al db per estrarre informazioni
				include_once("php/connessione.php");
				// Seleziono il numero dela prossima giornata
				$sql="SELECT NumGior FROM giornata WHERE Stato='NGA'";
				$giornata=$cid->query($sql);
				$gior=$giornata->fetch_row();

				/* Recupero il valore dello stato della pagina per capire se l'utente si è appena loggato
				o ha inserito i dati sbagliati nel LOGIN */
				if(isset($_GET['status'])) {
					$status=$_GET['status'];
					// Se l'utente ha commesso errori nel loggarsi
					if($status=="ko") {
						echo "<div class='well well-sm' style='background: rgba(212,71,42,0.4);'>";
						echo "<h4 align='center'>MAIL O PASSWORD ERRATE!</h4></div>";
					}
					// Se l'utente effettua correttamente il login
					else if($status="log") {
						echo "<center><div aling='center' class='well well-sm' style='width:30%; background: rgba(37,217,43,0.4);'>";
						echo "<h4 align='center'>LOGIN EFFETTUATO!</h4></div></center>";
					}
				}

				// Se l'utente + loggato potrà accedere alle varie pagine
				if (isset($_SESSION["nick"])) {
						if (isset($_GET["op"])) {
							if ($_GET["op"] != 'none') {
						 		include_once "php/". $_GET["op"] . ".php";
							}
						}
						// Altrimenti siamo nella homepage
						else {
							echo "<center><div class='well well-sm' style='background:rgba(224,224,224,0.6); width:85%;'>
										<h1 class='h1HOME'><i>Ciao $_SESSION[nick]!</h1>
										<h1><center>Preparati per le prossime partite!</i><br/><br/><br/>
										<h1><div align='center' class='well well-sm' style='background:rgba(20,202,222,0.4); width:45%;'>
										<b>PROSSIMA GIORNATA:<br/>$gior[0]</b></div></h1></div></center><br/>";
						}
				}
				// Dalla home se non si è loggati è possibile solo aprire il regolamento o la pagina di registrazione
				else {
					if (isset($_GET["op"]) && $_GET["op"] == 'registrazione' || isset($_GET["op"]) && $_GET["op"] == 'regolamento') {
							include_once "php/". $_GET["op"] . ".php";
					}
					else {
						// Altrimenti sei nella homepage del sito appena lo apri
								echo "<h1 class='h1HOME'>Crea la tua squadra,<br/>
								      sfida i tuoi amici,<br/>
											<b>DIVENTA CAMPIONE!</b><br/><br/><br/></h1>
											<h3 class='h3HOME'>Per accedere ai servizi è necessario autenticarsi</h3>";
					}
				}

				?>
			</div>
		</div>

		<?php include_once "comuni/footer.html"; ?>

	</body>
</html>
