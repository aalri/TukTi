<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
require_once 'libs/models/lasku.php';
session_start();
if (kirjautunutAsiakas()) {
    $asiakas = Asiakastiedot();
    $karhut = Lasku::maksamattomiaKarhujaMaaraAsiakasnrolla($asiakas->getAsiakasnro());    
    naytaNakyma('etusivu.php', array('asiakas' => $asiakas, 'karhut' => $karhut));    
} else if (kirjautunutYllapitaja()) {
    $yllapitaja = Yllapitajatiedot();
    naytaNakyma('etusivu.php', array('yllapitaja' => $yllapitaja));
} else{
    naytaNakyma('etusivu.php');
}