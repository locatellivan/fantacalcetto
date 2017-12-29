<?php
include_once("connessione.php");

$login= $_POST["user"];
$pwd = $_POST["pass"];

/*Inserire utenze dal database*/

$sql="SELECT nickname,password FROM Utenti WHERE nickname='".$login."'";

$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
														 ."<p>codice di errore ".$cid->errno
														 .":".$cid->error."</p>");
$row=$utente->fetch_row();


if ($login==$row[0] && $pwd==$row[1])
{
  if (isset($_POST["ricordami"])){
		setcookie ("user",$login,time()+43200,"/");
  }
	elseif (isset($_COOKIE["user"])) {
		unset($_COOKIE['user']);
		setcookie('user', null, -1, '/');
	}

  $query="SELECT ruoloU FROM Utenti WHERE nickname='".$login."'";
  $ruolo=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
  														 ."<p>codice di errore ".$cid->errno
  														 .":".$cid->error."</p>");
  $r=$ruolo->fetch_row();
	session_start();
  $_SESSION[''.$r[0].'']=$login;
  $cid->close();

  header("Location:../home.php?op=dashboard");
}
else
{
  header("Location:../home.php?op=none&status=ko&msg=" . urlencode("autenticazione fallita"));
}



?>
