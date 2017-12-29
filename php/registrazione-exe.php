<html>
<?php
include_once("connessione.php");
include_once("alert.html");
$nickname=$_POST['nickname'];
$psw1=$_POST['psw1'];
$psw2=$_POST['psw2'];
$email=$_POST['email'];
if($psw1==$psw2){

$sql="INSERT INTO utente(Nickname,Mail,Password) VALUES ('$nickname','$email','$psw1')";

$utente=$cid->query($sql) or die("<p>Impossibile eseguire query.</p>"
														 ."<p>codice di errore ".$cid->errno
														 .":".$cid->error."</p>");

$cid->close();
}
else {
	echo "Le password non coincidono";
}

header("Location:../main.php?status=ok");






 ?>
</html>
