<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
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
$lista = Tuoteryhma::getTuoteryhmatTiettyMaaraKohdasta($rivimaara, $rivimaara*($sivu-1));
naytaNakyma('tuoteryhmalista.php', array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));