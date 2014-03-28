<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tilaus.php';
$lista = Tilaus::getTilaukset();
naytaNakyma("kaikkitilaukset.php", array('lista' => $lista));
?>