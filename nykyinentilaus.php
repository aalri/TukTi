<?php
require_once 'libs/common.php';
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
$nykyinentilaus = $_SESSION['nykyinentilaus'];
if (empty($_POST["tuotenro"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("nykyinentilaus.php", array(
        'nykyinentilaus' => $nykyinentilaus, request
    ));
} else {
    $tuotenro = $_POST["tuotenro"];
    $nykyinentilaus = $_SESSION['nykyinentilaus'];    
    $nykyinentilaus->poistaTilauksesta($tuotenro);
    $_SESSION['nykyinentilaus'] = $nykyinentilaus;
    naytaNakyma("nykyinentilaus.php", array(
        'nykyinentilaus' => $nykyinentilaus, 'onnistui' => "Tuotetta ".Tuote::getTuoteNimiNumerolla($tuotenro)." poistettu tilauksesta", request
    ));
}