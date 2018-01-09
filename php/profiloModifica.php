<div class="well">
	<h3 align="center"><b>MODIFICA:</b></h3>
	<form role="form" method="POST" action="php/profiloModifica-exe.php">

		<div class="form-group">
					<label>Mail</label>
					<input class="form-control" type="email" id="mail" name="mail" placeholder="eMail"/>
		</div>
		<div class="form-group">
					<label>Nome</label>
					<input class="form-control" type="text" id="nome" name="nome" placeholder="Nome"/>
		</div>
		<div class="form-group">
					<label>Cognome</label>
					<input class="form-control" type="text" id="cognome" name="cognome" placeholder="Cognome"/>
		</div>
		<div class="form-group">
					<label>Sesso:</label>
					<br/><input type="radio" name="sesso" value="M"><label>Maschio</label>
					<br/><input type="radio" name="sesso" value="F"><label>Femmina</label>
		</div>
		<div class="form-group">
					<label>Data di Nascita</label>
					<input class="form-control" type="date" id="dataNasc" name="dataN" placeholder="Data Nascita">
		</div>
		<div class="form-group">
					<label>Luogo di Nascita</label>
					<input class="form-control" type="text" id="luogoNascita" name="luogoN" placeholder="Città di Nascita">
		</div>
		<div class="form-group">
					<label>Città Attuale</label>
					<input class="form-control" type="text" id="cittaAtt" name="cittaAtt" placeholder="Città Attuale">
		</div>
		<div class="form-group">
					<label>Squadra Tifata</label>
					<input class="form-control" type="text" id="squadraTifata" name="squadraTifata" placeholder="Squadra Tifata">
		</div>

		<input type="submit" class="btn btn-success" onclick="errModificaProfilo()" value="Aggiorna"></input>
		<input type="reset" class="btn btn-warning" value="Annulla"></input>

	</form>

</div>



<!-- Alert per gestione errori -->
<script>
	function errModificaProfilo()  {
		var mail = document.getElementById("mail").value;
		var nome = document.getElementById("nome").value;
		var cognome = document.getElementById("cognome").value;
		var luogoNasc = document.getElementById("luogoNascita").value;
		var cittaAtt = document.getElementById("cittaAtt").value;
		var squadraTifata = document.getElementById("squadraTifata").value;
		if(mail.length>40) {
			 var msgMail = "La mail deve essere di massimo 40 caratteri.\n";
			 	}
				else { var msgMail = "";
		}
		if(nome.length>20) {
			var msgNome="La squadra deve essere di massimo 20 caratteri.\n";
		}
		else {
			var msgNome="";
		}
		if(cognome.length>20){
			 var msgCognome="Il cognome deve essere di massimo 20 caratteri.\n";
			 	}
				else { var msgCognome="";
		}
		if(luogoNasc.length>20) {
			 var msgLuogoNasc = "La città di nascita deve essere di massimo 20 caratteri.\n";
			 	}
				else { var msgLuogoNasc="";
		}
		if(cittaAtt.length>20) {
			 var msgCittaAtt="La città attuale deve essere di massimo 20 caratteri.\n";
			 	}
				else { var msgCittaAtt="";
		}
		if(squadraTifata.length>15) {
			 var msgSquadraTifata="La squadra tifata deve essere di massimo 15 caratteri.\n";
			 	}
				else { var msgSquadraTifata="";
		}
		if ((nome.length>20) || (cognome.length>20) || (luogoNasc.length>20)  || (cittaAtt.length>20) || (squadraTifata.length>15)) {
			alert(msgMail+msgNome+msgCognome+msgLuogoNasc+msgCittaAtt+msgSquadraTifata);
		} else {
			alert("Modifica effettuata con successo.");
		}
	}

	</script>
