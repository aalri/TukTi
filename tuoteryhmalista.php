<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
$rivimaara = 5;
if (isset($_POST['haku'])){
    
}
if (isset($_GET['haku'])){
    
}else{
$lkm = Tuoteryhma::lukumaara();
$sivuja = ceil($lkm / $rivimaara);
$sivu = annaNykyinenSivu($sivuja);
$lista = Tuoteryhma::getTuoteryhmatTiettyMaaraKohdasta($rivimaara, $rivimaara*($sivu-1));
naytaNakyma('tuoteryhmalista.php', array('lista' => $lista, 'sivu' => $sivu, 'sivuja' => $sivuja));
}