<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';
$asiakas = Asiakastiedot();
$rivimaara = 5;
$lkm = Tilaus::asiakkaanTilaustenLukumaara($asiakas->getAsiakasnro());
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
$lista = Tilaus::getTilauksetAsiakasnumerollaTiettyMaaraKohdasta($asiakas->getAsiakasnro(), $rivimaara, $rivimaara*($sivu-1));
naytaNakyma("tilaukset.php", array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));
?>