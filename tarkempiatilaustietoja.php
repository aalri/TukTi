<?php

require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';
require_once 'libs/models/tuote.php';
$tilausnro = $_GET['tilausnro'];
$asiakas = Asiakastiedot();
if ($_POST['palaa']) {
    if (kirjautunutYllapitaja()){
        header('Location: ?ikkuna=kaikkitilaukset');
    }else{
        header('Location: ?ikkuna=tilaukseni');
    }
} else {
    if (kirjautunutYllapitaja()) {
        $lista = Tilausrivi::getTilausrivitTilausnumerolla($tilausnro);
        naytaNakyma("tarkempiatilaustietoja.php", array('lista' => $lista, 'tilausnro' => $tilausnro));
    } else {
        $asiakasnro = Tilaus::getTilausnumeronAsiakas($tilausnro);
        if ($asiakas->getAsiakasnro() === $asiakasnro) {
            $lista = Tilausrivi::getTilausrivitTilausnumerolla($tilausnro);
            naytaNakyma("tarkempiatilaustietoja.php", array('lista' => $lista, 'tilausnro' => $tilausnro));
        }
    }
}
?>