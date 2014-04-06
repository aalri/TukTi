<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
require_once 'libs/models/kuuluuryhmiin.php';
$sivu = 1;
$rivimaara = 5;
$lkm = Tuoteryhma::lukumaara();
$sivuja = ceil($lkm / $rivimaara);
if (isset($_GET['sivu'])) {
    $sivu = (int) $_GET['sivu'];
    if ($sivu < 1){
        $sivu = 1;
    }
    if ($sivu > $sivuja){
        $sivu = $sivuja;
    }
}
if (!empty($_POST['poista'])){
    $tuoteryhmanro = $_POST['poista'];
    $tuoteryhma = Tuoteryhma::etsiNumerolla($tuoteryhmanro);
    Tuoteryhma::poista($tuoteryhmanro);
    $_SESSION['ilmoitus'] = "Tuoteryhmä: '".$tuoteryhma->getNimi()."' poistettu onnistuneesti";
    header('Location: index.php?ikkuna=tuoteryhmatjatuotteet$sivu='.$_GET['sivu']);
}
$lista = Tuoteryhma::getTuoteryhmatTiettyMaaraKohdasta($rivimaara, $rivimaara*($sivu-1));
naytaNakyma("tuoteryhmatjatuotteet.php", array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));
?>