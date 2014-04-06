<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tilaus.php';
require_once 'libs/models/tilausrivi.php';
require_once 'libs/models/tuote.php';
if (!preg_match('/^\d+$/', $_GET['tilausnro'])){
    $_SESSION['varoitus'] = "Tilausta ei löytynyt kannasta";
    if (kirjautunutYllapitaja()){
    header('Location: index.php?ikkuna=tuoteryhmatjatuotteet');    
    }else{
    header('Location: ?ikkuna=tilaukset');   
    }    
}else{
$tuoteryhmanro = $_GET['tilausnro'];
}
$asiakas = Asiakastiedot();
if ($_POST['palaa']) {
    if (kirjautunutYllapitaja()){
        header('Location: ?ikkuna=kaikkitilaukset');
    }else{
        header('Location: ?ikkuna=tilaukset');
    }
} else {
    if (kirjautunutYllapitaja()) {
        $lista = Tilausrivi::getTilausrivitTilausnumerolla($tuoteryhmanro);
        naytaNakyma("tarkempiatilaustietoja.php", array('lista' => $lista, 'tilausnro' => $tuoteryhmanro));
    } else {
        $asiakasnro = Tilaus::getTilausnumeronAsiakas($tuoteryhmanro);
        if ($asiakas->getAsiakasnro() === $asiakasnro) {
            $lista = Tilausrivi::getTilausrivitTilausnumerolla($tuoteryhmanro);
            naytaNakyma("tarkempiatilaustietoja.php", array('lista' => $lista, 'tilausnro' => $tuoteryhmanro));
        }else{
            $_SESSION['varoitus'] = "Tilausta ei löytynyt kannasta";
            header('Location: ?ikkuna=tilaukset');
        }
    }
}
?>