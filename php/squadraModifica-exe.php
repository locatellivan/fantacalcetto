<?php

session_start();
include_once("connessione.php");

$nick=$_SESSION['nick'];
$motto=$_POST['motto'];

if(!empty($motto)) {
	$query="UPDATE squadra JOIN utente ON Utente=Mail SET Motto='$motto' WHERE Nickname='$nick'";
	$cid->query($query);
}

header("Location:../main.php?op=squadraInfo");

?>
