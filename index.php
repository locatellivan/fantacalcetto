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

		<?php include_once "comuni/navigation.php"; ?>

		<div class="container">
			<div>
				<?php

				include_once("php/connessione.php");
				// Seleziono il numero dela prossima giornata
				$sql="SELECT NumGior FROM giornata WHERE Stato='NGA'";
				$giornata=$cid->query($sql);
				$gior=$giornata->fetch_row();
				// queste variabili servono a gestire situazioni di errori locali alla pagina
				// per le quali evito una ridirezione, ma semplicemente produco un messaggio che
				// viene visualizzato in fondo alla pagina.
				$_errore = false;
				$_err_msg="";

				//Recupero il valore dello stato della pagina
				if(isset($_GET['status'])) {
					$status=$_GET['status'];
					if($status=="ko") {
						echo "<div class='well well-sm' style='background: rgba(212,71,42,0.4);'>";
						echo "<h4 align='center'>MAIL O PASSWORD ERRATE!</h4></div>";
					}
					else if($status="ok") {
						echo "<div class='well well-sm' style='background: rgba(37,217,43,0.4);'>";
						echo "<h4 align='center'>LOGIN EFFETTUATO!</h4></div>";
					}
				}

				if (isset($_SESSION["nick"]))
				{
						if (isset($_GET["op"]))
					{
						if ($_GET["op"] != 'none')
						{
						 include_once "php/". $_GET["op"] . ".php";
						}
					}
					else
						echo "<br/><div class='well'><h1 class='h1HOME'>Benvenuto $_SESSION[nick]!</h1>
										<h1><center>Puoi accedere alle funzionalità del sito.<br/><br/></div>
										<div class='well' style='color:white; background:rgba(79,115,106,0.74);'>
										<h1 align='center'>Prossima giornata:&nbsp;&nbsp;$gior[0]</center></h1></div>";
				}
				else
				{
					if (isset($_GET["op"]) && $_GET["op"] == 'registrazione' || isset($_GET["op"]) && $_GET["op"] == 'regolamento')
							include_once "php/". $_GET["op"] . ".php";
					 else
						{
						if (isset($_COOKIE["user"]))
							echo "<div class='well'><h1>Ciao $_COOKIE[user].<br/>
									Per accedere ai servizi è necessario autenticarti</h1></div>";
						else
						{
								echo "<h1 class='h1HOME'>Crea la tua squadra,<br/>
								      sfida i tuoi amici,<br/>
											<b>DIVENTA CAMPIONE!</b><br/><br/><br/></h1>
											<h3 class='h3HOME'>Per accedere ai servizi è necessario autenticarsi</h3>";
						}
					}
				}

				?>
			</div>
		</div>

		<?php include_once "comuni/footer.html"; ?>

	</body>
</html>
