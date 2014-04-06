<?php
require_once 'libs/common.php';
require_once 'libs/models/nykyinentilaus.php';
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/tuoteryhma.php';
$tuoteryhmanro = annaKokonaislukuna($_GET['tuoteryhma']);
$tuoteryhma = Tuoteryhma::etsiNumerolla($tuoteryhmanro);
if ($tuoteryhma === null){
    $_SESSION['varoitus'] = "Tuoteryhmää ei löytynyt kannasta";
    header('Location: index.php?ikkuna=tuoteryhmat'); 
}
$sivu = 1;
$rivimaara = 5;
$lkm = Tuote::tuoteryhmanLukumaara($tuoteryhmanro);
$sivuja = ceil($lkm / $rivimaara);
if (isset($_GET['sivu'])) {
    $sivu = (int) $_GET['sivu'];
    if ($sivu < 1){
        $sivu = 1;
    }
    if ($sivu > $sivuja){
        $sivu = $sivuja;
    }
}
$lista = Tuote::getTuoteryhmanTuotteetTiettyMaaraKohdasta($tuoteryhmanro, $rivimaara, $rivimaara*($sivu-1));
if (empty($_POST["tuotenro"]) || empty($_POST["maara"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("tuoteryhma.php", array(
        'tuoteryhma' => $tuoteryhma, 'lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja
    ));
}else if ((int)$_POST["maara"] <= 0) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("tuoteryhma.php", array(
        'virhe' => "Virhe määrä syötteessä", 'tuoteryhma' => $tuoteryhma, 'lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja
    ));
} else {
    $tuotenro = $_POST["tuotenro"];
    $maara = $_POST["maara"];
    $nykyinentilaus = $_SESSION['nykyinentilaus'];
    $nykyinentilaus->lisaaTilaukseen($tuotenro, $maara);
    $_SESSION['nykyinentilaus'] = $nykyinentilaus;
    $tuote = Tuote::etsiNumerolla($tuotenro);
    unset($_POST["tuotenro"]);
    unset($_POST["maara"]);
    naytaNakyma("tuoteryhma.php", array(
        'onnistui' => "Tuotetta ".$tuote->getNimi()." lisätty tilaukseen ".$maara." kappaletta." ,'tuoteryhma' => $tuoteryhma, 'lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja
    ));
}

