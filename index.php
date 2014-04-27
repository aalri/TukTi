<link href=" css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<?php
require_once 'libs/models/nykyinentilaus.php';
require_once 'libs/models/asiakas.php';
require_once 'libs/common.php';
$ikkuna = (String) $_GET['ikkuna'];
if ($ikkuna === 'etusivu') {
    $sivu = 'etusivu.php';
} else if ($ikkuna === 'tarkempiatilaustietoja' && (kirjautunutAsiakas() || kirjautunutYllapitaja())) {
    $sivu = 'tarkempiatilaustietoja.php';
} else if ($ikkuna === 'tuoteryhmat' && !kirjautunutYllapitaja()) {
    $sivu = 'tuoteryhmalista.php';
} else if ($ikkuna === 'tuoteryhma'&& !kirjautunutYllapitaja()) {
        $sivu = 'tuoteryhma.php';
} else if (kirjautunutYllapitaja()) {
    if ($ikkuna === 'varasto') {
        $sivu = 'varasto.php';
    } else if ($ikkuna === 'muokkaatuote') {
        $sivu = 'muokkaatuote.php';
    } else if ($ikkuna === 'lisaauusituote') {
        $sivu = 'lisaauusituote.php';
    } else if ($ikkuna === 'kaikkilaskut') {
        $sivu = 'kaikkilaskut.php';
    } else if ($ikkuna === 'asiakkaat') {
        $sivu = 'asiakkaat.php';
    } else if ($ikkuna === 'tuoteryhmatjatuotteet') {
        $sivu = 'tuoteryhmatjatuotteet.php';
    } else if ($ikkuna === 'lisaauusituoteryhma') {
        $sivu = 'lisaauusituoteryhma.php';
    } else if ($ikkuna === 'muokkaatuoteryhmannimea') {
        $sivu = 'muokkaatuoteryhmannimea.php';
    } else if ($ikkuna === 'muokkaatuoteryhmaankuuluvattuotteet') {
        $sivu = 'muokkaatuoteryhmaankuuluvattuotteet.php';
    } else if ($ikkuna === 'kaikkitilaukset') {
        $sivu = 'kaikkitilaukset.php';
    } else if ($ikkuna === 'automaattisetvarastontaydennykset') {
        $sivu = 'automaattisetvarastontaydennykset.php';    
    } else {
        header('Location: index.php?ikkuna=etusivu');
    }
} else if (kirjautunutAsiakas()) {
    if ($ikkuna === 'tiedot') {
        $sivu = 'tiedot.php';
    } else if ($ikkuna === 'muokkaatietojani') {
        $sivu = 'muokkaatietojani.php';
    } else if ($ikkuna === 'laskut') {
        $sivu = 'laskuni.php';
    } else if ($ikkuna === 'tilaukset') {
        $sivu = 'tilaukset.php';
    } else if ($ikkuna === 'nykyinentilaus') {
        $sivu = 'nykyinentilaus.php';
    } else if ($ikkuna === 'tilaa') {
        $sivu = 'tilaa.php';
    } else {
        header('Location: index.php?ikkuna=etusivu');
    }
} else {
    header('Location: index.php?ikkuna=etusivu');
}

require 'views/pohja.php';
exit();
?>


