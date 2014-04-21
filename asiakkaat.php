<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
require_once 'libs/models/tilaus.php';
$rivimaara = 5;
$lkm = Asiakas::AsiakkaidenLukumaara();
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
if (!empty($_POST['poista'])) {
    $asiakasnro = $_POST['poista'];    
    $asiakas = Asiakas::etsiNumerolla($asiakasnro);
    if ($asiakas === null){
        $_SESSION['varoitus'] = "Poistettavaa Asiakasta ei löytynyt.";
        header('Location: index.php?ikkuna=asiakkaat&sivu='.$sivu);
    }
    if (Tilaus::onToimitettujaTilauksiaAsiakasnrolla($asiakasnro)) {
        $asiakas->poista();
        $asiakas->paivitaKantaan();        
        $_SESSION['ilmoitus'] = "Asiakkaaseen: '" . $asiakas->getAsiakasnro() . "' on sidottu toimitettuja tilauksia, joten se on häivytetty";
        header('Location: index.php?ikkuna=asiakkaat&sivu='.$sivu);
    } else {
        $asiakas->poistaKannasta();
        $_SESSION['ilmoitus'] = "Asiakas: '". $asiakas->getAsiakasnro() ."' poistettu onnistuneesti";
        header('Location: index.php?ikkuna=asiakkaat&sivu='.$sivu);
    }
}
$lista = Asiakas::getAsiakkaatTiettyMaaraKohdasta($rivimaara, $rivimaara * ($sivu - 1));
naytaNakyma("asiakkaat.php", array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));
?>