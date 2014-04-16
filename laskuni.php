<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/tilausrivi.php';
$asiakas = Asiakastiedot();
$rivimaara = 5;
$lkm = Lasku::asiakkaanLaskujenLukumaara($asiakas->getAsiakasnro());
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
$lista = Lasku::getLaskutAsiakasnumerollaTiettyMaaraKohdasta($asiakas->getAsiakasnro(), $rivimaara, $rivimaara*($sivu-1));
$yhteensa = array();
foreach ($lista as $lasku){
    $yhteensa[] = Tilausrivi::getTilausrivitHintaYhteensaTilausnumerolla($lasku->getTilausnro());
}
naytaNakyma("laskuni.php", array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja, 'yhteensa' => $yhteensa));
?>