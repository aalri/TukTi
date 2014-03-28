<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/tilausrivi.php';
$asiakas = Asiakastiedot();
$lista = Lasku::getLaskutAsiakasnumerolla($asiakas->getAsiakasnro());
$yhteensa = array();
foreach ($lista as $lasku){
    $yhteensa[] = Tilausrivi::getTilausrivitHintaYhteensaTilausnumerolla($lasku->getTilausnro());
}
naytaNakyma("laskuni.php", array('lista' => $lista, 'yhteensa' => $yhteensa));
?>