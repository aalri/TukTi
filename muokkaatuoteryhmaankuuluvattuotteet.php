<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/kuuluuryhmiin.php';
$tuoteryhmanro = annaKokonaislukuna($_GET['tuoteryhma']);
$tuoteryhma = Tuoteryhma::etsiNumerolla($tuoteryhmanro);
if ($tuoteryhma === null){
    $_SESSION['varoitus'] = "Tuoteryhmää ei löytynyt kannasta";
    header('Location: index.php?ikkuna=tuoteryhmatjatuotteet'); 
}
$lista = Tuote::getTuotteetJaKuuluvuudetTuoteryhmaan($tuoteryhmanro);
if (empty($_POST['tallennettumuutokset'])) {
    naytaNakyma("muokkaatuoteryhmaankuuluvattuotteet.php", array(
        'tuoteryhma' => $tuoteryhma, 'lista' => $lista
    ));
    exit();
}
$ilmoitus = $tuoteryhma->getNimi()." muutokset:<br />";
foreach ($lista as $asia) {    
    $kuuluu = "false";
    if (isset($_POST['kuuluuryhmaan' . $asia->getTuotenro()])) {
        $kuuluu = "true";        
    }
    if ($_POST['kuuluiryhmaan' . $asia->getTuotenro()] != $kuuluu){
        if ($kuuluu == "true"){
            $kuuluuryhmiin = new Kuuluuryhmiin($asia->getTuotenro(), $tuoteryhmanro);
            if($kuuluuryhmiin->onkoKelvollinen()){
                $kuuluuryhmiin->lisaaKantaan();
                $ilmoitus .= "".$asia->getNimi()." on lisätty ryhmään.<br />";
            }
        }else if ($kuuluu == "false"){
            Kuuluuryhmiin::poista($asia->getTuotenro(), $tuoteryhmanro);
            $ilmoitus .= "".$asia->getNimi()." on poistettu ryhmästä.<br />";
        }
    }
}
$_SESSION['ilmoitus'] = $ilmoitus;
header('Location: index.php?ikkuna=tuoteryhmatjatuotteet'); 
