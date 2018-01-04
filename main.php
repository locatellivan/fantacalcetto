<?php session_start();?>

<!DOCTYPE html>
<html>

	<?php include_once "comuni/head.html"; ?>

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

				// queste variabili servono a gestire situazioni di errori locali alla pagina
				// per le quali evito una ridirezione, ma semplicemente produco un messaggio che
				// viene visualizzato in fondo alla pagina.
				$_errore = false;
				$_err_msg="";

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
						echo "<h1 class='h1HOME'>Ciao $_SESSION[nick] <br/>
										Puoi accedere alle funzionalità del sito</h1>";
				}
				else
				{
					if (isset($_GET["op"]) && $_GET["op"] == 'registrazione' || isset($_GET["op"]) && $_GET["op"] == 'regolamento')
							include_once "php/". $_GET["op"] . ".php";
					 else
						{
						if (isset($_COOKIE["user"]))
							echo "<h1>Ciao $_COOKIE[user].<br/>
									Per accedere ai servizi è necessario autenticarti</h1>";
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
