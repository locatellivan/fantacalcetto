<?php
include_once("connessione.php");
$nickname=$_POST['nickname'];
$psw=$_POST['psw'];
$email=$_POST['email'];

$sql="INSERT INTO Utenti(nickname,email,password) VALUES ('$nickname','$email','$psw')";

$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
														 ."<p>codice di errore ".$cid->errno
														 .":".$cid->error."</p>");

$cid->close();

header("Location:../home.php?status=ok");






 ?>
