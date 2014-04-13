<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';
$rivimaara = 5;
$lkm = Lasku::laskujenLukumaara();
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
$lista = Lasku::getLaskutTiettyMaaraKohdasta($rivimaara, $rivimaara * ($sivu - 1));
$yhteensa = array();
$asiakasnrot = array();
foreach ($lista as $lasku){
    $yhteensa[] = Tilausrivi::getTilausrivitHintaYhteensaTilausnumerolla($lasku->getTilausnro());
}
foreach ($lista as $lasku){
    $asiakasnrot[] = Tilaus::getTilausnumeronAsiakas($lasku->getTilausnro());
}
naytaNakyma("kaikkilaskut.php", array('lista' => $lista, 'yhteensa' => $yhteensa, 'asiakasnrot' => $asiakasnrot, 'sivu' => $sivu, 'sivuja' => $sivuja));
?>