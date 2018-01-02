<?php
include_once("connessione.php");

$mail= $_POST["mail"];
$psw = $_POST["password"];

/*Iniziare la sessione dell'utente loggato*/

$sql="SELECT Mail, Password FROM Utente WHERE Mail='$mail'";



$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
														 ."<p>Codice di errore ".$cid->errno
														 .":".$cid->error."</p>");

$row=$utente->fetch_row();

/* Gestione dei cookies */

if ($mail==$row[0] && $psw==$row[1])
{
  if (isset($_POST["ricordami"])){
		setcookie ("mail",$mail,time()+43200,"/");
  }
	elseif (isset($_COOKIE["mail"])) {
		unset($_COOKIE['mail']);
		setcookie('mail', null, -1, '/');
	}

  $query="SELECT Nickname FROM Utente WHERE Mail='".$mail."'";
  $type=$cid->query($query) or die("<p>Impossibile eseguire query.</p>"
  														 ."<p>Codice di errore ".$cid->errno
  														 .":".$cid->error."</p>");
  $user=$type->fetch_row();
	session_start();
  $_SESSION['nick']=$user[0];
  $cid->close();

  header("Location:../main.php");
}
else
{
  header("Location:../main.php?op=none&status=ko&msg=" . urlencode("Autenticazione fallita."));
}



?>
