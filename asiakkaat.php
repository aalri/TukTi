<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
$rivimaara = 5;
$lkm = Asiakas::AsiakkaidenLukumaara();
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
$lista = Asiakas::getAsiakkaatTiettyMaaraKohdasta($rivimaara, $rivimaara * ($sivu - 1));
naytaNakyma("asiakkaat.php", array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));
?>