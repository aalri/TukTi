<?php

require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/tuote.php';
if (!empty($_POST['toimita'])) {
    $tuoteryhmanro = $_POST['toimita'];
    if (!Tilaus::onToimitettu($tuoteryhmanro)) {
        if (Tuote::loytyyTuoteMaarat($tuoteryhmanro)) {
            Tilaus::paivitaToimitetuksiKantaan($tuoteryhmanro);
            Tuote::vahennaTuoteMaarat($tuoteryhmanro);
            $lasku = new Lasku();
            $lasku->setTilausnro($tuoteryhmanro);
            $lasku->setTyyppi("Lasku");
            $laskunro = $lasku->lisaaKantaanNykyisellaAjalla();
            $_SESSION['ilmoitus'] = "Tilaus numerolla: '" . $tuoteryhmanro . "' on kirjattu toimitetuksi ja uusi lasku numerolla: '" . $lasku->getLaskunro() . "'";
            unset($_POST['toimita']);
            header('Location: index.php?ikkuna=kaikkitilaukset');
        } else {
            $_SESSION['varoitus'] = "Tilausta numerolla: '" . $tuoteryhmanro . "' ei voida toimittaa tavarapulan takia!";
            unset($_POST['toimita']);
            header('Location: index.php?ikkuna=kaikkitilaukset');
        }
    } else {
        $_SESSION['varoitus'] = "Tilaus numerolla: '" . $tuoteryhmanro . "' on jo toimitettu!";
        unset($_POST['toimita']);
        header('Location: index.php?ikkuna=kaikkitilaukset');
    }
}
if (!empty($_POST['maksettu'])) {
    $tuoteryhmanro = $_POST['maksettu'];
    if (Tilaus::onToimitettu($tuoteryhmanro)) {
        Tilaus::paivitaMaksetuksiKantaan($tuoteryhmanro);
        $_SESSION['ilmoitus'] = "Tilaus numerolla: '" . $tuoteryhmanro . "' on kirjattu maksetuksi";
        unset($_POST['maksettu']);
        header('Location: index.php?ikkuna=kaikkitilaukset');
    } else {
        $_SESSION['varoitus'] = "Tilausta ei olla vielä toimitettu!";
        unset($_POST['maksettu']);
        header('Location: index.php?ikkuna=kaikkitilaukset');
    }
}
$rivimaara = 5;
$lkm = Tilaus::tilaustenLukumaara();
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
$lista = Tilaus::getTilauksetTiettyMaaraKohdasta($rivimaara, $rivimaara * ($sivu - 1));
naytaNakyma("kaikkitilaukset.php", array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));
?>