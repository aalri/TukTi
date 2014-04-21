<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/lasku.php';
require_once 'libs/models/asiakas.php';
require_once 'libs/common.php';

if (kirjautunutYllapitaja()){    
    Lasku::paivitaMaksamattomatLaskut();  
    Lasku::paivitaMaksamattomatKarhut();
}else if (kirjautunutAsiakas()){
    $asiakas = Asiakastiedot();
    Lasku::paivitaAsiakkaanMaksamattomatLaskut($asiakas->getAsiakasnro());
    Lasku::paivitaAsiakkaanMaksamattomatKarhut($asiakas->getAsiakasnro());
}
header('Location: index.php');
