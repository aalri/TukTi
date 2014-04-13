<?php

require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/tuote.php';
if (!empty($_POST['toimita'])) {
    $tilausnro = $_POST['toimita'];
    if (!Tilaus::onToimitettu($tilausnro)) {
        if (Tuote::loytyyTuoteMaarat($tilausnro)) {
            Tilaus::paivitaToimitetuksiKantaan($tilausnro);
            Tuote::vahennaTuoteMaarat($tilausnro);
            $lasku = new Lasku();
            $lasku->setTilausnro($tilausnro);
            $lasku->setTyyppi("Lasku");
            $laskunro = $lasku->lisaaKantaanNykyisellaAjalla();
            $_SESSION['ilmoitus'] = "Tilaus numerolla: '" . $tilausnro . "' on kirjattu toimitetuksi ja uusi lasku numerolla: '" . $lasku->getLaskunro() . "'";
            unset($_POST['toimita']);
            header('Location: index.php?ikkuna=kaikkitilaukset');
        } else {
            $_SESSION['varoitus'] = "Tilausta numerolla: '" . $tilausnro . "' ei voida toimittaa tavarapulan takia!";
            unset($_POST['toimita']);
            header('Location: index.php?ikkuna=kaikkitilaukset');
        }
    } else {
        $_SESSION['varoitus'] = "Tilaus numerolla: '" . $tilausnro . "' on jo toimitettu!";
        unset($_POST['toimita']);
        header('Location: index.php?ikkuna=kaikkitilaukset');
    }
}
if (!empty($_POST['maksettu'])) {
    $tilausnro = $_POST['maksettu'];
    if (Tilaus::onToimitettu($tilausnro)) {
        Tilaus::paivitaMaksetuksiKantaan($tilausnro);
        $_SESSION['ilmoitus'] = "Tilaus numerolla: '" . $tilausnro . "' on kirjattu maksetuksi";
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