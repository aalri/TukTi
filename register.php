<link href=" css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<?php
require_once 'libs/common.php';
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
if (empty($_POST['tallennetturekisteroityminen'])){   
    naytaNakyma("register.php", array(
    'asiakas' => new Asiakas()    
    ));
    exit();
}
$uusiasiakas = new Asiakas();
$uusiasiakas->setTunnus($_POST['tunnus']);
$uusiasiakas->setSalasana($_POST['salasana']);
$uusiasiakas->setNimi($_POST['nimi']);
$uusiasiakas->setOsoite($_POST['osoite']);
if ($uusiasiakas->onkoUusiKelvollinen()){      
    $uusiasiakas->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Onnittelut '".$uusiasiakas->getNimi()."' rekisteröidyit onnistuneesti asiakasnumerolla '".$uusiasiakas->getAsiakasnro()."'. Voit nyt kirjautua sisään tunnuksella ja salasanallasi.";
    header('Location: index.php?ikkuna=etusivu'); 
}else{
    naytaNakyma("register.php", array(        
    'asiakas' => $uusiasiakas, 'virhe' => $uusiasiakas->getVirhe()
    ));
}