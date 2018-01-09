<div class="well">
	<form role="form" method="POST" action="php/registrazione-exe.php">
		<div class="form-group">
		      <label>Email</label>
		      <input class="form-control" type="email" id="mail" name="email" placeholder="Email"/>
		</div>
		<div class="form-group">
		      <label>Nickname (non potrà essere modificato)</label>
		      <input class="form-control" type="text" id="nick" name="nickname" placeholder="Nickname"/>
		</div>
		<div class="form-group">
		      <label>Nome della Squadra (non potrà essere modificato)</label>
		      <input class="form-control" type="text" id="squadra" name="nomeSq" placeholder="Nome Squadra"/>
		</div>
		<div class="form-group">
		      <label>Password</label>
		      <input class="form-control" type="password" id="psw1" name="psw1" placeholder="Password">
		</div>
		<div class="form-group">
		      <label>Ripeti Password</label>
		      <input class="form-control" type="password" id="psw2" name="psw2" placeholder="Conferma Password">
		</div>

		<input type="submit" class="btn btn-success" onclick="errRegistrazione()"  value="Registra"></input>
		<input type="reset" class="btn btn-warning"  value="Annulla"></input>

	</form>
</div>


<!-- Alert per gestione errori -->
<script>
	function errRegistrazione()  {
		var nick = document.getElementById("nick").value;
		var nomeSq = document.getElementById("squadra").value;
		var mail = document.getElementById("mail").value;
		var psw1 = document.getElementById("psw1").value;
		var psw2 = document.getElementById("psw2").value;
		if(nick.length>30){
			 var msgNick = "Il Nickname deve essere di massimo 30 caratteri.\n";
			 	}
				else { var msgNick = "";
		}
		if(nomeSq.length>20) {
			var msgNomeSq="La squadra deve essere di massimo 20 caratteri.\n";
		}
		else {
			var msgNomeSq="";
		}
		if(mail.length>40){
			 var msgMail = "La mail deve essere di massimo 40 caratteri.\n";
			 	}
				else { var msgMail = "";
		}
		if(psw1.length>30){
			 var msgPsw = "La password deve essere di massimo 30 caratteri.\n";
			 	}
				else { var msgPsw = "";
		}
		if(psw1!=psw2) {
			 var msgPswConf = "Le password devono coincidere.\n";
			 	}
				else { var msgPswConf = "";
		}
		if((mail.length==0)|| (nick.length==0) || (nomeSq.length==0) || (psw1.length==0) || (psw2.length==0)){
			var msgVuoto = "i campi non possono essere vuoti.\n";
			 }
			 else { var msgVuoto = "";
	 }

					if((mail.length>40) || (nick.length>30) || (nomeSq.length>20) || (psw1.length>30) || (psw1.val!=psw2.val)||
				(mail.length==0)|| (nick.length==0) || (nomeSq.length==0) || (psw1.length==0) || (psw2.length==0)) {
						alert(msgVuoto+msgMail+msgNick+msgNomeSq+msgPsw+msgPswConf);
					}
					else {
							alert("Registrazione avvenuta con successo.\nLoggati per accedere ai servizi");
					}

	}
</script>
