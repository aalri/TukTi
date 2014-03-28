<?php
require_once 'libs/common.php';
require_once 'libs/models/nykyinentilaus.php';
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/tuoteryhma.php';
$tuoteryhmanro = (int) $_GET['tuoteryhma'];
$lista = Tuote::getTuoteryhmaanKuuluvatTuotteet($tuoteryhmanro);
$tuoteryhma = Tuoteryhma::etsiNumerolla($tuoteryhmanro);
if (empty($_POST["tuotenro"]) || empty($_POST["maara"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("tuoteryhma.php", array(
        'tuoteryhma' => $tuoteryhma, 'lista' => $lista, request
    ));
}else if ((int)$_POST["maara"] <= 0) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("tuoteryhma.php", array(
        'virhe' => "Virhe määrä syötteessä", 'tuoteryhma' => $tuoteryhma, 'lista' => $lista, request
    ));
} else {
    $tuotenro = $_POST["tuotenro"];
    $maara = $_POST["maara"];
    $nykyinentilaus = $_SESSION['nykyinentilaus'];
    $nykyinentilaus->lisaaTilaukseen($tuotenro, $maara);
    $_SESSION['nykyinentilaus'] = $nykyinentilaus;
    unset($_POST["tuotenro"]);
    unset($_POST["maara"]);
    naytaNakyma("tuoteryhma.php", array(
        'onnistui' => "Tuotetta ".$lista[$tuotenro-1]->getNimi()." lisätty tilaukseen ".$maara." kappaletta." ,'tuoteryhma' => $tuoteryhma, 'lista' => $lista, request
    ));
}

