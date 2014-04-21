<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/tilausrivi.php';
$rivimaara = 4;
$haku = annaNykyinenHaku();
$lkm = Tuote::lukumaaraHaulla($haku);
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
if (isset($_POST['haku'])){
    header('Location: index.php?ikkuna=varasto&sivu='.$sivu.'&haku='.$_POST['haku']);
}
if (!empty($_POST['poista'])) {
    $tuotenro = $_POST['poista'];    
    $tuote = Tuote::etsiNumerolla($tuotenro);
    if ($tuote === null){
        $_SESSION['varoitus'] = "Poistettavaa tuotetta ei löytynyt.";
        header('Location: index.php?ikkuna=varasto&sivu='.$sivu);
    }
    if (Tilausrivi::onTilausrivejaTuotenumerolla($tuotenro)) {
        $tuote->poista();
        $tuote->paivitaKantaan();        
        $_SESSION['ilmoitus'] = "Tuotteeseen: '" . $tuote->getNimi() . "' on sidottu tilausrivejä, joten se on häivytetty";
        header('Location: index.php?ikkuna=varasto&sivu='.$sivu.'&haku='.$haku);
    } else {
        $tuote->poistaKannasta();
        $_SESSION['ilmoitus'] = "Tuote: '" . $tuote->getNimi() . "', '". $tuote->getTuotenro() ."' poistettu onnistuneesti";
        header('Location: index.php?ikkuna=varasto&sivu='.$sivu.'&haku='.$haku);
    }
}
$lista = Tuote::getTuotteetTiettyMaaraKohdastaHaulla($rivimaara, $rivimaara*($sivu-1), $haku);
naytaNakyma('varasto.php', array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja, 'haku' => $haku));


