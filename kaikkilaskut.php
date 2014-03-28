<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';
$lista = Lasku::getLaskut();
$yhteensa = array();
$asiakasnrot = array();
foreach ($lista as $lasku){
    $yhteensa[] = Tilausrivi::getTilausrivitHintaYhteensaTilausnumerolla($lasku->getTilausnro());
}
foreach ($lista as $lasku){
    $asiakasnrot[] = Tilaus::getTilausnumeronAsiakas($lasku->getTilausnro());
}
naytaNakyma("kaikkilaskut.php", array('lista' => $lista, 'yhteensa' => $yhteensa, 'asiakasnrot' => $asiakasnrot));
?>