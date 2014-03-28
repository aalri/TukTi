<link href=" css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<?php
require_once 'libs/models/nykyinentilaus.php';
require_once 'libs/models/asiakas.php';
require_once 'libs/common.php';
$ikkuna = (String)$_GET['ikkuna'];
require 'views/pohja.php';
exit();
?>


