<?php

require_once 'libs/yhteydenotto.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';

$asiakas = Asiakastiedot();
$nykyinentilaus = Nykyinentilaustiedot();
if (Lasku::onMaksamattomiaKarhujaAsiakasnrolla($asiakas->getAsiakasnro())) {
    naytaNakyma("tilaa.php", array(
        'maksamatta' => true
    ));    
}

if (!isset($_POST['tilaa'])) {
    naytaNakyma("tilaa.php", array(
        'nykyinentilaus' => $nykyinentilaus
    ));
}
$tilaus = Tilaus::luoKantaanUusitilaus($asiakas->getAsiakasnro());
foreach($nykyinentilaus->getRivit() as $rivi){
    Tilausrivi::luoKantaanUusitilausrivi($tilaus->getTilausnro(), $rivi->getTuotenro(), $rivi->getMaara(), $rivi->getKappalehinta());
}
$uusitilaus = new Nykyinentilaus();
$_SESSION['nykyinentilaus'] = $uusitilaus;
$_SESSION['ilmoitus'] = "Tilaus tilattu onnistuneesti tilausnumerolla: '".$tilaus->getTilausnro()."'";
header('Location: index.php?ikkuna=etusivu');

