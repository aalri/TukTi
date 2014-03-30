<?php

require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
session_start();
if (kirjautunutAsiakas()) {
    $asiakas = Asiakastiedot();
    naytaNakyma('etusivu.php', array('asiakas' => $asiakas));
} else if (kirjautunutYllapitaja()) {
    $yllapitaja = Yllapitajatiedot();
    naytaNakyma('etusivu.php', array('yllapitaja' => $yllapitaja));
} else{
    naytaNakyma('etusivu.php');
}