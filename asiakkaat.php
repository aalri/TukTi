<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
$lista = Asiakas::getAsiakkaat();
naytaNakyma("asiakkaat.php", array('lista' => $lista));
?>