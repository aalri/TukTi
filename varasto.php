<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/tilausrivi.php';
$sivu = 1;
$rivimaara = 5;
$lkm = Tuote::lukumaara();
$sivuja = ceil($lkm / $rivimaara);
if (isset($_GET['sivu'])) {
    $sivu = (int) $_GET['sivu'];
    if ($sivu < 1){
        $sivu = 1;
    }
    if ($sivu > $sivuja){
        $sivu = $sivuja;
    }
}
$lista = Tuote::getTuotteetTiettyMaaraKohdasta($rivimaara, $rivimaara*($sivu-1));
if (!empty($_POST['poista'])) {
    $tuotenro = $_POST['poista'];    
    $tuote = Tuote::etsiNumerolla($tuotenro);
    if ($tuote === null){
        $_SESSION['varoitus'] = "Poistettavaa tuotetta ei löytynyt.";
        header('Location: index.php?ikkuna=varasto');
    }
    if (Tilausrivi::onTilausrivejaTuotenumerolla($tuotenro)) {
        $tuote->poista();
        $tuote->paivitaKantaan();        
        $_SESSION['ilmoitus'] = "Tuotteeseen: '" . $tuote->getNimi() . "' on sidottu tilausrivejä, joten se on häivytetty";
        header('Location: index.php?ikkuna=varasto');
    } else {
        $tuote->poistaKannasta();
        $_SESSION['ilmoitus'] = "Tuote: '" . $tuote->getNimi() . "', '". $tuote->getTuotenro() ."' poistettu onnistuneesti";
        header('Location: index.php?ikkuna=varasto');
    }
}
naytaNakyma('varasto.php', array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));


