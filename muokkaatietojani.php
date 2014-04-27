<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
$asiakas = Asiakastiedot();
if (empty($_POST['tallennettumuutokset'])) {
    naytaNakyma('muokkaatietojani.php', array('asiakas' => $asiakas));    
}
$muokattuasiakas = new Asiakas($asiakas->getAsiakasnro(),$_POST['nimi'] ,$_POST['osoite'], $asiakas->getTunnus(), $asiakas->getSalasana(), "Ei");
if (strlen($_POST['salasana']) > 0){
    $muokattuasiakas->setSalasana($_POST['salasana']);
}
if ($muokattuasiakas->onkoKelvollinen()) {
    $muokattuasiakas->paivitaKantaan();
    $_SESSION['ilmoitus'] = "Vanhat tietosi: (" . $asiakas->getNimi() . "," . $asiakas->getOsoite() . ") muutettu uudeksi: (" . $muokattuasiakas->getNimi() . "," . $muokattuasiakas->getOsoite() . ").";
    $_SESSION['asiakas'] = $muokattuasiakas;
    header('Location: index.php?ikkuna=tiedot');
} else {
    naytaNakyma("muokkaatietojani.php", array(
        'asiakas' => $muokattuasiakas, 'virhe' => "Virhe.\n" . $muokattuasiakas->getVirhe(),
    ));
}
