<?php
session_start();
  
  function naytaNakyma($sivu, $data = array()) {
    $data = (object)$data;
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