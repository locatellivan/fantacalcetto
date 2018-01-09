<div class="well">
	<h3 align="center"><b>MODIFICA MOTTO:</b></h3>
	<form role="form" method="POST" action="php/squadraModifica-exe.php">

		<div class="form-group">
					<label>Motto della Squadra (max. 30 caratteri)</label>
					<input class="form-control" type="text" id='motto' name="motto" placeholder="inserisci un motto"/>
		</div>

		<input type="submit" class="btn btn-success" onclick="errModificaSquadra()" value="Aggiorna Motto"></input>
		<input type="reset" class="btn btn-warning" value="Annulla"></input>


	</form>

</div>
