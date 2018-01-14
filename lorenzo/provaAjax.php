<?php
  //questo file recupera le info dal db da visualizzare

  $hostname = 'localhost';
  $username= 'root';
  $password='';
  $database ='fantacalcettostatale';
  $con = new mysqli($hostname, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  $sql="SELECT Fantamilioni FROM utenti WHERE Nickname='lorenzoncina'";
  $result= $con->query($sql);
  $row= $result->fetch_assoc();
  $fantamilioni= $row['Fantamilioni'];
  echo $fantamilioni;

 ?>
