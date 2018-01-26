<?php

  // Distruggo la sessione se l'utente si slogga
  session_start();
  session_destroy();
  header("Location:../index.php");

 ?>
