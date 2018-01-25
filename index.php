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

				//Recupero il valore dello stato della pagina
				if(isset($_GET['status'])) {
					$status=$_GET['status'];
					if($status=="ko") {
						echo "<div class='well well-sm' style='background: rgba(212,71,42,0.4);'>";
						echo "<h4 align='center'>MAIL O PASSWORD ERRATE!</h4></div>";
					}
					else if($status="log") {
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
						echo "<div class='well well-sm' style='background:rgba(66,77,79,0.4);'>
									<h1 class='h1HOME'><i>Benvenuto $_SESSION[nick]!</h1>
									<h1><center>Preparati per le prossime partite!</i><br/><br/><br/>
									<h1><div align='center' class='well well-sm' style='background:rgba(20,202,222,0.4); width:40%;'>
									<b>PROSSIMA GIORNATA:<br/>$gior[0]</b></div></h1></div><br/>";
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
