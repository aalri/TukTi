<?php

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/' . $sivu;
    exit();
}

function kirjautunutAsiakas() {
    if (isset($_SESSION['asiakas'])) {
        return true;
    }
    return false;
}

function Asiakastiedot() {
    $asiakas = $_SESSION['asiakas'];
    return $asiakas;
}

function Nykyinentilaustiedot() {
    return $_SESSION['nykyinentilaus'];
}

function kirjautunutYllapitaja() {
    if (isset($_SESSION['yllapitaja'])) {
        return true;
    }
    return false;
}

function Yllapitajatiedot() {
    return $_SESSION['yllapitaja'];
}

function annaKokonaislukuna($merkkijono) {
    if (!preg_match('/^\d+$/', $merkkijono)) {
        return -1;
    } else {
        return $merkkijono;
    }
}

function annaNykyinenSivu($sivuja) {
    if (isset($_GET['sivu'])) {
        $sivu = (int) $_GET['sivu'];
        if ($sivu < 1) {
            $sivu = 1;
        }
        if ($sivu > $sivuja) {
            $sivu = $sivuja;
        }
        return $sivu;
    }
    return 1;
}
