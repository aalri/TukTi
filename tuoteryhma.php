<?php

require_once 'libs/common.php';
require_once 'libs/models/nykyinentilaus.php';
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/tuoteryhma.php';
require_once 'libs/models/kuuluuryhmiin.php';
$tuoteryhmanro = annaKokonaislukuna($_GET['tuoteryhma']);
$tuoteryhma = Tuoteryhma::etsiNumerolla($tuoteryhmanro);
if ($tuoteryhma === null) {
    $_SESSION['varoitus'] = "Tuoteryhmää ei löytynyt kannasta";
    header('Location: index.php?ikkuna=tuoteryhmat');
}
$rivimaara = 5;
$lkm = Tuote::tuoteryhmanLukumaara($tuoteryhmanro);
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
$lista = Tuote::getTuoteryhmanTuotteetTiettyMaaraKohdasta($tuoteryhmanro, $rivimaara, $rivimaara * ($sivu - 1));
if (empty($_POST["tuotenro"]) || empty($_POST["maara"])) {
    naytaNakyma("tuoteryhma.php", array(
        'tuoteryhma' => $tuoteryhma, 'lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja
    ));
} else if ((int) $_POST["maara"] <= 0) {
    naytaNakyma("tuoteryhma.php", array(
        'virhe' => "Virhe määrä syötteessä", 'tuoteryhma' => $tuoteryhma, 'lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja
    ));
} else {
    $tuotenro = $_POST["tuotenro"];
    if (!Kuuluuryhmiin::kuuluuTuoteryhmaan(annaKokonaislukuna($tuotenro))) {
        naytaNakyma("tuoteryhma.php", array(
            'virhe' => "Virhe, tuotetta ei löytynyt", 'tuoteryhma' => $tuoteryhma, 'lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja
        ));
    } else {
        $maara = $_POST["maara"];
        $tuote = Tuote::etsiNumerolla($tuotenro);
        $nykyinentilaus = $_SESSION['nykyinentilaus'];
        $nykyinentilaus->lisaaTilaukseen($tuotenro, $maara, $tuote->getHinta());
        $_SESSION['nykyinentilaus'] = $nykyinentilaus;
        unset($_POST["tuotenro"]);
        unset($_POST["maara"]);
        naytaNakyma("tuoteryhma.php", array(
            'onnistui' => "Tuotetta " . $tuote->getNimi() . " lisätty tilaukseen " . $maara . " kappaletta.", 'tuoteryhma' => $tuoteryhma, 'lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja
        ));
    }
}


