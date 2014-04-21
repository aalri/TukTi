<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
$uusituote= new Tuote(0, "Uusituote", 0.0, 0, 0, 0, "Ei");
if ($uusituote->onkoKelvollinen()){
    $uusituote->lisaaKantaan();    
    $_SESSION['ilmoitus'] = "Tuote '".$uusituote->getNimi()."' lisätty onnistuneesti numerolla '".$uusituote->getTuotenro()."'.";
    header('Location: index.php?ikkuna=muokkaatuote&tuotenro='.$uusituote->getTuotenro()); 
}else{
$_SESSION['varoitus'] = "Uutta tuotetta ei onnistuttu luomaan.";
header('Location: index.php?ikkuna=varasto'); 
}