<script>
//gestione alert in registrazione
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


//Gestione alert in modifica squadra


	function errModificaSquadra()  {
		var motto = document.getElementById("motto").value;

  if(motto.length>30){
     var msgMotto = "Il motto deve essere di massimo 30 caratteri.\n";
      }
      else {
        var msgMotto = "";
  }
  if(motto.length>30)  {
    alert(msgMotto);
  }
  else {
    alert("Modifica avvenuta con successo.\n");
  }

}


// Alert per gestione errori del modifica squadra


	function errModificaProfilo()  {
		var mail = document.getElementById("mail").value;
		var nome = document.getElementById("nome").value;
		var cognome = document.getElementById("cognome").value;
    var dataNasc = document.getElementById("dataNasc").value;
		var luogoNasc = document.getElementById("luogoNascita").value;
		var cittaAtt = document.getElementById("cittaAtt").value;
		var squadraTifata = document.getElementById("squadraTifata").value;

    var today = new Date();
    var giorno = dataNasc.slice(8);
    var mese = dataNasc.substring(5,7);
    var anno = dataNasc.substring(0 ,4);
    var newDataNasc = new Date(anno, mese,giorno);
    var diff = today.getTime() - newDataNasc.getTime();


		if(mail.length>40) {
			 var msgMail = "La mail deve essere di massimo 40 caratteri.\n";
			 	}
				else { var msgMail = "";
		}
		if(nome.length>20) {
			var msgNome="Il nome deve essere di massimo 20 caratteri.\n";
		}
		else {
			var msgNome="";
		}
		if(cognome.length>20){
			 var msgCognome="Il cognome deve essere di massimo 20 caratteri.\n";
			 	}
				else { var msgCognome="";
		}
		if(diff<0) {
			 var msgDataNasc = "La data di nascita deve essere valida (almeno un mese prima)\n";
			 	}
				else { var msgDataNasc="";
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
		if ((nome.length>20) || (cognome.length>20) || (luogoNasc.length>20)  || (cittaAtt.length>20) || (squadraTifata.length>15) || (diff<0)) {
			alert(msgMail+msgNome+msgCognome+msgDataNasc+msgLuogoNasc+msgCittaAtt+msgSquadraTifata);
		} else {
			alert("Modifica effettuata con successo.");
		}
	}

	</script>
