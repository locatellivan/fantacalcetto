<div class="well">

	<h1 align="center"><b>FANTAMERCATO</b></h1><br/>

	<p id="testo">SOLDI CORRENTI</p>
	<p><input name=check id="spunta" type="checkbox" onclick="controlloCheck()"></p>

</div>

	<script>

	function controlloCheck(){
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
	return request
	}
		function funzione(){
			var xhttp=new ajaxRequest();
			xhttp.onreadystatechange=function(){
				if(this.readyState==4 && this.status==200){
					document.getElementById("testo").innerHTML=this.responseText;
				}
			}
			xhttp.open("GET","provaAjax.php", true);
			xhttp.send();
		}

		function funzione2(){
			var xhttp=new ajaxRequest();
			xhttp.onreadystatechange=function(){
				if(this.readyState==4 && this.status==200){
					document.getElementById("testo").innerHTML=this.responseText;
				}
			}
			xhttp.open("GET","provaAjax2.php", true);
			xhttp.send();
		}

		</script>
