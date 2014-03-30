<link href=" css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<?php
require_once 'libs/models/nykyinentilaus.php';
require_once 'libs/models/asiakas.php';
require_once 'libs/common.php';
$ikkuna = (String) $_GET['ikkuna'];
if ($ikkuna === 'varasto' && kirjautunutYllapitaja()) {
    $sivu = 'varasto.php';
} else if ($ikkuna === 'kaikkilaskut' && kirjautunutYllapitaja()) {
    $sivu = 'kaikkilaskut.php';
} else if ($ikkuna === 'asiakkaat' && kirjautunutYllapitaja()) {
    $sivu = 'asiakkaat.php';
} else if ($ikkuna === 'tuoteryhmatjatuotteet' && kirjautunutYllapitaja()) {
    $sivu = 'tuoteryhmatjatuotteet.php';
} else if ($ikkuna === 'kaikkitilaukset' && kirjautunutYllapitaja()) {
    $sivu = 'kaikkitilaukset.php';
} else if ($ikkuna === 'tuoteryhma') {
    $sivu = 'tuoteryhma.php';
} else if ($ikkuna === 'etusivu') {
    $sivu = 'etusivu.php';
} else if ($ikkuna === 'tiedot' && kirjautunutAsiakas()) {
    $sivu = 'tiedot.php';
} else if ($ikkuna === 'laskut' && kirjautunutAsiakas()) {
    $sivu = 'laskuni.php';
} else if ($ikkuna === 'tilaukset' && kirjautunutAsiakas()) {
    $sivu = 'tilaukset.php';
} else if ($ikkuna === 'tarkempiatilaustietoja' && (kirjautunutAsiakas() || kirjautunutYllapitaja())) {
    $sivu = 'tarkempiatilaustietoja.php';
} else if ($ikkuna === 'nykyinentilaus' && kirjautunutAsiakas()) {
    $sivu = 'nykyinentilaus.php';
} else if ($ikkuna === 'tuoteryhmat') {
    $sivu = 'tuoteryhmalista.php';
} else {
    header('Location: index.php?ikkuna=etusivu');
}
require 'views/pohja.php';
exit();
?>


