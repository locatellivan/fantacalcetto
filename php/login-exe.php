<?php
include_once("connessione.php");

$mail= $_POST["mail"];
$psw = $_POST["password"];

/*Inserire utenze dal database*/

$sql="SELECT Mail, Password FROM Utente WHERE Mail='$mail'";



$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
														 ."<p>Codice di errore ".$cid->errno
														 .":".$cid->error."</p>");

$row=$utente->fetch_row();

if ( $psw==$row[1] && $mail==$row[0])
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
  $_SESSION['mail']=$user[0];
  $cid->close();

  header("Location:../main.php");
}
else
{
  header("Location:../main.php?op=none&status=ko&msg=" . urlencode("Autenticazione fallita."));
}



?>
