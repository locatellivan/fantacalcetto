<script>

  // Gestione alert in registrazione
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
		else {
      var msgPswConf = "";
		}
		if((mail.length==0)|| (nick.length==0) || (nomeSq.length==0) || (psw1.length==0) || (psw2.length==0)){
			var msgVuoto = "i campi non possono essere vuoti.\n";
		}
		else {
      var msgVuoto = "";
	  }

	 if((mail.length>40) || (nick.length>30) || (nomeSq.length>20) || (psw1.length>30) || (psw1.val!=psw2.val)||
			(mail.length==0)|| (nick.length==0) || (nomeSq.length==0) || (psw1.length==0) || (psw2.length==0)) {
			alert(msgVuoto+msgMail+msgNick+msgNomeSq+msgPsw+msgPswConf);
	 }
	 else {
			alert("Registrazione avvenuta con successo.\nLoggati per accedere ai servizi");
		}

	}

  // Gestione alert in modifica squadra
	function errModificaSquadra()  {
		var motto = document.getElementById("motto").value;

    if(motto.length>30) {
       var msgMotto = "Il motto deve essere di massimo 30 caratteri.\n";
    }
    else {
       var msgMotto = "";
    }
    if(motto.length==0) {
      var msgMottoVuoto = "Il motto non può essere vuoto.\n";
    }
    else {
      var msgMottoVuoto = "";
    }
    if(motto.length>30 || motto.length==0)  {
      alert(msgMotto+msgMottoVuoto);
    }
    else {
      alert("Modifica avvenuta con successo.\n");
    }

  }

  // Gestione alert in modifica profilo
	function errModificaProfilo()  {
		var mail = document.getElementById("mail").value;
		var nome = document.getElementById("nome").value;
		var cognome = document.getElementById("cognome").value;
    var dataNasc = document.getElementById("dataNasc").value;
		var luogoNasc = document.getElementById("luogoNascita").value;
		var cittaAtt = document.getElementById("cittaAtt").value;
		var squadraTifata = document.getElementById("squadraTifata").value;

    // Gestione date: in Javascript i mesi partono da 0!
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
    if(mail.length==0 && nome.length==0 && cognome.length==0 && luogoNasc.length==0 && cittaAtt.length==0 && squadraTifata.length==0) {
      var msgVuoto ="Tutti i campi di testo sono vuoti, se presenti sono state salvate le modifiche al sesso e alla data di nascita.\n"
    }
    else {
      var msgVuoto = "";
    }
		if ((mail.length>40 || nome.length>20) || (cognome.length>20) || (luogoNasc.length>20)  || (cittaAtt.length>20) || (squadraTifata.length>15) || (diff<0)
         || (mail.length==0 && nome.length==0 && cognome.length==0 && luogoNasc.length==0 && cittaAtt.length==0 && squadraTifata.length==0)) {
			alert(msgMail+msgNome+msgCognome+msgDataNasc+msgLuogoNasc+msgCittaAtt+msgSquadraTifata+msgVuoto);
		} else {
			alert("Modifica effettuata con successo.");
		}
	}

  // Gestione alert per il crea formazione
  function errCreaFormazione()  {
		var nomeForm = document.getElementById("nomeForm").value;
		var por1 = document.getElementById("por1").value;
		var por2 = document.getElementById("por2").value;
		var dif1 = document.getElementById("dif1").value;
		var dif2 = document.getElementById("dif2").value;
		var dif3 = document.getElementById("dif3").value;
		var cen1 = document.getElementById("cen1").value;
		var cen2 = document.getElementById("cen2").value;
		var cen3 = document.getElementById("cen3").value;
		var att1 = document.getElementById("att1").value;
		var att2 = document.getElementById("att2").value;
		var att3 = document.getElementById("att3").value;

    if(nomeForm.length>20) {
			 var msgNomeForm = "Il nome della formazione deve essere di massimo 20 caratteri.\n";
			 	}
				else { var msgNomeForm = "";
		}
		if(nomeForm.length==0) {
			 var msgFormVuota = "E' necessario inserire un nome per la formazione.\n";
			 	}
				else { var msgFormVuota = "";
		}
		if(por1==por2) {
			 var msgPor = "I portieri devono essere diversi.\n";
			 	}
				else { var msgPor = "";
		}
		if(dif1==dif2 || dif2==dif3 || dif1==dif3) {
			 var msgDif = "I difensori devono essere diversi.\n";
			 	}
				else { var msgDif = "";
		}
		if(cen1==cen2 || cen2==cen3 || cen1==cen3) {
			 var msgCen = "I centrocampisti devono essere diversi.\n";
			 	}
				else { var msgCen = "";
		}
		if(att1==att2 || att2==att3 || att1==att3) {
			 var msgAtt = "Gli attaccanti devono essere diversi.\n";
			 	}
				else { var msgAtt = "";
		}
		if((nomeForm.length>20) || nomeForm.length==0 || por1==por2 || dif1==dif2 || dif2==dif3 || dif1==dif3
				|| cen1==cen2 || cen2==cen3 || cen1==cen3 || att1==att2 || att2==att3 || att1==att3) {
 			alert(msgFormVuota+msgNomeForm+msgPor+msgDif+msgCen+msgAtt);
 	 }
 	 else {
 			alert("La formazione è stata registrata con successo.");
 	 }
	}


  // Gestione alert per il crea campionato
  function errCreaCampionato() {

    var nomeCamp = document.getElementById("nomeCamp").value;
		var dataInizio = document.getElementById("dataInizio").value;
		var dataFine = document.getElementById("dataFine").value;

    // Gestione date: in Javascript i mesi partono da 0!
    var today = new Date();
    var giornoInizio = dataInizio.slice(8);
    var meseInErr = dataInizio.substring(5,7);
    var meseInizio = meseInErr - 1;
    var annoInizio = dataInizio.substring(0 ,4);
    var newDataInizio = new Date(annoInizio, meseInizio, giornoInizio);
    var giornoFine = dataFine.slice(8);
    var meseFiErr = dataFine.substring(5,7);
    var meseFine = meseFiErr - 1;
    var annoFine = dataFine.substring(0 ,4);
    var newDataFine = new Date(annoFine, meseFine, giornoFine);
    var diff = newDataFine.getTime() - newDataInizio.getTime();
    var diffAnni = annoFine-annoInizio;
    var diffInizio = newDataInizio.getTime() - today.getTime();
    // Booleana per capire se la data inserita è quella odierna
    if(today.getDate()==newDataInizio.getDate() && today.getMonth()==newDataInizio.getMonth()
       && today.getFullYear()==newDataInizio.getFullYear()) {
      var dataOggi=true;
    }
    else {
      var dataOggi=false;
    }

    if(nomeCamp.length==0) {
			 var msgCampVuoto = "E' necessario inserire un nome per il campionato.\n";
		}
		else { var msgCampVuoto = "";
		}
    if(nomeCamp.length>20) {
			 var msgCamp = "Il nome del campionato può essere lungo massimo 20 caratteri.\n";
		}
		else {
      var msgCamp = "";
		}
    if(diff<=0) {
      var msgDate = "La data di fine campionato deve essere maggiore della data di inizio.\n";
    }
    else {
      var msgDate = "";
    }
    if(diffAnni>1) {
      var msgAnni = "Un campionato può svolgersi massimo in un certo anno e nel successivo (ex: 01/01/2018 - 31/12/2019).\n";
    }
    else {
      var msgAnni = "";
    }
    if(diffInizio<0 && !(dataOggi)) {
      var msgDataInizio = "La data di inizio non può essere minore della data corrente.\n";
    }
    else {
      var msgDataInizio = "";
    }
    if(nomeCamp.length==0 || nomeCamp.length>20 || diff<=0 || diffAnni>1 || (diffInizio<0 && !(dataOggi))) {
      alert(msgCampVuoto+msgCamp+msgDataInizio+msgAnni+msgDate);
    }
    else {
      alert("Campionato registrato con successo.");
    }
  }

    // Funzioni AJAX per la gestione del fatamercato
    function controlloCheck() {
      if(document.getElementById('spunta').checked==true) {
        funzione();
      } else {
          funzione2();
        }

    }

    function ajaxRequest() {
      var request=false;
      try{ request = new XMLHttpRequest()}catch(e1){
      try{ request = new ActiveXObject("Msxml2.XMLHTTP")}catch(e2){
          try{ request = new ActiveXObject("Microsoft.XMLHTTP")
          }catch(e3){request = false}
        }
      }
      return request;
    }

    function funzione() {
      var xhttp=new ajaxRequest();
      xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
          document.getElementById("soldi").innerHTML=this.responseText;
        }
      }
      xhttp.open("GET","php/provaAjax.php", true);
      xhttp.send();
    }


</script>
