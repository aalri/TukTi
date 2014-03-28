<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';
$asiakas = Asiakastiedot();
$lista = Tilaus::getTilauksetAsiakasnumerolla($asiakas->getAsiakasnro());
naytaNakyma("tilaukset.php", array('lista' => $lista));
?>