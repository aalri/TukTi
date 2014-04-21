<?php

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/' . $sivu;
    exit();
}

//kertoo onko asiakasta istunnossa
function kirjautunutAsiakas() {
    if (isset($_SESSION['asiakas'])) {
        return true;
    }
    return false;
}

//palauttaa asiakkaan
function Asiakastiedot() {
    $asiakas = $_SESSION['asiakas'];
    return $asiakas;
}

//palauttaa nykyisentilauksen
function Nykyinentilaustiedot() {
    return $_SESSION['nykyinentilaus'];
}

//kertoo onko ylläpitäjää istunnossa
function kirjautunutYllapitaja() {
    if (isset($_SESSION['yllapitaja'])) {
        return true;
    }
    return false;
}

//palauttaa ylläpitäjän
function Yllapitajatiedot() {
    return $_SESSION['yllapitaja'];
}

//palauttaa kokonaisluvun tai -1, jos syöte ei ollut kokonaisluku
function annaKokonaislukuna($merkkijono) {
    if (!preg_match('/^\d+$/', $merkkijono)) {
        return -1;
    } else {
        return $merkkijono;
    }
}

//palauttaa nykyisen sivun tarkastelemalla $_GET['sivu']:n arvoa ja sivujen kokonaismäärää.
function annaNykyinenSivu($sivuja) {
    if (isset($_GET['sivu'])) {
        $sivu = (int) $_GET['sivu'];
        if ($sivu <= 1) {
            $sivu = 1;
        }else if ($sivu > $sivuja) {
            $sivu = $sivuja;
        }
        return $sivu;
    }
    return 1;
}
//palauttaa nykyisen haun tai tyhjän.
function annaNykyinenHaku() {
    if (isset($_GET['haku'])) {
        return $_GET['haku'];
    }
    return "";
}