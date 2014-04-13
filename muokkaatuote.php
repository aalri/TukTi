<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuote.php';
$tuotenro = annaKokonaislukuna($_GET['tuotenro']);
$tuote = Tuote::etsiNumerolla($tuotenro);
if ($tuote === null){
    $_SESSION['varoitus'] = "Tuotetta ei löytynyt kannasta";
    header('Location: index.php?ikkuna=varasto'); 
}
if (empty($_POST['tallennettumuutokset'])) {
    naytaNakyma("muokkaatuote.php", array(
        'vanhanimi' => $tuote->getNimi(),
        'tuote' => $tuote
    ));
    exit();
}
$uusituote = new Tuote($tuotenro, $_POST['nimi'], $_POST['tietoja'], $_POST['hinta'], $_POST['maara'], $_POST['lisayskynnys'], $_POST['lisaysmaara'], "Ei");
if ($uusituote->onkoKelvollinen()) {
    $uusituote->paivitaKantaan();
    $_SESSION['ilmoitus'] = "Tuotteen vanhat tiedot: (" . $tuote->getNimi() . "," . $tuote->getJaljella() . "," . $tuote->getHinta() . "," . $tuote->getLisayskynnys() . "," . $tuote->getLisaysmaara() . ") muutettu uudeksi: (" . $uusituote->getNimi() . "," . $uusituote->getJaljella() . "," . $uusituote->getHinta() . "," . $uusituote->getLisayskynnys() . "," . $uusituote->getLisaysmaara() . ") onnistuneesti tuotenumerolla: '" . $uusituote->getTuotenro() . "'.";
    header('Location: index.php?ikkuna=varasto');
} else {
    naytaNakyma("muokkaatuote.php", array(
        'vanhanimi' => $tuote->getNimi(), 'tuote' => $uusituote, 'virhe' => "Virhe.\n" . $uusituote->getVirhe(),
    ));
}