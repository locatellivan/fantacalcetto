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
