<div class="well">
	<form role="form" method="POST" action="php/registrazione-exe.php">
		<div class="form-group">
		      <label>Email</label>
		      <input class="form-control" type="email" name="email" placeholder="Email"/>
		</div>
		<div class="form-group">
		      <label>Nickname (non potrà essere modificato)</label>
		      <input class="form-control" type="text" name="nickname" placeholder="Nickname"/>
		</div>
		<div class="form-group">
		      <label>Nome della Squadra (non potrà essere modificato)</label>
		      <input class="form-control" type="text" name="nomeSq" placeholder="Nome Squadra"/>
		</div>
		<div class="form-group">
		      <label>Password</label>
		      <input class="form-control" type="password" name="psw1" placeholder="Password">
		</div>
		<div class="form-group">
		      <label>Ripeti Password</label>
		      <input class="form-control" type="password" name="psw2" placeholder="Conferma Password">
		</div>

		<input type="submit" class="btn btn-success" value="Registra"></input>
		<input type="reset" class="btn btn-warning" value="Annulla"></input>

	</form>
</div>
