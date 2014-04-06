<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
$tuoteryhmanro = annaKokonaislukuna($_GET['tuoteryhma']);
$tuoteryhma = Tuoteryhma::etsiNumerolla($tuoteryhmanro);

if ($tuoteryhma === null){
    $_SESSION['varoitus'] = "Tuoteryhmää ei löytynyt kannasta";
    header('Location: index.php?ikkuna=tuoteryhmatjatuotteet'); 
}
$vanhanimi = $tuoteryhma->getNimi();
if (empty($_POST['nimi'])){   
    naytaNakyma("muokkaatuoteryhmannimea.php", array(
    'tuoteryhma' => $tuoteryhma    
    ));
    exit();
}
$tuoteryhma->setNimi($_POST['nimi']);
if ($tuoteryhma->onkoKelvollinen()){    
    $tuoteryhma->paivitaKantaan();      
    $_SESSION['ilmoitus'] = "Tuoteryhmän vanha nimi: '".$vanhanimi."' muutettu uudeksi: '".$tuoteryhma->getNimi()."' onnistuneesti tuoteryhmänumerolla: '".$tuoteryhma->getTuoteryhmanro()."'.";
    header('Location: index.php?ikkuna=tuoteryhmatjatuotteet'); 
}else{
    naytaNakyma("muokkaatuoteryhmannimea.php", array(
    'tuoteryhma' => $tuoteryhma(), 'virhe' => $tuoteryhma->getVirhe(),
    ));
}