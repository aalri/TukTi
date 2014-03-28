<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
$lista = Tuoteryhma::getTuoteryhmat();
naytaNakyma("tuoteryhmatjatuotteet.php", array('lista' => $lista));
?>