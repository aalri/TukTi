<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/common.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';
require_once 'libs/models/tuote.php';

$tilausnro = annaKokonaislukuna($_GET['tilausnro']);
$rivimaara = 5;
$lkm = Tilausrivi::lukumaaraTilausnumerolla($tilausnro);
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
if (!Tilaus::onTilausNumerolla($tilausnro)) {
    $_SESSION['varoitus'] = "Tilausta ei löytynyt kannasta";
    if (kirjautunutYllapitaja()) {
        header('Location: index.php?ikkuna=kaikkitilaukset');
    } else {
        header('Location: ?ikkuna=tilaukset');
    }
}
if ($_POST['palaa']) {
    if (kirjautunutYllapitaja()) {
        header('Location: ?ikkuna=kaikkitilaukset');
    } else {
        header('Location: ?ikkuna=tilaukset');
    }
} else {
    if (kirjautunutYllapitaja()) {
        $lista = Tilausrivi::getTilausrivitTilausnumerollaTiettyMaaraKohdasta($tilausnro, $rivimaara, $rivimaara*($sivu-1));
        naytaNakyma("tarkempiatilaustietoja.php", array('lista' => $lista, 'tilausnro' => $tilausnro, 'sivu' => $sivu, 'sivuja' => $sivuja));
    } else {
        $asiakas = Asiakastiedot();
        $asiakasnro = Tilaus::getTilausnumeronAsiakas($tilausnro);
        if ($asiakas->getAsiakasnro() === $asiakasnro) {
            $lista = Tilausrivi::getTilausrivitTilausnumerollaTiettyMaaraKohdasta($tilausnro, $rivimaara, $rivimaara*($sivu-1));            
            naytaNakyma("tarkempiatilaustietoja.php", array('lista' => $lista, 'tilausnro' => $tilausnro, 'sivu' => $sivu, 'sivuja' => $sivuja));
        } else {
            $_SESSION['varoitus'] = "Tilausta ei löytynyt kannasta";
            header('Location: ?ikkuna=tilaukset');
        }
    }
}
?>