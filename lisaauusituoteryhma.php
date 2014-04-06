<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
if (!isset($_POST['nimi'])){   
    naytaNakyma("lisaauusituoteryhma.php", array(
    'tuoteryhma' => new Tuoteryhma()    
    ));
    exit();
}
$uusituoteryhma = new Tuoteryhma();
$uusituoteryhma->setNimi($_POST['nimi']);
if ($uusituoteryhma->onkoKelvollinen()){    
    $uusituoteryhma->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Tuoteryhmä '".$uusituoteryhma->getNimi()."' lisätty onnistuneesti numerolla '".$uusituoteryhma->getTuoteryhmanro()."'.";
    header('Location: index.php?ikkuna=tuoteryhmatjatuotteet'); 
}else{
    naytaNakyma("lisaauusituoteryhma.php", array(
    'tuoteryhma' => $uusituoteryhma, 'virhe' => $uusituoteryhma->getVirhe()
    ));
}