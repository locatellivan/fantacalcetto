<nav class="navbar navbar-inverse navbar-static-top">
	 <div class="container">

		 <div class="navbar-header">
 		 	 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				 <span class="sr-only">Toggle navigation</span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
			 </button>
			 <a href="index.php">
			 	<img src="img/Home.PNG" style="width:50px; padding:8px; height:50px;"/>
			 </a>
		 </div>

		 <div id="navbar" class="navbar-collapse collapse">
			 <ul class="nav navbar-nav">
				 <li class="active"><a href="index.php">HOME</a></li>
				 <li class="active"><a href="index.php?op=regolamento">REGOLAMENTO</a></li>
				 <?php if (isset($_SESSION["nick"])) { ?>
					 <li class="active"><a href="index.php?op=amministrazione">AMMINISTRAZIONE</a></li>
					 <li class="dropdown">
						 <a href="#" class="dropdown-toggle" data-toggle="dropdown"
			          role="button" aria-haspopup="true" aria-expanded="false"
								>Account<span class="caret"></span></a>
						 <ul class="dropdown-menu">
							 <li><a href="index.php?op=profiloInfo">Dati Profilo</a></li>
							 <li><a href="index.php?op=profiloModifica">Modifica Dati</a></li>
							 <li role="separator" class="divider"></li>
							 <li><a href="index.php?op=eliminaProfilo">Elimina Account</a></li>
						 </ul>
					 </li>

				 <li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown"
		          role="button" aria-haspopup="true" aria-expanded="false"
							>Squadra<span class="caret"></span></a>
					 <ul class="dropdown-menu">
						 <li><a href="index.php?op=SquadraInfo">Dati Squadra</a></li>
						 <li><a href="index.php?op=SquadraModifica">Modifica Motto</a></li>
						 <li role="separator" class="divider"></li>
						 <li><a href="index.php?op=fantamercato">Fantamercato</a></li>
					 </ul>
				 </li>

				 <li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown"
						 role="button" aria-haspopup="true" aria-expanded="false"
						 >Campionati<span class="caret"></span></a>
					 <ul class="dropdown-menu">
						<li><a href="index.php?op=listaCampionati">Lista</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="index.php?op=classificaCampionati">Classifiche Generali</a></li>
						<li><a href="index.php?op=classificaGiornata">Classifica della Giornata</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="index.php?op=classificheXML">Esporta Classifiche</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="index.php?op=creaCampionato">Crea Campionato</a></li>
						<li><a href="index.php?op=eliminaCampionato">Elimina Campionato</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="index.php?op=storicoCampioni">Storico Campioni</a></li>
						<li><a href="index.php?op=campionatiFantasma">Campionati Fantasma</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"
						role="button" aria-haspopup="true" aria-expanded="false"
						>Formazioni<span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="index.php?op=creaFormazione">Crea Formazione</a></li>
					<li><a href="index.php?op=consegnaFormazione">Consegna Formazione</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="index.php?op=formazioniIscritte">Formazioni Iscritte</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="index.php?op=eliminaFormazione">Elimina Formazione</a></li>
				</ul>
			</li>



	 <?php } // end if?>
			 </ul>

			 <ul class="nav navbar-nav navbar-right">
		 <?php if (isset($_SESSION["nick"])) { ?>
				 <li><a href="php/logout-exe.php"><span class="glyphicon glyphicon-log-out"></span> Logout

		 <?php } else {?>
	 <li><a href="index.php?op=registrazione"><span class="glyphicon glyphicon-user"></span> Registrati </a></li>
	 <li><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-in"></span> Login
	 <?php }?>

	 </a></li>
			 </ul>
		 </div><!--/.nav-collapse -->
	 </div>
 </nav>

 <!-- Di seguito viene introdotta una modal per effettuare il login. La modal � un box di dialogo modale. Cio� permette di aprire una pagina, sulla pagina corrente, con la quale instaurare una
comunicazione con l'utente (come in questo caso che si richiede di inserire login e password).
Maggiori informazioni a http://www.html.it/guide/img/bootstrap/ref/modal.html -->

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog"  aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
		 <div class="loginmodal-container">
			 <h1><b>Accedi al tuo account</b></h1><br>
			 <form method="POST" action="php/login-exe.php">
			 <input type="text" name="mail" placeholder="e-Mail"  value="<?php if (isset($_COOKIE["user"])) echo $_COOKIE["user"]; ?>">
			 <input type="password" name="password" placeholder="Password">
			 <b>Ricordami</b>:  <input type="checkbox" name="ricordami" <?php if (isset($_COOKIE["user"])) echo "checked"; ?>>
			 <br/><input type="submit" onclick="pippo()" name="login" class="login loginmodal-submit" value="Login">
			 </form>

			 <div class="login-help">
			 <a href="index.php?op=registrazione">Non hai ancora un account? Registrati</a>
			 </div>
		 </div>
	 </div>
	 </div>
