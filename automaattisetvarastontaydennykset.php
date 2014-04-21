<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
$rivimaara = 5;
$lkm = Tuote::lukumaaraAliKynnyksen();
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
if (!empty($_POST['kirjaatoimitus'])){
    $tuotenro = $_POST['kirjaatoimitus'];
    $tuote = Tuote::etsiNumerolla($tuotenro);
    if ($tuote->getLisayskynnys()>$tuote->getJaljella()){
        $tuote->setJaljella($tuote->getLisaysmaara() + $tuote->getJaljella());
        $tuote->paivitaKantaan();        
        $_SESSION['ilmoitus'] = "Tuotetta nro '".$tuote->getTuotenro()."' lisätty automaattisesti varastoon ".$tuote->getLisaysmaara()." kappaletta.";
        header('Location: index.php?ikkuna=automaattisetvarastontaydennykset');
    }else{
    $_SESSION['varoitus'] = "Tuotemäärä ei alittanut kynnystä";
    header('Location: index.php?ikkuna=automaattisetvarastontaydennykset');
    }

}
$lista = Tuote::getTuotteetMaaraAliKynnyksenTiettyMaaraKohdasta($rivimaara, $rivimaara * ($sivu - 1));
naytaNakyma("automaattisetvarastontaydennykset.php", array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));