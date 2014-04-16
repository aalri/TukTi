<link href=" css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<?php
session_start();
require_once 'libs/common.php';
require_once 'libs/models/yllapitaja.php';
require_once 'libs/models/asiakas.php';
require_once 'libs/models/nykyinentilaus.php';
require_once 'libs/yhteydenotto.php';

if (empty($_POST["username"]) && empty($_POST["password"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("login.php");
    exit();
}

$kayttaja = $_POST["username"];
$salasana = $_POST["password"];
$asiakas = Asiakas::etsiKayttajaTunnuksilla($kayttaja, $salasana);
/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
if (Yllapitaja::etsiKayttajaTunnuksilla($kayttaja, $salasana) !== null) {
    $_SESSION['yllapitaja'] = $kayttaja;    
    header('Location: paivitalaskut.php');
} else if ($asiakas !== null) {
    $nykyinentilaus = new Nykyinentilaus();
    $_SESSION['nykyinentilaus'] = $nykyinentilaus;
    $_SESSION['asiakas'] = $asiakas;  
    header('Location: paivitalaskut.php');
} else if (empty($_POST["username"])) {
    naytaNakyma("login.php", array(
        'virhe' => "Kirjautuminen epäonnistui! Tunnus kenttä on tyhjä.", request
    ));
} else if (empty($_POST["password"])) {
    naytaNakyma("paivitalaskut.php", array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Salasana kenttä on tyhjä.", request
    ));
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä lomakkeen ja virheen.
     * Tässä käytetään omassa kirjastotiedostossa määriteltyjä yleiskäyttöisiä funktioita.
     */
    naytaNakyma("login.php", array(
        /* Välitetään näkymälle tieto siitä, kuka yritti kirjautumista */
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", request));
}