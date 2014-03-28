<?php
  session_start();

  unset($_SESSION["yllapitaja"]);
  unset($_SESSION["asiakas"]);

  header('Location: index.php');
?>